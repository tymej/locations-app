<?php

namespace Localization\Infrastructure\Container;

use Localization\Infrastructure\Mapper\AddressMapper;
use Localization\Infrastructure\Parameters;
use PDO;

class DataMapperProvider extends AbstractContainer
{
    public function loadInstances(): void
    {
        $pdo = new PDO(
            Parameters::getDatabaseConfigValue('DATABASE_DSN'),
            Parameters::getSecret('DATABASE_USER'),
            Parameters::getSecret('DATABASE_PASSWORD')
        );

        $this->setInstances(
            [
                AddressMapper::class => new AddressMapper($pdo)
            ]
        );
    }
}