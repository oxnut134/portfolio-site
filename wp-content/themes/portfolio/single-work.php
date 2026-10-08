<?php
/**
 * 作品詳細。
 * 上から: タイトルと一言の概要 → 使用技術 → デモ → 本文（概要、スクリーンショット、
 * 主な機能、工夫した点、制作の経緯）→ GitHub リンク。
 */

get_header();

while ( have_posts() ) :
	the_post();

	$techs        = get_the_terms( get_the_ID(), 'tech' );
	$demo_url     = portfolio_work_meta( '_work_demo_url' );
	$demo_account = portfolio_work_meta( '_work_demo_account' );
	$test_card    = portfolio_work_meta( '_work_test_card' );
	$github_url   = portfolio_work_meta( '_work_github_url' );
	?>

	<article class="container container--narrow work">
		<header class="page-header">
			<h1 class="page-header__title"><?php the_title(); ?></h1>
			<?php if ( has_excerpt() ) : ?>
				<p class="page-header__lead"><?php echo esc_html( get_the_excerpt() ); ?></p>
			<?php endif; ?>
		</header>

		<?php if ( $techs && ! is_wp_error( $techs ) ) : ?>
			<section class="work__meta" aria-labelledby="tech-heading">
				<h2 class="work__meta-title" id="tech-heading">使用技術</h2>
				<ul class="tag-list">
					<?php foreach ( $techs as $tech ) : ?>
						<li class="tag"><?php echo esc_html( $tech->name ); ?></li>
					<?php endforeach; ?>
				</ul>
			</section>
		<?php endif; ?>

		<?php if ( $demo_url || $demo_account || $test_card ) : ?>
			<section class="demo-box" aria-labelledby="demo-heading">
				<h2 class="demo-box__title" id="demo-heading">デモ</h2>
				<dl class="demo-box__list">
					<?php if ( $demo_url ) : ?>
						<dt>URL</dt>
						<dd><a href="<?php echo esc_url( $demo_url ); ?>" rel="noopener"><?php echo esc_html( $demo_url ); ?></a></dd>
					<?php endif; ?>
					<?php if ( $demo_account ) : ?>
						<dt>デモアカウント</dt>
						<dd><?php echo nl2br( esc_html( $demo_account ) ); ?></dd>
					<?php endif; ?>
					<?php if ( $test_card ) : ?>
						<dt>テスト用カード番号</dt>
						<dd><code><?php echo esc_html( $test_card ); ?></code></dd>
					<?php endif; ?>
				</dl>
			</section>
		<?php endif; ?>

		<div class="entry-content">
			<?php the_content(); ?>
		</div>

		<footer class="work__footer">
			<?php if ( $github_url ) : ?>
				<p><a class="button" href="<?php echo esc_url( $github_url ); ?>" rel="noopener">GitHub でコードを見る</a></p>
			<?php endif; ?>
			<p><a href="<?php echo esc_url( home_url( '/#works' ) ); ?>">← 作品一覧へ戻る</a></p>
		</footer>
	</article>

	<?php
endwhile;

get_footer();
