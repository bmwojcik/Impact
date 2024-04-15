<?php

declare(strict_types=1);

namespace Impact\Campaign\ViewModel;

use Impact\Campaign\Query\Campaign\GetById;
use Impact\Campaign\Setup\Patch\Data\InstallCampaignAttribute;
use Magento\Catalog\Model\Product;
use Magento\Framework\View\Element\Block\ArgumentInterface;

class CampaignLabel implements ArgumentInterface
{
    private GetById $getById;

    public function __construct(GetById $getById)
    {
        $this->getById = $getById;
    }

    /**
     * @param Product $product
     *
     * @return string
     */
    public function getCampaignLabel(Product $product): string
    {
        $result = '';
        if ($campaign = $product->getCustomAttribute(InstallCampaignAttribute::ATTRIBUTE_CODE)) {
            $campaign = $this->getById->execute((int)$campaign->getValue());

            if ($campaign->getStatus()) {
                $result = $campaign->getTitle();
            }
        }

        return $result;
    }
}
