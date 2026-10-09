<?php

/**
 * プロフィール（スラッグ profile の固定ページ）。経歴とスキルは本文に書く。
 */

get_header();

while (have_posts()) :
	the_post();
?>

	<article class="container container--narrow">
		<header class="page-header">
			<h1 class="page-header__title"><?php the_title(); ?></h1>
		</header>

		<div class="entry-content">
			<?php /*the_content();*/ ?>
			<h2><?php echo esc_html('自己紹介'); ?></h2>
			<p><?php echo nl2br(esc_html('都内在住のフルスタックエンジニアです。長年の製造業（FA 機器開発）でのソフトウェア開発と、営業・組織運営の経験を経て、現在はモダンな Web 技術を使ったアプリケーション開発に取り組んでいます。

【実務経験】
・LINE を活用したマーケティングリサーチプラットフォーム
　既存システムの機能改修・品質改善（PHP / Laravel、静的解析、テストの拡充）

【主な制作実績】
・フリマアプリ（Laravel、Stripe 決済、Render で公開）
　決済処理を再利用できる部品として設計し、Webhook による購入確定と二重販売の防止を実装
・Wandering Log（Next.js、Google Maps 連携、AI チャット）
　地図上で訪問先を記録するアプリ。複数のモーダルの連動と重なり順を自前で管理
・stripe-subscription-kit（npm で公開）
　Next.js などで Stripe のサブスクリプションを組み込むための自作パッケージ

【対応できる業務】
・Web アプリケーション開発（フルスタック）
・Stripe 決済の導入
・データベース設計
・Vercel、Render などへのデプロイと運用
・要件整理から実装まで一貫した対応

【使用スキル】
フロントエンド：Next.js、React、TypeScript
バックエンド：Node.js、PHP、Laravel、PostgreSQL、Drizzle ORM
認証・決済：NextAuth.js、Stripe
インフラ：Vercel、Render、Supabase、Docker

【稼働】
フルリモート希望

長年の社会人経験を活かし、納期遵守と丁寧な報告・連絡・相談を徹底します。技術の視点だけでなく、現場での「使いやすさ」を意識した提案を心がけています。

小さなご相談から開発案件まで、お気軽にご相談ください。
')); ?></p>
		</div>
		<div class="entry-content">
			<?php /*the_content();*/ ?>
			<h2><?php echo esc_html('経歴'); ?></h2>
			<?php $data = portfolio_site_data(); ?>
			<?php foreach ($data['career'] as $item): ?>
				<h3><?php echo esc_html($item['title']); ?></h3>
				<p><?php echo esc_html($item['period']); ?></p>
				<p><?php echo nl2br(esc_html($item['text'])); ?></p>
			<?php endforeach; ?>
		</div>
		<footer class="work__footer">
			<p><a class="button" href="<?php echo esc_url(home_url('/#works')); ?>">作品を見る</a></p>
		</footer>
	</article>

<?php
endwhile;

get_footer();
