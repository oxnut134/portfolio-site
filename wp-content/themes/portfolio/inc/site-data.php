<?php
/**
 * サイト全体で使う文言とリンク。管理画面ではなく、ここ（Git）で管理する。
 */

function portfolio_site_data() {
	return array(
		// トップに出す一言の自己紹介（仮）
		'intro'        => 'Laravel を中心に、使う人の流れから考えて Web アプリケーションを作っています。',

		// プロフィールへの導線に添える文（仮）
		'profile_lead' => '経歴と、扱える技術をまとめています。',

		// 全ページのフッターに出すリンク。ランサーズと CrowdWorks の URL は仮
		'footer_links' => array(
			array(
				'label' => 'GitHub',
				'url'   => 'https://github.com/oxnut134',
			),
			array(
				'label' => 'ランサーズ',
				'url'   => 'https://www.lancers.jp/profile/your-id',
			),
			array(
				'label' => 'CrowdWorks',
				'url'   => 'https://crowdworks.jp/public/employees/your-id',
			),
		),
	);
}
