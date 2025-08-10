<?php get_header(); ?>

<main class="main">

  <!-- メインビジュアル（下層） -->
  <div class="main__lower-image js-in-view fade-in-up"></div>
  <section class="sub-mv sub-mv__bg sub-mv__bg--contact js-in-view fade-in">
    <div class="sub-mv_inner">
      <div class="sub-mv__header">
        <h1 class="sub-mv__title sub-mv__title--price">contact</h1>
      </div>
    </div>
  </section>

  <!-- breadcrumbs -->
  <?php get_template_part('breadcrumb'); ?>
  <!-- /breadcrumbs -->

  <!-- お問い合わせページ -->
  <div class="page top-page">
    <div class="page__content">

      <!-- フォームセクション -->
      <section class="section page-contact">
        <div class="page-content__inner inner">
          <!-- フォームの囲み -->
          <div class="form-wrapper js-in-view fade-in">

            <?php echo do_shortcode('[contact-form-7 id="aa21727" title="お問合せ"]'); ?>

          </div>

          <!-- Google reCAPTCHA表示 -->
          <div class="form__recaptcha">
            This site is protected by reCAPTCHA and the Google
            <br class="u-mobile">
            <a href="https://policies.google.com/privacy">Privacy Policy</a> and
            <a href="https://policies.google.com/terms">Terms of Service</a> apply.
          </div>

      </section>

    </div>
  </div>
  </div>
  <!-- /お問い合わせページ -->

</main>

<?php get_footer(); ?>