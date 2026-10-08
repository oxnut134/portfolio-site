<?php
/**
 * トップ: 一言の自己紹介、作品一覧、プロフィールへの導線。
 */

$site  = portfolio_site_data();
$works = portfolio_get_works();

get_header();
?>

<section class="hero">
	<div class="container">
		<h1 class="hero__title"><?php bloginfo( 'name' ); ?></h1>
		<p class="hero__intro"><?php echo esc_html( $site['intro'] ); ?></p>
	</div>
</section>

<section class="section" id="works" aria-labelledby="works-heading">
	<div class="container">
		<h2 class="section__title" id="works-heading">作品</h2>

		<?php if ( $works->have_posts() ) : ?>
			<div class="work-grid">
				<?php
				while ( $works->have_posts() ) :
					$works->the_post();
					get_template_part( 'template-parts/work-card' );
				endwhile;
				wp_reset_postdata();
				?>
			</div>
		<?php else : ?>
			<p>作品は準備中です。</p>
		<?php endif; ?>
	</div>
</section>

<section class="section section--muted" aria-labelledby="profile-heading">
	<div class="container">
		<h2 class="section__title" id="profile-heading">プロフィール</h2>
		<p><?php echo esc_html( $site['profile_lead'] ); ?></p>
		<p><a class="button" href="<?php echo esc_url( portfolio_profile_url() ); ?>">プロフィールを見る</a></p>
	</div>
</section>

<?php
get_footer();
