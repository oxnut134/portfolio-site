<?php
/**
 * テーマの基本設定と CSS の読み込み。
 */

add_action( 'after_setup_theme', 'portfolio_setup' );
function portfolio_setup() {
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'html5', array( 'gallery', 'caption', 'style', 'script' ) );
	add_theme_support( 'wp-block-styles' );
	add_theme_support( 'responsive-embeds' );

	// 作品カード用の画像（16:10 で切り抜く）
	add_image_size( 'work-card', 800, 500, true );
}

add_action( 'wp_enqueue_scripts', 'portfolio_enqueue_assets' );
function portfolio_enqueue_assets() {
	$css = 'assets/css/main.css';
	wp_enqueue_style(
		'portfolio-main',
		get_theme_file_uri( $css ),
		array(),
		filemtime( get_theme_file_path( $css ) )
	);
}

/**
 * <meta name="description"> に入れる文。抜粋があればそれ、なければ一言の自己紹介。
 */
function portfolio_meta_description() {
	if ( is_singular() && has_excerpt() ) {
		return wp_strip_all_tags( get_the_excerpt() );
	}
	return portfolio_site_data()['intro'];
}

/**
 * プロフィールページの URL。
 */
function portfolio_profile_url() {
	$page = get_page_by_path( 'profile' );
	return $page ? get_permalink( $page ) : home_url( '/profile/' );
}
