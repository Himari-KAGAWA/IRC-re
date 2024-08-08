<?php get_header(); ?>

<main class="main">
  <div class="main__lower-image wow fadeInUp"></div>
  <section class="sub-mv sub-mv__bg sub-mv__bg--privacy wow fadeIn">
    <div class="sub-mv_inner">
      <div class="sub-mv__header">
        <h1 class="sub-mv__title sub-mv__title--privacy">
          privacy <span class="sub-mv__title-uppercase">p</span>olicy
        </h1>
      </div>
    </div>
  </section>

    <!-- breadcrumbs -->
    <?php get_template_part('breadcrumb'); ?>
  <!-- /breadcrumbs -->

  <!-- page-contents -->
  <div class="page top-page--privacy">
    <section class="legal-document">
      <div class="legal-document__inner inner wow fadeIn">
        <h2 class="legal-document__title"><?php echo esc_html(get_the_title()); ?></h2>

        <?php if (have_posts()) : ?>
          <?php while (have_posts()) : the_post(); ?>
            <div class="legal-document__content">
              <?php the_content(); ?>
            </div>
          <?php endwhile; ?>
        <?php else : ?>
          <p>現在、表示する内容はありません。</p>
        <?php endif; ?>

      </div>
    </section>
    <!-- /page-contents -->
  </div>

</main>

<?php get_footer(); ?>