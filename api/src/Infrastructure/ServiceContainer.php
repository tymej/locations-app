<?php

namespace Localization\Infrastructure;

use Localization\Infrastructure\Container\AbstractContainer;
use Localization\Infrastructure\Exception\ServiceProviderNotFound;

class ServiceContainer
{
    /**
     * @var array|ContainerInterface[]
     */
    private static $containers = [];

    public static function getInstance(string $class): ?object
    {
        foreach (static::$containers as $container) {
            if ($container->hasInstance($class)) {
                return $container->getInstance($class);
            }
        }

        return null;
    }

    public static function initServiceProviders(array $serviceProviders): void
    {
        foreach ($serviceProviders as $serviceProvider) {
            if (!class_exists($serviceProvider)) {
                throw new ServiceProviderNotFound(sprintf('Service provider %s does not exist', $serviceProvider));
            }

            /** @var $provider AbstractContainer */
            $provider = new $serviceProvider();
            $provider->loadInstances();
            static::$containers[] = $provider;
        }
    }
}
