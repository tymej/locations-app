<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Localization\Infrastructure\Parameters;

Parameters::loadSecrets(__DIR__ . '/../.secrets');
Parameters::loadConfig(require_once __DIR__ . '/../config/database.php', [], []);


return new PDO(
    Parameters::getDatabaseConfigValue('DATABASE_DSN'),
    Parameters::getSecret('DATABASE_USER'),
    Parameters::getSecret('DATABASE_PASSWORD')
);
