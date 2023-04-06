<?php

final class WC_WoocommerceModule_Provider
{
    public static function paymentMethods()
    {
        /**
         * Comment/disable adapters that are not applicable
         */
        return [
            'WC_WoocommerceModule_CreditCard',
            //'WC_WoocommerceModule_CreditCard_Amex',
            //'WC_WoocommerceModule_CreditCard_Diners',
            //'WC_WoocommerceModule_CreditCard_Discover',
            //'WC_WoocommerceModule_CreditCard_Jcb',
            //'WC_WoocommerceModule_CreditCard_Maestro',
            //'WC_WoocommerceModule_CreditCard_Mastercard',
            //'WC_WoocommerceModule_CreditCard_UnionPay',
            //'WC_WoocommerceModule_CreditCard_Visa',
        ];
    }

    public static function autoloadClient()
    {
        require_once WOOCOMMERCE_MODULE_EXTENSION_BASEDIR . 'classes/vendor/autoload.php';
    }
}
