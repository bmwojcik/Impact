<?php

declare(strict_types=1);

namespace Impact\Campaign\Controller\Adminhtml\Campaign;

use Magento\Backend\App\Action;
use Magento\Backend\Model\View\Result\Page;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Controller\ResultInterface;

/**
 * New action Campaign controller.
 */
class NewAction extends Action implements HttpGetActionInterface
{
    /**
     * Authorization level of a basic admin session.
     *
     * @see _isAllowed()
     */
    public const ADMIN_RESOURCE = 'Impact_Campaign::management';

    /**
     * Create new Campaign action.
     *
     * @return Page|ResultInterface
     */
    public function execute()
    {
        /** @var Page $resultPage */
        $resultPage = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
        $resultPage->setActiveMenu('Impact_Campaign::management');
        $resultPage->getConfig()->getTitle()->prepend(__('New Campaign'));

        return $resultPage;
    }
}
