<?php

declare(strict_types=1);

namespace Impact\Campaign\Model\Source;


use Magento\Catalog\Model\ResourceModel\Product\CollectionFactory;
use Magento\Framework\Data\OptionSourceInterface;

class Products implements OptionSourceInterface {

    private CollectionFactory $productCollectionFactory;

    /**
     * @param CollectionFactory $productCollectionFactory
     */
    public function __construct(
        CollectionFactory $productCollectionFactory
    ) {
        $this->productCollectionFactory = $productCollectionFactory;
    }

    /**
     * @return array
     */
    public function toOptionArray()
    {
        $collection = $this->productCollectionFactory->create()->addAttributeToSelect('*');
        $options = [];

        foreach ($collection as $product) {
            $options[] = ['label' => $product->getName(), 'value' => $product->getId()];
        }

        return $options;
    }

}
