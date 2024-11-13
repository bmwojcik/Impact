<?php

namespace Impact\Campaign\Command\CampaignProduct;

use Exception;
use Impact\Campaign\Api\Data\CampaignProductInterface;
use Impact\Campaign\Model\CampaignProductModel;
use Impact\Campaign\Model\CampaignProductModelFactory;
use Impact\Campaign\Model\ResourceModel\CampaignProductResource;
use Magento\Framework\Exception\CouldNotSaveException;
use Psr\Log\LoggerInterface;

/**
 * Save CampaignProduct Command.
 */
class SaveCommand
{
    /**
     * @var LoggerInterface
     */
    private LoggerInterface $logger;

    /**
     * @var CampaignProductModelFactory
     */
    private CampaignProductModelFactory $modelFactory;

    /**
     * @var CampaignProductResource
     */
    private CampaignProductResource $resource;

    /**
     * @param LoggerInterface $logger
     * @param CampaignProductModelFactory $modelFactory
     * @param CampaignProductResource $resource
     */
    public function __construct(
        LoggerInterface             $logger,
        CampaignProductModelFactory $modelFactory,
        CampaignProductResource     $resource
    )
    {
        $this->logger = $logger;
        $this->modelFactory = $modelFactory;
        $this->resource = $resource;
    }

    /**
     * Save CampaignProduct.
     *
     * @param CampaignProductInterface $campaignProduct
     *
     * @return int
     * @throws CouldNotSaveException
     */
    public function execute(CampaignProductInterface $campaignProduct): int
    {
        try {
            /** @var CampaignProductModel $model */
            $model = $this->modelFactory->create();
            $model->addData($campaignProduct->getData());
            $model->setHasDataChanges(true);

            if (!$model->getData(CampaignProductInterface::CAMPAIGN_PRODUCT_ID)) {
                $model->isObjectNew(true);
            }
            $this->resource->save($model);
        } catch (Exception $exception) {
            $this->logger->error(
                __('Could not save CampaignProduct. Original message: {message}'),
                [
                    'message' => $exception->getMessage(),
                    'exception' => $exception
                ]
            );
            throw new CouldNotSaveException(__('Could not save CampaignProduct.'));
        }

        return (int)$model->getData(CampaignProductInterface::CAMPAIGN_PRODUCT_ID);
    }
}
