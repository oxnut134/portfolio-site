<?php
/**
 * サイト全体で使う文言とリンク。管理画面ではなく、ここ（Git）で管理する。
 */

function portfolio_site_data() {
	return array(
		// トップに出す一言の自己紹介（仮）
		'intro'        => 'LaravelとNext.js を中心に Web アプリケーションを作っています。',

		// プロフィールへの導線に添える文（仮）
		'profile_lead' => '経歴と、扱える技術をまとめています。',
		// プロフィールの履歴
		'career' => array(
			array(
				'period' => '1984～1998',
				'title'  => 'FA用プリンターソフトウェア開発',
				'text'   => '自動車工場向けFAプリンター、ラベルプリンターなどの周辺ソフト、アプリケーションソフトを開発。
				ユーザーサポートも担当。',
			),
			array(
				'period' => '2024～2026',
				'title'  => 'WEBアプリ開発',
				'text'   => '2025年3月～9月　coachtech受講(HTML/CSS/Laravel/PHP/MySQL/Docker,等)
2025年10月～12月　frontend習得(JavaScrip/Next.js/React/TypeScript, 等）
2026年1月　プロテスト合格
2026年1月～6月
　アプリ開発・ポートフォリオ作成（shop-reminder, wandering-log,他）
　利用技術：Next.js/React/TypeScript,/postgreSQL
　　　　　　Render/Vercel/googleMapsAPI/AI/Claude
2026年6月～現在
　Webサービス開発の実務案件に参画。PHPを用いた開発、GitHub上での　　PR作成・レビュー対応、テストコードの拡充等を継続的に担当（稼働　　中）  
',
			),

		),
		// 全ページのフッターに出すリンク。ランサーズと CrowdWorks の URL は仮
		'footer_links' => array(
			array(
				'label' => 'GitHub',
				'url'   => 'https://github.com/oxnut134',
			),
			/*array(
				'label' => 'ランサーズ',
				'url'   => 'https://www.lancers.jp/profile/your-id',
			),
			array(
				'label' => 'CrowdWorks',
				'url'   => 'https://crowdworks.jp/public/employees/your-id',
			),*/
		),
	);
}
