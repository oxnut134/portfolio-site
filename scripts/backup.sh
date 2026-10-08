#!/usr/bin/env bash
# DB と uploads（アップロードした画像など）を backups/ に書き出す。
# コンテナが起動している状態で実行する。
set -euo pipefail
cd "$(dirname "$0")/.."

mkdir -p backups
stamp=$(date +%Y%m%d-%H%M%S)
db_file="backups/db-$stamp.sql.gz"
uploads_file="backups/uploads-$stamp.tar.gz"

docker compose exec -T db sh -c \
  'exec mariadb-dump --single-transaction -u"$MARIADB_USER" -p"$MARIADB_PASSWORD" "$MARIADB_DATABASE"' \
  | gzip > "$db_file"
echo "DB:      $db_file ($(du -h "$db_file" | cut -f1))"

# uploads はまだ 1 枚もアップロードしていないと存在しない。
# uploads/simply-static は書き出しの一時ファイルなので除く
if docker compose exec -T wordpress test -d /var/www/html/wp-content/uploads; then
  docker compose exec -T wordpress tar -czf - -C /var/www/html/wp-content --exclude=uploads/simply-static uploads > "$uploads_file"
  echo "uploads: $uploads_file ($(du -h "$uploads_file" | cut -f1))"
else
  echo "uploads: まだフォルダがないので省略"
fi
