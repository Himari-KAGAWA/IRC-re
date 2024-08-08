<?php get_header(); ?>

<main class="main">
  <div class="main__lower-image wow fadeInUp"></div>
  <section class="sub-mv sub-mv__bg sub-mv__bg--contact wow fadeIn">
    <div class="sub-mv_inner">
      <div class="sub-mv__header">
        <h1 class="sub-mv__title sub-mv__title--blog">contact</h1>
      </div>
    </div>
  </section>

  <!-- breadcrumbs -->
  <?php get_template_part('breadcrumb'); ?>
  <!-- /breadcrumbs -->

  <!-- page-contents -->
  <div class="page top-page--thx">
    <div class="page__content page-thanks">
      <div class="page-thanks__inner">
        <div class="page-thanks__message wow fadeIn">
          <p class="page-thanks__complete">
            お問い合わせ内容を送信完了しました。
          </p>
          <p class="page-thanks__text">
            このたびは、お問い合わせ頂き
            <br class="u-mobile" />
            誠にありがとうございます。
            <br />
            お送り頂きました内容を確認の上、
            <br class="u-mobile" />
            3営業日以内に折り返しご連絡させて頂きます。
            <br />
            また、ご記入頂いたメールアドレスへ、
            <br class="u-mobile" />
            自動返信の確認メールをお送りしております。
          </p>
        </div>
      </div>
    </div>
  </div>
  <!-- /page-contents -->
</main>

<?php get_footer(); ?>