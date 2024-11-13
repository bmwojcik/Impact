<?php

declare(strict_types=1);

namespace Impact\Campaign\Query\CampaignProduct;

use Impact\Campaign\Api\Data\CampaignProductInterface;
use Magento\Framework\Api\SearchCriteriaBuilder;

class GetProductsCampaigns
{
    public function __construct(
        private SearchCriteriaBuilder $searchCriteriaBuilder,
        private GetListQuery $getListQuery
    )
    {}

    /**
     * @param string $productId
     * @return CampaignProductInterface[]
     */
    public function execute(string $productId): array
    {
        $result = [];

        if ($productId) {
            $this->searchCriteriaBuilder->addFilter(CampaignProductInterface::PRODUCT_ID, $productId);
            $searchResults = $this->getListQuery->execute($this->searchCriteriaBuilder->create());
            $result = $searchResults->getItems();
        }

        return $result;
    }
}
