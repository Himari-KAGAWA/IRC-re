<?php get_header(); ?>

<main class="main">
  <div class="main__lower-image wow fadeInUp"></div>
  <section class="sub-mv sub-mv__bg sub-mv__bg--contact wow fadeIn">
    <div class="sub-mv_inner">
      <div class="sub-mv__header">
        <h1 class="sub-mv__title sub-mv__title--price">contact</h1>
      </div>
    </div>
  </section>

  <!-- breadcrumbs -->
  <?php get_template_part('breadcrumb'); ?>
  <!-- /breadcrumbs -->

  <!-- page-contents -->
  <div class="page top-page">
    <div class="page__content page-contact">
      <div class="page-contact__inner">
        <div class="page-contact__attention wow fadeIn">
          <p>
            お急ぎの場合はお電話でお問合せ下さい。
            <br />
            TEL：
            <a href="tel:0123-456-7890">0123-456-7890</a>
          </p>
        </div>
        <div class="page-contact__form-wrapper wow fadeIn">

          <?php echo do_shortcode('[contact-form-7 id="aa21727" title="お問合せ"]'); ?>

        </div>
      </div>
    </div>
  </div>
  <!-- /page-contents -->
</main>

<?php get_footer(); ?>