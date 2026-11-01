<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="<?php echo esc_attr( portfolio_meta_description() ); ?>">
	<link rel="icon" type="image/png" href="<?php echo esc_url( get_template_directory_uri() . '/favicon.png' ); ?>">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<a class="skip-link" href="#main">本文へ移動</a>

<?php
$site       = portfolio_site_data();
$github_url = array_column( $site['footer_links'], 'url', 'label' )['GitHub'] ?? '';
?>
<header class="site-header">
	<div class="container site-header__inner">
		<a class="site-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>">
			<span class="site-brand__logo" aria-hidden="true"><?php echo esc_html( $site['logo_text'] ); ?></span>
			<span class="site-brand__text">
				<span class="site-brand__name"><?php bloginfo( 'name' ); ?></span>
				<span class="site-brand__role"><?php echo esc_html( $site['header_role'] ); ?></span>
			</span>
		</a>
		<nav class="site-nav" aria-label="メインメニュー">
			<a
				class="site-nav__link"
				href="<?php echo esc_url( home_url( '/#works' ) ); ?>"
				<?php echo ( is_front_page() || is_singular( 'work' ) ) ? 'aria-current="true"' : ''; ?>
			>作品</a>
			<a
				class="site-nav__link"
				href="<?php echo esc_url( portfolio_profile_url() ); ?>"
				<?php echo is_page( 'profile' ) ? 'aria-current="page"' : ''; ?>
			>プロフィール</a>
			<?php if ( $github_url ) : ?>
				<a class="site-nav__icon" href="<?php echo esc_url( $github_url ); ?>" rel="me noopener" aria-label="GitHub">
					<svg viewBox="0 0 16 16" width="22" height="22" fill="currentColor" aria-hidden="true" focusable="false">
						<path d="M8 0C3.58 0 0 3.58 0 8c0 3.54 2.29 6.53 5.47 7.59.4.07.55-.17.55-.38 0-.19-.01-.82-.01-1.49-2.01.37-2.53-.49-2.69-.94-.09-.23-.48-.94-.82-1.13-.28-.15-.68-.52-.01-.53.63-.01 1.08.58 1.23.82.72 1.21 1.87.87 2.33.66.07-.52.28-.87.51-1.07-1.78-.2-3.64-.89-3.64-3.95 0-.87.31-1.59.82-2.15-.08-.2-.36-1.02.08-2.12 0 0 .67-.21 2.2.82.64-.18 1.32-.27 2-.27s1.36.09 2 .27c1.53-1.04 2.2-.82 2.2-.82.44 1.1.16 1.92.08 2.12.51.56.82 1.27.82 2.15 0 3.07-1.87 3.75-3.65 3.95.29.25.54.73.54 1.48 0 1.07-.01 1.93-.01 2.2 0 .21.15.46.55.38A8.01 8.01 0 0 0 16 8c0-4.42-3.58-8-8-8z"/>
					</svg>
				</a>
			<?php endif; ?>
			<a
				class="button site-nav__contact"
				href="<?php echo esc_url( $site['contact_url'] ); ?>"
				target="_blank"
				rel="noopener"
				aria-label="開発の相談をする（新しいタブで開く）"
			>開発の相談をする</a>
		</nav>
	</div>
</header>

<main id="main" class="site-main">
