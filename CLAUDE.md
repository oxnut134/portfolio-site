# portfolio-site

WordPress で作るポートフォリオサイト。手元の Docker で作り、Simply Static で
静的 HTML に書き出して GitHub Pages / Cloudflare Pages で公開する。

## 環境
- 初回（または作り直し）: `cp .env.example .env` → `./scripts/setup.sh`
- 起動: `docker compose up -d` / 停止: `docker compose stop`
- サイト: http://localhost:8000 （管理画面は /wp-admin、ログイン情報は .env）
- WP-CLI: `docker compose run --rm wpcli wp <コマンド>`
- ポート 80, 5432, 8080, 8025, 1025 は ~/coachtech/frea-market が使うので使わない
- `docker compose down -v` は DB と画像が消えるので、確認なしに実行しない

## スクリプト
- `scripts/setup.sh` : 起動 + WordPress のインストールと設定。何度実行してもよい
- `scripts/export.sh`: 静的 HTML を export/ に書き出す（毎回 export/ を空にする）
- `scripts/backup.sh`: DB と uploads を backups/ に書き出す

## 構成
- 自作テーマ: wp-content/themes/portfolio/ （編集するのは基本ここだけ）
- WordPress 本体・プラグイン・uploads・DB は Docker ボリューム（Git 管理外）
- 設定の変更は管理画面で手作業せず scripts/setup.sh に WP-CLI で書く
- プラグインを足すときも setup.sh に追記する
- コンテナは uid 1000（ホストのユーザー）で動かしている。root で動かすと
  テーマや export/ の所有者がずれる
- コンテナ内の Apache は 80 に加えて 8000 でも待ち受ける
  （docker/apache/listen-8000.conf）。サイト URL にコンテナ自身から届かないと
  Simply Static が失敗するため。ポートを変えるときは compose.yaml、この conf、
  setup.sh の SITE_URL を揃える

## 静的書き出しの制約（テーマを書くときに守る）
- 公開先で PHP は動かない。フォーム・検索・コメントなど動的機能は使わない
- 表示時に admin-ajax / REST API を呼ばない
- URL は直書きせず home_url() / get_theme_file_uri() などを使う
- パーマリンクは /%postname%/
- 書き出しは相対パス。どこからもリンクされていないページは書き出されない

## Git
- .env, export/, backups/ はコミットしない
