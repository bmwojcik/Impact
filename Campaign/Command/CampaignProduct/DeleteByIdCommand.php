<?php

namespace Impact\Campaign\Command\CampaignProduct;

use Exception;
use Impact\Campaign\Api\Data\CampaignProductInterface;
use Impact\Campaign\Model\CampaignProductModel;
use Impact\Campaign\Model\CampaignProductModelFactory;
use Impact\Campaign\Model\ResourceModel\CampaignProductResource;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\NoSuchEntityException;
use Psr\Log\LoggerInterface;

/**
 * Delete CampaignProduct by id Command.
 */
class DeleteByIdCommand
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
     * Delete CampaignProduct.
     *
     * @param int $entityId
     *
     * @return void
     * @throws CouldNotDeleteException
     */
    public function execute(int $entityId): void
    {
        try {
            /** @var CampaignProductModel $model */
            $model = $this->modelFactory->create();
            $this->resource->load($model, $entityId, CampaignProductInterface::CAMPAIGN_PRODUCT_ID);

            if (!$model->getData(CampaignProductInterface::CAMPAIGN_PRODUCT_ID)) {
                throw new NoSuchEntityException(
                    __('Could not find CampaignProduct with id: `%id`',
                        [
                            'id' => $entityId
                        ]
                    )
                );
            }

            $this->resource->delete($model);
        } catch (Exception $exception) {
            $this->logger->error(
                __('Could not delete CampaignProduct. Original message: {message}'),
                [
                    'message' => $exception->getMessage(),
                    'exception' => $exception
                ]
            );
            throw new CouldNotDeleteException(__('Could not delete CampaignProduct.'));
        }
    }
}
