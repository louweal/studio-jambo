<?php

/**	
 * Template:			woocommerce.php
 * Description:			
 */

get_header();

?>

<main id="site-main" class="main">
    <?php get_hero(); ?>

    <?php if (is_singular('product')) { ?>

        <section class="section woocommerce woocommerce--product" data-aos="fade-up-10">
            <div class="container">
                <div class="woocommerce__content">
                    <?php woocommerce_content(); ?>
                </div>
            </div>
        </section>
    <?php } else if (is_product_category() || is_shop()) { ?>

        <section class="section section--woocommerce woocommerce woocommerce--shop">
            <div class="container">
                <div class="row">
                    <div class="box lg:box-3 flex flex-col gap-[1.875rem] lg:pr-8">
                        <?php if (is_active_sidebar('sidebar-products')) { ?>
                            <div class="woocommerce__sidebar js-woo-filter">
                                <?php dynamic_sidebar('sidebar-products'); ?>
                            </div>
                        <?php } ?>
                    </div>
                    <div class="box lg:box-9">
                        <div class="woocommerce__content">
                            <?php if (is_product_category()) { ?>
                                <div class="editor mb-[3.125rem] lg:max-w-[90%]">

                                <?php } ?>
                                <?php woocommerce_content(); ?>

                                </div>
                        </div>
                    </div>
                    <button class="btn btn--filter js-woo-toggle lg:hidden">
                        <!-- <svg xmlns="http://www.w3.org/2000/svg" width="25" height="24" fill="none">
                            <path stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M18.5 5h3M3.5 5h11M10.5 12h11M3.5 12h3M18.5 19h3M3.5 19h11M17.914 3.586a2 2 0 1 1-2.828 2.828 2 2 0 0 1 2.828-2.828M9.914 10.586a2 2 0 1 1-2.828 2.828 2 2 0 0 1 2.828-2.828M17.914 17.586a2 2 0 1 1-2.828 2.828 2 2 0 0 1 2.828-2.828" />
                        </svg> -->
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24">
                            <path stroke="#000" stroke-linecap="round" stroke-width="1.5" d="M4 5h6m0 0a2 2 0 1 0 4 0m-4 0a2 2 0 1 1 4 0m0 0h6M4 12h12m0 0a2 2 0 1 0 4 0 2 2 0 0 0-4 0Zm-8 7h12M8 19a2 2 0 1 0-4 0 2 2 0 0 0 4 0Z" />
                        </svg>
                        <span>Open filters</span>
                    </button>
                </div>
        </section>

    <?php } else { ?>
        <section class="section section--woocommerce woocommerce" data-aos="fade-up-10">
            <div class="container">
                <div class="woocommerce__content">
                    <?php woocommerce_content(); ?>
                </div>
            </div>
        </section>
    <?php } ?>

</main>

<?php get_footer(); ?>