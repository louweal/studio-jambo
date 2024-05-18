<?php

/**
 * Template:			singular.php
 * Description:			The template for displaying single posts and pages.
 *
 */

get_header();

?>

<main id="site-main" class="main">

    <?php if (have_posts()) {
        while (have_posts()) {
            the_post(); ?>



            <?php if (is_singular('post')) { ?>

                <?php $terms = get_the_terms($post, 'category'); ?>

                <section class="section">
                    <div class="container flex flex-col lg:flex-row gap-8 lg:gap-0">
                        <div class="lg:w-8/12 mx-auto flex flex-col gap-6 lg:ml-[calc(100%/12*1.5)]">
                            <div class="section__details">
                                <?php if ($terms) { ?>
                                    <span><?php echo $terms[0]->name; ?></span>
                                <?php } ?>
                                <p><?php the_date(); ?></p>
                            </div>
                            <div class="editor editor--post">
                                <h1><?php the_title(); ?></h1>
                                <?php the_content(); ?>
                            </div>
                        </div>
                        <div class="lg:w-1/12 flex lg:justify-end lg:order-[-1] relative">
                            <div class="section__share">
                                <span>Share</span>
                                <div class="section__share-links">
                                    <a target="_blank" title="LinkedIn" href=https://www.linkedin.com/shareArticle?mini=true&url=<?php the_permalink(); ?>">
                                        <i class="fa-brands fa-linkedin-in"></i>
                                    </a>
                                    <a target="_blank" title="Facebook" href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>">
                                        <i class="fa-brands fa-facebook-f"></i>
                                    </a>
                                    <a target="_blank" title="Twitter" href="https://twitter.com/intent/tweet?url=<?php the_permalink(); ?>">
                                        <i class="fa-brands fa-twitter"></i>
                                    </a>
                                    <a target="_blank" title="Mail" href="mailto:?subject=<?php the_title(); ?>&amp;body=%0D%0ALees het volledige artikel op: <?php the_permalink(); ?>">
                                        <i class="fa-solid fa-envelope"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

            <?php } else { ?>

                <?php get_hero(); ?>

                <?php if (!empty(get_the_content())) { ?>
                    <section class="section">
                        <div class="container">
                            <div class="lg:w-8/12 mx-auto">
                                <div class="editor">
                                    <?php if (is_singular('post')) { ?>
                                        <h1><?php the_title(); ?></h1>
                                    <?php } ?>
                                    <?php the_content(); ?>
                                </div>
                            </div>
                        </div>
                    </section>
                <?php } ?>

                <?php get_template_part('/template-parts/pagebuilder/pagebuilder', '');
                ?>

            <?php } ?>

    <?php }
    } ?>

</main>

<?php get_footer(); ?>