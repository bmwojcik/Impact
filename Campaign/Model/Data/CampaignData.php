<?php

declare(strict_types=1);

namespace Impact\Campaign\Model\Data;

use Impact\Campaign\Api\Data\CampaignInterface;
use Magento\Framework\DataObject;

class CampaignData extends DataObject implements CampaignInterface
{
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

    /**
     * Getter for Status.
     *
     * @return int|null
     */
    public function getStatus(): ?int
    {
        return $this->getData(self::STATUS) === null ? null
            : (int)$this->getData(self::STATUS);
    }

    /**
     * Setter for Status.
     *
     * @param int|null $status
     *
     * @return void
     */
    public function setStatus(?int $status): void
    {
        $this->setData(self::STATUS, $status);
    }

    /**
     * Getter for Title.
     *
     * @return string|null
     */
    public function getTitle(): ?string
    {
        return $this->getData(self::TITLE);
    }

    /**
     * Setter for Title.
     *
     * @param string|null $title
     *
     * @return void
     */
    public function setTitle(?string $title): void
    {
        $this->setData(self::TITLE, $title);
    }

    /**
     * Getter for Color.
     *
     * @return string|null
     */
    public function getColor(): ?string
    {
        return $this->getData(self::COLOR);
    }

    /**
     * Setter for Color.
     *
     * @param string|null $color
     *
     * @return void
     */
    public function setColor(?string $color): void
    {
        $this->setData(self::COLOR, $color);
    }

    /**
     * Getter for Products.
     *
     * @return array
     */
    public function getProducts(): array
    {
        $products = $this->getData(self::PRODUCTS);

        if (!is_array($products)) {
            return explode(',', $products  ?? []);
        }

        return $products;
    }

    /**
     * Setter for Products.
     *
     * @param string|null $products
     *
     * @return void
     */
    public function setProducts(?string $products): void
    {
        $this->setData(self::PRODUCTS, $products);
    }
}
