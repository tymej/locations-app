<?php

namespace Localization\Infrastructure\ApiClient;

use Localization\Application\Api\Locations\Coordinates;
use Localization\Application\Api\LocationsClientInterface;
use Localization\Infrastructure\Exception\ApiClientException;

class HereApiClient extends AbstractApiClient implements LocationsClientInterface
{
    public function __construct(private string $geocodeApiUrl, private string $token)
    {
    }

    public function receiveCoordinates(string $street, string $city): Coordinates
    {
        $query = '?q=' . urlencode(sprintf('%s %s', $street, $city)) . '&apiKey=' . $this->token;

        $result = $this->sendGetJsonRequest($this->geocodeApiUrl . $query);

        if (!$result || !isset($result['items'][0]['position'])) {
            throw new ApiClientException(sprintf('API error: Can not receive coordinates for %s %s', $street, $city));
        }

        $element = $result['items'][0];
        return new Coordinates($element['position']['lat'], $element['position']['lng']);
    }
}