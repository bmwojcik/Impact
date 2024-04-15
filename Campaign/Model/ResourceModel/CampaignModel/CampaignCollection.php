<?php

declare(strict_types=1);

namespace Impact\Campaign\Model\ResourceModel\CampaignModel;

use Impact\Campaign\Model\CampaignModel;
use Impact\Campaign\Model\ResourceModel\CampaignResource;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class CampaignCollection extends AbstractCollection
{
    /**
     * @var string
     */
    protected $_eventPrefix = 'impact_campaign_collection';

    /**
     * Initialize collection model.
     */
    protected function _construct()
    {
        $this->_init(CampaignModel::class, CampaignResource::class);
    }
}
