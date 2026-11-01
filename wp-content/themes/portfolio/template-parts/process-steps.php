<?php
/**
 * トップの「仕事の進め方」。文言は inc/site-data.php の process_steps。
 */

$steps = portfolio_site_data()['process_steps'];
?>
<section class="section process" aria-labelledby="process-heading">
	<div class="container">
		<h2 class="section__title" id="process-heading">仕事の進め方</h2>

		<ol class="process__list">
			<?php foreach ( $steps as $index => $step ) : ?>
				<li class="process__step">
					<img
						class="process__image"
						src="<?php echo esc_url( get_theme_file_uri( 'assets/images/' . $step['image'] ) ); ?>"
						width="600"
						height="600"
						alt=""
					>
					<div class="process__body">
						<h3 class="process__title">
							<span class="process__number"><?php echo esc_html( $index + 1 ); ?></span>
							<?php echo esc_html( $step['title'] ); ?>
						</h3>
						<p class="process__text"><?php echo esc_html( $step['text'] ); ?></p>
						<p class="process__source"><?php echo esc_html( $step['source'] ); ?></p>
					</div>
				</li>
			<?php endforeach; ?>
		</ol>
	</div>
</section>
