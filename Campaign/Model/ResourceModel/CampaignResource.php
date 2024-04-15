<?php

declare(strict_types=1);

namespace Impact\Campaign\Model\ResourceModel;

use Impact\Campaign\Api\Data\CampaignInterface;
use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class CampaignResource extends AbstractDb
{
    /**
     * @var string
     */
    protected $_eventPrefix = 'impact_campaign_resource_model';

    /**
     * Initialize resource model.
     */
    protected function _construct()
    {
        $this->_init('impact_campaign', CampaignInterface::CAMPAIGN_ID);
        $this->_useIsObjectNew = true;
    }
}
