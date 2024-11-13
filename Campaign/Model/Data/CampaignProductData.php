<?php

namespace Impact\Campaign\Model\Data;

use Impact\Campaign\Api\Data\CampaignProductInterface;
use Magento\Framework\DataObject;

class CampaignProductData extends DataObject implements CampaignProductInterface
{
    /**
     * Getter for CampaignProductId.
     *
     * @return int|null
     */
    public function getCampaignProductId(): ?int
    {
        return $this->getData(self::CAMPAIGN_PRODUCT_ID) === null ? null
            : (int)$this->getData(self::CAMPAIGN_PRODUCT_ID);
    }

    /**
     * Setter for CampaignProductId.
     *
     * @param int|null $campaignProductId
     *
     * @return void
     */
    public function setCampaignProductId(?int $campaignProductId): void
    {
        $this->setData(self::CAMPAIGN_PRODUCT_ID, $campaignProductId);
    }

    /**
     * Getter for ProductId.
     *
     * @return int|null
     */
    public function getProductId(): ?int
    {
        return $this->getData(self::PRODUCT_ID) === null ? null
            : (int)$this->getData(self::PRODUCT_ID);
    }

    /**
     * Setter for ProductId.
     *
     * @param int|null $productId
     *
     * @return void
     */
    public function setProductId(?int $productId): void
    {
        $this->setData(self::PRODUCT_ID, $productId);
    }

    /**
     * Getter for CampaignId.
     *
     * @return int|null
     */
    public function getCampaignId(): ?int
    {
        return $this->getData(self::CAMPAIGN_ID) === null ? null
            : (int)$this->getData(self::CAMPAIGN_ID);
    }

    /**
     * Setter for CampaignId.
     *
     * @param int|null $campaignId
     *
     * @return void
     */
    public function setCampaignId(?int $campaignId): void
    {
        $this->setData(self::CAMPAIGN_ID, $campaignId);
    }
}
