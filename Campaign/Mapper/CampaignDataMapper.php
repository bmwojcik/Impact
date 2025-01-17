<?php

declare(strict_types=1);

namespace Impact\Campaign\Mapper;

use Impact\Campaign\Api\Data\CampaignInterface;
use Impact\Campaign\Api\Data\CampaignInterfaceFactory;
use Impact\Campaign\Model\CampaignModel;
use Magento\Framework\DataObject;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

/**
 * Converts a collection of Campaign entities to an array of data transfer objects.
 */
class CampaignDataMapper
{
    /**
     * @var CampaignInterfaceFactory
     */
    private CampaignInterfaceFactory $entityDtoFactory;

    /**
     * @param CampaignInterfaceFactory $entityDtoFactory
     */
    public function __construct(
        CampaignInterfaceFactory $entityDtoFactory
    )
    {
        $this->entityDtoFactory = $entityDtoFactory;
    }

    /**
     * Map magento models to DTO array.
     *
     * @param AbstractCollection $collection
     *
     * @return array|CampaignInterface[]
     */
    public function map(AbstractCollection $collection): array
    {
        $results = [];
        /** @var CampaignModel $item */
        foreach ($collection->getItems() as $item) {
            /** @var CampaignInterface|DataObject $entityDto */
            $entityDto = $this->entityDtoFactory->create();
            $entityDto->addData($item->getData());

            $results[] = $entityDto;
        }

        return $results;
    }
}
