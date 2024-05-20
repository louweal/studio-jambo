<?php

/**
 * Template:			hero.php
 * Description:			Default hero template
 */

?>

<header class="hero">


</header>

<?php

return;

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