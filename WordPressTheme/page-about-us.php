<?php get_header(); ?>

<main class="main">
  <div class="main__lower-image wow fadeInUp"></div>
  <!-- 下層ページメインビュー -->
  <section class="sub-mv sub-mv__bg sub-mv__bg--about wow fadeIn">
    <div class="sub-mv_inner">
      <div class="sub-mv__header">
        <h1 class="sub-mv__title">about us</h1>
      </div>
    </div>
  </section>
  <!-- /下層ページメインビュー -->

  <!-- breadcrumbs -->
  <?php get_template_part('breadcrumb'); ?>
  <!-- /breadcrumbs -->

  <!-- page-contents -->
  <div class="page top-page--about">
    <div class="page__inner">
      <div class="page__content page-about">
        <div class="page-about__inner inner">
          <div class="page-about__img-wrapper wow fadeIn">
            <div class="page-about__img-left">
              <img src="<?php echo get_theme_file_uri(); ?>/assets/images/common/about-bg.jpg" alt="鐙と鞍の画像" />
            </div>
            <div class="page-about__img-right">
              <img src="<?php echo get_theme_file_uri(); ?>/assets/images/common/about-bg_2.jpg" alt="こちらを見つめる黒い馬の画像" />
            </div>
          </div>
          <div class="page-about__contents">
            <div class="page-about__lead wow fadeIn">
              We're
              <br />
              happy
              <br />
              together.
            </div>
            <div class="page-about__copy wow fadeIn">
              <p class="page-about__text u-desktop">
                私たちのクラブでは、馬との信頼関係を築くことを最も大切にしています。<br>言葉を話さない、自分とは違う意思を持つ相手と心を通わせることで得られる喜びは、他に代えがたいものです。<br>馬との触れ合いを通じて、心身ともに豊かな時間を過ごしていただけるよう、私たちがサポートします。
              </p>
            </div>
          </div>
          <p class="page-about__text u-mobile">
            私たちのクラブでは、馬との信頼関係を築くことを最も大切にしています。<br>
            言葉を話さない、自分とは違う意思を持つ相手と心を通わせることで得られる喜びは、他に代えがたいものです。
            <br>
            生涯にわたる学びの場として、皆さんがそれぞれの目標に向かって成長できるよう、私たちがサポートします。
            <br>
            馬との触れ合いを通じて、心身ともに豊かな時間を過ごしていただけることを願っています。
          </p>
          <div class="page-about__img-icon u-desktop wow fadeInUp">
            <img src="<?php echo get_theme_file_uri(); ?>/assets/images/common/horse-contact-illust.png" alt="馬の足跡風に並んだ蹄鉄" width="225" height="160" />
          </div>
        </div>

        <!-- ギャラリーセクション -->
        <!-- ギャラリー画像グループが空でないかチェック -->
        <?php $imgGroup = SCF::get('about_gallery'); ?>
        <?php if (!empty($imgGroup)) : ?>
          <section class="page-galley top-page-gallery">
            <div class="page-galley__inner inner">
              <div class="page-galley__header section-header wow fadeIn" data-wow-duration="1.5s">
                <div class="section-header__engtitle">gallery</div>
                <h2 class="section-header__jatitle">フォト</h2>
              </div>
              <div class="page-gallery__content">
                <div class="page-gallery__items">

                  <!-- ギャラリー画像呼出し -->
                  <?php foreach ($imgGroup as $imgItem) : ?>
                    <!-- 以下、画像・URL・altを取得 -->
                    <?php
                    $img_data = wp_get_attachment_image_src($imgItem['gallery_img'], 'full');
                    $url = $img_data[0];
                    // altテキストが未入力の場合は代替テキストを表示
                    $img_alt = !empty($imgItem['gallery_alt']) ? esc_attr($imgItem['gallery_alt']) : 'ギャラリー画像'; ?>
                    <div class="page-gallery__item js-modal__trigger wow fadeIn">
                      <img src="<?php echo esc_url($url); ?>" alt="<?php echo $img_alt; ?>" width="345" height="523" />
                    </div>
                  <?php endforeach; ?>
                </div>
              </div>
            </div>
          </section>
        <?php endif; ?>
        <!-- /ギャラリーセクション -->

      </div>

      <!-- modal本体 -->
      <div class="page-gallery__modal modal js-modal">
        <div class="modal__img-wrapper">
          <div class="modal__img">
            <!-- ここにクリックされたimgが書き込まれる -->
          </div>
        </div>
        <div class="modal__bg js-modal-close"></div>
      </div>
      <!-- /modal -->
    </div>
  </div>
  <!-- /page-contents -->

</main>
<?php get_footer(); ?>