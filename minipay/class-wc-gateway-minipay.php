<?php

if (!defined('ABSPATH')) {
    exit;
}

class WC_Gateway_Minipay extends WC_Payment_Gateway
{
    // private $log;
    // private $log_context;

    public function __construct()
    {
        $this->id = 'minipay';
        $this->icon = ''; // URL of the icon that will be displayed on the checkout page
        $this->has_fields = true;
        $this->method_title = 'MiniPay';
        $this->method_description = 'Description of MiniPay';

        // Load the settings
        $this->init_form_fields();
        $this->init_settings();

        // Define user set variables
        $this->title = $this->get_option('title');
        $this->description = $this->get_option('description');

        // Actions
        add_action('woocommerce_update_options_payment_gateways_' . $this->id, array($this, 'process_admin_options'));
        add_action('woocommerce_receipt_' . $this->id, array($this, 'receipt_page'));

        // Payment listener/API hook
        add_action('woocommerce_api_wc_gateway_' . $this->id, array($this, 'check_response'));


        // Other custom code
        // Enable logging for debugging
        // $this->log = wc_get_logger();
        // $this->log_context = array('source' => 'minipay');
    }

    // public function is_available()
    // {
    //     $is_available = ('yes' === $this->enabled);
    //     $this->log->info('Is available: ' . ($is_available ? 'yes' : 'no'), $this->log_context);
    //     return $is_available;
    // }

    public function init_form_fields()
    {
        // $this->log->info('init form fields...', $this->log_context);

        $this->form_fields = array(
            'enabled' => array(
                'title' => 'Enable/Disable',
                'type' => 'checkbox',
                'label' => 'Enable MiniPay',
                'default' => 'yes'
            ),
            'title' => array(
                'title' => 'Title',
                'type' => 'text',
                'description' => 'This controls the title which the user sees during checkout.',
                'default' => 'MiniPay',
                'desc_tip' => true,
            ),
            'description' => array(
                'title' => 'Description',
                'type' => 'textarea',
                'default' => 'MiniPay is a super light, stablecoin-based, non-custodial wallet inside the Opera Mini browser that allows you to send and receive funds instantly using just a phone number.',
            ),
            'wallet' => array(
                'title' => 'Celo Wallet Address',
                'type' => 'text',
                'description' => 'Your wallet address.',
                'default' => '0x000000000',
            ),
            'split' => array(
                'title' => 'Split',
                'type' => 'checkbox',
                'label' => 'Split the payment',
                'default' => 'yes',
                'description' => 'Split the payment and send it to multiple receivers, for example to donate a percentage directly to a good cause.',
            ),
        );
    }

    public function admin_options()
    {
        echo '<h2>' . esc_html($this->get_method_title()) . '</h2>';
        echo wp_kses_post(wpautop($this->get_method_description()));
        echo '<table class="form-table">';
        $this->generate_settings_html();
        echo '</table>';
    }

    public function payment_fields()
    {
        // $this->log->info('set payment fields...', $this->log_context);

        if ($this->description) {
            echo wpautop(wp_kses_post($this->description));
        }
        // You can also add custom payment fields here
    }

    public function validate_fields()
    {
        // Validate payment fields here
        return true;
    }

    public function process_payment($order_id)
    {
        // $this->log->info('Processing payment...', $this->log_context);

        $order = wc_get_order($order_id);

        // Mark as on-hold (we're awaiting the payment)
        $order->update_status('on-hold', __('Awaiting payment', 'my-custom-gateway'));

        // Reduce stock levels
        wc_reduce_stock_levels($order_id);

        // Remove cart
        WC()->cart->empty_cart();

        // Return thankyou redirect
        return array(
            'result' => 'success',
            'redirect' => $this->get_return_url($order)
        );
    }

    public function receipt_page($order)
    {
        echo '<p>' . __('Thank you for your order, please click the button below to pay with MiniPay.', 'my-custom-gateway') . '</p>';
        // Custom payment form can be added here
    }

    public function check_response()
    {
        // Handle the payment response
    }
}
