<?php

declare(strict_types=1);

namespace Impact\Campaign\Service;

use Impact\Campaign\Api\Service\GetSerializedCampaignDataInterface;
use Impact\Campaign\Query\CampaignProduct\GetProductsCampaigns;
use Impact\Campaign\Query\Campaign\GetById;
use Impact\Campaign\Api\Data\CampaignProductInterface;

class GetSerializedCampaignData implements GetSerializedCampaignDataInterface
{
    public function __construct(
        private GetProductsCampaigns $getProductsCampaigns,
        private GetById $getById
    ) {}

    /** @inheritdoc */
    public function execute(string $productId): array
    {
        $campaignsData = [];
        $campaignProducts = $this->getProductsCampaigns->execute($productId);

        foreach ($campaignProducts as $campaignProduct) {
            $campaignId = $campaignProduct->getCampaignId();
            $campaign = $this->getById->execute($campaignId);

            if ($campaign->getStatus()) {
                $campaignsData[] = [
                    'title' => $campaign->getTitle(),
                    'color' => $campaign->getColor()
                ];
            }
        }

        return $campaignsData;
    }
}
