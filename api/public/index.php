<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Localization\Infrastructure\ServiceContainer;
use Localization\Infrastructure\Parameters;
use Localization\Infrastructure\RequestFactory;
use Localization\Infrastructure\Router;

Parameters::loadSecrets(__DIR__ . '/../.secrets');
Parameters::loadConfig(
    require_once __DIR__ . '/../config/database.php',
    require_once __DIR__ . '/../config/routes.php',
    require_once __DIR__ . '/../config/api.php',
);

ServiceContainer::initServiceProviders(require_once __DIR__ . '/../config/service_providers.php');
Router::init();

echo Router::process(
    RequestFactory::createFromGlobals(
        $_SERVER,
        getallheaders() ?: null,
        file_get_contents('php://input') ?: null
    )
)->resolve();
