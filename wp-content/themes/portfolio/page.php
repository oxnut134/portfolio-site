<?php
/**
 * そのほかの固定ページ。
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
	</article>

	<?php
endwhile;

get_footer();
