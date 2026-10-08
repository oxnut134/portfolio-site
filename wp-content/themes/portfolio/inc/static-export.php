<?php
/**
 * 静的 HTML に書き出す前提の調整。
 * 公開先で動かないもの・不要なものの出力を止める。
 * ブロックエディターの CSS（wp-block-library など）は本文の表示に必要なので消さない。
 */

// 著者ページは作らない（管理者のユーザー名がわかってしまうため）
add_action( 'template_redirect', 'portfolio_disable_author_pages' );
function portfolio_disable_author_pages() {
	if ( is_author() ) {
		global $wp_query;
		$wp_query->set_404();
		status_header( 404 );
		nocache_headers();
	}
}

// サイトマップにもユーザー（著者ページ）を載せない
add_filter( 'wp_sitemaps_add_provider', 'portfolio_remove_users_sitemap', 10, 2 );
function portfolio_remove_users_sitemap( $provider, $name ) {
	return 'users' === $name ? false : $provider;
}

add_action( 'init', 'portfolio_remove_dynamic_head_output' );
function portfolio_remove_dynamic_head_output() {
	// フィード（書き出していない）
	remove_action( 'wp_head', 'feed_links', 2 );
	remove_action( 'wp_head', 'feed_links_extra', 3 );

	// REST API・外部編集ツール・oEmbed 向けの案内（公開先に PHP がないので届かない）
	remove_action( 'wp_head', 'rest_output_link_wp_head' );
	remove_action( 'wp_head', 'rsd_link' );
	remove_action( 'wp_head', 'wp_oembed_add_discovery_links' );
	remove_action( 'wp_head', 'wp_shortlink_wp_head' );
	remove_action( 'template_redirect', 'rest_output_link_header', 11 );
	remove_action( 'template_redirect', 'wp_shortlink_header', 11 );

	// WordPress のバージョン表示
	remove_action( 'wp_head', 'wp_generator' );

	// 絵文字を画像に置き換えるスクリプトと、その CSS（端末の絵文字で足りる）
	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'wp_print_styles', 'print_emoji_styles' );
	remove_action( 'wp_enqueue_scripts', 'wp_enqueue_emoji_styles' );
	add_filter( 'emoji_svg_url', '__return_false' );
}
