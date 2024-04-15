<?php

declare(strict_types=1);

namespace Impact\Campaign\Command\Campaign;

use Exception;
use Impact\Campaign\Api\Data\CampaignInterface;
use Impact\Campaign\Model\CampaignModel;
use Impact\Campaign\Model\CampaignModelFactory;
use Impact\Campaign\Model\ResourceModel\CampaignResource;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\NoSuchEntityException;
use Psr\Log\LoggerInterface;

/**
 * Delete Campaign by id Command.
 */
class DeleteByIdCommand
{
    /**
     * @var LoggerInterface
     */
    private LoggerInterface $logger;

    /**
     * @var CampaignModelFactory
     */
    private CampaignModelFactory $modelFactory;

    /**
     * @var CampaignResource
     */
    private CampaignResource $resource;

    /**
     * @param LoggerInterface $logger
     * @param CampaignModelFactory $modelFactory
     * @param CampaignResource $resource
     */
    public function __construct(
        LoggerInterface      $logger,
        CampaignModelFactory $modelFactory,
        CampaignResource     $resource
    )
    {
        $this->logger = $logger;
        $this->modelFactory = $modelFactory;
        $this->resource = $resource;
    }

    /**
     * Delete Campaign.
     *
     * @param int $entityId
     *
     * @return void
     * @throws CouldNotDeleteException
     */
    public function execute(int $entityId): void
    {
        try {
            /** @var CampaignModel $model */
            $model = $this->modelFactory->create();
            $this->resource->load($model, $entityId, CampaignInterface::CAMPAIGN_ID);

            if (!$model->getData(CampaignInterface::CAMPAIGN_ID)) {
                throw new NoSuchEntityException(
                    __('Could not find Campaign with id: `%id`',
                        [
                            'id' => $entityId
                        ]
                    )
                );
            }

            $this->resource->delete($model);
        } catch (Exception $exception) {
            $this->logger->error(
                __('Could not delete Campaign. Original message: {message}'),
                [
                    'message' => $exception->getMessage(),
                    'exception' => $exception
                ]
            );
            throw new CouldNotDeleteException(__('Could not delete Campaign.'));
        }
    }
}
