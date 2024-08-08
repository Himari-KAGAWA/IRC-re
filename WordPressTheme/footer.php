<!-- contactセクションが不要なページを選定 -->
<?php if (!is_404() && !is_page(array('contact', 'thanks'))) : ?>

  <!-- contactセクション -->
  <section id="contact" class="contact section">
    <div class="contact__inner inner wow fadeIn" data-wow-duration="1s">
      <div class="contact__wrapper">
        <div class="contact__info wow fadeInUp">
          <div class="contact__logo">
            <div class="contact__logo-img">
              <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/common/logo-contact.png" alt="今浪乗馬クラブ" width="174" height="66" />
            </div>
          </div>
          <div class="contact__access">

            <?php
            // ページID28のACFグループフィールドから店舗情報を取得
            $top_information = get_field('top_information', 28);

            if ($top_information) : // 店舗情報が存在する場合のみ表示
              $address = $top_information['address'];
              $tel_number = $top_information['tel_number'];
              $open_hours = $top_information['open_hours'];
              $close_hours = $top_information['close_hours'];
              $holiday = $top_information['holiday'];
            ?>

              <div class="contact__store-info">
                <address class="contact__address">
                  <?php echo esc_html($address); ?>
                </address>
                <p>
                  TEL：
                  <a href="tel:<?php echo esc_html($tel_number); ?>"><?php echo esc_html($tel_number); ?></a>
                </p>
                <p>営業時間：<?php echo esc_html($open_hours); ?>-<?php echo esc_html($close_hours); ?></p>
                <p>定休日：<?php echo esc_html($holiday); ?></p>
              </div>
            <?php endif; ?>
            <!-- 地図 -->
            <div class="contact__map">
              <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d207871.3336464209!2d140.30361077989053!3d35.50453567889507!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x6022c3f35a102367%3A0xfd6b8e70043a3276!2z5Lmd5Y2B5Lmd6YeM5rWc!5e0!3m2!1sja!2sjp!4v1719334933669!5m2!1sja!2sjp" style="border: 0" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
          </div>
        </div>
        <div class="contact__inquiry wow fadeInUp">
          <div class="contact__header section-header">
            <div class="section-header__engtitle section-header__engtitle--contact">
              contact
            </div>
            <h2 class="section-header__jatitle section-header__jatitle--layout">
              お問い合わせ
            </h2>
          </div>
          <p class="contact__text">ご予約・お問い合わせはコチラ</p>
          <div class="contact__link">
            <a href="<?php echo esc_url(home_url('/contact')); ?>" class="link-button link-button--con">
              <span class="arrow-x"></span>
            </a>
          </div>
        </div>
      </div>
    </div>
    <div class="contact__img-icon wow fadeInUp">
      <img src="<?php echo get_theme_file_uri(); ?>/assets/images/common/horse-contact-illust.png" alt="馬の足跡風に並んだ蹄鉄のイラスト" width="225" height="160" />
    </div>
  </section>
  <!-- /contactセクション -->
<?php endif; ?>


<!-- to-topアイコン -->
<div class="to-top" style="">
  <a href="#" class="to-top__link arrow"></a>
