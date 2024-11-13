<?php

namespace Impact\Campaign\Mapper;

use Impact\Campaign\Api\Data\CampaignProductInterface;
use Impact\Campaign\Api\Data\CampaignProductInterfaceFactory;
use Impact\Campaign\Model\CampaignProductModel;
use Magento\Framework\DataObject;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

/**
 * Converts a collection of CampaignProduct entities to an array of data transfer objects.
 */
class CampaignProductDataMapper
{
    /**
     * @var CampaignProductInterfaceFactory
     */
    private CampaignProductInterfaceFactory $entityDtoFactory;

    /**
     * @param CampaignProductInterfaceFactory $entityDtoFactory
     */
    public function __construct(
        CampaignProductInterfaceFactory $entityDtoFactory
    )
    {
        $this->entityDtoFactory = $entityDtoFactory;
    }

    /**
     * Map magento models to DTO array.
     *
     * @param AbstractCollection $collection
     *
     * @return array|CampaignProductInterface[]
     */
    public function map(AbstractCollection $collection): array
    {
        $results = [];
        /** @var CampaignProductModel $item */
        foreach ($collection->getItems() as $item) {
            /** @var CampaignProductInterface|DataObject $entityDto */
            $entityDto = $this->entityDtoFactory->create();
            $entityDto->addData($item->getData());

            $results[] = $entityDto;
        }

        return $results;
    }
}
