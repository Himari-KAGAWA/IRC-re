<?php get_header(); ?>

<main class="main">
  <div class="main__lower-image wow fadeInUp"></div>
  <!-- 下層ページメインビュー -->
  <section class="sub-mv sub-mv__bg sub-mv__bg--blog wow fadeIn">
    <div class="sub-mv_inner">
      <div class="sub-mv__header">
        <h1 class="sub-mv__title sub-mv__title--blog">blog</h1>
      </div>
    </div>
  </section>
  <!-- /下層ページメインビュー -->

  <!-- breadcrumbs -->
  <?php get_template_part('breadcrumb'); ?>
  <!-- /breadcrumbs -->

  <!-- page-contents -->
  <div class="page-2rows top-page-2rows">
    <div class="page-2rows__inner inner">
      <div class="page-2rows__wrapper wow fadeIn">

        <!-- page-main -->
        <?php if (have_posts()) : ?>
          <?php while (have_posts()) : ?>
            <?php the_post(); ?>
            <div class="page-2rows__main page-blogDetail">
              <!-- 投稿の日付を表示 -->
              <time class="page-blogDetail__date" datetime="<?php the_time('c'); ?>"><?php the_time('Y.m/d'); ?></time>
              <!-- 投稿のタイトルを表示 -->
              <h1 class="page-blogDetail__title"><?php the_title(); ?></h1>
              <!-- 投稿のアイキャッチ画像を表示 -->
              <div class="page-blogDetail__img">
                <?php if (has_post_thumbnail()) : ?>
                  <?php the_post_thumbnail(); ?>
                <?php else : ?>
                  <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/common/no-img.png" alt="<?php echo esc_attr('No image'); ?>" width="301" height="201"> <!-- サムネイルがない場合はno-img画像を表示 -->
                <?php endif; ?>
              </div>
              <!-- 投稿の内容を表示 -->
              <div class="page-blogDetail__content">
                <?php the_content(); ?>
              </div>
            <?php endwhile; ?>
          <?php endif; ?>

          <!-- 前の記事・次の記事 -->
          <div class="pagination pagination--detail top-pagination">

            <?php
            // 前の記事を取得
            $previous_post = get_previous_post();

            // 次の記事を取得
            $next_post = get_next_post();
            ?>

            <?php if ($previous_post) : ?>
              <!-- 前の記事へのリンク -->
              <a href="<?php echo esc_url(get_permalink($previous_post->ID)); ?>" class="previouspostslink"></a>
            <?php endif; ?>

            <?php if ($next_post) : ?>
              <!-- 次の記事へのリンク -->
              <a href="<?php echo esc_url(get_permalink($next_post->ID)); ?>" class="nextpostslink"></a>
            <?php endif; ?>

          </div>
          <!-- /前の記事・次の記事 -->


            </div>
            <!-- /page-main -->

            <!-- sidebar -->
            <?php get_sidebar(); ?>
            <!-- /sidebar -->
      </div>

      <!-- /page-main -->
    </div>
  </div>
  <!-- /page-contents -->

</main>

<?php get_footer(); ?>