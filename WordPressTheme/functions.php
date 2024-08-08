<?php

/*------------------------------------------
CSS・JavaScript・font・swiperの設定
/*----------------------------------------*/
function theme_enqueue_styles_and_scripts()
{

  // Google Fonts
  wp_enqueue_style('google-fonts', 'https://fonts.googleapis.com/css2?family=BioRhyme:wght@200..800&family=Lora:ital,wght@0,400..700;1,400..700&family=Zen+Old+Mincho&display=swap', array(), null);

  // Swiper CSS
  wp_enqueue_style('swiper-style', 'https://cdnjs.cloudflare.com/ajax/libs/Swiper/8.4.7/swiper-bundle.min.css', array(), null);

  // WOW CSS
  wp_enqueue_style('animate-style', get_template_directory_uri() . '/assets/css/animate.css', array(), null);

  // メインスタイルシート
  wp_enqueue_style('theme-style', get_template_directory_uri() . '/assets/css/style.css', array(), null);

  // jQuery
  wp_enqueue_script('jquery-cdn', 'https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js', array(), null, true);

  // Swiper JS
  wp_enqueue_script('swiper-js', 'https://cdnjs.cloudflare.com/ajax/libs/Swiper/8.4.7/swiper-bundle.min.js', array(), null, true);

  // inview JS
  wp_enqueue_script('inview-js', get_template_directory_uri() . '/assets/js/jquery.inview.min.js', array(), null, true);

  // WOW JS
  wp_enqueue_script('wow-js', 'https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js', array(), null, true);

  // オリジナルのJSファイル
  wp_enqueue_script('theme-script', get_template_directory_uri() . '/assets/js/script.js', array(), null, true);
}
add_action('wp_enqueue_scripts', 'theme_enqueue_styles_and_scripts');


/*------------------------------------------
投稿画面の標準機能の設定
/*----------------------------------------*/
function my_setup()
{
  // アイキャッチ画像（サムネイル）をサポート
  add_theme_support('post-thumbnails');

  // RSSフィードリンクを自動的に生成
  add_theme_support('automatic-feed-links');

  // HTMLの<title>タグを自動生成
  add_theme_support('title-tag');

  // HTML5マークアップのサポートを追加
  add_theme_support('html5', array(
    'comment-list',    // コメントリストのマークアップをHTML5に
    'comment-form',    // コメントフォームのマークアップをHTML5に
    'search-form',     // 検索フォームのマークアップをHTML5に
    'gallery',         // ギャラリーのマークアップをHTML5に
    'caption',         // キャプションのマークアップをHTML5に
    'style',           // スタイルのマークアップをHTML5に
    'script'           // スクリプトのマークアップをHTML5に
  ));
}
// テーマの初期設定を行うフック
add_action('after_setup_theme', 'my_setup');


/*------------------------------------------
【投稿一覧】アイキャッチを利用できるようにする
/*----------------------------------------*/
add_theme_support('post-thumbnails');

// カスタム画像サイズを追加
add_image_size('admin-list-thumb', 100, 100, true); // true はハードクロップを指定

// WordPress管理画面の投稿一覧のテーブルヘッダーに新しい列を追加
function add_featured_image_column_to_posts($columns)
{
  $columns['featured_image'] = __('アイキャッチ');
  return $columns;
}
add_filter('manage_posts_columns', 'add_featured_image_column_to_posts');


/*------------------------------------------
【投稿一覧】アイキャッチ画像を表示する
/*----------------------------------------*/
function show_featured_image_column_in_posts($column_name, $post_id)
{
  if ('featured_image' === $column_name) {
    $post_featured_image = get_the_post_thumbnail($post_id, 'admin-list-thumb');
    if ($post_featured_image) {
      echo $post_featured_image;
    } else {
      echo __('画像なし');
    }
  }
}
add_action('manage_posts_custom_column', 'show_featured_image_column_in_posts', 10, 2);


/*------------------------------------------
【管理画面】アイキャッチ画像カラムの幅を調整
/*----------------------------------------*/
function custom_admin_css()
{
  echo '<style>
        .column-featured_image {
            width: 100px;
        }
        .column-featured_image img {
            width: 100px;
            height: 100px;
            object-fit: cover;
        }
    </style>';
}
add_action('admin_head', 'custom_admin_css');


/*---------------------------------------
【ダッシュボード】ブログ投稿のアイコン
/*--------------------------------------*/
function change_post_menu_icon()
{
?>
  <style>
    #adminmenu .menu-icon-post div.wp-menu-image:before {
      content: '\f464';
      /* Dashicons Edit アイコン */
    }
  </style>
<?php
}
add_action('admin_head', 'change_post_menu_icon');


