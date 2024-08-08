<?php get_header(); ?>

<main class="main">
  <div class="main__lower-image wow fadeInUp"></div>
  <section class="sub-mv sub-mv__bg sub-mv__bg--terms  wow fadeIn">
    <div class="sub-mv_inner">
      <div class="sub-mv__header">
        <h1 class="sub-mv__title sub-mv__title--terms">
          terms of
          <span class="sub-mv__title-uppercase">s</span><!--  -->ervice
        </h1>
      </div>
    </div>
  </section>

    <!-- breadcrumbs -->
  <?php get_template_part('breadcrumb'); ?>
  <!-- /breadcrumbs -->

  <!-- page-contents -->
  <div class="page top-page--terms">
    <section class="term-of-use">
      <div class="term-of-use__inner inner wow fadeIn">
        <h2 class="term-of-use__title"><?php echo esc_html(get_the_title()); ?></h2>

        <?php if (have_posts()) : ?>
          <?php while (have_posts()) : the_post(); ?>
            <div class="term-of-use__content">
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