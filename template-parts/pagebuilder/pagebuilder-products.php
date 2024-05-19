<?php

/**
 * Template:			pagebuilder-products.php
 * Description:			Products Pagebuilder Layout
 */
$default = get_sub_field('products_default');
if ($default) {
    $editor = get_field('products_editor', 'options');
    $button = get_field('products_button', 'options');
    $items = get_field('products_relationship', 'options');
} else {
    $editor = get_sub_field('products_editor');
    $button = get_sub_field('products_button');
    $items = get_sub_field('products_relationship');
}

?>

<section class="section section--overflow-h section--products" data-aos="fade-up-10">
    <div class="container">
        <div class="grid grid-cols-12 mb-6">
            <div class="col-span-12 lg:col-span-8">
                <?php if ($editor) { ?>
                    <div class="section__title">
                        <?php echo $editor; ?>
                    </div>
                <?php } ?>
            </div>

            <?php if ($button) { ?>
                <div class="col-span-12 lg:col-span-4 text-right">
                    <?php the_link($button, 'btn btn--dark'); ?>
                </div>
            <?php } ?>
        </div>
    </div>

    <div class="container">
        <?php if ($items) { ?>
            <div class="slider slider--products swiper js-slider<?php echo $margin; ?>" data-slider="products">
                <div class="slider__wrapper swiper-wrapper">
                    <?php foreach ($items as $post) {
                        global $post; ?>
                        <div class="slider__slide swiper-slide">
                            <?php get_template_part('./template-parts/card/card', 'product'); ?>
                        </div>
                    <?php }
                    wp_reset_postdata(); ?>
                </div>
            </div>
        <?php } ?>

        <?php if ($button) { ?>
            <div class="lg:hidden">
                <?php the_link($button, 'btn btn--dark'); ?>
            </div>
        <?php } ?>
    </div>
</section>