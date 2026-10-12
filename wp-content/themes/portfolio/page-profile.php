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
			<p><?php echo nl2br(esc_html('私は、長年、FA機器関連のソフトウェア開発に携わった後、営業や組織運営など、技術以外の業務も経験してきました。そうした経験を通して、技術そのものだけでなく『誰が、どのように使うのか』を考えることの大切さを感じ、現在はモダンなWeb技術を使ったアプリケーション開発に取り組んでいます。これまでの開発経験とユーザー視点の両方を活かし、使いやすく継続的に改善できるサービスを作っていきたいと考えています。
		
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

長年の社会人経験を活かし、納期遵守と丁寧な報告・連絡・相談を徹底します。また、技術だけでなく、これまで営業や組織運営などで培った「要望を整理する力」「相手の意図を汲み取る力」「関係者と調整しながら進める力」などを十分に活かしながら、クライアントの皆様の課題を解決するアプリケーションを開発していきたいと考えております。

開発案件はもちろん、仕様が固まっていない段階の小さな案件まで、まずはお気軽にご相談ください。
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
