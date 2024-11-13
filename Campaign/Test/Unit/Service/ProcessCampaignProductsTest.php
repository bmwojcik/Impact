<?php

declare(strict_types=1);

namespace Impact\Campaign\Test\Unit\Service;

use Impact\Campaign\Api\Data\CampaignInterface;
use Impact\Campaign\Api\Data\CampaignProductInterface;
use Impact\Campaign\Api\Data\CampaignProductInterfaceFactory;
use Impact\Campaign\Command\CampaignProduct\SaveCommand;
use Impact\Campaign\Service\ProcessCampaignProducts;
use Magento\Framework\TestFramework\Unit\Helper\ObjectManager;
use PHPUnit\Framework\TestCase;
use Monolog\Logger;

class ProcessCampaignProductsTest extends TestCase
{
    private $processCampaignProducts;
    private $campaignProductFactoryMock;
    private $saveCommandMock;
    private $loggerMock;
    private $campaignMock;
    private $campaignProductMock;

    protected function setUp(): void
    {
        $objectManager = new ObjectManager($this);

        $this->campaignProductFactoryMock = $this->createMock(CampaignProductInterfaceFactory::class);
        $this->saveCommandMock = $this->createMock(SaveCommand::class);
        $this->loggerMock = $this->createMock(Logger::class);
        $this->campaignMock = $this->createMock(CampaignInterface::class);
        $this->campaignProductMock = $this->createMock(CampaignProductInterface::class);

        $this->campaignProductFactoryMock->method('create')
            ->willReturn($this->campaignProductMock);

        $this->processCampaignProducts = $objectManager->getObject(ProcessCampaignProducts::class, [
            'campaignProductFactory' => $this->campaignProductFactoryMock,
            'camapignProductSave' => $this->saveCommandMock,
            'logger' => $this->loggerMock,
        ]);
    }

    public function testExecuteAssignsProductsToCampaignSuccessfully()
    {
        $productIds = [1, 2];
        $campaignId = 123;

        $this->campaignMock->expects($this->once())
            ->method('getProducts')
            ->willReturn($productIds);
        $this->campaignMock->expects($this->any())
            ->method('getCampaignId')
            ->willReturn($campaignId);

        $this->campaignProductMock->expects($this->exactly(2))
            ->method('setCampaignId')
            ->withConsecutive([$campaignId], [$campaignId]);
        $this->campaignProductMock->expects($this->exactly(2))
            ->method('setProductId')
            ->withConsecutive([(int)$productIds[0]], [(int)$productIds[1]]);

        $this->saveCommandMock->expects($this->exactly(2))
            ->method('execute')
            ->with($this->campaignProductMock);

        $this->loggerMock->expects($this->exactly(2))
            ->method('debug');

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

        $this->campaignProductMock->expects($this->once())
            ->method('setCampaignId')
            ->with($campaignId);
        $this->campaignProductMock->expects($this->once())
            ->method('setProductId')
            ->with((int)$productIds[0]);

        $this->saveCommandMock->expects($this->once())
            ->method('execute')
            ->with($this->campaignProductMock)
            ->willThrowException(new \Exception('Error saving campaign product'));

        $this->loggerMock->expects($this->once())
            ->method('debug');

        $result = $this->processCampaignProducts->execute($this->campaignMock);
        $this->assertFalse($result);
    }
}
