<?php

declare(strict_types=1);

namespace Impact\Campaign\Service;

use Impact\Campaign\Api\Data\CampaignProductInterface;
use Impact\Campaign\Api\Data\CampaignProductInterfaceFactory;
use Impact\Campaign\Api\Data\CampaignInterface;
use Impact\Campaign\Api\Service\ProcessCampaignProductsInterface;
use Impact\Campaign\Command\CampaignProduct\SaveCommand;
use Impact\Campaign\Setup\Patch\Data\InstallCampaignAttribute;
use Magento\Catalog\Api\ProductRepositoryInterface;
use Monolog\Logger;

class ProcessCampaignProducts implements ProcessCampaignProductsInterface
{
    public function __construct(
        private CampaignProductInterfaceFactory $campaignProductFactory,
        private SaveCommand $camapignProductSave,
        private Logger $logger
    )
    {
    }


    /**
     * @inheritDoc
     */
    public function execute(CampaignInterface $campaign): bool
    {
        foreach ($campaign->getProducts() as $productId) {
            try {
                $campaignProductEntity = $this->campaignProductFactory->create();
                $campaignProductEntity->setCampaignId($campaign->getCampaignId());
                $campaignProductEntity->setProductId((int)$productId);
                $this->camapignProductSave->execute($campaignProductEntity);
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
