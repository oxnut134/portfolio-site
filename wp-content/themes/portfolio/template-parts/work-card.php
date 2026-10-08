<?php
/**
 * 作品カード。作品のループの中で呼ぶ。
 */

$techs = get_the_terms( get_the_ID(), 'tech' );
?>
<article class="work-card">
	<a class="work-card__link" href="<?php the_permalink(); ?>">
		<div class="work-card__image">
			<?php
			if ( has_post_thumbnail() ) {
				the_post_thumbnail( 'work-card', array( 'alt' => '' ) );
			}
			?>
		</div>
		<div class="work-card__body">
			<h3 class="work-card__title"><?php the_title(); ?></h3>
			<?php if ( has_excerpt() ) : ?>
				<p class="work-card__excerpt"><?php echo esc_html( get_the_excerpt() ); ?></p>
			<?php endif; ?>
			<?php if ( $techs && ! is_wp_error( $techs ) ) : ?>
				<ul class="tag-list">
					<?php foreach ( $techs as $tech ) : ?>
						<li class="tag"><?php echo esc_html( $tech->name ); ?></li>
					<?php endforeach; ?>
				</ul>
			<?php endif; ?>
		</div>
	</a>
</article>
