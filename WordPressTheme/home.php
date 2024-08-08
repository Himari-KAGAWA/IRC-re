<?php get_header(); ?>

<main class="main">
  <div class="main__lower-image wow fadeInUp"></div>
  <section class="sub-mv sub-mv__bg sub-mv__bg--blog wow fadeIn">
    <div class="sub-mv_inner">
      <div class="sub-mv__header">
        <h1 class="sub-mv__title sub-mv__title--blog">blog</h1>
      </div>
    </div>
  </section>

  <!-- breadcrumbs -->
  <?php get_template_part('breadcrumb'); ?>
  <!-- /breadcrumbs -->

  <!-- page-contents -->
  <div class="page-2rows top-page-2rows">
    <div class="page-2rows__inner inner">
      <div class="page-2rows__wrapper wow fadeIn">
        <!-- page-main -->
        <div class="page-2rows__main page-blog wow fadeIn">

          <!-- ブログカードのラッパー -->
          <div class="page-blog__items blog-cards blog-cards--2col">

            <!-- 投稿があるかどうかをチェック -->
            <?php if (have_posts()) : ?>
              <!-- 投稿がある間、ループを開始 -->
              <?php while (have_posts()) : ?>
                <?php the_post(); ?>

                <!-- ブログカード -->
                <article class="blog-cards__item card-02 wow fadeIn">
                  <a href="<?php the_permalink(); ?>" class="card-02__link">

                    <!-- 投稿のサムネイル画像 -->
                    <div class="card-02__img">
                      <?php if (has_post_thumbnail()) : ?>
                        <?php the_post_thumbnail(); ?>
                      <?php else : ?>
                        <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/common/no-img.png" alt="<?php echo esc_attr('No image'); ?>" width="301" height="201"> <!-- サムネイルがない場合はno-img画像を表示 -->
                      <?php endif; ?>
                    </div>

                    <!-- 投稿のヘッダー -->
                    <div class="card-02__header">
                      <!-- 投稿の日付 -->
                      <time class="card-02__date" datetime="<?php the_time('c'); ?>"><?php the_time('Y.m/d'); ?></time>
                      <!-- 投稿のタイトル -->
                      <h2 class="card-02__title"><?php the_title(); ?></h2>
                    </div>
                    <!-- 投稿のコンテンツ -->
                    <div class="card-02__content">
                      <!-- 投稿の抜粋を表示 -->
                      <p><?php the_excerpt(); ?></p>
                    </div>
                  </a>
                </article>
                <!-- /ブログカード -->
              <?php endwhile; ?>
            <?php endif; ?> <!-- 投稿がない場合、何も表示しない -->
          </div>

          <!-- /page-main -->

          <!-- pagination -->
          <div class="pagination top-pagination">
            <?php wp_pagenavi(); ?>
          </div>
          <!-- /pagination -->

        </div>

        <!-- sidebar -->
        <?php get_sidebar(); ?>
        <!-- /sidebar -->

      </div>
    </div>
  </div>
  <!-- /page-contents -->

</main>

<?php get_footer(); ?>