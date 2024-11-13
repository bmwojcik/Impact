<?php

namespace Impact\Campaign\Api\Data;

interface CampaignProductInterface
{
    /**
     * String constants for property names
     */
    public const CAMPAIGN_PRODUCT_ID = "campaign_product_id";
    public const PRODUCT_ID = "product_id";
    public const CAMPAIGN_ID = "campaign_id";

    /**
     * Getter for CampaignProductId.
     *
     * @return int|null
     */
    public function getCampaignProductId(): ?int;

    /**
     * Setter for CampaignProductId.
     *
     * @param int|null $campaignProductId
     *
     * @return void
     */
    public function setCampaignProductId(?int $campaignProductId): void;

    /**
     * Getter for ProductId.
     *
     * @return int|null
     */
    public function getProductId(): ?int;

    /**
     * Setter for ProductId.
     *
     * @param int|null $productId
     *
     * @return void
     */
    public function setProductId(?int $productId): void;

    /**
     * Getter for CampaignId.
     *
     * @return int|null
     */
    public function getCampaignId(): ?int;

    /**
     * Setter for CampaignId.
     *
     * @param int|null $campaignId
     *
     * @return void
     */
    public function setCampaignId(?int $campaignId): void;
}