</div>
<!-- footerセクション -->
<footer class="footer section">
  <div class="footer__inner inner">
    <div class="footer__wrapper footer-nav wow fadeIn" data-wow-duration="1s">
      <div class="footer-nav__logo">
        <picture>
          <source srcset="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/common/pc/logo-footer_pc.png" media="(min-width: 768px)" />
          <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/common/logo-footer_sp.png" alt="今浪乗馬クラブ" width="140" height="50" />
        </picture>

        <?php
        // ACFのグループフィールドからSNSリンクを取得
        $sns_link = get_field('sns_link', 28); // ページIDが28の場合

        if ($sns_link) :
          $facebook_link = $sns_link['facebook_link'];
          $instagram_link = $sns_link['instagram_link'];
          $x_link = $sns_link['x_link'];
        ?>
          <!-- SNSアイコン -->
          <ul class="footer-nav__sns">
            <?php if ($facebook_link) : ?>
              <li class="footer-nav__icon">
                <a href="<?php echo esc_url($facebook_link); ?>" target="_blank">
                  <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/common/FacebookLogo.png" alt="facebookアイコン" width="24" height="24" />
                </a>
              </li>
            <?php endif; ?>

            <?php if ($instagram_link) : ?>
              <li class="footer-nav__icon">
                <a href="<?php echo esc_url($instagram_link); ?>" target="_blank">
                  <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/common/InstagramLogo.png" alt="instagramアイコン" width="24" height="24" />
                </a>
              </li>
            <?php endif; ?>

            <?php if ($x_link) : ?>
              <li class="footer-nav__icon footer-nav__icon--x">
                <a href="<?php echo esc_url($x_link); ?>" target="_blank">
                  <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/common/x-icon.svg" alt="<?php echo esc_attr('Xアイコン'); ?>" width="24" height="24" />
                </a>
              </li>
            <?php endif; ?>
          </ul>
        <?php endif; ?>

      </div>
      <div class="footer-nav__content">
        <ul class="footer-nav__items1">
          <li class="footer-nav__item footer-nav__item-bold">
            <a href="<?php echo esc_url(home_url('/campaign')); ?>">キャンペーン</a>
          </li>
          <li class="footer-nav__item">
            <a href="<?php echo esc_url(home_url('/campaign_category/license')); ?>">乗馬ライセンス取得</a>
          </li>
          <li class="footer-nav__item">
            <a href="<?php echo esc_url(home_url('/campaign_category/experience')); ?>">乗馬体験プログラム</a>
          </li>
          <li class="footer-nav__item">
            <a href="<?php echo esc_url(home_url('/campaign_category/tour')); ?>">外乗ツアー</a>
          </li>
          <li class="footer-nav__item footer-nav__item-bold footer-nav__item--layout">
            <a href="<?php echo esc_url(home_url('/about-us')); ?>">私たちについて</a>
          </li>
        </ul>
        <ul class="footer-nav__items2">
          <li class="footer-nav__item footer-nav__item-bold">
            <a href="<?php echo esc_url(home_url('/Information')); ?>">乗馬メニュー情報</a>
          </li>
          <li class="footer-nav__item">
            <a href="<?php echo esc_url(home_url('/Information#panel1')); ?>">メンバーシップ制度</a>
          </li>
          <li class="footer-nav__item">
            <a href="<?php echo esc_url(home_url('/Information#panel3')); ?>">乗馬体験プログラム</a>
          </li>
          <li class="footer-nav__item">
            <a href="<?php echo esc_url(home_url('/Information#panel2')); ?>">乗馬ライセンス取得</a>
          </li>
          <li class="footer-nav__item footer-nav__item-bold footer-nav__item--layout">
            <a href="<?php echo esc_url(home_url('/blog')); ?>">ブログ</a>
          </li>
        </ul>
        <ul class="footer-nav__items3">
          <li class="footer-nav__item footer-nav__item-bold">
            <a href="<?php echo esc_url(home_url('/voice')); ?>">お客様の声</a>
          </li>
          <li class="footer-nav__item footer-nav__item-bold footer-nav__item--layout">
            <a href="<?php echo esc_url(home_url('/price')); ?>">料金一覧</a>
          </li>
          <li class="footer-nav__item">
            <a href="<?php echo esc_url(home_url('/price#membership')); ?>">メンバーシップ</a>
          </li>
          <li class="footer-nav__item">
            <a href="<?php echo esc_url(home_url('/price#experience_v')); ?>">乗馬体験プログラム</a>
          </li>
          <li class="footer-nav__item">
            <a href="<?php echo esc_url(home_url('/price#license')); ?>">乗馬ライセンス取得</a>
          </li>
        </ul>
        <ul class="footer-nav__items4">
          <li class="footer-nav__item footer-nav__item-bold">
            <a href="<?php echo esc_url(home_url('/faq')); ?>">よくある質問</a>
          </li>
          <li class="footer-nav__item footer-nav__item-bold footer-nav__item--layout">
            <a href="<?php echo esc_url(home_url('/privacypolicy')); ?>">
              プライバシー
              <br class="u-mobile" />
              ポリシー
            </a>
          </li>
          <li class="footer-nav__item footer-nav__item-bold footer-nav__item--layout">
            <a href="<?php echo esc_url(home_url('/terms-of-service')); ?>">利用規約</a>
          </li>
          <li class="footer-nav__item footer-nav__item-bold footer-nav__item--layout">
            <a href="<?php echo esc_url(home_url('/sitemap')); ?>">サイトマップ</a>
          </li>
          <li class="footer-nav__item footer-nav__item-bold footer-nav__item--layout">
            <a href="<?php echo esc_url(home_url('/contact')); ?>">お問わ合せ</a>
          </li>
        </ul>
      </div>
    </div>
  </div>
  <div class="footer__corporate">
    <small>&copy; 2021 - 2024 今浪乗馬クラブ All Rights Reserved.</small>
  </div>
</footer>
<!-- /footerセクション -->

<?php wp_footer(); ?>
</body>

</html>