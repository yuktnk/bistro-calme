<?php get_header(); ?>

<h2 class="pageTitle">メニュー<span>MENU</span></h2>

<?php get_template_part('template-parts/breadcrumb.php'); ?>

<main class="main">
    <section class="sec">
        <div class="container">
            <div class="sec_header">
                <h2 class="title title-jp">フード</h2>
                <span class="title title-en">FOOD</span>
            </div>
            <div class="row justify-content-center">
                <?php if ( have_posts() ) : ?>
                    <?php while ( have_posts() ) : the_post();?>
                        <div class="col-md-3">
                            <?php get_template_part('template-parts/loop', 'menu') ?>
                        </div>
                    <?php endwhile; ?>
                <?php endif; ?>
            </div>
        </div>
    </section>
</main>

<?php get_footer(); ?>