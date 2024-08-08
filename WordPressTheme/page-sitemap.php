<?php get_header(); ?>

<main class="main">
  <div class="main__lower-image wow fadeIn"></div>
  <section class="sub-mv sub-mv__bg sub-mv__bg--siteMap wow fadeIn">
    <div class="sub-mv_inner">
      <div class="sub-mv__header">
        <h1 class="sub-mv__title sub-mv__title--siteMap">
          site
          <span class="sub-mv__title-uppercase">map</span>
        </h1>
      </div>
    </div>
  </section>

  <!-- breadcrumbs -->
  <?php get_template_part('breadcrumb'); ?>
  <!-- /breadcrumbs -->

  <!-- page-contents -->
  <div class="page top-page top-page--siteMap">
    <div class="page__icon"></div>
    <div class="page__inner inner">
      <div class="page__content sitemap wow fadeIn">
        <div class="sitemap__content">
          <ul class="sitemap__items1">
            <li class="sitemap__item sitemap__item-bold">
              <a href="<?php echo esc_url(home_url('/campaign')); ?>">キャンペーン</a>
            </li>
            <li class="sitemap__item">
              <a href="<?php echo esc_url(home_url('/')); ?>
/campaign_category/license">乗馬ライセンス取得</a>
            </li>
            <li class="sitemap__item">
              <a href="<?php echo esc_url(home_url('/')); ?>
/campaign_category/experience">乗馬体験プログラム</a>
            </li>
            <li class="sitemap__item">
              <a href="<?php echo esc_url(home_url('/')); ?>
/campaign_category/tour">外乗ツアープログラム</a>
            </li>
            <li class="sitemap__item sitemap__item-bold sitemap__item--layout">
              <a href="<?php echo esc_url(home_url('/about-us')); ?>">私たちについて</a>
            </li>
          </ul>
          <ul class="sitemap__items2">
            <li class="sitemap__item sitemap__item-bold">
              <a href="<?php echo esc_url(home_url('/Information')); ?>">乗馬メニュー情報</a>
            </li>
            <li class="sitemap__item">
              <a href="<?php echo esc_url(home_url('/Information#panel1')); ?>">
                メンバーシップ制度
              </a>
            </li>
            <li class="sitemap__item">
              <a href="<?php echo esc_url(home_url('/Information#panel3')); ?>">
                乗馬体験プログラム
              </a>
            </li>
            <li class="sitemap__item">
              <a href="<?php echo esc_url(home_url('/Information#panel2')); ?>">
                乗馬ライセンス取得
              </a>
            </li>
            <li class="sitemap__item sitemap__item-bold sitemap__item--layout">
              <a href="<?php echo esc_url(home_url('/blog')); ?>">ブログ</a>
            </li>
          </ul>
          <ul class="sitemap__items3">
            <li class="sitemap__item sitemap__item-bold">
              <a href="<?php echo esc_url(home_url('/voice')); ?>">お客様の声</a>
            </li>
            <li class="sitemap__item sitemap__item-bold sitemap__item--layout">
              <a href="<?php echo esc_url(home_url('/price')); ?>">料金一覧</a>
            </li>
            <li class="sitemap__item">
              <a href="<?php echo esc_url(home_url('/price#membership')); ?>">メンバーシップ</a>
            </li>
            <li class="sitemap__item">
              <a href="<?php echo esc_url(home_url('/price#experience_v')); ?>">乗馬体験プログラム</a>
            </li>
            <li class="sitemap__item">
              <a href="<?php echo esc_url(home_url('/price#license')); ?>">乗馬ライセンス取得</a>
            </li>
          </ul>
          <ul class="sitemap__items4">
            <li class="sitemap__item sitemap__item-bold">
              <a href="<?php echo esc_url(home_url('/faq')); ?>">よくある質問</a>
            </li>
            <li class="sitemap__item sitemap__item-bold sitemap__item--layout">
              <a href="<?php echo esc_url(home_url('/privacypolicy')); ?>">
                プライバシー
                <br class="u-mobile" />
                ポリシー
              </a>
            </li>
            <li class="sitemap__item sitemap__item-bold sitemap__item--layout">
              <a href="<?php echo esc_url(home_url('/terms-of-service')); ?>">利用規約</a>
            </li>
            <li class="sitemap__item sitemap__item-bold sitemap__item--layout">
              <a href="<?php echo esc_url(home_url('/sitemap')); ?>">サイトマップ</a>
            </li>
            <li class="sitemap__item sitemap__item-bold sitemap__item--layout">
              <a href="<?php echo esc_url(home_url('/contact')); ?>">お問わ合せ</a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <!-- /page-contents -->

</main>

<?php get_footer(); ?>