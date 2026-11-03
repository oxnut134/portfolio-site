<?php
/**
 * 作品詳細。
 * 上から: 種別・タイトル・一言の概要（＋リード文） → デモ / GitHub のボタン
 * → 概要カード（担当・期間・技術・見どころ） → デモの入り方 → 本文（概要、スクリーンショット、
 * 主な機能、工夫した点、制作の経緯）→ GitHub リンク。
 * 最初の一画面で「何を・どこまで・いつ作ったか」と「どこで触れるか」が分かるようにする。
 */

get_header();

while ( have_posts() ) :
	the_post();

	$techs        = get_the_terms( get_the_ID(), 'tech' );
	$kind         = portfolio_work_meta( '_work_kind' );
	$lead         = portfolio_work_meta( '_work_lead' );
	$role         = portfolio_work_meta( '_work_role' );
	$period       = portfolio_work_meta( '_work_period' );
	$highlight    = portfolio_work_meta( '_work_highlight' );
	$demo_url     = portfolio_work_meta( '_work_demo_url' );
	$demo_account = portfolio_work_meta( '_work_demo_account' );
	$test_card    = portfolio_work_meta( '_work_test_card' );
	$github_url   = portfolio_work_meta( '_work_github_url' );
	$has_techs    = $techs && ! is_wp_error( $techs );
	?>

	<article class="container container--narrow work">
		<header class="page-header">
			<?php if ( $kind ) : ?>
				<p class="work__kind"><?php echo esc_html( $kind ); ?></p>
			<?php endif; ?>
			<h1 class="page-header__title"><?php the_title(); ?></h1>
			<?php if ( has_excerpt() ) : ?>
				<p class="page-header__lead"><?php echo esc_html( get_the_excerpt() ); ?></p>
			<?php endif; ?>
			<?php if ( $lead ) : ?>
				<p class="page-header__note"><?php echo nl2br( esc_html( $lead ) ); ?></p>
			<?php endif; ?>

			<?php if ( $demo_url || $github_url ) : ?>
				<p class="work__actions">
					<?php if ( $demo_url ) : ?>
						<a
							class="button button--try"
							href="<?php echo esc_url( $demo_url ); ?>"
							target="_blank"
							rel="noopener"
							aria-label="デモを試す（新しいタブで開く）"
						>デモを試す</a>
					<?php endif; ?>
					<?php if ( $github_url ) : ?>
						<a
							class="button button--outline"
							href="<?php echo esc_url( $github_url ); ?>"
							target="_blank"
							rel="noopener"
							aria-label="GitHub でコードを見る（新しいタブで開く）"
						>GitHub でコードを見る</a>
					<?php endif; ?>
				</p>
			<?php endif; ?>
		</header>

		<?php if ( $role || $period || $has_techs || $highlight ) : ?>
			<section class="work-summary" aria-label="作品の概要">
				<dl class="work-summary__list">
					<?php if ( $role ) : ?>
						<dt>担当</dt>
						<dd><?php echo esc_html( $role ); ?></dd>
					<?php endif; ?>
					<?php if ( $period ) : ?>
						<dt>期間</dt>
						<dd><?php echo esc_html( $period ); ?></dd>
					<?php endif; ?>
					<?php if ( $has_techs ) : ?>
						<dt>技術</dt>
						<dd>
							<ul class="tag-list">
								<?php foreach ( $techs as $tech ) : ?>
									<li class="tag"><?php echo esc_html( $tech->name ); ?></li>
								<?php endforeach; ?>
							</ul>
						</dd>
					<?php endif; ?>
					<?php if ( $highlight ) : ?>
						<dt>見どころ</dt>
						<dd><?php echo nl2br( esc_html( $highlight ) ); ?></dd>
					<?php endif; ?>
				</dl>
			</section>
		<?php endif; ?>

		<?php // デモの URL は上のボタンにあるので、ここは入り方だけ ?>
		<?php if ( $demo_account || $test_card ) : ?>
			<section class="demo-box" aria-labelledby="demo-heading">
				<h2 class="demo-box__title" id="demo-heading">デモの入り方</h2>
				<dl class="demo-box__list">
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
