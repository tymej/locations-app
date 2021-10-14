<?php

namespace Localization\Application\Command;

use Localization\Application\Api\LocationsClientInterface;
use Localization\Application\Entity\CompanyAddress;

class CalculateDistance
{
    public function __construct(
        private LocationsClientInterface $locationsClient
    )
    {
    }

    public function handle(CompanyAddress $companyAddress, string $destinationStreet, string $destinationCity)
    {
        $companyCoordinates = $this->locationsClient->receiveCoordinates(
            $companyAddress->street,
            $companyAddress->city
        );

        $destinationCoordinates = $this->locationsClient->receiveCoordinates(
            $destinationStreet,
            $destinationCity
        );

        return $companyCoordinates->kmDistanceTo($destinationCoordinates);
    }
}