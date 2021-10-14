<?php

declare(strict_types=1);

namespace Localization\Infrastructure\Container;

use Localization\Application\Api\LocationsClientInterface;
use Localization\Infrastructure\ApiClient\HereApiClient;
use Localization\Infrastructure\Parameters;

class ApiClientProvider extends AbstractContainer
{
    public function loadInstances(): void
    {
        $hereApiClient = new HereApiClient(
            Parameters::getApiParam('HERE_MAPS_GEOCODE_API_URL'),
            Parameters::getSecret('HERE_API_KEY')
        );

        $this->setInstances(
            [
                LocationsClientInterface::class => $hereApiClient,
            ]
        );
    }
}
