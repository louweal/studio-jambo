<?php
/*
Plugin Name: MiniPay
Description: MiniPay for WooCommerce.
Version: 1.0
Author: Anneloes Louwe
*/

// Exit if accessed directly.
if (!defined('ABSPATH')) {
    exit;
}

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
    $gateways[] = 'WC_Gateway_MyCustom';
    return $gateways;
}
