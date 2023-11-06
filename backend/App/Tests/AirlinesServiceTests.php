<?php

use PHPUnit\Framework\TestCase;
use App\Services\AirlinesService;
use App\Interfaces\iApiService;

class AirlinesServiceTests extends TestCase
{
    public function test_getAirlinesNames_returnsAirlinesNames()
    {
        // Arrange
        $apiServiceMock = $this->createMock(iApiService::class);
        $apiServiceMock->expects($this->once())
            ->method('getApiRequest')
            ->with('/airlines')
            ->willReturn(json_encode(
            [
                ['id' => 1, 'display_name' => 'Airline 1'],
                ['id' => 2, 'display_name' => 'Airline 2'],
            ]));

        $expectedResult =
        [
            ['id' => 1, 'display_name' => 'Airline 1'],
            ['id' => 2, 'display_name' => 'Airline 2'],
        ];

        $sut = new AirlinesService($apiServiceMock);

        // Act
        $result = $sut->getAirlinesNames();

        // Assert
        $this->assertEquals($expectedResult, $result);
    }
}