/*---------------------------------------
【ダッシュボード】左メニューのカスタマイズ
/*--------------------------------------*/
/* 「ブログ投稿」ラベル変更 */
function change_post_menu_label()
{
  global $menu;
  global $submenu;
  $name = 'ブログ';
  $menu[5][0] = $name;
  $submenu['edit.php'][5][0] = $name . '一覧';
  $submenu['edit.php'][10][0] = '新しい' . $name;
}
function change_post_object_label()
{
  global $wp_post_types;
  $name = 'ブログ';
  $labels = &$wp_post_types['post']->labels;
  $labels->name = $name;
  $labels->singular_name = $name;
  $labels->add_new = _x('追加', $name);
  $labels->add_new_item = $name . 'の新規追加';
  $labels->edit_item = $name . 'の編集';
  $labels->new_item = '新規' . $name;
  $labels->view_item = $name . 'を表示';
  $labels->search_items = $name . 'を検索';
  $labels->not_found = $name . 'が見つかりませんでした';
  $labels->not_found_in_trash = 'ゴミ箱に' . $name . 'は見つかりませんでした';
}
add_action('init', 'change_post_object_label');
add_action('admin_menu', 'change_post_menu_label');


/*------------------------------------------
【ダッシュボード】メニューの並び順
/*----------------------------------------*/
function custom_menu_order($menu_order)
{
  if (!$menu_order) return true;

  // メニューの新しい順序を定義
  return array(
    'index.php',                    // ダッシュボード
    'edit.php',                     // 投稿
    'edit.php?post_type=campaign',  // カスタム投稿タイプ: キャンペーン
    'edit.php?post_type=voice',     // カスタム投稿タイプ: ボイス
    'edit.php?post_type=page',      // 固定ページ
    'upload.php',                   // メディア
    'link-manager.php',             // リンク (リンクマネージャープラグインが有効な場合)
    'edit-comments.php',            // コメント
    'themes.php',                   // 外観
    'plugins.php',                  // プラグイン
    'users.php',                    // ユーザー
    'tools.php',                    // ツール
    'options-general.php',          // 設定
    'separator1',                   // 最初の区切り
    'separator2',                   // 2番目の区切り
    'separator-last',               // 最後の区切り
  );
}

add_filter('custom_menu_order', 'custom_menu_order');
add_filter('menu_order', 'custom_menu_order');


/*------------------------------------------
カスタム投稿タイプの表示件数指定
/*----------------------------------------*/
function custom_posts_per_page($query)
{
  // 管理画面以外かつメインクエリの場合に実行
  if (!is_admin() && $query->is_main_query()) {
    // カスタム投稿タイプ 'campaign' または 'campaign_category' タクソノミーアーカイブページの場合
    if ($query->is_post_type_archive('campaign') || $query->is_tax('campaign_category')) {
      $query->set('posts_per_page', 4); // 投稿数を 4 に設定
    }
    // カスタム投稿タイプ 'voice' または 'voice_category' タクソノミーアーカイブページの場合
    elseif ($query->is_post_type_archive('voice') || $query->is_tax('voice_category')) {
      $query->set('posts_per_page', 6); // 投稿数を 6 に設定
    }
  }
}
// アクションフック 'pre_get_posts' にフック
add_action('pre_get_posts', 'custom_posts_per_page');


/*------------------------------------------
footer：自動で追記されるクラス名を削除
/*----------------------------------------*/
function remove_body_class_from_home_page($classes)
{
  if (is_home()) {
    // home.phpなどのページテンプレートではクラスを削除する
    $classes = array_diff($classes, array('blog'));
  }
  return $classes;
}
add_filter('body_class', 'remove_body_class_from_home_page');


/*---------------------------------------
【投稿画面】タイトルプレイスホルダー変更
/*--------------------------------------*/
// 管理画面用カスタマイズのcssファイルを指定
function my_admin_style()
{
  wp_enqueue_style('my_admin_style', get_template_directory_uri() . '/assets/css/admin-style.css');
}
add_action('admin_enqueue_scripts', 'my_admin_style');

// タイトルのプレイスホルダーの変更
function custom_enter_title_here($title, $post)
{
  // 投稿タイプをチェック
  if ($post->post_type == 'campaign') {
    $title = 'キャンペーンのタイトルを入力してください';
  } elseif ($post->post_type == 'voice') {
    $title = 'お客様の声のタイトルを入力してください';
  } elseif ($post->post_type == 'post') {
    $title = '記事のタイトルを入力してください';  // デフォルトの投稿タイプのタイトルプレースホルダー
  }
  return $title;
}
add_filter('enter_title_here', 'custom_enter_title_here', 10, 2);


/*---------------------------------------
【投稿画面】本文プレイスホルダーの変更
/*--------------------------------------*/
/* 本文の説明テキストを変更(クリックしたら戻る) */
function custom_enter_placeholder($text)
{
  $screen = get_current_screen();
  if ($screen->post_type == 'post') {
    $text = 'ここにブログ記事の本文・画像などを入力してください';
  } elseif ($screen->post_type == 'campaign') {
    $text = 'ここにキャンペーンの説明を入力してください';
  } elseif ($screen->post_type == 'voice') {
    $text = 'ここにお客様の声の本文を入力してください';
  }
  return $text;
}
add_filter('write_your_story', 'custom_enter_placeholder', 10, 2);
