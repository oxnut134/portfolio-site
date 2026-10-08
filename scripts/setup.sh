#!/usr/bin/env bash
# 初期設定。コンテナの起動から WordPress のインストール・設定までを行う。
# 何度実行してもよい（インストール済みならインストールは飛ばし、設定だけ当て直す）。
set -euo pipefail
cd "$(dirname "$0")/.."

if [ ! -f .env ]; then
  echo ".env がありません。cp .env.example .env してパスワードを書き換えてください。" >&2
  exit 1
fi
set -a; . ./.env; set +a

SITE_URL=http://localhost:8000

wp() { docker compose run --rm -T wpcli wp "$@"; }

# バインドマウント先を Docker に root で作らせないよう、先に作っておく
mkdir -p export backups

docker compose up -d --wait

if ! wp core is-installed 2>/dev/null; then
  wp core install \
    --url="$SITE_URL" \
    --title="$WP_TITLE" \
    --admin_user="$WP_ADMIN_USER" \
    --admin_password="$WP_ADMIN_PASSWORD" \
    --admin_email="$WP_ADMIN_EMAIL" \
    --skip-email

  # サンプルのコンテンツと同梱プラグインを消す（初回だけ）
  wp post delete 1 2 3 --force || true
  wp plugin delete hello akismet || true
fi

# 日本語
wp language core install ja --activate
wp option update timezone_string Asia/Tokyo
wp option update date_format 'Y年n月j日'
wp option update time_format 'H:i'

# 静的書き出しの前提
wp rewrite structure '/%postname%/'
wp option update default_comment_status closed
wp option update default_ping_status closed

# テーマ（作品の投稿タイプはテーマが登録するので、有効化のあとに URL のルールを作り直す）
wp theme activate portfolio
wp rewrite flush

# プロフィールの固定ページ（なければ仮の内容で作る。本文は管理画面で書き換える）
if [ -z "$(wp post list --post_type=page --name=profile --post_status=any --format=ids)" ]; then
  wp post create - --post_type=page --post_name=profile --post_title='プロフィール' --post_status=publish <<'HTML'
<!-- wp:heading -->
<h2 class="wp-block-heading">経歴</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>（仮）ここに経歴を書きます。</p>
<!-- /wp:paragraph -->

<!-- wp:heading -->
<h2 class="wp-block-heading">スキル</h2>
<!-- /wp:heading -->

<!-- wp:list -->
<ul class="wp-block-list"><!-- wp:list-item -->
<li>（仮）ここにスキルを書きます。</li>
<!-- /wp:list-item --></ul>
<!-- /wp:list -->
HTML
fi

# プラグイン（足すときはここに追記する）
wp plugin install simply-static --activate
wp language plugin install --all ja || true

# Simply Static: export/ に相対パスで書き出す
wp option patch update simply-static delivery_method local
wp option patch update simply-static local_dir /var/www/export/
wp option patch update simply-static destination_url_type relative
wp option patch update simply-static clear_directory_before_export true --format=json
wp option patch update simply-static generate_404 true --format=json
# リンクをたどって見つかったファイルだけを書き出す。
# true だと wp-includes が丸ごとコピーされ、約 70MB になる
wp option patch update simply-static smart_crawl false --format=json
# 著者ページは書き出さない（テーマ側でも 404 にしている）
wp option patch update simply-static urls_to_exclude '/author/'

echo
echo "完了: $SITE_URL （管理画面: $SITE_URL/wp-admin）"
