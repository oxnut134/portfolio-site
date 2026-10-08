<?php
/**
 * ページが見つからないとき。
 */

get_header();
?>

<div class="container container--narrow">
	<header class="page-header">
		<h1 class="page-header__title">ページが見つかりません</h1>
		<p class="page-header__lead">URL が変わったか、削除された可能性があります。</p>
	</header>
	<p><a class="button" href="<?php echo esc_url( home_url( '/' ) ); ?>">トップへ戻る</a></p>
</div>

<?php
get_footer();
