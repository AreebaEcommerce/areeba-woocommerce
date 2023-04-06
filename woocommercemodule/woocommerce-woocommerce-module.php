<?php
/**
 * Plugin Name: WooCommerce woocommerce module Extension
 * Description: woocommerce module for WooCommerce
 * Version: 1.7.3
 * Author: woocommerce module
 * WC requires at least: 3.6.0
 * WC tested up to: 3.7.0
 */
if (!defined('ABSPATH')) {
    exit;
}

define('WOOCOMMERCE_MODULE_EXTENSION_URL', 'https://gateway.areebapayment.com/');
define('WOOCOMMERCE_MODULE_EXTENSION_NAME', 'woocommerce module');
define('WOOCOMMERCE_MODULE_EXTENSION_VERSION', '1.7.3');
define('WOOCOMMERCE_MODULE_EXTENSION_UID_PREFIX', 'woocommerce_module_');
define('WOOCOMMERCE_MODULE_EXTENSION_BASEDIR', plugin_dir_path(__FILE__));

add_action('plugins_loaded', function () {
    require_once WOOCOMMERCE_MODULE_EXTENSION_BASEDIR . 'classes/includes/woocommerce-module-provider.php';
    require_once WOOCOMMERCE_MODULE_EXTENSION_BASEDIR . 'classes/includes/woocommerce-module-creditcard.php';
    require_once WOOCOMMERCE_MODULE_EXTENSION_BASEDIR . 'classes/includes/woocommerce-module-creditcard-amex.php';
    require_once WOOCOMMERCE_MODULE_EXTENSION_BASEDIR . 'classes/includes/woocommerce-module-creditcard-diners.php';
    require_once WOOCOMMERCE_MODULE_EXTENSION_BASEDIR . 'classes/includes/woocommerce-module-creditcard-discover.php';
    require_once WOOCOMMERCE_MODULE_EXTENSION_BASEDIR . 'classes/includes/woocommerce-module-creditcard-jcb.php';
    require_once WOOCOMMERCE_MODULE_EXTENSION_BASEDIR . 'classes/includes/woocommerce-module-creditcard-maestro.php';
    require_once WOOCOMMERCE_MODULE_EXTENSION_BASEDIR . 'classes/includes/woocommerce-module-creditcard-mastercard.php';
    require_once WOOCOMMERCE_MODULE_EXTENSION_BASEDIR . 'classes/includes/woocommerce-module-creditcard-unionpay.php';
    require_once WOOCOMMERCE_MODULE_EXTENSION_BASEDIR . 'classes/includes/woocommerce-module-creditcard-visa.php';

    add_filter('woocommerce_payment_gateways', function ($methods) {
        foreach (WC_WoocommerceModule_Provider::paymentMethods() as $paymentMethod) {
            $methods[] = $paymentMethod;
        }
        return $methods;
    }, 0);

    // add_filter('woocommerce_before_checkout_form', function(){
    add_filter('the_content', function($content){
        if(is_checkout_pay_page() || is_checkout()) {
            if(!empty($_GET['gateway_return_result']) && $_GET['gateway_return_result'] == 'error') {
                wc_print_notice(__('Payment failed or was declined', 'woocommerce'), 'error');
            }
        }
        return $content;
    }, 0, 1);

    add_action( 'init', 'woocommerce_clear_cart_url' );
    function woocommerce_clear_cart_url() {
        if (isset( $_GET['clear-cart']) && is_order_received_page()) {
            global $woocommerce;

            $woocommerce->cart->empty_cart();
        }
    }
});
