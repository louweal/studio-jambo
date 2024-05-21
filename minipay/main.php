<?php
/*
Plugin Name: MiniPay
Description: MiniPay for WooCommerce.
Version: 1.0001
Author: Anneloes Louwe
*/

// Exit if accessed directly.
if (!defined('ABSPATH')) {
    exit;
}

add_action('wp_enqueue_scripts', 'enqueue_minipay_script');
function enqueue_minipay_script()
{
    if (is_checkout()) { // page slug
        // Enqueue the script
        wp_enqueue_script('minipay-script', plugin_dir_url(__FILE__) . 'dist/minipay.bundle.js', array(), time(), true);
    }
}

add_filter('script_loader_tag', 'add_type_attribute', 10, 3);
function add_type_attribute($tag, $handle, $src)
{
    // Add type="module" to our script
    if ('minipay-script' === $handle) {
        $tag = '<script type="module" src="' . esc_url($src) . '"></script>';
    }
    return $tag;
}

function minipay_enqueue_styles()
{
    // Enqueue your CSS file
    wp_enqueue_style(
        'minipay-styles', // Handle
        plugins_url('src/css/main.css', __FILE__), // Path to your CSS file
        array(), // Dependencies
        null, // Version number
        'all' // Media type
    );
}
add_action('wp_enqueue_scripts', 'minipay_enqueue_styles');

add_action('plugins_loaded', 'init_minipay_gateway');
function init_minipay_gateway()
{

    // Check if WooCommerce is active
    if (!class_exists('WC_Payment_Gateway')) return;

    // Include our Gateway Class
    include_once 'class-wc-gateway-minipay.php';

    // Add the Gateway to WooCommerce
    add_filter('woocommerce_payment_gateways', 'add_minipay_payment_gateway');
}

function add_minipay_payment_gateway($gateways)
{
    $gateways[] = 'WC_Gateway_Minipay';
    return $gateways;
}
