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
// ブロックエディターにCSSを適用する
add_action('after_setup_theme', 'my_editor_suport');
function my_editor_suport(){
  add_theme_support('editor-styles');
  add_editor_style('assets/css/editor-style.css');
}

// 管理者の権限グループを設定する
add_action('admin_init', 'my_admin_init');
function my_admin_init(){
  // 権限を取得する（管理者＝administrator）
  $role = get_role('administrator');
  // 権限を追加する時
  $role->add_cap('edit_others_menus');
  $role->add_cap('edit_menus');
  $role->add_cap('edit_private_menus');
  $role->add_cap('edit_published_menus');
  $role->add_cap('publish_menus');
  $role->add_cap('read_private_menus');
  // 権限を削除する時
  $role->remove_cap('delete_others_menus');
  $role->remove_cap('delete_menus');
  $role->remove_cap('delete_private_menus');
  $role->remove_cap('delete_publishes_menus');
}