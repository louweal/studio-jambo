<?php

/**
 * Template:			hero.php
 * Description:			Default hero template
 */

$page_id = 7;
$thumbnail_ml = get_the_post_thumbnail_url($page_id, 'medium_large');
$thumbnail_full = get_the_post_thumbnail_url($page_id, 'full');
?>

<header class="hero">
    <div class="grid lg:grid-cols-2 min-h-full">
        <div class="order-2 lg:order-1">
            <div class="hero__inner">
                <h1><?php echo get_the_title($page_id); ?></h1>
            </div>
        </div>

    </div>
    <div class="order-1 lg:order-2 min-h-full">
        <?php if ($thumbnail_ml) { ?>
            <picture class="">
                <source media="(min-width: 30em)" srcset="<?php echo $thumbnail_full; ?>">
                <img src="<?php the_post_thumbnail_url('medium_large'); ?>" alt="<?php echo $thumbnail_ml; ?>">
            </picture>

        <?php } ?>
    </div>
    </div>

</header>