<?php get_header(); ?>

<main>

  <!-- breadcrumbs -->
  <?php get_template_part('breadcrumb'); ?>
  <!-- /breadcrumbs -->

  <!-- page-contents -->
  <div class="not-found">
    <div class="not-found__bg"></div>
    <div class="not-found__inner inner">
      <div class="not-found__wrapper wow fadeIn">
        <h1 class="not-found__message">404</h1>
        <p class="not-found__text">
          申し訳ありません。
          <br />
          お探しのページが見つかりません。
        </p>
        <div class="not-found__link">
          <a href="<?php echo esc_url(home_url('/')); ?>" class="link-button link-button--404">
            <span class="arrow-x arrow-x--400"></span>
          </a>
        </div>
      </div>
    </div>
  </div>
  <!-- /page-contents -->
</main>

<?php get_footer(); ?>