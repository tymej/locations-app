<?php

declare(strict_types=1);

namespace Localization\Application\Entity;

use JsonSerializable;

class CompanyAddress implements JsonSerializable
{
    public function __construct(
        public string $id,
        public string $street,
        public string $city
    ) {
    }

    public function jsonSerialize(): array
    {
        return [
            'id' => $this->id,
            'street' => $this->street,
            'city' => $this->city,
        ];
    }
}
