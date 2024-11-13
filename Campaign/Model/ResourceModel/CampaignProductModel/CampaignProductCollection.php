<?php

namespace Impact\Campaign\Model\ResourceModel\CampaignProductModel;

use Impact\Campaign\Model\CampaignProductModel;
use Impact\Campaign\Model\ResourceModel\CampaignProductResource;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class CampaignProductCollection extends AbstractCollection
{
    /**
     * @var string
     */
    protected $_eventPrefix = 'campaign_product_collection';

    /**
     * Initialize collection model.
     */
    protected function _construct()
    {
        $this->_init(CampaignProductModel::class, CampaignProductResource::class);
    }
}
