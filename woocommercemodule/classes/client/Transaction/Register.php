<?php

namespace WoocommerceModule\Client\Transaction;

use WoocommerceModule\Client\Transaction\Base\AbstractTransaction;
use WoocommerceModule\Client\Transaction\Base\AddToCustomerProfileInterface;
use WoocommerceModule\Client\Transaction\Base\AddToCustomerProfileTrait;
use WoocommerceModule\Client\Transaction\Base\OffsiteInterface;
use WoocommerceModule\Client\Transaction\Base\OffsiteTrait;
use WoocommerceModule\Client\Transaction\Base\ScheduleInterface;
use WoocommerceModule\Client\Transaction\Base\ScheduleTrait;

/**
 * Register: Register the customer's payment data for recurring charges.
 *
 * The registered customer payment data will be available for recurring transaction without user interaction.
 *
 * @package WoocommerceModule\Client\Transaction
 */
class Register extends AbstractTransaction implements OffsiteInterface, ScheduleInterface, AddToCustomerProfileInterface {
    use OffsiteTrait;
    use ScheduleTrait;
    use AddToCustomerProfileTrait;
}
