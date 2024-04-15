<?php

declare(strict_types=1);

namespace Impact\Campaign\Test\Unit\Service;

use Impact\Campaign\Api\Data\CampaignInterface;
use Impact\Campaign\Setup\Patch\Data\InstallCampaignAttribute;
use Magento\Framework\TestFramework\Unit\Helper\ObjectManager;
use PHPUnit\Framework\TestCase;
use Impact\Campaign\Service\ProcessCampaignProducts;
use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Catalog\Api\Data\ProductInterface;

class ProcessCampaignProductsTest extends TestCase
{

    private $processCampaignProducts;
    private $productRepositoryMock;
    private $campaignMock;
    private $productMock;

    protected function setUp(): void
    {
        $objectManager = new ObjectManager($this);

        $this->productRepositoryMock = $this->createMock(ProductRepositoryInterface::class);
        $this->campaignMock = $this->createMock(CampaignInterface::class);
        $this->productMock = $this->createMock(ProductInterface::class);

        $this->processCampaignProducts = $objectManager->getObject(ProcessCampaignProducts::class, [
            'productRepository' => $this->productRepositoryMock,
        ]);
    }

    public function testExecuteAssignsProductsToCampaignSuccessfully()
    {
        $productIds = [1,2];
        $campaignId = 123;

        $this->campaignMock->expects($this->once())
            ->method('getProducts')
            ->willReturn($productIds);
        $this->campaignMock->expects($this->any())
            ->method('getCampaignId')
            ->willReturn($campaignId);

        $this->productRepositoryMock->method('getById')
            ->willReturn($this->productMock);

        $this->productMock->expects($this->exactly(2))
            ->method('setCustomAttribute')
            ->with(InstallCampaignAttribute::ATTRIBUTE_CODE, $campaignId);

        $this->productRepositoryMock->expects($this->exactly(2))
            ->method('save')
            ->with($this->productMock);

        $result = $this->processCampaignProducts->execute($this->campaignMock);
        $this->assertTrue($result);
    }

    public function testExecuteReturnsFalseOnException()
    {
        $productIds = [1];
        $campaignId = 123;

        $this->campaignMock->expects($this->once())
            ->method('getProducts')
            ->willReturn($productIds);
        $this->campaignMock->expects($this->any())
            ->method('getCampaignId')
            ->willReturn($campaignId);


        $this->productRepositoryMock->expects($this->once())
            ->method('getById')
            ->with($this->equalTo(1))
            ->willThrowException(new \Magento\Framework\Exception\NoSuchEntityException(__('No such entity with id = 1')));

        $result = $this->processCampaignProducts->execute($this->campaignMock);
        $this->assertFalse($result);
    }
}


