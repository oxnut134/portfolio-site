<?php
/**
 * 作品カード。作品のループの中で呼ぶ。
 */

$terms = get_the_terms( get_the_ID(), 'tech' );
$techs = ( $terms && ! is_wp_error( $terms ) ) ? wp_list_pluck( $terms, 'name' ) : array();
$kind  = portfolio_work_meta( '_work_kind' );
$demo  = portfolio_work_meta( '_work_demo_url' );

// カードのタグは site-data の指定に絞る。指定がない作品は先頭の 3 つ
$card_techs = portfolio_site_data()['card_techs'][ get_post_field( 'post_name' ) ] ?? $techs;
$card_techs = array_slice( array_intersect( $card_techs, $techs ), 0, 3 );
?>
<article class="work-card">
	<a class="work-card__link" href="<?php the_permalink(); ?>">
		<div class="work-card__image">
			<?php
			if ( has_post_thumbnail() ) {
				the_post_thumbnail( 'work-card', array( 'alt' => '' ) );
			}
			?>
			<?php if ( $kind ) : ?>
				<span class="work-card__kind"><?php echo esc_html( $kind ); ?></span>
			<?php endif; ?>
		</div>
		<div class="work-card__body">
			<h3 class="work-card__title"><?php the_title(); ?></h3>
			<?php if ( has_excerpt() ) : ?>
				<p class="work-card__excerpt"><?php echo esc_html( get_the_excerpt() ); ?></p>
			<?php endif; ?>
			<?php if ( $card_techs ) : ?>
				<ul class="tag-list">
					<?php foreach ( $card_techs as $tech ) : ?>
						<li class="tag"><?php echo esc_html( $tech ); ?></li>
					<?php endforeach; ?>
				</ul>
			<?php endif; ?>
		</div>
	</a>
	<?php // カード全体が詳細ページへのリンクなので、入れ子にしないようリンクの外に置く ?>
	<?php if ( $demo ) : ?>
		<p class="work-card__actions">
			<a
				class="button button--try"
				href="<?php echo esc_url( $demo ); ?>"
				target="_blank"
				rel="noopener"
				aria-label="<?php the_title_attribute(); ?>をお試し（新しいタブで開く）"
			>お試し</a>
		</p>
	<?php endif; ?>
</article>
