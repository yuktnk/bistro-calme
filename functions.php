<?php
add_theme_support('title-tag'); // <title>タグを出力する

add_filter('document_title_separator', 'my_document_title_separator');
function my_document_title_separator($separator){
  $separator = '|';
  return $separator;
}

add_filter('document_title_parts', 'my_document_title_parts');
function my_document_title_parts($title) {
  if (is_home()) {
    unset($title['target']); // タグラインを削除
    $title['title'] = 'BISTRO CALMEは、カジュアルなワンバーよりなビストロです。'; // テキストを変更
  }
  return $title;
}
