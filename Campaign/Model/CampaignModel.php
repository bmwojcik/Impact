<?php

declare(strict_types=1);

namespace Impact\Campaign\Model;

use Impact\Campaign\Model\ResourceModel\CampaignResource;
use Magento\Framework\Model\AbstractModel;

class CampaignModel extends AbstractModel
{
    /**
     * @var string
     */
    protected $_eventPrefix = 'impact_campaign_model';

    /**
     * Initialize magento model.
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(CampaignResource::class);
    }
}
