<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="<?php echo esc_attr( portfolio_meta_description() ); ?>">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<a class="skip-link" href="#main">本文へ移動</a>

<header class="site-header">
	<div class="container site-header__inner">
		<a class="site-header__name" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a>
		<nav class="site-nav" aria-label="メインメニュー">
			<a href="<?php echo esc_url( home_url( '/#works' ) ); ?>">作品</a>
			<a href="<?php echo esc_url( portfolio_profile_url() ); ?>">プロフィール</a>
		</nav>
	</div>
</header>

<main id="main" class="site-main">
