<section class="menu menu-border">
    <?php if(!empty(block_value('url'))) : ?>
        <a href="<?php block_field('url'); ?>">
    <?php endif; ?>

    <figure class="menu_pic">
        <img src="<?php block_field('pic'); ?>">
    </figure>
    <h3 class="menu_title"><?php block_field('name'); ?></h3>
    <p class="menu_price"><?php block_field('price'); ?></p>
    <div class="menu_desc">
        <?php block_field('desc'); ?>
    </div>
    
    <?php if(!empty(block_value('url'))) : ?>
        </a>
    <?php endif; ?>
</section>
