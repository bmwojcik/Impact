<?php

declare(strict_types=1);

namespace Impact\Campaign\ViewModel;

use Impact\Campaign\Api\Service\GetSerializedCampaignDataInterface;
use Impact\Campaign\Query\Campaign\GetById;
use Impact\Campaign\Setup\Patch\Data\InstallCampaignAttribute;
use Magento\Catalog\Model\Product;
use Magento\Framework\View\Element\Block\ArgumentInterface;

class CampaignLabel implements ArgumentInterface
{
    public function __construct(
        private GetSerializedCampaignDataInterface $getSerializedCampaignData
    ){
    }

    /**
     * @param Product $product
     *
     * @return array
     */
    public function getCampaignLabel(Product $product): array
    {
        return $this->getSerializedCampaignData->execute((string)$product->getId());
    }
}
