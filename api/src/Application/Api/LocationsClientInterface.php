<?php

declare(strict_types=1);

namespace Localization\Application\Api;

use Localization\Application\Api\Locations\Coordinates;

interface LocationsClientInterface
{
    public function receiveCoordinates(string $street, string $city): Coordinates;
}
