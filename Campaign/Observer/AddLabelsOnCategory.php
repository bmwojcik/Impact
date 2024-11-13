<?php
declare(strict_types=1);

namespace Impact\Campaign\Observer;

use Magento\Framework\Event\Observer as EventObserver;
use Magento\Framework\Event\ObserverInterface;
use Magento\Store\Model\StoreManagerInterface;

class AddLabelsOnCategory implements ObserverInterface
{

    /**
     * Append review summary to collection
     *
     * @param EventObserver $observer
     * @return $productCollection
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function execute(EventObserver $observer)
    {
        $productCollection = $observer->getEvent()->getCollection();
        $productCollection->getSelect()->joinLeft(
            ['cp' => $productCollection->getTable('campaign_product')],
            'e.entity_id = cp.product_id',
            []
        )->joinLeft(
            ['c' => $productCollection->getTable('impact_campaign')],
            'cp.campaign_id = c.campaign_id',
            []
        )->columns(
            ['campaign_data' => new \Zend_Db_Expr('IF(COUNT(c.campaign_id) > 0, JSON_ARRAYAGG(JSON_OBJECT("title", c.title, "color", c.color)), NULL)')]
        )->where(
            'c.status = 1 OR c.campaign_id IS NULL'
        )->group('e.entity_id');

        return $this;
    }
}
