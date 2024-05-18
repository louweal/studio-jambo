<?php

/**
 * Template:			plugins.php
 * Description:			plugins options and settings
 */


/**
 * Add options and sub options pages to theme
 * 
 * Here we can add fields that are 
 * globally available throughout the theme.
 * 
 * @since	1.0
 */
// add_action( 'acf/init', 'acf_options_init' );
function acf_options_init()
{

    // Check function exists.
    if (function_exists('acf_add_options_page')) {

        // Register options page.
        $option_page = acf_add_options_page(array(
            'page_title'     => 'Theme settings',
            'menu_title'    => 'Theme settings',
            'menu_slug'     => 'theme-settings',
            'capability'    => 'edit_posts',
            'redirect'        => false
        ));
    }
}


/**
 * 
 * Add custom Block Editor Block
 * 
 */

add_action('acf/init', 'custom_acf_blocks_init');
function custom_acf_blocks_init()
{

    // Check function exists.
    if (function_exists('acf_register_block_type')) {

        // Register a testimonial block.
        acf_register_block_type(array(
            'name'              => 'block',
            'title'             => 'Block',
            'description'       => 'Editor Block',
            'render_template'   => 'template-parts/block/block.php',
            'category'          => 'common',
        ));
    }
}
