<?php

namespace Localization\Application\Api\Locations;

class Coordinates
{
    private const EARTH_KM_RADIUS = 6371;
    private const ONE_DEGREE = M_PI / 180;

    public function __construct(
        private float $latitude,
        private float $longitude
    )
    {
    }

    public function getLatitude(): float
    {
        return $this->latitude;
    }

    public function getLongitude(): float
    {
        return $this->longitude;
    }

    public function kmDistanceTo(self $destinationCoordinates): int
    {
        $sourceLatDegrees = $this->latitude * self::ONE_DEGREE;
        $sourceLonDegrees = $this->longitude * self::ONE_DEGREE;
        $destinationLatDegrees = $destinationCoordinates->getLatitude() * self::ONE_DEGREE;
        $destinationLonDegrees = $destinationCoordinates->getLongitude() * self::ONE_DEGREE;

        return acos(
            sin($destinationLatDegrees) *
                sin($sourceLatDegrees) +
                cos($destinationLatDegrees) *
                cos($sourceLatDegrees) *
                cos($destinationLonDegrees - $sourceLonDegrees)
            ) * self::EARTH_KM_RADIUS;
    }
}