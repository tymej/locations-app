<?php

$dataMigrations = [
    require_once __DIR__ . '/data/addresses_samples.php',
];

$pdoDriver = require_once __DIR__ . '/database_provider.php';

foreach (array_filter($dataMigrations) as $dataMigration) {
    $pdoDriver->prepare($dataMigration)->execute();
}
