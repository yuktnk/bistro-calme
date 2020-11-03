<?php
$args = array(
    'post_type' => 'post', // 投稿記事だけを指定
    'post_per_page' => 5,  // 最新記事を5件表示
);
$the_query = new WP_Query($args);
if ( $the_query->have_posts() ) :
?>
<aside class="archive">
    <h2 class="archive_title">最新記事</h2>
    <ul class="archive_list">
        <?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
            <li>
                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
            </li>
        <?php endwhile; ?>
        <!-- ↓ new WP_Queryを使うとWordPressループで使われているグローバルな投稿データが変わるため、リセットする必要がある -->
        <?php wp_reset_postdata(); ?> 
    </ul>
</aside>
<?php endif; ?>
