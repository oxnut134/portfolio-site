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
			<p><?php echo nl2br(esc_html('私は学生時代、研究室でプログラミングを始め、就職後は約15年、自動車工場や物流の現場で使われるFAプリンターのソフトウェアを開発してきました。お客様の要望を聞いて仕様をまとめるところから、現場への導入、保守までが私の担当でした。

その後は新製品の企画や営業、業界団体の事務局長など、技術以外の仕事を長く経験しましたが、定年を迎えたのを機に、やはり好きなプログラミングをもう一度仕事にしたいと考え、モダンなWeb開発を学び直しました。

現在は、Next.js や Laravel を使ったWebアプリを、企画から設計・実装・デプロイまで一人で作っています。また、業務委託でのチーム開発にも参加し、PRとコードレビューを通じて既存サービスの品質改善に取り組みました。

現場で毎日使われるソフトを作ってきた経験から、「誰が、どのように使うのか」を大切にしています。一人で作り切る力とチームで進める経験を活かして、使いやすく、改善し続けられるサービスを作っていきたいと考えています。
		
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
