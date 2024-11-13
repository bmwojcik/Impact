<?php

declare(strict_types=1);

namespace Impact\Campaign\Api\Data;

interface CampaignInterface
{
    /**
     * String constants for property names
     */
    public const CAMPAIGN_ID = "campaign_id";
    public const STATUS = "status";
    public const TITLE = "title";
    public const PRODUCTS = "products";

    public const COLOR = "color";

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

    /**
     * Getter for Status.
     *
     * @return int|null
     */
    public function getStatus(): ?int;

    /**
     * Setter for Status.
     *
     * @param int|null $status
     *
     * @return void
     */
    public function setStatus(?int $status): void;

    /**
     * Getter for Title.
     *
     * @return string|null
     */
    public function getTitle(): ?string;

    /**
     * Setter for Title.
     *
     * @param string|null $title
     *
     * @return void
     */
    public function setTitle(?string $title): void;


    /**
     * Getter for Color.
     *
     * @return string|null
     */
    public function getColor(): ?string;

    /**
     * Setter for Color.
     *
     * @param string|null $color
     *
     * @return void
     */
    public function setColor(?string $color): void;

    /**
     * Getter for Products.
     *
     * @return array
     */
    public function getProducts(): array;

    /**
     * Setter for Products.
     *
     * @param string|null $products
     *
     * @return void
     */
    public function setProducts(?string $products): void;
}
