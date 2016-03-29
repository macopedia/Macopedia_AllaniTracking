<?php
/**
 * Created by PhpStorm.
 * User: jidziak
 * Date: 29.03.16
 * Time: 13:37
 */
class Macopedia_AllaniTracking_Helper_Data extends Mage_Core_Helper_Abstract
{
    public function getOrderInfo()
    {
        $lastRealOrderId = Mage::getSingleton('checkout/session')->getLastRealOrderId();
        $lastOrder = Mage::getModel('sales/order')->loadByIncrementId($lastRealOrderId);
        $productIds = array();
        foreach ($lastOrder->getAllVisibleItems() as $item) {
            $productIds[] = $item->getProduct()->getId();
        }
        return array(
            'product_ids'   => implode(',', $productIds),
            'order_value'   => number_format($lastOrder->getGrandTotal(), 2, '.', ''),
            'order_id'      => $lastRealOrderId
        );
    }
}