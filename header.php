<?php

/**	
 * Template:			header.php
 * Description:			The template for displaying the header
 */

?>

<!DOCTYPE html>
<html lang="<?php bloginfo('language'); ?>" class="no-js">

<head>

    <?php
    wp_head(); ?>
    <script type="text/javascript" src="https://cloudfront.loggly.com/js/loggly.tracker-2.2.4.min.js" async></script>
    <script>
        var _LTracker = _LTracker || [];
        _LTracker.push({
            'logglyKey': 'ede83e6b-b945-485c-8641-8e773fc077f5',
            'sendConsoleErrors': true,
            'tag': 'loggly-jslogger',
        });
    </script>
</head>

<body <?php body_class(); ?>>

    <?php
    wp_body_open(); ?>

    <header id="site-header" class="header">
        <div class="flex flex-row justify-between items-center w-full">
            <div class="header__logo">
                <a href="<?php echo home_url(); ?>" title="<?php bloginfo('name'); ?>" rel="home">
                    <picture>
                        <?php if (get_the_retina_logo()) { ?>
                            <source srcset="<?php the_logo(); ?> 1x, <?php the_retina_logo(); ?> 2x">
                        <?php } ?>
                        <img alt="<?php bloginfo('name'); ?>" src="<?php the_logo(); ?>">
                    </picture>
                </a>
            </div>

            <div>
                <a href="/checkout/">Checkout</a>
            </div>

            <div>
                <a href="/mijn-account/">Sign in</a>
            </div>

            <?php if (has_nav_menu('menu-main')) { ?>
                <div class="hidden lg:block">
                    <?php $nav_menu_args = array(
                        'theme_location'        => 'menu-main',
                        'container'             => 'nav',
                        'container_class'       => 'menu menu--main',
                        'menu_class'            => 'menu__list menu__list--main',
                        'walker'                => new Custom_Walker_Nav_Menu()
                    );
                    wp_nav_menu($nav_menu_args); ?>

                </div>
            <?php } ?>

            <?php if (is_active_sidebar('cart-widget')) { ?>
                <?php dynamic_sidebar('cart-widget'); ?>
            <?php } ?>

            <!-- <div class="header__toggle order-1">
                <button id="menu-toggle" class="toggle js-toggle-menu" title="Toggle menu">
                    <span class="toggle__inner">
                        <span></span><span></span><span></span>
                    </span>
                </button>
            </div> -->
        </div>


    </header>