<?php

declare(strict_types=1);

namespace Impact\Campaign\Block\Form\Campaign;

use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

/**
 * Back to list button.
 */
class Back extends GenericButton implements ButtonProviderInterface
{
    /**
     * Retrieve Back To Grid button settings.
     *
     * @return array
     */
    public function getButtonData(): array
    {
        return $this->wrapButtonSettings(
            __('Back To Grid')->getText(),
            'back',
            sprintf("location.href = '%s';", $this->getUrl('*/*/')),
            [],
            10
        );
    }
}
