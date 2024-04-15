<?php

declare(strict_types=1);

namespace Impact\Campaign\Service;

use Impact\Campaign\Api\Data\CampaignInterface;
use Impact\Campaign\Api\Service\ProcessCampaignProductsInterface;
use Impact\Campaign\Setup\Patch\Data\InstallCampaignAttribute;
use Magento\Catalog\Api\ProductRepositoryInterface;
use Monolog\Logger;

class ProcessCampaignProducts implements ProcessCampaignProductsInterface
{
    private ProductRepositoryInterface $productRepository;
    private Logger $logger;

    /**
     * @param ProductRepositoryInterface $productRepository
     * @param Logger $logger
     */
    public function __construct(
        ProductRepositoryInterface $productRepository,
        Logger $logger
    ) {
        $this->productRepository = $productRepository;
        $this->logger = $logger;
    }

    /**
     * @inheritDoc
     */
    public function execute(CampaignInterface $campaign): bool
    {
        foreach ($campaign->getProducts() as $productId) {
            try {
                $product = $this->productRepository->getById($productId);
                $product->setCustomAttribute(InstallCampaignAttribute::ATTRIBUTE_CODE, $campaign->getCampaignId());
                $this->productRepository->save($product);
                $this->logger->debug(
                    sprintf('Product with id %s is now assigned to Campaign %s', $productId, $campaign->getCampaignId())
                );
            } catch (\Exception $e) { echo $e->getMessage();
                $this->logger->debug(
                    sprintf('Error with assignind to campaign. Product ID: %s, message: %s',
                        $productId,
                        $e->getMessage()
                    )
                );

                return false;
            }
        }

        return true;
    }
}
