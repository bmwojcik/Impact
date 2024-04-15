<?php

declare(strict_types=1);

namespace Impact\Campaign\Command\Campaign;

use Exception;
use Impact\Campaign\Api\Data\CampaignInterface;
use Impact\Campaign\Api\Service\ProcessCampaignProductsInterface;
use Impact\Campaign\Model\CampaignModel;
use Impact\Campaign\Model\CampaignModelFactory;
use Impact\Campaign\Model\ResourceModel\CampaignResource;
use Magento\Framework\Exception\CouldNotSaveException;
use Psr\Log\LoggerInterface;

/**
 * Save Campaign Command.
 */
class SaveCommand
{
    private LoggerInterface $logger;

    private CampaignModelFactory $modelFactory;

    private CampaignResource $resource;

    private ProcessCampaignProductsInterface $processCampaignProducts;

    /**
     * @param LoggerInterface $logger
     * @param CampaignModelFactory $modelFactory
     * @param CampaignResource $resource
     * @param ProcessCampaignProductsInterface $processCampaignProducts
     */
    public function __construct(
        LoggerInterface      $logger,
        CampaignModelFactory $modelFactory,
        CampaignResource     $resource,
        ProcessCampaignProductsInterface $processCampaignProducts
    )
    {
        $this->logger = $logger;
        $this->modelFactory = $modelFactory;
        $this->resource = $resource;
        $this->processCampaignProducts = $processCampaignProducts;
    }

    /**
     * Save Campaign.
     *
     * @param CampaignInterface $campaign
     *
     * @return int
     * @throws CouldNotSaveException
     */
    public function execute(CampaignInterface $campaign): int
    {
        try {
            /** @var CampaignModel $model */
            $model = $this->modelFactory->create();
            $model->addData($campaign->getData());
            $model->setHasDataChanges(true);

            if (!$model->getData(CampaignInterface::CAMPAIGN_ID)) {
                $model->isObjectNew(true);
            }
            $this->addProductsToEntity($model);
            $this->resource->save($model);
            $this->processCampaignProducts->execute($campaign);
        } catch (Exception $exception) {
            $this->logger->error(
                __('Could not save Campaign. Original message: {message}'),
                [
                    'message' => $exception->getMessage(),
                    'exception' => $exception
                ]
            );
            throw new CouldNotSaveException(__('Could not save Campaign.'));
        }

        return (int)$model->getData(CampaignInterface::CAMPAIGN_ID);
    }

    /**
     * @param CampaignModel $campaign
     *
     * @return CampaignModel
     */
    private function addProductsToEntity(CampaignModel $campaign): CampaignModel
    {
        $products = implode(',', $campaign->getProducts() ?? []);
        $campaign->setProducts($products);

        return $campaign;
    }
}
