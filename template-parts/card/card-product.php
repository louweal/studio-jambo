<?php

/**
 * Template:			card.php
 * Description:			The card template for products
 *
 */

$product = wc_get_product($post->ID);

$price = $product->get_regular_price();
$attachment_ids = $product->get_gallery_image_ids();

?>

<article class="card card--product">
    <a class="card__inner" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
        <div class="card__header">
            <?php if (has_post_thumbnail()) { ?>
                <picture>
                    <source media="(min-width: 30em)" srcset="<?php the_post_thumbnail_url('medium_large'); ?>">
                    <img class="card__featured" src="<?php the_post_thumbnail_url('medium_large'); ?>" alt="<?php the_title(); ?>">
                </picture>
            <?php } ?>

        </div>
        <div class="card__body">
            <div class="editor editor--card text-center">
                <h3><?php the_title(); ?></h3>
                <span class="price">
                    € <?php echo $price; ?>
                </span>
            </div>
        </div>
    </a>
</article>