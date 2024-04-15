<?php

declare(strict_types=1);

namespace Impact\Campaign\Block\Form\Campaign;

use Impact\Campaign\Api\Data\CampaignInterface;
use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

/**
 * Delete entity button.
 */
class Delete extends GenericButton implements ButtonProviderInterface
{
    /**
     * Retrieve Delete button settings.
     *
     * @return array
     */
    public function getButtonData(): array
    {
        if (!$this->getCampaignId()) {
            return [];
        }

        return $this->wrapButtonSettings(
            __('Delete')->getText(),
            'delete',
            sprintf("deleteConfirm('%s', '%s')",
                __('Are you sure you want to delete this campaign?'),
                $this->getUrl(
                    '*/*/delete',
                    [CampaignInterface::CAMPAIGN_ID => $this->getCampaignId()]
                )
            ),
            [],
            20
        );
    }
}
