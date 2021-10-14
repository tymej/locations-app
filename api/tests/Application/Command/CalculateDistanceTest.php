<?php

namespace Localization\Tests\Application\Command;

use Generator;
use Localization\Application\Api\Locations\Coordinates;
use Localization\Application\Api\LocationsClientInterface;
use Localization\Application\Command\CalculateDistance;
use Localization\Application\Entity\CompanyAddress;
use PHPUnit\Framework\TestCase;
use Prophecy\PhpUnit\ProphecyTrait;

class CalculateDistanceTest extends TestCase
{
    use ProphecyTrait;

    /**
     * @dataProvider dataForTestHandle
     */
    public function testHandle(
        CompanyAddress $companyAddress,
        string $destinationStreet,
        string $destinationCity,
        Coordinates $source,
        Coordinates $destination,
        float $expectedKmDistance
    ): void {
        $apiClient = $this->prophesize(LocationsClientInterface::class);

        $apiClient->receiveCoordinates($companyAddress->street, $companyAddress->city)->willReturn($source);
        $apiClient->receiveCoordinates($destinationStreet, $destinationCity)->willReturn($destination);

        $command = new CalculateDistance($apiClient->reveal());

        $result = $command->handle($companyAddress, $destinationStreet, $destinationCity);

        $this->assertSame($expectedKmDistance, $result);
    }

    public function dataForTestHandle(): Generator
    {
        yield [
            $this->mockCompanyAddress(),
            ...$this->createFlatAddress(),
            new Coordinates(53.4238586,14.55556213),
            new Coordinates(53.441142, 14.563973),
            2.0
        ];
        yield [
            $this->mockCompanyAddress(),
            ...$this->createFlatAddress(),
            new Coordinates(53.436160, 14.513382),
            new Coordinates(50.068628, 19.902706),
            526.83
        ];
    }

    protected function mockCompanyAddress(): CompanyAddress
    {
        $address = $this->prophesize(CompanyAddress::class);
        $address->street = 'some test street';
        $address->city = 'some test city';
        return $address->reveal();
    }

    protected function createFlatAddress(): array
    {
        return ['street', 'city'];
    }
}