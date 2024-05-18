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

</head>

<body <?php body_class(); ?>>

    <?php
    wp_body_open(); ?>

    <header id="site-header" class="header">
        <div class="container">

            <div class="header__logo">
                <a class="logo logo--site" href="<?php echo home_url(); ?>" title="<?php bloginfo('name'); ?>" rel="home">
                    <picture>
                        <?php if (get_the_retina_logo()) { ?>
                            <source srcset="<?php the_logo(); ?> 1x, <?php the_retina_logo(); ?> 2x">
                        <?php } ?>
                        <img alt="<?php bloginfo('name'); ?>" src="<?php the_logo(); ?>">
                    </picture>
                </a>
            </div>

            <?php if (has_nav_menu('menu-main')) { ?>
                <div class="header__navigation" id="header-nav">
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


            <div class="header__toggle">
                <button id="menu-toggle" class="toggle js-toggle-menu" title="Toggle menu">
                    <span class="toggle__inner">
                        <span></span><span></span><span></span>
                    </span>
                </button>
            </div>

        </div>
    </header>