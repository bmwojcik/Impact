<?php

declare(strict_types=1);

namespace Impact\Campaign\Query\Campaign;

use Impact\Campaign\Api\Data\CampaignInterface;
use Magento\Framework\Api\SearchCriteriaBuilder;

class GetById
{
    private array $instances;

    private GetListQuery $getListQuery;

    private SearchCriteriaBuilder $searchCriteriaBuilder;

    /**
     * @param GetListQuery $getListQuery
     * @param SearchCriteriaBuilder $searchCriteriaBuilder
     */
    public function __construct(
        GetListQuery $getListQuery,
        SearchCriteriaBuilder $searchCriteriaBuilder
    ) {
        $this->getListQuery = $getListQuery;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
    }

    /**
     * @param int $campaignId
     *
     * @return CampaignInterface|null
     */
    public function execute(int $campaignId): ?CampaignInterface
    {
        if (!isset($this->instances[$campaignId])) {
            $result = null;
            $this->searchCriteriaBuilder->addFilter(CampaignInterface::CAMPAIGN_ID, $campaignId);
            $searchResults = $this->getListQuery->execute($this->searchCriteriaBuilder->create());

            if ($row = current($searchResults->getItems())) {
                $result = $row;
            }

            $this->instances[$campaignId] = $result;
        }

        return $this->instances[$campaignId];
    }
}
