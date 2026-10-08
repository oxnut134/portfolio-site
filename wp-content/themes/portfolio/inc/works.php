<?php
/**
 * 作品（投稿タイプ work）、使用技術（タクソノミー tech）、作品の入力欄。
 */

add_action( 'init', 'portfolio_register_works' );
function portfolio_register_works() {
	register_post_type(
		'work',
		array(
			'labels'       => array(
				'name'          => '作品',
				'singular_name' => '作品',
				'add_new_item'  => '作品を追加',
				'edit_item'     => '作品を編集',
				'all_items'     => '作品一覧',
				'search_items'  => '作品を検索',
				'not_found'     => '作品はまだありません',
			),
			'public'       => true,
			'has_archive'  => false, // 一覧はトップに出すので、/works/ のページは作らない
			'rewrite'      => array(
				'slug'       => 'works',
				'with_front' => false,
			),
			'menu_icon'    => 'dashicons-portfolio',
			'menu_position' => 5,
			'show_in_rest' => true, // ブロックエディターを使うために必要
			'supports'     => array( 'title', 'editor', 'excerpt', 'thumbnail', 'page-attributes' ),
			// 新しい作品の本文に最初から入る見出し。作品どうしで構成を揃えるため
			'template'     => array(
				array( 'core/heading', array( 'content' => '概要' ) ),
				array( 'core/paragraph', array( 'placeholder' => 'どんなアプリか、誰が何をするか' ) ),
				array( 'core/heading', array( 'content' => 'スクリーンショット' ) ),
				array( 'core/image' ),
				array( 'core/heading', array( 'content' => '主な機能' ) ),
				array( 'core/list' ),
				array( 'core/heading', array( 'content' => '工夫した点' ) ),
				array( 'core/paragraph', array( 'placeholder' => '何が課題で、どう解いたか' ) ),
				array( 'core/heading', array( 'content' => '制作の経緯' ) ),
				array( 'core/paragraph', array( 'placeholder' => 'なぜ作ったか、期間、体制' ) ),
			),
		)
	);

	register_taxonomy(
		'tech',
		'work',
		array(
			'labels'             => array(
				'name'          => '使用技術',
				'singular_name' => '使用技術',
				'add_new_item'  => '使用技術を追加',
				'search_items'  => '使用技術を検索',
			),
			'public'             => false, // 技術ごとのページは作らない
			'show_ui'            => true,
			'show_in_rest'       => true,
			'show_admin_column'  => true,
			'hierarchical'       => false,
			'rewrite'            => false,
		)
	);
}

/**
 * 作品の入力欄の定義。キー => ラベル、種類、補足。
 */
function portfolio_work_fields() {
	return array(
		'_work_demo_url'     => array(
			'label' => 'デモ URL',
			'type'  => 'url',
			'help'  => '',
		),
		'_work_demo_account' => array(
			'label' => 'デモアカウント',
			'type'  => 'textarea',
			'help'  => 'ログインの方法や ID・パスワード。全世界に公開されるので、デモ専用のものだけを書く。',
		),
		'_work_test_card'    => array(
			'label' => 'テスト用カード番号',
			'type'  => 'text',
			'help'  => '例: 4242 4242 4242 4242',
		),
		'_work_github_url'   => array(
			'label' => 'GitHub リンク',
			'type'  => 'url',
			'help'  => '',
		),
	);
}

/**
 * 作品の入力欄の値を返す。未入力なら空文字。
 */
function portfolio_work_meta( $key, $post_id = null ) {
	return (string) get_post_meta( $post_id ? $post_id : get_the_ID(), $key, true );
}

add_action( 'add_meta_boxes_work', 'portfolio_add_work_meta_box' );
function portfolio_add_work_meta_box() {
	add_meta_box( 'portfolio-work-details', '作品の情報', 'portfolio_render_work_meta_box', 'work', 'normal', 'high' );
}

function portfolio_render_work_meta_box( $post ) {
	wp_nonce_field( 'portfolio_save_work', 'portfolio_work_nonce' );

	foreach ( portfolio_work_fields() as $key => $field ) {
		$value = portfolio_work_meta( $key, $post->ID );
		?>
		<p>
			<label for="<?php echo esc_attr( $key ); ?>"><strong><?php echo esc_html( $field['label'] ); ?></strong></label><br>
			<?php if ( 'textarea' === $field['type'] ) : ?>
				<textarea class="widefat" rows="3" id="<?php echo esc_attr( $key ); ?>" name="<?php echo esc_attr( $key ); ?>"><?php echo esc_textarea( $value ); ?></textarea>
			<?php else : ?>
				<input class="widefat" type="<?php echo esc_attr( $field['type'] ); ?>" id="<?php echo esc_attr( $key ); ?>" name="<?php echo esc_attr( $key ); ?>" value="<?php echo esc_attr( $value ); ?>">
			<?php endif; ?>
			<?php if ( $field['help'] ) : ?>
				<span class="description"><?php echo esc_html( $field['help'] ); ?></span>
			<?php endif; ?>
		</p>
		<?php
	}
}

add_action( 'save_post_work', 'portfolio_save_work_meta' );
function portfolio_save_work_meta( $post_id ) {
	if ( ! isset( $_POST['portfolio_work_nonce'] )
		|| ! wp_verify_nonce( sanitize_key( $_POST['portfolio_work_nonce'] ), 'portfolio_save_work' ) ) {
		return;
	}
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}

	foreach ( portfolio_work_fields() as $key => $field ) {
		$raw = isset( $_POST[ $key ] ) ? wp_unslash( $_POST[ $key ] ) : '';

		if ( 'url' === $field['type'] ) {
			$value = esc_url_raw( trim( $raw ) );
		} elseif ( 'textarea' === $field['type'] ) {
			$value = sanitize_textarea_field( $raw );
		} else {
			$value = sanitize_text_field( $raw );
		}

		if ( '' === $value ) {
			delete_post_meta( $post_id, $key );
		} else {
			update_post_meta( $post_id, $key, $value );
		}
	}
}

/**
 * 作品を並び順（「順序」欄の小さい順、同じなら新しい順）で取得する。
 */
function portfolio_get_works() {
	return new WP_Query(
		array(
			'post_type'      => 'work',
			'posts_per_page' => -1,
			'orderby'        => array(
				'menu_order' => 'ASC',
				'date'       => 'DESC',
			),
			'no_found_rows'  => true,
		)
	);
}
