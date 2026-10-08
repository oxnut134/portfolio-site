</main>

<footer class="site-footer">
	<div class="container site-footer__inner">
		<ul class="site-footer__links">
			<?php foreach ( portfolio_site_data()['footer_links'] as $link ) : ?>
				<li><a href="<?php echo esc_url( $link['url'] ); ?>" rel="me noopener"><?php echo esc_html( $link['label'] ); ?></a></li>
			<?php endforeach; ?>
		</ul>
		<p class="site-footer__copy">&copy; <?php echo esc_html( wp_date( 'Y' ) ); ?> <?php bloginfo( 'name' ); ?></p>
	</div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
