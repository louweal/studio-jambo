<?php

/**
 * Template:			hero.php
 * Description:			Default hero template
 */

?>

<header class="hero">
    <div class="grid lg:grid-cols-2 h-full">
        <div class="order-2 lg:order-1">
            <div class="hero__inner">
                <h1><?php echo get_the_title($page_id); ?></h1>
            </div>
        </div>

        <div class="order-1 lg:order-2 h-full overflow-hidden">
            <?php if ($thumbnail_ml) { ?>
                <picture class="">
                    <source media="(min-width: 30em)" srcset="<?php echo $thumbnail_full; ?>">
                    <img src="<?php the_post_thumbnail_url('medium_large'); ?>" alt="<?php echo $thumbnail_ml; ?>">
                </picture>

            <?php } ?>
        </div>
    </div>

</header>

<?php
$args = array(
    'post_type'         => array('product'),
    'post_status'         => array('publish'),
    'posts_per_page'    => -1,
    'orderby'            => 'date'
);
$post_query = new WP_Query($args);
?>
<?php if ($post_query->have_posts()) {
    $i = 1;
?>
    <div class="flex flex-col gap-8">
        <?php while ($post_query->have_posts()) {
            $post_query->the_post();
            setup_postdata($post);
            echo $post->post_title;
        ?>
    </div>
<?php
        } //while
        wp_reset_postdata();
    }
?>