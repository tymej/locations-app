<?php

$modelsMigrations = [
    require_once __DIR__ . '/model/create_address_table.php',
];

$pdoDriver = require_once __DIR__ . '/database_provider.php';

foreach (array_filter($modelsMigrations) as $modelMigration) {
    $pdoDriver->prepare($modelMigration)->execute();
}
