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