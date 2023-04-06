<?php

namespace WoocommerceModule\Client\Transaction\Base;
use WoocommerceModule\Client\Data\Item;

/**
 * Interface ItemsInterface
 *
 * @package WoocommerceModule\Client\Transaction\Base
 */
interface ItemsInterface {

    /**
     * @param Item[] $items
     * @return void
     */
    public function setItems($items);

    /**
     * @return Item[]
     */
    public function getItems();

    /**
     * @param Item $item
     * @return void
     */
    public function addItem($item);

}
