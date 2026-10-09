<?php

/**
 * プロフィール（スラッグ profile の固定ページ）。経歴とスキルは本文に書く。
 */

get_header();

while (have_posts()) :
	the_post();
?>

	<article class="container container--narrow">
		<header class="page-header">
			<h1 class="page-header__title"><?php the_title(); ?></h1>
		</header>

		<div class="entry-content">
			<?php /*the_content();*/ ?>
			<h2><?php echo esc_html('経歴'); ?></h2>
			<?php $data = portfolio_site_data(); ?>
			<?php foreach ($data['career'] as $item): ?>
				<h3><?php echo esc_html($item['title']); ?></h3>
				<p><?php echo esc_html($item['period']); ?></p>
				<p><?php echo nl2br(esc_html($item['text'])); ?></p>
			<?php endforeach; ?>
		</div>

		<footer class="work__footer">
			<p><a class="button" href="<?php echo esc_url(home_url('/#works')); ?>">作品を見る</a></p>
		</footer>
	</article>

<?php
endwhile;

get_footer();
