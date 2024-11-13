<?php

namespace Impact\Campaign\Api\Service;

interface GetSerializedCampaignDataInterface
{
    /**
     * @param string $productId
     *
     * @return array
     */
    public function execute(string $productId): array;
}
