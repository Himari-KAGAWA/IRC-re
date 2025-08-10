'use strict';

document.addEventListener("DOMContentLoaded", function () {
  jQuery(function ($) {
    // この中であればWordpressでも「$」が使用可能になる

    // ========== GSAPプラグイン登録 ==========
    gsap.registerPlugin(ScrollTrigger, ScrollToPlugin);

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

    // 初期状態でスライダー止める
    mainViewSwiper.autoplay.stop();

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
      document.querySelector('.js-campaign-next').setAttribute('aria-label', '次のスライド');
      document.querySelector('.js-campaign-prev').setAttribute('aria-label', '前のスライド');
    };

    // スライダー初期化の実行
    initCampaignSlider();

    // ========== スクロール検知＆to-topアイコン制御 ==========
    // .to-top ボタン要素取得
    var toTop = document.querySelector('.to-top');
    // footer要素取得
    var footer = document.querySelector('footer');
    // CSSのbottom初期値を数値で取得
    var originalBottom = parseInt(getComputedStyle(toTop).bottom, 10);
    window.addEventListener('scroll', function () {
      var scrollPos = window.scrollY; // 現在のスクロール位置
      var windowHeight = window.innerHeight; // ビューポート高さ
      var footerTop = footer.getBoundingClientRect().top + scrollPos; // フッターのドキュメント上端位置

      // 200px以上スクロールで表示
      if (scrollPos > 200) {
        toTop.classList.add('is-show');
      } else {
        toTop.classList.remove('is-show');
      }

      // フッターに到達した場合
      if (scrollPos + windowHeight >= footerTop) {
        // footerから10px上に止めるように計算
        var overlap = scrollPos + windowHeight - footerTop + originalBottom;
        gsap.to(toTop, {
          duration: 0.3,
          bottom: "".concat(overlap, "px"),
          ease: "power2.out"
        });
      } else {
        // フッター未到達時は元の位置
        gsap.to(toTop, {
          duration: 0.3,
          bottom: "".concat(originalBottom, "px"),
          ease: "power2.out"
        });
      }
    });

    // ========== スクロール位置でヘッダーの色変更（ScrollTrigger） ==========
    var header = document.querySelector('.header');
    /* .mvか.sub-mvどちらかをトリガーに どちらも無ければ処理しない */
    var mv = document.querySelector('.mv') || document.querySelector('.sub-mv');
    var headerHeight = header.offsetHeight;
    if (mv) {
      ScrollTrigger.create({
        trigger: mv,
        start: "bottom top+=".concat(headerHeight),
        onEnter: function onEnter() {
          return header.classList.add('is-color');
        },
        onLeaveBack: function onLeaveBack() {
          return header.classList.remove('is-color');
        }
      });
    }

    // ========== ページ内リンクのスムーススクロール（ScrollToPlugin） ==========
    var anchors = document.querySelectorAll('a[href^="#"]:not([href="#"])');
    anchors.forEach(function (anchor) {
      anchor.addEventListener('click', function (e) {
        e.preventDefault();
        var targetId = anchor.getAttribute('href');
        var targetElement = document.querySelector(targetId);
        if (targetElement) {
          gsap.to(window, {
            duration: 1,
            ease: 'power2.out',
            scrollTo: {
              y: targetElement,
              offsetY: headerHeight,
              autoKill: true
            }
          });
        }
      });
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
          $(this).delay(200).animate({
            width: '100%'
          }, speed, function () {
            image.css('opacity', '1');
            $(this).css({
              left: '0',
              right: 'auto'
            });
            $(this).animate({
              width: '0%'
            }, speed);
          });
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
        $('.page-information__tabs .page-information__tab-panel').removeClass('is-active').eq(index).addClass('is-active'); //○番目のコンテンツのみを表示
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
      $('.page-information__tabs .page-information__tab-panel').removeClass('is-active');
      //何番目のタブかを格納
      var tabno = $('.page-information__tabs .page-information__tab-panel#' + tabname).index();
      //コンテンツ表示
      $('.page-information__tabs .page-information__tab-panel').eq(tabno).addClass('is-active');
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
            modalImage.innerHTML = '<img src="'.concat(imagePath, '" alt="', imageAlt, '">');
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
          $item.removeClass('is-show').fadeOut().promise().done(function () {
            $item.addClass('is-show').fadeIn();
          });
          // all 以外の場合は、クリックした要素のdata属性の値を同じ値のアイテムを表示
        } else {
          $item.removeClass('is-show').fadeOut().promise().done(function () {
            $item.filter('[data-item = "' + $filterItem + '"]').addClass('is-show').fadeIn();
          });
        }
      });
    });

    // ========== スクロールアニメーション ==========
    var intersectionObserver = new IntersectionObserver(function (entries) {
      entries.forEach(function (entry) {
        if (entry.isIntersecting) {
          entry.target.classList.add("is-in-view");
        } else {
          // 何度でも表示させる場合はコメントアウトを解除
          // entry.target.classList.remove("is-in-view");
        }
      });
    });

    // IntersectionObserverを監視
    var InViewItems = document.querySelectorAll(".js-in-view");
    InViewItems.forEach(function (inViewItem) {
      intersectionObserver.observe(inViewItem);
    });

    // ========== オープニングアニメーション ==========
    var tl = gsap.timeline({
      defaults: {
        ease: 'power3.out'
      },
      delay: 0.05
    });

    // 初期はCSSでセット済みなら .set は不要（残すなら保険としてOK）
    gsap.set('.opening__logoOrangeFx .logoMask--bottom', {
      clipPath: 'inset(var(--splitY) 50% 0 50%)'
    });
    gsap.set('.opening__logoOrangeFx .logoMask--top', {
      clipPath: 'inset(var(--splitY) 0 calc(100% - var(--splitY)) 0)'
    });

    // 1) 英文：中央1px → 左右いっぱいへ水平展開
    tl.to('.opening__logoOrangeFx .logoMask--bottom', {
      clipPath: 'inset(var(--splitY) 0% 0 0%)',
      // ← すべて%で統一
      duration: 1.55,
      ease: 'power2.out'
    }, '+=0.12');

    // 2) 日本語：下からせり上げ
    tl.to('.opening__logoOrangeFx .logoMask--top', {
      clipPath: 'inset(0% 0 calc(100% - var(--splitY)) 0)',
      duration: 1.25,
      ease: 'power3.out'
    }, '-=0.25')

    // 3) 左半分：下→上（スライドアップ風）
    .to('.opening__half--left', {
      clipPath: 'inset(0% 50.1% 0% 0%)',
      // ← %統一
      duration: 1.3,
      ease: 'power3.out'
    }, '+=0.5')

    // 4) 右半分：下→上（※右を上から下へにしたいなら初期/終端値を逆に）
    .to('.opening__half--right', {
      clipPath: 'inset(0% 0% 0% 49.1%)',
      // ← %統一
      duration: 1.3,
      ease: 'power3.out'
    }, '-=1.18') // 0.12秒遅れ（1.3 - 0.12 = 1.18 で重ね開始）

    // 5) オレンジロゴをフェードアウト
    // .to('.opening__logoOrange', {
    //   opacity: 0,
    //   duration: 0.4,
    //   ease: 'power1.out'
    // }, '-=0.8')

    // 6) 白抜きロゴをフェードイン
    .fromTo('.opening__logoWhite', {
      display: 'block',
      opacity: 0
    }, {
      opacity: 1,
      duration: 1.3,
      ease: 'power2.out'
    }, '-=0.4')

    // 7) オープニング全体をフェードアウト → Swiper開始
    .to('.opening', {
      opacity: 0,
      duration: 1.15,
      ease: 'power2.inOut',
      delay: 0.2,
      onComplete: function onComplete() {
        document.querySelector('.opening').style.display = 'none';
        // Swiper再始動
        mainViewSwiper.autoplay.start();
      }
    });

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
});