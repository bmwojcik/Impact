<?php

declare(strict_types=1);

namespace Impact\Campaign\Test\Unit\Service;

use Impact\Campaign\Api\Data\CampaignInterface;
use Impact\Campaign\Api\Data\CampaignProductInterface;
use Impact\Campaign\Query\Campaign\GetById;
use Impact\Campaign\Query\CampaignProduct\GetProductsCampaigns;
use Impact\Campaign\Service\GetSerializedCampaignData;
use PHPUnit\Framework\TestCase;

class GetSerializedCampaignDataTest extends TestCase
{
    private $getSerializedCampaignData;
    private $getProductsCampaignsMock;
    private $getByIdMock;
    private $campaignProductMock;
    private $campaignMock;

    protected function setUp(): void
    {
        $this->getProductsCampaignsMock = $this->createMock(GetProductsCampaigns::class);
        $this->getByIdMock = $this->createMock(GetById::class);
        $this->campaignProductMock = $this->createMock(CampaignProductInterface::class);
        $this->campaignMock = $this->createMock(CampaignInterface::class);

        $this->getSerializedCampaignData = new GetSerializedCampaignData(
            $this->getProductsCampaignsMock,
            $this->getByIdMock
        );
    }

    public function testExecuteReturnsSerializedCampaignData()
    {
        $productId = '123';
        $campaignId = 456; // Changed to integer
        $campaignTitle = 'Summer Sale';
        $campaignColor = '#FF5733';

        $this->getProductsCampaignsMock->expects($this->once())
            ->method('execute')
            ->with($productId)
            ->willReturn([$this->campaignProductMock]);

        $this->campaignProductMock->expects($this->once())
            ->method('getCampaignId')
            ->willReturn($campaignId);

        $this->getByIdMock->expects($this->once())
            ->method('execute')
            ->with($campaignId)
            ->willReturn($this->campaignMock);

        $this->campaignMock->expects($this->once())
            ->method('getStatus')
            ->willReturn(1); // Changed to integer

        $this->campaignMock->expects($this->once())
            ->method('getTitle')
            ->willReturn($campaignTitle);

        $this->campaignMock->expects($this->once())
            ->method('getColor')
            ->willReturn($campaignColor);

        $result = $this->getSerializedCampaignData->execute($productId);

        $expected = [
            [
                'title' => $campaignTitle,
                'color' => $campaignColor
            ]
        ];

        $this->assertEquals($expected, $result);
    }

    public function testExecuteReturnsEmptyArrayWhenNoActiveCampaigns()
    {
        $productId = '123';

        $this->getProductsCampaignsMock->expects($this->once())
            ->method('execute')
            ->with($productId)
            ->willReturn([$this->campaignProductMock]);

        $this->campaignProductMock->expects($this->once())
            ->method('getCampaignId')
            ->willReturn(456); // Changed to integer

        $this->getByIdMock->expects($this->once())
            ->method('execute')
            ->willReturn($this->campaignMock);

        $this->campaignMock->expects($this->once())
            ->method('getStatus')
            ->willReturn(0); // Changed to integer

        $result = $this->getSerializedCampaignData->execute($productId);

        $this->assertEmpty($result);
    }
}
