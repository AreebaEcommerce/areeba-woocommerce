<?php

namespace WoocommerceModule\Client\Transaction;

use WoocommerceModule\Client\Transaction\Base\AbstractTransactionWithReference;
use WoocommerceModule\Client\Transaction\Base\AmountableInterface;
use WoocommerceModule\Client\Transaction\Base\AmountableTrait;
use WoocommerceModule\Client\Transaction\Base\ItemsInterface;
use WoocommerceModule\Client\Transaction\Base\ItemsTrait;

/**
 * Capture: Charge a previously preauthorized transaction.
 *
 * @package WoocommerceModule\Client\Transaction
 */
class Capture extends AbstractTransactionWithReference implements AmountableInterface, ItemsInterface {
    use AmountableTrait;
    use ItemsTrait;
}
