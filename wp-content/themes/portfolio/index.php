<?php
/**
 * 予備のテンプレート。専用のテンプレートがない表示のときに使われる。
 */

get_header();
?>

<div class="container container--narrow">
	<?php if ( have_posts() ) : ?>
		<?php
		while ( have_posts() ) :
			the_post();
			?>
			<article <?php post_class(); ?>>
				<header class="page-header">
					<h1 class="page-header__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
				</header>
				<div class="entry-content">
					<?php the_content(); ?>
				</div>
			</article>
		<?php endwhile; ?>
	<?php else : ?>
		<p>表示できる内容がありません。</p>
	<?php endif; ?>
</div>

<?php
get_footer();
