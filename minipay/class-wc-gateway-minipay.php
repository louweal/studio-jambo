<?php

if (!defined('ABSPATH')) {
    exit;
}


function shortWallet($address)
{
    $start = substr($address, 0, 6);
    $end = substr($address, -5);
    return $start . "....." . $end;
}

function inspectWallet($address)
{
    // return shortWallet($address);
    return "<a href='https://alfajores.celoscan.io/address/" . $address . "' target='_blank'>" . shortWallet($address) . "</a>";
}

class WC_Gateway_Minipay extends WC_Payment_Gateway
{
    // private $log;
    // private $log_context;

    public $wallet1;
    public $wallet2;
    public $percentage;

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
        // $this->description = $this->get_option('description');
        $this->wallet1 = $this->get_option('wallet1');
        $this->wallet2 = $this->get_option('wallet2');
        $this->percentage = $this->get_option('percentage');

        // Actions
        add_action('woocommerce_receipt_' . $this->id, array($this, 'receipt_page'));
        add_action('woocommerce_update_options_payment_gateways_' . $this->id, array($this, 'process_admin_options'));

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
                'description' => 'This is the title which the user sees during checkout.',
                'default' => 'MiniPay',
            ),
            // 'description' => array(
            //     'title' => 'Description',
            //     'type' => 'textarea',
            //     'default' => 'Pay with <a href="https://docs.celo.org/developer/build-on-minipay/overview" target="_blank">MiniPay</a>.',
            // ),
            'wallet1' => array(
                'title' => 'Receiver Wallet Address 1',
                'type' => 'text',
                'description' => 'Celo Wallet Address of the main receiver.',
            ),
            'wallet2' => array(
                'title' => 'Receiver Wallet Address 2',
                'type' => 'text',
                'description' => 'Celo Wallet Address of the second receiver. For example the wallet address of a good cause.',

            ),
            'percentage' => array(
                'title' => 'Percentage to main receiver',
                'type' => 'text',
                'description' => 'Set the percentage of each payment that goes to the main receiver. The remaining percentage goes to the second receiver.',
                'default' => '80',
            ),
        );
    }

    public function admin_options()
    {
        echo '<h2>' . esc_html($this->get_method_title()) . '</h2>';
        // echo wp_kses_post(wpautop($this->get_method_description()));
        // echo '<p>' . esc_html($this->get_method_wallet1()) . '</p>';
        echo '<table class="form-table">';
        $this->generate_settings_html();
        echo '</table>';
    }

    public function payment_fields()
    {
        // if ($this->description) {
        //     echo wpautop(wp_kses_post($this->description));
        // }
        echo wpautop("Make sure you are using Opera Mini Beta with <a href='https://docs.celo.org/developer/build-on-minipay/overview' target='_blank'>MiniPay</a> and have enough cUSD in your MiniPay wallet to use this payment method.");

        echo "<br>Receiver(s):<br>";
        if (isset($this->percentage) && !empty($this->percentage)) {
            $percentage1 = (int)$this->percentage;
            $percentage2 = (100 - $percentage1);
        }

        if (isset($this->percentage) && !empty($this->percentage) && isset($this->wallet1) && !empty($this->wallet1)) {
            echo wpautop(inspectWallet($this->wallet1) . " - " . $percentage1 . "%");
        }
        if (isset($this->percentage) && !empty($this->percentage) && isset($this->wallet2) && !empty($this->wallet2)) {
            echo wpautop(inspectWallet($this->wallet2) . " - " . $percentage2 . "%");
        }
    }



    public function validate_fields()
    {
        // Validate payment fields here
        return true;
    }

    public function process_payment($order_id)
    {
        $order = wc_get_order($order_id);
        // Mark as pending payment (allowing the customer to pay).
        $order->update_status('pending', __('Awaiting MiniPay payment', 'woocommerce'));

        // wc_reduce_stock_levels($order_id);

        // Remove cart
        // WC()->cart->empty_cart();

        // Return thankyou redirect
        // return array(
        //     'result' => 'success',
        //     'redirect' => $this->get_return_url($order)
        // );

        // Return thank you page redirect.
        return array(
            'result'   => 'success',
            'redirect' => $order->get_checkout_payment_url(true),
        );
    }

    public function receipt_page($order)
    {
        error_log('receipt_page method called.');
        echo '<p>Thank you for your order, please click the button below to pay with MiniPay.<br></p>';
        echo "<button class='btn minipay-pay'>Pay now</button>";
    }

    public function check_response()
    {
        // Handle the payment response
        // echo "Handle response";
    }
}
