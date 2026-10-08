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

# テーマ
wp theme activate portfolio

# プラグイン（足すときはここに追記する）
wp plugin install simply-static --activate
wp language plugin install --all ja || true

# Simply Static: export/ に相対パスで書き出す
wp option patch update simply-static delivery_method local
wp option patch update simply-static local_dir /var/www/export/
wp option patch update simply-static destination_url_type relative
wp option patch update simply-static clear_directory_before_export true --format=json

echo
echo "完了: $SITE_URL （管理画面: $SITE_URL/wp-admin）"
