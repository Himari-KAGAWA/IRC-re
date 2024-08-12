'use strict';

jQuery(function ($) {
  // この中であればWordpressでも「$」が使用可能になる

  // ========== ハンバーガーメニュー ==========
  $('.js-hamburger').on('click', function () {
    var $this = $(this);
    if ($this.hasClass('is-open') || $this.hasClass('is-active')) {
      $('.js-drawer-menu, .js-sp-nav').fadeOut();
      $this.removeClass('is-open is-active');
      $('body').removeClass('no-scroll');
    } else {
      $('.js-drawer-menu, .js-sp-nav').fadeIn();
      $this.addClass('is-open is-active');
      $('body').addClass('no-scroll');
    }
  });

  // ========== ドロワーメニュー内リンクがクリックされたとき ==========
  $('.js-sp-nav a').click(function () {
    $('.js-hamburger').removeClass('is-active is-open');
    $('.js-sp-nav').fadeOut(300);
    $('body').removeClass('no-scroll'); // ナビ内のリンクがクリックされたらno-scrollクラスを外す
  });

  // ========== ドロワーメニューのリサイズに対応 ==========
  // ウィンドウがリサイズされたときのイベント
  $(window).resize(function () {
    if ($(window).width() > 768) {
      // ウィンドウ幅が768px以上のときに非表示にする
      $('.js-sp-nav').fadeOut();
      $('.js-hamburger').removeClass('is-open');
      $('body').removeClass('no-scroll');
    }
  });

  // ========== swiper メインビュー ==========
  // メインビューのスライダー初期化
  var mainViewSwiperSettings = {
    loop: true,
    speed: 3000,
    effect: 'fade',
    fadeEffect: {
      crossFade: true // クロスフェードを有効にする
    },

    // 自動再生の設定
    autoplay: {
      delay: 3000,
      // スライドの切り替え間隔（ミリ秒）
      disableOnInteraction: false // ユーザー操作後も自動再生を続ける
    }
  };
  // Swiperインスタンスの作成
  var mainViewSwiper = new Swiper('.js-mv-swiper', mainViewSwiperSettings);

  // ========== swiper キャンペーン ==========
  // スライダーの初期化
  var initCampaignSlider = function initCampaignSlider() {
    var campaignSlider = new Swiper('.campaign__slider .js-campaign-swiper', {
      loop: true,
      loopAdditionalSlides: 1,
      // スライドの前後に要素を複製
      slidesPerView: 'auto',
      // cssで幅を指定している場合はauto
      spaceBetween: 24,
      grabCursor: true,
      autoplay: {
        delay: 3000,
        // 自動再生の遅延（ミリ秒）
        disableOnInteraction: false // ユーザー操作後も自動再生を続ける
      },

      navigation: {
        nextEl: '.js-campaign-next',
        // 次のスライドボタン
        prevEl: '.js-campaign-prev',
        // 前のスライドボタン
        clickable: true // ナビゲーションボタンをクリック可能にする
      },

      breakpoints: {
        767: {
          spaceBetween: 40 // 767px以上の画面幅ではスライド間のスペースを40pxに設定
        }
      },

      // スクリーンリーダー対応のための初期化処理
      on: {
        init: setAriaLabels // スライダー初期化時にラベルを設定
      }
    });
  };

  // スクリーンリーダー対応のためのラベル設定関数
  var setAriaLabels = function setAriaLabels() {
    document
      .querySelector('.js-campaign-next')
      .setAttribute('aria-label', '次のスライド');
    document
      .querySelector('.js-campaign-prev')
      .setAttribute('aria-label', '前のスライド');
  };

  // スライダー初期化の実行
  initCampaignSlider();

  // ========== スクロール検知＆to-topアイコン制御 ==========
  jQuery(document).ready(function ($) {
    var toTop = $('.to-top');
    var footer = $('footer');
    var originalBottom = parseInt(toTop.css('bottom')); // 初期のbottom値を取得
    $(window).on('scroll', function () {
      var scrollPos = $(this).scrollTop();
      var windowHeight = $(this).height();
      if (scrollPos > 200) {
        // スクロールが200px以上の場合
        toTop.addClass('is-show');
      } else {
        // スクロールが200px以下の場合
        toTop.removeClass('is-show');
      }
      if (scrollPos >= footer.offset().top - windowHeight) {
        // フッターの近くに到達した場合
        var newBottom =
          scrollPos + windowHeight - (footer.offset().top - originalBottom);
        toTop.css('bottom', newBottom + 'px');
      } else {
        // フッターの近くに到達していない場合
        toTop.css('bottom', originalBottom + 'px');
      }
    });
  });

  // ========== ヘッダー色変更 ==========
  $(document).ready(function () {
    // ヘッダークラス名付与
    var header = $('.header');
    // ヘッダーの高さ取得
    var headerHeight = $('.header').height();
    // メインビューの高さを取得（トップページと下層ページの両方に対応）
    var mainVisualHeight = $('.mv').height();
    var subMvHeight = $('.sub-mv').height();
    var targetHeight = mainVisualHeight || subMvHeight; // main-visual がない場合、sub-mv の高さを使用
    // メインビューの高さ - ヘッダーの高さ
    $(window).scroll(function () {
      if ($(this).scrollTop() > targetHeight - headerHeight) {
        // 指定px以上のスクロールでクラス名付与
        header.addClass('is-color');
      } else {
        // クラス名が付いてたら削除
        header.removeClass('is-color');
      }
    });
  });

  // ========== スムーススクロール ==========
  jQuery('a[href^="#"]').on('click', function (e) {
    var speed = 600;
    var id = jQuery(this).attr('href');
    var target = jQuery('#' == id ? 'html' : id);
    var position = jQuery(target).offset().top;
    jQuery('html, body').animate(
      {
        scrollTop: position
      },
      speed,
      'swing' // swing or linear
    );
  });

  // ========== js-inview ==========
  //要素の取得とスピードの設定
  var box = $('.js-inview'),
    speed = 700;
  //.colorboxの付いた全ての要素に対して下記の処理を行う
  box.each(function () {
    $(this).append('<div class="color"></div>');
    var color = $(this).find($('.color')),
      image = $(this).find('img');
    var counter = 0;
    image.css('opacity', '0');
    color.css('width', '0%');
    //inviewを使って背景色が画面に現れたら処理をする
    color.on('inview', function () {
      if (counter == 0) {
        $(this)
          .delay(200)
          .animate(
            {
              width: '100%'
            },
            speed,
            function () {
              image.css('opacity', '1');
              $(this).css({
                left: '0',
                right: 'auto'
              });
              $(this).animate(
                {
                  width: '0%'
                },
                speed
              );
            }
          );
        counter = 1;
      }
    });
  });

  // ========== サイドバー：アコーディオン ==========
  $(document).ready(function () {
    $('.js-open').click(function () {
      $(this).toggleClass('is-rotated'); // クリックされた要素にis-rotatedを追加または削除
      $(this).next('.page-sidebar__month').slideToggle(); // 直後の.page-sidebar__monthをスライドで開閉
    });
  });

  // ========== FAQ：アコーディオン ==========
  $('.js-faq').on('click', function () {
    $(this).find('.js-faq-open').stop().slideToggle(300);
    $(this).toggleClass('is-open');
  });

  // ========== タブ切替 information ==========
  $(function () {
    $('.page-information__tabs li').click(function () {
      var index = $('.page-information__tabs li').index(this); //何番目のタブがクリックされたかを格納
      $('.page-information__tabs li').removeClass('is-active');
      $(this).addClass('is-active');
      $('.page-information__tabs .page-information__tab-panel')
        .removeClass('is-active')
        .eq(index)
        .addClass('is-active'); //○番目のコンテンツのみを表示
    });
  });
  // ========== タブへダイレクトリンクの実装：information ==========
  $(function () {
    //リンクからハッシュを取得
    var hash = location.hash;
    hash = (hash.match(/^#panel\d+$/) || [])[0];
    //リンクにハッシュが入っていればtabnameに格納
    var tabname = hash ? hash.slice(1) : 'panel1';
    //コンテンツ非表示・タブを非アクティブ
    $('.page-information__tabs li').removeClass('is-active');
    $('.page-information__tabs .page-information__tab-panel').removeClass(
      'is-active'
    );
    //何番目のタブかを格納
    var tabno = $(
      '.page-information__tabs .page-information__tab-panel#' + tabname
    ).index();
    //コンテンツ表示
    $('.page-information__tabs .page-information__tab-panel')
      .eq(tabno)
      .addClass('is-active');
    //タブのアクティブ化
    $('.page-information__tabs li').eq(tabno).addClass('is-active');
    // タブへスクロール（タブへのダイレクトリンクの場合にのみ実行）
    if (hash) {
      var headerHeight = $('.header').height() + 24; // ヘッダーの高さを取得
      var targetOffset = $('.page-information__tabs').offset().top; // タブの位置を取得
      var scrollTo = targetOffset - headerHeight; // スクロール位置を計算
      $('html, body').scrollTop(scrollTo); // スクロール実行
    }
  });

  // ========== モーダル：ギャラリー画像 ==========
  (function () {
    // ギャラリーの各画像要素を取得
    var triggers = document.querySelectorAll('.js-modal__trigger');
    // モーダル内の画像要素を取得
    var modalImage = document.querySelector('.modal__img');
    // 要素が存在するか確認
    if (triggers.length > 0 && modalImage) {
      // クリックイベントリスナーを追加
      triggers.forEach(function (trigger) {
        trigger.addEventListener('click', function () {
          // クリックされた画像のパスとalt属性を取得
          var imgElement = trigger.querySelector('img');
          var imagePath = imgElement.getAttribute('src');
          var imageAlt = imgElement.getAttribute('alt');

          // モーダル内の画像要素に画像を表示
          var modalImgElement = modalImage.querySelector('img');
          if (!modalImgElement) {
            // もしモーダルに画像要素がない場合、新しく作成して追加
            modalImgElement = document.createElement('img');
            modalImage.appendChild(modalImgElement);
          }
          modalImgElement.src = imagePath;
          modalImgElement.alt = imageAlt;

          // モーダルを表示
          var modal = document.querySelector('.js-modal');
          if (modal) {
            modal.classList.remove('fadeOut-modal');
            modal.classList.add('fadeIn-modal');
            modal.classList.add('active');
            // 背景を固定してスクロールしないようにする
            document.body.style.overflow = 'hidden';
            // モーダルを表示するために、displayプロパティを変更
            modal.style.display = 'block';
          }
        });
      });
    }

    // モーダルの背景と画像をクリックして閉じるイベントリスナー
    var modalBackground = document.querySelector('.modal__bg');
    if (modalBackground) {
      modalBackground.addEventListener('click', closeModal);
    }
    if (modalImage) {
      modalImage.addEventListener('click', closeModal);
    }
    function closeModal() {
      // モーダルを非表示にする前にフェードアウトアニメーションを追加
      var modal = document.querySelector('.js-modal');
      if (modal) {
        modal.classList.remove('fadeIn-modal');
        modal.classList.add('fadeOut-modal');
        // アニメーション終了後にモーダルを非表示
        modal.addEventListener('animationend', function handleAnimationEnd() {
          modal.classList.remove('active');
          document.body.style.overflow = 'auto';
          modal.style.display = 'none';
          modal.removeEventListener('animationend', handleAnimationEnd);
        });
      }
    }
  })();

  // ========== タブ絞り込み：page-campaign,page-voice ==========
  $(function () {
    // 変数を要素をセット
    var $filter = $('.js-tab-btn [data-filter]'),
      $item = $('.js-panel [data-item]');
    // カテゴリをクリックしたら
    $filter.click(function (e) {
      // デフォルトの動作をキャンセル
      e.preventDefault();
      var $this = $(this);
      // クリックしたカテゴリにクラスを付与
      $filter.removeClass('is-show');
      $this.addClass('is-show');
      // クリックした要素のdata属性を取得
      var $filterItem = $this.attr('data-filter');
      // データ属性が ALL なら全ての要素を表示
      if ($filterItem == 'ALL') {
        $item
          .removeClass('is-show')
          .fadeOut()
          .promise()
          .done(function () {
            $item.addClass('is-show').fadeIn();
          });
        // all 以外の場合は、クリックした要素のdata属性の値を同じ値のアイテムを表示
      } else {
        $item
          .removeClass('is-show')
          .fadeOut()
          .promise()
          .done(function () {
            $item
              .filter('[data-item = "' + $filterItem + '"]')
              .addClass('is-show')
              .fadeIn();
          });
      }
    });
  });

  // ========== WOWアニメーション ==========
  new WOW().init();

  // ========== タブ絞り込み用ダイレクトリンク ==========
  // $(document).ready(function () {
  //   // ページロード時にURLのハッシュを読み込んで該当のカテゴリを表示
  //   var hash = window.location.hash;
  //   if (hash) {
  //     var $filterItem = hash.substr(1);
  //     $(".js-tab-btn [data-filter='" + $filterItem + "']").click();
  //     // カテゴリの位置を取得し、ヘッダーの高さ＋24pxを加えてスクロール位置を計算
  //     var headerHeight = $('.header').height() + 24;
  //     var targetOffset = $('.category-list__items').offset().top;
  //     var scrollTo = targetOffset - headerHeight;
  //     $('html, body').scrollTop(scrollTo);
  //   }
  // });

  // ========== フワッと出てくるアニメーション ==========
  // const fadeInItems = document.querySelectorAll('.js-fadeIn');
  // if (fadeInItems.length) {
  //   const intersectionObserver = new IntersectionObserver(function (entries) {
  //     entries.forEach(function (entry) {
  //       if (entry.isIntersecting) {
  //         entry.target.classList.add('js-fadeIn');
  //       } else {
  //         entry.target.classList.remove('js-fadeIn');
  //       }
  //     });
  //   });
  //   fadeInItems.forEach(function (fadeInItem) {
  //     intersectionObserver.observe(fadeInItem);
  //   });
  // }
});
