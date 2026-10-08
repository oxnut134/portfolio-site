<?php
/**
 * プロフィール（スラッグ profile の固定ページ）。経歴とスキルは本文に書く。
 */

get_header();

while ( have_posts() ) :
	the_post();
	?>

	<article class="container container--narrow">
		<header class="page-header">
			<h1 class="page-header__title"><?php the_title(); ?></h1>
		</header>

		<div class="entry-content">
			<?php the_content(); ?>
		</div>

		<footer class="work__footer">
			<p><a class="button" href="<?php echo esc_url( home_url( '/#works' ) ); ?>">作品を見る</a></p>
		</footer>
	</article>

	<?php
endwhile;

get_footer();
