<?php

declare(strict_types=1);

namespace Localization\Infrastructure;

class Parameters
{
    private static array $database = [];

    private static array $routes = [];

    private static array $secrets = [];

    private static array $api = [];

    public static function loadSecrets(string $secretsFile): void
    {
        if (!file_exists($secretsFile)) {
            return;
        }

        $envLines = file($secretsFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

        array_walk($envLines, function (string $line) {
            if (0 === mb_strpos(trim($line), '#')) {
                return;
            }

            $keyValue = explode('=', $line);

            if (!$keyValue || 2 !== count($keyValue)) {
                return;
            }

            self::$secrets[reset($keyValue)] = end($keyValue);
        });
    }

    public static function loadConfig(array $database, array $routes, array $api): void
    {
        static::$database = $database;
        static::$routes = $routes;
        static::$api = $api;
    }

    public static function getDatabaseConfigValue(string $key): string
    {
        return static::$database[$key] ?? '';
    }

    /**
     * @return string[]
     */
    public static function getRoutes(): array
    {
        return static::$routes;
    }

    public static function getSecret(string $key): string
    {
        return self::$secrets[$key] ?? '';
    }

    public static function getApiParam(string $key): string
    {
        return self::$api[$key] ?? '';
    }
}
