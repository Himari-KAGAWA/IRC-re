<?php get_header(); ?>

<main class="main">
  <div class="main__lower-image wow fadeInUp"></div>
  <!-- 下層ページメインビュー -->
  <section class="sub-mv sub-mv__bg sub-mv__bg--info wow fadeIn">
    <div class="sub-mv_inner">
      <div class="sub-mv__header">
        <h1 class="sub-mv__title sub-mv__title--info">Information</h1>
      </div>
    </div>
  </section>

  <!-- breadcrumbs -->
  <?php get_template_part('breadcrumb'); ?>
  <!-- /breadcrumbs -->

  <!-- page-contents -->
  <div class="page top-page--info">
    <div class="page__inner inner">
      <div class="page__content page-information">
        <div class="page-information__tabs wow fadeIn">
          <ul class="page-information__tab">
            <li id="tab1" class="page-information__tab-nav is-active">
              <span>
                メンバー<br class="u-mobile" />シップ制度
              </span>
            </li>
            <li id="tab2" class="page-information__tab-nav">
              <span>
                乗馬ライ<br class="u-mobile" />センス取得
              </span>
            </li>
            <li id="tab3" class="page-information__tab-nav">
              <span>
                乗馬体験<br class="u-mobile" />プログラム
              </span>
            </li>
          </ul>
          <div class="page-information__tab-panels">
            <div id="panel1" class="page-information__tab-panel is-active">
              <div class="page-information__panel-wrapper">
                <div class="page-information__content">
                  <p class="page-information__title">メンバーシップ制度</p>
                  <p class="page-information__desc">
                    一般会員とジュニア会員（共に永久会員）、会員以外の皆さまにもご利用できるビジター制をご用意しております！
                    <br />
                    会員・ビジターを問わず、初心者からさらなる乗馬技術の向上を目指す方まで、安心してご利用いただけるコースがありますので、ご自身に合うコースを選択することができます！
                  </p>
                </div>
                <div class="page-information__img js-inview">
                  <picture>
                    <source
                      media="(min-width: 768px)"
                      srcset="<?php echo get_theme_file_uri(); ?>/assets/images/common/lower/page-info-panel-pc_01.webp" />
                    <img
                      src="<?php echo get_theme_file_uri(); ?>/assets/images/common/lower/page-info-panel-pc_01.webp"
                      alt="ヘルメットをかぶってこちらに微笑む少女の画像"
                      width="295"
                      height="187" />
                  </picture>
                </div>
              </div>
            </div>
            <div id="panel2" class="page-information__tab-panel">
              <div class="page-information__panel-wrapper">
                <div class="page-information__content">
                  <p class="page-information__title">乗馬ライセンス取得</p>
                  <p class="page-information__desc">
                    「全国乗馬倶楽部振興協会認定」の乗馬技能ライセンス取得コースです！
                    <br />
                    乗馬５級～１級、乗馬２～３級障害、乗馬インストラクター養成まで、各種ライセンスを取得できるコースです。合宿コースもございますので、お気軽にお問い合わせください！
                  </p>
                </div>
                <div class="page-information__img js-inview">
                  <picture>
                    <source
                      media="(min-width: 768px)"
                      srcset="<?php echo get_theme_file_uri(); ?>/assets/images/common/lower/page-info-panel-pc_02.webp
                          " />
                    <img
                      src="<?php echo get_theme_file_uri(); ?>/assets/images/common/lower/page-info-panel-pc_02.webp"
                      alt="ジャンプの練習をする人馬の画像"
                      width="295"
                      height="187" />
                  </picture>
                </div>
              </div>
            </div>
            <div id="panel3" class="page-information__tab-panel">
              <div class="page-information__panel-wrapper">
                <div class="page-information__content">
                  <p class="page-information__title">乗馬体験プログラム</p>
                  <p class="page-information__desc">
                    初心者から上級者まで、様々な乗馬体験ができるプログラムになります！
                    <br />
                    馬場での乗馬体験やふれあいを通じてリハビリテーションを行うホースセラピー、国内外の外乗ツアーなどを楽しむことができます！
                  </p>
                </div>
                <div class="page-information__img js-inview">
                  <picture>
                    <source
                      media="(min-width: 768px)"
                      srcset="<?php echo get_theme_file_uri(); ?>/assets/images/common/lower/page-info-panel-pc_03.webp
                          " />
                    <img
                      src="<?php echo get_theme_file_uri(); ?>/assets/images/common/lower/page-info-panel-pc_03.webp"
                      alt="山の麓を乗馬で散策する人達の画像"
                      width="295"
                      height="187" />
                  </picture>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- /page-contents -->

</main>

<?php get_footer(); ?>