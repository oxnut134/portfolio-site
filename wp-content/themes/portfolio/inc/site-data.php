<?php
/**
 * サイト全体で使う文言とリンク。管理画面ではなく、ここ（Git）で管理する。
 */

function portfolio_site_data() {
	return array(
		// トップの <title> でサイト名の後ろに付ける文（「サイト名 | これ」になる）
		'title_tagline' => 'Web エンジニア ポートフォリオ',

		// トップの見出し
		'headline'     => '設計から公開まで一貫して対応します。',

		// トップの見出しの右上に出すバッジ
		'hero_badges'  => array( 'Next.js', 'Laravel' ),

		// ヘッダーのロゴの文字、名前の下の肩書き、相談ボタンのリンク先
		'logo_text'    => 'To',
		'header_role'  => 'Web Developer',
		'contact_url'  => 'https://forms.gle/SizQQz8tqX7aGNHU9',

		// トップに出す自己紹介。meta description（抜粋のないページ）にも使う
		'intro'        => 'FA機器のソフトウェア開発や営業の経験を経て、現在はLaravelやNext.jsでWebアプリケーション開発に取り組んでいます。',

		// トップの「仕事の進め方」。image は assets/images/ のファイル名、source は作業の中身
		'process_steps' => array(
			array(
				'image'  => 'step1-hearing.webp',
				'title'  => '聞く',
				'text'   => '要望・課題の整理',
				'source' => 'ヒアリング',
			),
			array(
				'image'  => 'step2-idea.webp',
				'title'  => '決める',
				'text'   => '要件定義',
				'source' => 'アプリ設計',
			),
			array(
				'image'  => 'step3-coding.webp',
				'title'  => '作る',
				'text'   => '実装・テスト',
				'source' => 'Next.js・Laravel',
			),
			array(
				'image'  => 'step4-delivery.webp',
				'title'  => '届ける',
				'text'   => '公開・運用',
				'source' => 'デプロイ・保守',
			),
		),

		// トップの作品カードに出す技術タグ（作品のスラッグ => 3 つまで）。詳細ページには全部出る
		'card_techs'    => array(
			'qualitative-research' => array( 'Laravel', 'PHPUnit', 'PHPStan' ),
			'frea-market'          => array( 'Laravel', 'Stripe', 'PostgreSQL' ),
			'wandering-log'        => array( 'Next.js', 'TypeScript', 'Google Maps API' ),
		),

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
				'text'   => '2025年3月～9月　プログラミングスクール受講(HTML/CSS/Laravel/PHP/MySQL/Docker,等)
2025年10月～12月　フロントエンド習得(JavaScript/Next.js/React/TypeScript, 等）
2026年1月　プロテスト合格
2026年1月～6月
　アプリ開発・ポートフォリオ作成（shop-reminder, wandering-log,他）
　利用技術：Next.js/React/TypeScript,/postgreSQL/MySQL
　　　　　　Render/Vercel/googleMapsAPI/AI/Claude
2026年7月～9月
　Webサービス開発の実務案件に参画。PHPを用いた開発、GitHub上でのPR作成・レビュー対応、テストコードの拡
　充等を担当',
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
