#!/usr/bin/env bash
# Simply Static で静的 HTML を export/ に書き出す（管理画面の「生成」と同じ処理）。
# export/ は毎回空にしてから書き出される。
set -euo pipefail
cd "$(dirname "$0")/.."

wp() { docker compose run --rm -T wpcli wp "$@" 2>/dev/null; }

wp eval 'Simply_Static\Plugin::instance()->run_static_export() || WP_CLI::error( "書き出しを開始できませんでした（実行中の書き出しがないか確認）" );'
echo "書き出し中…（数分かかります）"

# 処理は wordpress コンテナ側でバックグラウンド実行されるので、終わるまで待つ
for _ in $(seq 1 120); do
  sleep 5
  state=$(wp eval 'echo Simply_Static\Plugin::instance()->get_archive_creation_job()->is_job_done() ? "done" : "running";')
  [ "$state" = done ] && break
done

wp eval 'foreach ( (array) get_option( "simply-static" )["archive_status_messages"] as $task => $m ) { echo $task . ": " . wp_strip_all_tags( $m["message"] ) . "\n"; }'

if [ "${state:-}" != done ]; then
  echo "時間内に終わりませんでした。管理画面の Simply Static で状況を確認してください。" >&2
  exit 1
fi
if [ ! -f export/index.html ]; then
  echo "export/index.html がありません。書き出しに失敗しています。" >&2
  exit 1
fi
echo "完了: export/ に HTML $(find export -name '*.html' | wc -l) 件、全 $(find export -type f | wc -l) ファイル"
