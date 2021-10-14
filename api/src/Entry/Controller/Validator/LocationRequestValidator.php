<?php

declare(strict_types=1);

namespace Localization\Entry\Controller\Validator;

use Localization\Infrastructure\Http\Request;

class LocationRequestValidator
{
    public function isValid(Request $request): bool
    {
        $street = $request->getJsonBodyValue('street');
        $city = $request->getJsonBodyValue('city');

        return is_string($street) && $street && is_string($city) && $city;
    }
}
