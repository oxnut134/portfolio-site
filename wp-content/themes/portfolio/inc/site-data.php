<?php
/**
 * サイト全体で使う文言とリンク。管理画面ではなく、ここ（Git）で管理する。
 */

function portfolio_site_data() {
	return array(
		// トップの <title> でサイト名の後ろに付ける文（「サイト名 | これ」になる）
		'title_tagline' => 'Web エンジニア ポートフォリオ',

		// トップの見出し
		'headline'     => 'Next.js と Laravel で、設計から公開まで一貫して対応します。',

		// トップに出す自己紹介。meta description（抜粋のないページ）にも使う
		'intro'        => 'FA機器関連のソフトウェア開発や営業・組織運営の経験を経て、現在はLaravelやNext.jsを中心としたWebアプリケーション開発に取り組んでいます。これまで培ってきた要件理解やユーザー視点も活かしながら、使いやすさと保守性を意識した開発を行っています。',

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
				'period' => '1998～2008',
				'title'  => '新商品開発',
				'text'   => 'RFID・ICカード関連の新商品の企画・開発を担当し、マーケティングや営業も含めて商品化まで携わる。
				IT関連企業等に採用・販売実績あり',
			),
			array(
				'period' => '2008～2024',
				'title'  => '事務局運営・一般事務',
				'text'   => '会員企業との連絡・調整、会議や委員会の運営、その他一般事務',
			),
			array(
				'period' => '2024～2026',
				'title'  => 'Webアプリ開発',
				'text'   => '2025年3月～9月　COACHTECH受講(HTML/CSS/Laravel/PHP/MySQL/Docker,等)
2025年10月～12月　フロントエンド習得(JavaScript/Next.js/React/TypeScript, 等）
2026年1月　プロテスト合格
2026年1月～6月
　アプリ開発・ポートフォリオ作成（shop-reminder, wandering-log,他）
　利用技術：Next.js/React/TypeScript,/postgreSQL/MySQL
　　　　　　Render/Vercel/googleMapsAPI/AI/Claude
2026年6月～現在
　Webサービス開発の実務案件に参画。PHPを用いた開発、GitHub上でのPR作成・レビュー対応、テストコードの拡充等を継続的に担当  
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
