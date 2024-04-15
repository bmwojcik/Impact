<?php

declare(strict_types=1);

namespace Impact\Campaign\Controller\Adminhtml\Campaign;

use Magento\Backend\App\Action;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Controller\ResultInterface;

/**
 * Campaign backend index (list) controller.
 */
class Index extends Action implements HttpGetActionInterface
{
    /**
     * Authorization level of a basic admin session.
     */
    public const ADMIN_RESOURCE = 'Impact_Campaign::management';

    /**
     * Execute action based on request and return result.
     *
     * @return ResultInterface|ResponseInterface
     */
    public function execute()
    {
        $resultPage = $this->resultFactory->create(ResultFactory::TYPE_PAGE);

        $resultPage->setActiveMenu('Impact_Campaign::management');
        $resultPage->addBreadcrumb(__('Campaign'), __('Campaign'));
        $resultPage->addBreadcrumb(__('Manage Campaigns'), __('Manage Campaigns'));
        $resultPage->getConfig()->getTitle()->prepend(__('Campaign List'));

        return $resultPage;
    }
}
