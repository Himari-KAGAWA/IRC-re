<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1.0" />
  <meta name="format-detection" content="telephone=no" />
  <!-- noindex -->
  <meta name="robots" content="noindex" />
  <!-- meta情報 -->

  <?php wp_head(); ?>
</head>

<body <?php if (!is_home()) { body_class(''); } ?>>

  <!-- header -->
  <header class="header <?php if (is_404()) {
                          echo 'header--no';
                        } ?>">
    <div class="header__inner">
      <h1 class="header__logo">
        <a href="<?php echo esc_url(home_url('/')); ?>" class="header__logo-link">
          <picture>
            <source srcset="<?php echo get_theme_file_uri(); ?>/assets/images/common/pc/logo-header_pc.png" media="(min-width:767px)" />
            <img src="<?php echo get_theme_file_uri(); ?>/assets/images/common/logo-header_sp.png" alt="今浪乗馬クラブ" width="152" height="58" />
          </picture>
        </a>
      </h1>
      <div class="header__drawer hamburger u-mobile js-hamburger">
        <span></span>
        <span></span>
        <span></span>
      </div>
      <!-- PCナビ -->
      <nav class="header__pc-nav pc-nav u-desktop">
        <ul class="pc-nav__items">
          <li class="pc-nav__item">
            <a href="<?php echo esc_url(home_url('/campaign')); ?>" class="pc-nav__link first">
              キャンペーン
              <span aria-hidden="true">Campaign</span>
            </a>
          </li>
          <li class="pc-nav__item">
            <a href="<?php echo esc_url(home_url('/about-us')); ?>">
              私たちについて
              <span aria-hidden="true">About us</span>
            </a>
          </li>
          <li class="pc-nav__item">
            <a href="<?php echo esc_url(home_url('/Information')); ?>">
              乗馬メニュー情報
              <span aria-hidden="true">Information</span>
            </a>
          </li>
          <li class="pc-nav__item">
            <a href="<?php echo esc_url(home_url('/blog')); ?>">
              ブログ
              <span aria-hidden="true">Blog</span>
            </a>
          </li>
          <li class="pc-nav__item">
            <a href="<?php echo esc_url(home_url('/voice')); ?>">
              お客様の声
              <span aria-hidden="true">Voice</span>
            </a>
          </li>
          <li class="pc-nav__item">
            <a href="<?php echo esc_url(home_url('/price')); ?>">
              料金一覧
              <span aria-hidden="true">Price</span>
            </a>
          </li>
          <li class="pc-nav__item">
            <a href="<?php echo esc_url(home_url('/faq')); ?>">
              よくある質問
              <span aria-hidden="true">FAQ</span>
            </a>
          </li>
          <li class="pc-nav__item">
            <a href="<?php echo esc_url(home_url('/contact')); ?>">
              お問合せ
              <span aria-hidden="true">Contact</span>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /PCナビ -->
      <!-- SPナビ -->
      <div class="header__sp-nav sp-nav js-sp-nav">
        <div class="sp-nav__header">
          <div class="sp-nav__logo">
            <a href="<?php echo esc_url(home_url('/')); ?>">
              <img src="<?php echo get_theme_file_uri(); ?>/assets/images/common/logo-header_sp.png" alt="今浪乗馬クラブ" width="152" height="58" />
            </a>
          </div>
        </div>
        <div class="sp-nav__inner inner">
          <div class="sp-nav__content">
            <ul class="sp-nav__items1">
              <li class="sp-nav__item sp-nav__item--bold">
                <a href="<?php echo esc_url(home_url('/campaign')); ?>">キャンペーン</a>
              </li>
              <li class="sp-nav__item">
                <a href="<?php echo esc_url(home_url('/')); ?>
/campaign_category/license">乗馬ライセンス取得</a>
              </li>
              <li class="sp-nav__item">
                <a href="<?php echo esc_url(home_url('/')); ?>
/campaign_category/experience">乗馬体験プログラム</a>
              </li>
              <li class="sp-nav__item">
                <a href="<?php echo esc_url(home_url('/')); ?>
/campaign_category/tour">外乗ツアー</a>
              </li>
              <li class="sp-nav__item sp-nav__item--bold sp-nav__item--layout">
                <a href="<?php echo esc_url(home_url('/about-us')); ?>">私たちについて</a>
              </li>
            </ul>
            <ul class="sp-nav__items2">
              <li class="sp-nav__item sp-nav__item--bold">
                <a href="<?php echo esc_url(home_url('/Information')); ?>">乗馬メニュー情報</a>
              </li>
              <li class="sp-nav__item">
                <a href="<?php echo esc_url(home_url('/Information#panel1')); ?>">
                  メンバーシップ制度
                </a>
              </li>
              <li class="sp-nav__item">
                <a href="<?php echo esc_url(home_url('/Information#panel3')); ?>">
                  乗馬体験プログラム
                </a>
              </li>
              <li class="sp-nav__item">
                <a href="<?php echo esc_url(home_url('/Information#panel2')); ?>">
                  乗馬ライセンス取得
                </a>
              </li>
              <li class="sp-nav__item sp-nav__item--bold sp-nav__item--layout">
                <a href="<?php echo esc_url(home_url('/blog')); ?>">ブログ</a>
              </li>
            </ul>
            <ul class="sp-nav__items3">
              <li class="sp-nav__item sp-nav__item--bold">
                <a href="<?php echo esc_url(home_url('/voice')); ?>">お客様の声</a>
              </li>
              <li class="sp-nav__item sp-nav__item--bold sp-nav__item--layout">
                <a href="<?php echo esc_url(home_url('/price')); ?>">料金一覧</a>
              </li>
              <li class="sp-nav__item">
                <a href="<?php echo esc_url(home_url('/price#membership')); ?>">メンバーシップ</a>
              </li>
              <li class="sp-nav__item">
                <a href="<?php echo esc_url(home_url('/price#experience')); ?>">乗馬体験プログラム</a>
              </li>
              <li class="sp-nav__item">
                <a href="<?php echo esc_url(home_url('/price#license')); ?>">乗馬ライセンス取得</a>
              </li>
            </ul>
            <ul class="sp-nav__items4">
              <li class="sp-nav__item sp-nav__item--bold">
                <a href="<?php echo esc_url(home_url('/faq')); ?>">よくある質問</a>
              </li>
              <li class="sp-nav__item sp-nav__item--bold sp-nav__item--layout">
                <a href="<?php echo esc_url(home_url('/privacypolicy')); ?>">
                  プライバシー
                  <br class="u-mobile" />
                  ポリシー
                </a>
              </li>
              <li class="sp-nav__item sp-nav__item--bold sp-nav__item--layout">
                <a href="<?php echo esc_url(home_url('/terms-of-service')); ?>">利用規約</a>
              </li>
              <li class="sp-nav__item sp-nav__item--bold sp-nav__item--layout">
                <a href="<?php echo esc_url(home_url('/sitemap')); ?>">サイトマップ</a>
              </li>
              <li class="sp-nav__item sp-nav__item--bold sp-nav__item--layout">
                <a href="<?php echo esc_url(home_url('/contact')); ?>">お問わ合せ</a>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <!-- /SPナビ -->
  </header>
  <!-- /header -->