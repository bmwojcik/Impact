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
     * Getter for Description.
     *
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->getData(self::DESCRIPTION);
    }

    /**
     * Setter for Description.
     *
     * @param string|null $description
     *
     * @return void
     */
    public function setDescription(?string $description): void
    {
        $this->setData(self::DESCRIPTION, $description);
    }

    /**
     * Getter for Url.
     *
     * @return string|null
     */
    public function getUrl(): ?string
    {
        return $this->getData(self::URL);
    }

    /**
     * Setter for Url.
     *
     * @param string|null $url
     *
     * @return void
     */
    public function setUrl(?string $url): void
    {
        $this->setData(self::URL, $url);
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
