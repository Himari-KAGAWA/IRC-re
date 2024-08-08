<?php get_header(); ?>

<!-- 下層ページメインビュー -->

<main class="main">
  <div class="main__lower-image wow fadeInUp"></div>
  <section class="sub-mv sub-mv__bg sub-mv__bg--voice wow fadeIn">
    <div class="sub-mv_inner">
      <div class="sub-mv__header">
        <h1 class="sub-mv__title sub-mv__title--blog">voice</h1>
      </div>
    </div>
  </section>
  <!-- /下層ページメインビュー -->

  <!-- breadcrumbs -->
  <?php get_template_part('breadcrumb'); ?>
  <!-- /breadcrumbs -->

  <!-- page-contents -->
  <div class="page top-page">
    <div class="page__inner inner">
      <div class="page__content page-voice">
        <div class="page-voice__nav category-list">
          <ul class="category-list__items wow fadeIn">

            <!-- "ALL"という項目をリストの最初に追加 -->
            <li class="category-list__item">
              <a href="<?php echo esc_url(home_url('/voice')); ?>" class="category-list__item-link category category--link">ALL</a>
            </li>
            <!-- voice_categoryタクソノミーからすべてのカテゴリーを取得 -->
            <?php $voice_category_terms = get_terms('voice_category', array('hide_empty' => false)); ?>
            <!-- 取得したカテゴリーごとにリスト項目を作成 -->
            <?php foreach ($voice_category_terms as $voice_category_term) : ?>
              <li class="category-list__item">
                <!-- 各カテゴリーへのリンクを生成 -->
                <a href="<?php echo get_term_link($voice_category_term, 'voice_category'); ?>" class="category-list__item-link category category--link <?php if (is_tax('voice_category') && $voice_category_term->slug == get_queried_object()->slug) echo 'is-show'; ?>">
                  <?php echo $voice_category_term->name; ?>
                </a>
              </li>
            <?php endforeach; ?>

          </ul>
        </div>
        <!-- お客様の声カードのラッパー -->
        <div class="page-voice__items voice-cards">

          <!-- 投稿があるかどうかをチェック -->
          <?php if (have_posts()) : ?>
            <!-- 投稿がある間、ループを開始 -->
            <?php while (have_posts()) : the_post(); ?> <!-- whileループ内でthe_post()を直接使用 -->
              <!-- お客様の声カード -->
              <div class="voice-cards__item card-03 wow fadeIn">
                <div class="card-03__header">
                  <div class="card-03__left">
                    <div class="card-03__attribute">

                      <?php
                      // ACFからお客様情報のグループフィールドを取得
                      $metadata = get_field('metadata');

                      if ($metadata) {
                        $age = isset($metadata['age']) ? $metadata['age'] : '';
                        $gender = isset($metadata['gender']) ? $metadata['gender'] : '';
                      }
                      ?>
                      <!-- 性別と年代 -->
                      <p>
                        <?php if (!empty($age)) : ?>
                          <?php echo esc_html($age); ?>
                        <?php endif; ?>
                        <?php if (!empty($gender)) : ?>
                          (<?php echo esc_html($gender); ?>)
                        <?php endif; ?>
                      </p>

                      <!-- カテゴリー -->
                      <span class="category">
                        <?php
                        $categories = get_the_terms(get_the_ID(), 'voice_category');
                        if ($categories && !is_wp_error($categories)) {
                          foreach ($categories as $category) {
                            echo esc_html($category->name) . ' ';
                          }
                        }
                        ?>
                      </span>
                    </div>
                    <!-- タイトル -->
                    <h3 class="card-03__title">
                      <?php echo esc_html(get_the_title()); ?>
                    </h3>
                  </div>
                  <!-- サムネイル画像 -->
                  <div class="card-03__img js-inview">
                    <?php if (has_post_thumbnail()) : ?>
                      <?php the_post_thumbnail(); // 投稿にサムネイルがある場合は表示
                      ?>
                    <?php else : ?>
                      <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/common/no-img.png" alt="<?php echo esc_attr('No image'); ?>"> <!-- サムネイルがない場合はデフォルト画像を表示 -->
                    <?php endif; ?>
                  </div>
                </div>
                <!-- お客様の声本文 -->
                <div class="card-03__content">
                  <?php the_content(); ?>
                </div>
              </div>
              <!-- /voice-card -->
            <?php endwhile; ?>
          <?php else : ?>
            <p>現在、表示する投稿はありません。</p>
          <?php endif; ?>
        </div>
      </div>

      <!-- pagination -->
      <div class="pagination top-pagination">
        <?php wp_pagenavi(); ?>
      </div>
      <!-- /pagination -->

    </div>
  </div>
  <!-- /page-contents -->

</main>

<?php get_footer(); ?>