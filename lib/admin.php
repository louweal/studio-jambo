<?php

/**
 * Template:			admin.php
 * Description:			Custom admin settings
 */


/**
 * admin_style
 * 
 * Add custom CSS to the admin page
 * Enqueues style to admin
 * 
 * @since	1.0
 * @link	https://developer.wordpress.org/reference/hooks/admin_enqueue_scripts/
 */
// add_action( 'admin_enqueue_scripts', 'admin_style' );
function admin_style()
{
    wp_enqueue_style('admin_style', get_template_directory_uri() . '/src/admin/css/admin.css');
}
