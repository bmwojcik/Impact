<?php

declare(strict_types=1);

namespace Impact\Campaign\Api\Service;

use Impact\Campaign\Api\Data\CampaignInterface;

interface ProcessCampaignProductsInterface
{
    /**
     * @param CampaignInterface $campaign
     *
     * @return bool
     */
    public function execute(CampaignInterface $campaign): bool;
}
