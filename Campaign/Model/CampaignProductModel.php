<?php

namespace Impact\Campaign\Model;

use Impact\Campaign\Model\ResourceModel\CampaignProductResource;
use Magento\Framework\Model\AbstractModel;

class CampaignProductModel extends AbstractModel
{
    /**
     * @var string
     */
    protected $_eventPrefix = 'campaign_product_model';

    /**
     * Initialize magento model.
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(CampaignProductResource::class);
    }
}
