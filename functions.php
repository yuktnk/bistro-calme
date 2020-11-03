<?php
/**
 * <title>タグを出力する
 */
add_theme_support( 'title-tag' );


/**
 * タイトルタグの区切り文字をエン・ダッシュから縦線に変更する
 */
add_filter('document_title_separator', 'my_document_title_separator');
function my_document_title_separator($separator){
  $separator = '|';
  return $separator;
}

/**
 * タイトルタグのテキストを変更する
 */
add_filter('document_title_parts', 'my_document_title_parts');
function my_document_title_parts($title){
  if (is_home()) {
    unset($title['tagline']); // タグラインを削除
    $title['title'] = 'BISTRO CALMEは、カジュアルなワインバーよりなビストロです。'; //テキストを変更
  }
  return $title;
}

// アイキャッチ画像を使用可能にする
add_theme_support( 'post-thumbnails' );

// カスタムメニュー機能を使用可能にする
add_theme_support('menus');

// コメントフォームから「名前」「メールアドレス」「サイト」を削除する
add_filter('comment_form_default_fields', 'my_comment_form_default_fields');
function my_comment_form_default_fields($args) {
  $args['author'] = ''; // 「名前」を削除
  $args['email'] = '';  // 「メールアドレス」を削除
  $args['url'] = '';    // 「サイト」を削除
  return $args;
}

// pre_get_posts（アクションフック）を設定してメインクエリの内容を変更する
add_action('pre_get_posts', 'my_pre_get_posts');
function my_pre_get_posts($query) {
  // 管理画面、メインクエリ以外には設定しない
  if ( is_admin() || !$query->is_main_query() ) {
    return;
  }
  // トップページで表示する投稿数を3件にする
  if ( $query->is_home() ) {
    $query->set('posts_per_page', 3);
    return;
  }
}

// WPの自動整形を止める（フォームのようなHTMLタグのみで構成したページには余計な機能なため。）
add_action('wp', 'my_wpautop');
function my_wpautop() {
  if (is_page('contact')){
    remove_filter('the_content', 'wpautop');
  }
}