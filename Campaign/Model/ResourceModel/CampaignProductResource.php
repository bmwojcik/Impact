<?php

namespace Impact\Campaign\Model\ResourceModel;

use Impact\Campaign\Api\Data\CampaignProductInterface;
use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class CampaignProductResource extends AbstractDb
{
    /**
     * @var string
     */
    protected $_eventPrefix = 'campaign_product_resource_model';

    /**
     * Initialize resource model.
     */
    protected function _construct()
    {
        $this->_init('campaign_product', CampaignProductInterface::CAMPAIGN_PRODUCT_ID);
        $this->_useIsObjectNew = true;
    }
}
