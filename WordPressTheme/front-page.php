<?php get_header(); ?>

<main>
  <!-- mv：メインビュー -->
  <div class="mv">
    <div class="mv__inner wow fadeIn">
      <div class="mv__lead-wrap">
        <p class="mv__lead">
          絆が、心と体を自由にする
          <br />
          最高の乗馬体験を。
        </p>
      </div>

      <!-- メインビュースライダー -->
      <div class="mv__swiper swiper js-mv-swiper">
        <!-- swiper:変更不可クラス -->
        <div class="mv__swiper-wrap swiper-wrapper">
          <?php
          $slideImages = SCF::get('top_images');
          foreach ($slideImages as $image) :
            // 各サブフィールドのデータを取得
            $img_url_SP = wp_get_attachment_image_src($image['mvImg_sp'], 'full');
            $img_url_PC = wp_get_attachment_image_src($image['mvImg_pc'], 'full');
            $img_alt = !empty($image['mvImg_alt']) ? esc_attr($image['mvImg_alt']) : 'メインビューの画像';
          ?>

            <!-- swiper-wrapper:変更不可クラス -->
            <div class="mv__slide-img swiper-slide">
              <!-- スライド画像 -->
              <!-- SP・PCの画像が存在する場合の処理 -->
              <?php if ($img_url_SP && $img_url_PC) : ?>
                <picture>
                  <source srcset="<?php echo esc_url($img_url_PC[0]); ?>" media="(min-width:768px)" />
                  <img src="<?php echo esc_url($img_url_SP[0]); ?>" alt="<?php echo $img_alt; ?>" width="375" height="667" decoding="async" />
                </picture>
                <!-- スマホ用画像のみが存在する場合、PCはローディング画像を表示 -->
              <?php elseif ($img_url_SP) : ?>
                <picture>
                  <source srcset="<?php echo esc_url(get_theme_file_uri() . '/assets/images/common/pc/mv-loading_pc.webp'); ?>" media="(min-width: 768px)">
                  <img src="<?php echo esc_url($img_url_SP[0]); ?>" alt="<?php echo $img_alt; ?>" width="375" height="667" decoding="async" />
                </picture>
                <!-- PC用画像のみが存在する場合、SPはローディング画像を表示 -->
              <?php elseif ($img_url_PC) : ?>
                <picture>
                  <source srcset="<?php echo esc_url($img_url_PC[0]); ?>" media="(min-width: 768px)">
                  <img src="<?php echo esc_url(get_theme_file_uri() . '/assets/images/common/mv-loading.webp'); ?>" alt="<?php echo $img_alt; ?>" width="375" height="667" decoding="async" />
                </picture>
              <?php else : ?>
                <!-- どちらの画像も存在しない場合ローディング画像を表示 -->
                <picture>
                  <source srcset="<?php echo esc_url(get_theme_file_uri() . '/assets/images/common/pc/mv-loading_pc.webp'); ?>" media="(min-width: 768px)">
                  <img src="<?php echo esc_url(get_theme_file_uri() . '/assets/images/common/mv-loading.webp'); ?>" alt="Loading image" width="375" height="667">
                </picture>
              <?php endif; ?>
            </div>
            <!-- /スライド画像 -->
          <?php endforeach; ?>

        </div>
      </div>
    </div>
  </div>
  <!-- /mv：メインビュー -->

  <!-- campaign：キャンペーン -->
  <section id="campaign" class="campaign top-campaign">
    <div class="campaign__inner inner wow fadeIn">
      <div class="campaign__header section-header">
        <div class="section-header__engtitle">campaign</div>
        <h2 class="section-header__jatitle">キャンペーン</h2>
      </div>
      <!-- 矢印ボタン -->
      <div class="campaign__arrow-control u-desktop">
        <div class="swiper-button-prev js-campaign-prev" aria-label="前のスライド"></div>
        <div class="swiper-button-next js-campaign-next" aria-label="次のスライド"></div>
      </div>
      <!-- キャンペーンスライダー -->
      <div class="campaign__slider wow fadeInRightBig" data-wow-duration="1s">
        <!-- swiper:変更不可クラス -->
        <div class="campaign__swiper swiper js-campaign-swiper">
          <!-- swiper-wrapper:変更不可クラス -- -->
          <ul class="campaign__swiper-wrap swiper-wrapper">

            <?php
            // 新着6件のカスタム投稿を取得
            $args = array(
              'post_type' => 'campaign',
              'posts_per_page' => 6,
              'orderby' => 'date',
              'order' => 'DESC',
            );
            $query = new WP_Query($args);
            ?>
            <!-- キャンペーンカード-->
            <!-- サブループとしてカスタム投稿をループ -->
            <?php if ($query->have_posts()) : ?>
              <?php while ($query->have_posts()) : $query->the_post(); ?>
                <li class="campaign__slide swiper-slide card-01">
                  <div class="card-01__link">
                    <div class="card-01__img">
                      <!-- アイキャッチ画像の表示 -->
                      <?php if (has_post_thumbnail()) : ?>
                        <?php the_post_thumbnail(); ?>
                      <?php else : ?>
                        <!-- アイキャッチ画像がない場合のデフォルト画像 -->
                        <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/common/no-img.png" alt="<?php echo esc_attr('No image'); ?>" width="280" height="188">
                      <?php endif; ?>
                    </div>
                    <div class="card-01__body">
                      <div class="card-01__header">
                        <div class="category">
                          <!-- カテゴリー名の表示 -->
                          <?php
                          $terms = get_the_terms(get_the_ID(), 'campaign_category');
                          if ($terms && !is_wp_error($terms)) {
                            echo esc_html($terms[0]->name);
                          }
                          ?>
                        </div>
                        <!-- 投稿のタイトルを表示 -->
                        <h3 class="card-01__title">
                          <?php the_title(); ?>
                        </h3>
                      </div>
                      <div class="card-01__content">
                        <!-- 金額 -->
                        <?php
                        // ACFからキャンペーン価格のグループフィールドを取得
                        $campaign_price = get_field('campaign_price');

                        if ($campaign_price) {
                          // 正常価格とオファー価格をそれぞれ取得
                          $normal_price = $campaign_price['normal_price'];
                          $offer_price = $campaign_price['offer_price'];
                        }
                        ?>
                        <?php if (!empty($offer_price)) : ?>

                          <!-- パッケージタイトル -->
                          <?php
                          // ACFからグループフィールドを取得
                          $package_group = get_field('package_title');

                          if ($package_group) {
                            // グループフィールドからパッケージタイトル、対象になる属性、対象人数を取得
                            $target_attribute = isset($package_group['target_attribute']) ? $package_group['target_attribute'] : '';
                            $target_people = isset($package_group['target_people']) ? $package_group['target_people'] : '';

                            // 対象人数が設定されていない場合、デフォルトの "お一人様" を設定
                            if (!$target_people) {
                              $target_people = "お一人様";
                            }

                            // パッケージタイトル、対象になる属性、対象人数を組み合わせて表示
                            echo '<p class="card-01__lead">' . esc_html($target_attribute) . esc_html($target_people) . '</p>';
                          }
                          ?>
                          <p class="card-01__discount">
                            <?php if (!empty($normal_price)) : ?>
                              <!-- 正常価格を表示 -->
                              <span class="card-01__price">¥<?php echo esc_html(number_format($normal_price)); ?>
                              </span>
                            <?php endif; ?>
                            <!-- オファー価格を表示 -->
                            ¥<?php echo esc_html(number_format($offer_price)); ?>
                          </p>
                        <?php endif; ?>
                        <!-- /金額 -->
                        </p>
                      </div>
                    </div>
                  </div>
                </li>
              <?php endwhile; ?>
              <?php wp_reset_postdata(); ?>
            <?php else : ?>
              <p>キャンペーンの投稿が見つかりませんでした</p>
            <?php endif; ?>
            <!-- /キャンペーンカード -->
            <!-- swiper-wrapper -->
          </ul>
          <!-- /swiper -->
        </div>
      </div>
    </div>
    <div class="campaign__link wow fadeInUp">
      <a href="<?php echo esc_url(home_url('/campaign')); ?>" id="js-click" class="link-button">

        <span class="arrow-x"></span>
      </a>
    </div>
  </section>
  <!-- /campaign：キャンペーン -->

  <!-- about-us：私たちについて -->
  <section id="about" class="about top-about">
    <div class="about__inner inner">
      <div class="about__header section-header wow fadeIn">
        <div class="section-header__engtitle">about us</div>
        <h2 class="section-header__jatitle">私たちについて</h2>
      </div>
      <div class="about__img-wrapper wow fadeIn">
        <div class="about__img-left">
          <img src="<?php echo get_theme_file_uri(); ?>/assets/images/common/about-bg.webp" alt="鐙と鞍の画像" />
        </div>
        <div class="about__img-right">
          <img src="<?php echo get_theme_file_uri(); ?>/assets/images/common/about-bg_2.jpg" alt="こちらを見つめる黒い馬の画像" />
        </div>
      </div>
      <div class="about__contents">
        <div class="about__lead wow fadeIn">
          We're
          <br />
          happy
          <br class="u-desktop" />
          together.
        </div>
        <div class="about__copy wow fadeIn">
          <p class="about__text">
            私たちのクラブでは、馬との信頼関係を築くことを最も大切にしています。<br>言葉を話さない、自分とは違う意思を持つ相手と心を通わせることで得られる喜びは、他に代えがたいものです。<br>馬との触れ合いを通じて、心身ともに豊かな時間を過ごしていただけるよう、私たちがサポートします。
          </p>
          <div class="about__link wow fadeInUp">
            <a href="<?php echo esc_url(home_url('/about-us')); ?>" class="link-button">
              <span class="arrow-x"></span>
            </a>
          </div>
        </div>
      </div>
    </div>
    <div class="about__img-icon u-desktop wow fadeInUp">
      <img src="<?php echo get_theme_file_uri(); ?>/assets/images/common/pc/horse.png" alt="走る馬のアイコン" width="170" height="144" />
    </div>
  </section>
  <!-- /about-us：私たちについて -->

  <!-- information：乗馬メニュー情報 -->
  <section id="information" class="information section">
    <div class="information__inner inner">
      <div class="information__header section-header wow fadeIn">
        <div class="section-header__engtitle">information</div>
        <h2 class="section-header__jatitle">乗馬メニュー情報</h2>
      </div>
      <div class="information__wrapper wow fadeIn">
        <div class="information__img js-inview">
          <img src="<?php echo get_theme_file_uri(); ?>/assets/images/common/information.webp" alt="ニンジンを分け合う人馬の画像" width="345" height="227" />
        </div>
        <div class="information__content">
          <p class="information__title">乗馬ライセンス取得</p>
          <p class="information__desc">
            「全国乗馬倶楽部振興協会認定」の乗馬技能ライセンス取得のための、様々なコースをご用意しております。
            <br />
            初めての方から経験豊富なライダーの方まで、すべてのレベルに対応する技能を持ったスタッフが安心・安全にライセンスを取得するためのサポートをいたします。会員だけでなくビジターの方にもご利用いただけるコースもございます。
          </p>
          <div class="information__link wow fadeInUp">
            <a href="<?php echo esc_url(home_url('/information')); ?>" class="link-button link-button__layout">
              <span class="arrow-x"></span>
            </a>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- /information：乗馬メニュー情報 -->

  <!-- blog：ブログ -->
  <section id="blog" class="blog">
    <div class="blog__inner inner">
      <div class="blog__header section-header wow fadeIn">
        <div class="section-header__engtitle section-header__engtitle--white">
          Blog
        </div>
        <h2 class="section-header__jatitle section-header__jatitle--white">
          ブログ
        </h2>
      </div>
      <div class="blog__items blog-cards">
        <?php
        // 投稿を取得するためのクエリ引数を設定
        $args = array(
          'post_type' => 'post',
          'posts_per_page' => 3 // 表示させたい投稿の数
        );
        // 新しいWP_Queryオブジェクトを作成
        $the_query = new WP_Query($args);
        ?>

        <?php if ($the_query->have_posts()) : ?>
          <?php while ($the_query->have_posts()) : $the_query->the_post(); ?>
            <!-- ブログカード -->
            <article class="blog-cards__item card-02 wow fadeIn">
              <!-- 投稿のパーマリンクをリンクとして追加 -->
              <a href="<?php the_permalink(); ?>" class="card-02__link">
                <div class="card-02__img">
                  <!-- アイキャッチ画像の表示 -->
                  <?php if (has_post_thumbnail()) : ?>
                    <?php the_post_thumbnail(); ?>
                  <?php else : ?>
                    <!-- アイキャッチ画像がない場合のデフォルト画像 -->
                    <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/common/no-img.png" alt="No image" width="301" height="201">
                  <?php endif; ?>
                </div>
                <div class="card-02__header">
                  <!-- 投稿日時を表示 -->
                  <time class="card-02__date" datetime="<?php echo get_the_date('c'); ?>">
                    <?php echo get_the_date('Y.m/d'); ?></time>
                  <!-- 投稿のタイトルを表示 -->
                  <h3 class="card-02__title"><?php the_title(); ?></h3>
                </div>
                <!-- 本文 -->
                <div class="card-02__content">
                  <?php the_excerpt(); ?>
                </div>
              </a>
            </article>
            <!-- /ブログカード -->
          <?php endwhile; ?>
          <!-- クエリの投稿データをリセット -->
          <?php wp_reset_postdata(); ?>
        <?php else : ?>
          <p>まだブログ記事は投稿されてません</p>
        <?php endif; ?>

      </div>
      <div class="blog__link wow fadeInUp">
        <a href="<?php echo esc_url(home_url('/blog')); ?>" class="link-button">
          <span class="arrow-x"></span>
        </a>
      </div>
    </div>
    <div class="blog__img-icon u-desktop wow fadeInUp">
      <img src="<?php echo get_theme_file_uri(); ?>/assets/images/common/pc/blog-illust-w.png" alt="足跡風に並んだ蹄鉄のイラスト" width="218" height="150" />
    </div>
  </section>
  <!-- /blog：ブログ -->

  <!-- voice：お客様の声 -->
  <section id="voice" class="voice top-voice">
    <div class="voice__inner inner">
      <div class="voice__header section-header wow fadeIn">
        <div class="section-header__engtitle">voice</div>
        <h2 class="section-header__jatitle">お客様の声</h2>
      </div>
      <div class="voice__items voice-cards wow fadeIn">
        <?php
        // 新着2件のカスタム投稿を取得
        $args = array(
          'post_type' => 'voice',
          'posts_per_page' => 2,
          'orderby' => 'date',
          'order' => 'DESC',
        );
        $query = new WP_Query($args);
        ?>
        <!-- ボイスカード -->
        <!-- サブループとしてカスタム投稿をループ -->
        <?php if ($query->have_posts()) : ?>
          <?php while ($query->have_posts()) : $query->the_post(); ?>
            <div class="voice-cards__item card-03 wow fadeIn">
              <a href="<?php echo esc_url(home_url('/voice')); ?>" class="card-03__link">
                <div class="card-03__header">
                  <div class="card-03__left">
                    <div class="card-03__attribute">
                      <?php
                      // ACFのグループフィールドからデータを取得
                      $metadata = get_field('metadata');
                      $age = $metadata['age'];
                      $gender = $metadata['gender'];
                      ?>
                      <!-- 年代とジェンダー -->
                      <p><?php echo esc_html($age); ?>(<?php echo esc_html($gender); ?>)</p>
                      <!-- カテゴリー -->
                      <?php
                      $terms = get_the_terms(get_the_ID(), 'voice_category');
                      if ($terms && !is_wp_error($terms)) :
                        $term = $terms[0];
                      ?>
                        <span class="category"><?php echo esc_html($term->name); ?></span>
                      <?php endif; ?>
                    </div>
                    <!-- タイトル -->
                    <h3 class="card-03__title"><?php the_title(); ?></h3>
                  </div>
                  <!-- お客様のアバター -->
                  <div class="card-03__img js-inview">
                    <?php if (has_post_thumbnail()) : ?>
                      <?php the_post_thumbnail(); ?>
                    <?php else : ?>
                      <img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/common/noimg.jpg" alt="No image" width="151" height="117">
                    <?php endif; ?>
                  </div>
                </div>
                <!-- 本文 -->
                <div class="card-03__content">
                  <?php
                  $content = get_the_content();

                  // 余計なHTMLコメントを削除
                  $content = preg_replace('/<!--(.*)-->/Uis', '', $content);

                  if (mb_strlen($content, 'UTF-8') > 170) {
                    // 本文から改行を削除しないように変更
                    $content = mb_substr($content, 0, 170, 'UTF-8');
                    echo wp_kses_post($content) . '…'; // 改行を含むテキストをエスケープ
                  } else {
                    echo wp_kses_post($content); // 改行を含むテキストをエスケープ
                  }
                  ?>
                </div>

              </a>
            </div>
            <!-- ボイスカード -->
          <?php endwhile; ?>
          <?php wp_reset_postdata(); ?>
        <?php else : ?>
          <p>お客様の声の投稿が見つかりませんでした</p>
        <?php endif; ?>
      </div>

      <div class="voice__link wow fadeInUp">
        <a href="<?php echo esc_url(home_url('/voice')); ?>" class="link-button">
          <span class="arrow-x"></span>
        </a>
      </div>
    </div>
    <div class="voice__img-icon u-desktop wow fadeInUp">
      <img src="<?php echo get_theme_file_uri(); ?>/assets/images/common/horse-illust.png" alt="障害を飛ぶ人馬のイラスト" width="330" height="235" />
    </div>
    <div class="voice__img-icon2 u-desktop wow fadeInUp">
      <img src="<?php echo get_theme_file_uri(); ?>/assets/images/common/pc/horseshoe.png" alt="縦に3つ並んだ蹄鉄のイラスト" width="71" height="162" />
    </div>
  </section>
  <!-- /voice：お客様の声 -->

  <!-- price：料金一覧 -->
  <section id="price" class="price section">
    <div class="price__inner inner">
      <div class="price__header section-header wow fadeIn">
        <div class="section-header__engtitle">price</div>
        <h2 class="section-header__jatitle">料金一覧</h2>
      </div>
      <div class="price__contents wow fadeIn">
        <div class="price__items">

          <!-- 乗馬体験プログラム：ビジター -->
          <?php
          // 固定ページIDを指定
          $page_id = 14;

          // 固定ページからSCFのデータを取得
          $program = SCF::get('ridingProgram_visitor', $page_id);

          // 取得した講習情報が空でないかを確認
          if (!empty($program)) :
          ?>
            <div class="price__courses">
              <h3 class="price__course">乗馬体験プログラム【ビジター】</h3>
              <dl class="price__course-list">
                <!-- 各講習情報をループで表示 -->
                <?php foreach ($program as $programItem) :
                  // タイトルが設定されているかを確認
                  $name = isset($programItem['course_visiter']) ? esc_html($programItem['course_visiter']) : '';
                  // 価格を整数に変換して取得
                  $price = isset($programItem['fee_visiter']) ? intval($programItem['fee_visiter']) : 0;

                  // 料金が未入力または0の場合はスキップ
                  if ($price === 0) {
                    continue;
                  }
                ?>
                  <div class="price__corse-menus">
                    <!-- プログラムのタイトルを表示 -->
                    <dt class="price__corse-menu"><?php echo $name; ?></dt>
                    <!-- 価格をフォーマットして表示 -->
                    <dd class="price__corse-price">¥<?php echo number_format($price); ?></dd>
                  </div>
                <?php endforeach; ?>
              </dl>
            </div>
          <?php endif; ?>


          <!-- 乗馬体験プログラム -->
          <?php
          // 固定ページIDを指定
          $page_id = 14;

          // 固定ページからSCFのデータを取得
          $program = SCF::get('ridingProgram_all', $page_id);

          // 取得したプログラムの情報が空でないかを確認
          if (!empty($program)) :
          ?>
            <div class="price__courses">
              <h3 class="price__course">乗馬体験プログラム【全員対象】</h3>
              <dl class="price__course-list">
                <!-- 各プログラムの情報をループで表示 -->
                <?php foreach ($program as $programItem) :
                  // タイトルが設定されているかを確認
                  $name = isset($programItem['corse_all']) ? esc_html($programItem['corse_all']) : '';
                  // 価格を整数に変換して取得
                  $price = isset($programItem['fee_all']) ? intval($programItem['fee_all']) : 0;

                  // 料金が未入力または0の場合はスキップ
                  if ($price === 0) {
                    continue;
                  }
                ?>
                  <div class="price__corse-menus">
                    <!-- プログラムのタイトルを表示 -->
                    <dt class="price__corse-menu">
                      <?php echo $name; ?>
                    </dt>
                    <!-- 価格をフォーマットして表示 -->
                    <dd class="price__corse-price">¥<?php echo number_format($price); ?></dd>
                  </div>
                <?php endforeach; ?>
              </dl>
            </div>
          <?php endif; ?>


          <!-- 乗馬体験ツアー：メンバー -->
          <?php
          // 固定ページIDを指定
          $page_id = 14;

          // 固定ページからSCFのデータを取得
          $tour = SCF::get('ridingTour_Members', $page_id);

          // 取得した講習情報が空でないかを確認
          if (!empty($tour)) :
          ?>
            <div class="price__courses">
              <h3 class="price__course">乗馬体験ツアー【メンバー】</h3>
              <dl class="price__course-list">
                <!-- 各講習情報をループで表示 -->
                <?php foreach ($tour as $tourItem) :
                  // タイトルが設定されているかを確認
                  $name = isset($tourItem['course_tour']) ? esc_html($tourItem['course_tour']) : '';
                  // 価格を整数に変換して取得
                  $price = isset($tourItem['fee_tour']) ? intval($tourItem['fee_tour']) : 0;

                  // 料金が未入力または0の場合はスキップ
                  if ($price === 0) {
                    continue;
                  }
                ?>
                  <div class="price__corse-menus">
                    <!-- ツアーのタイトルを表示 -->
                    <dt class="price__corse-menu">
                      <?php echo $name; ?>
                    </dt>
                    <dd class="price__corse-price">¥<?php echo number_format($price); ?></dd>
                  </div>
                <?php endforeach; ?>
              </dl>
            </div>
          <?php endif; ?>


          <!-- ライセンス取得 -->
          <?php
          // 固定ページIDを指定
          $page_id = 14;

          // 固定ページからSCFのデータを取得
          $license = SCF::get('get_license', $page_id);

          // 取得した講習情報が空でないかを確認
          if (!empty($license)) :
          ?>
            <div class="price__courses">
              <h3 class="price__course">ライセンス取得【全員対象】</h3>
              <dl class="price__course-list">
                <?php
                // 表示したアイテムの数をカウントする変数
                $count = 0;

                // 各ライセンス情報をループで表示
                foreach ($license as $licenseItem) :
                  // タイトルが設定されているかを確認
                  $name = isset($licenseItem['course_license']) ? esc_html($licenseItem['course_license']) : '';
                  // 価格を整数に変換して取得
                  $price = isset($licenseItem['fee_license']) ? intval($licenseItem['fee_license']) : 0;

                  // 料金が未入力または0の場合はスキップ
                  if ($price === 0) {
                    continue;
                  }

                  // 上位2つのコースのみ表示
                  if ($count < 2) :
                    $count++; // 表示したアイテムの数をカウント
                ?>
                    <div class="price__corse-menus">
                      <!-- ライセンスコースのタイトルと料金 -->
                      <dt class="price__corse-menu">
                        <?php echo $name; ?>
                      </dt>
                      <dd class="price__corse-price">¥<?php echo number_format($price); ?></dd>
                    </div>
                <?php
                  else :
                    // 上位2つ表示したらループを終了
                    break;
                  endif;
                endforeach;
                ?>
              </dl>
            </div>
          <?php endif; ?>

          <div class="price__attention">
            ※会員料金・騎乗料等の詳細は<a href="<?php echo esc_url(home_url('/price')); ?>">料金一覧</a>をご覧ください。
          </div>
        </div>

        <div class="price__img js-inview wow fadeIn">
          <picture>
            <source srcset="<?php echo get_theme_file_uri(); ?>/assets/images/common/pc/price-pc.webp" media="(min-width:768px)" alt="障害を踏み切って飛ぶ馬の画像" />
            <img src="<?php echo get_theme_file_uri(); ?>/assets/images/common/price-sp.webp" alt="栗毛の馬の画像" width="345" height="227" />
          </picture>
        </div>
      </div>
      <div class="price__link wow fadeInUp">
        <a href="<?php echo esc_url(home_url('/price')); ?>" class="link-button">
          <span class="arrow-x"></span>
        </a>
      </div>
    </div>
    <div class="price__img-icon u-desktop wow fadeInUp">
      <img src="<?php echo get_theme_file_uri(); ?>/assets/images/common/pc/hose-price-illust.png" alt="" width="340" height="265" />
    </div>
  </section>
  <!-- /price：料金一覧 -->

</main>

<?php get_footer(); ?>