<?php

declare(strict_types=1);

namespace Localization\Infrastructure\Router;

class Route
{
    public const METHOD_GET = 'GET';
    public const METHOD_POST = 'POST';
    public const METHOD_PUT = 'PUT';
    public const METHOD_DELETE = 'DELETE';

    private const ALLOWED_METHODS = [self::METHOD_GET, self::METHOD_POST, self::METHOD_PUT, self::METHOD_DELETE];

    public function __construct(
        public string $endpoint,
        public string $controller,
        public string $controllerMethod,
        public string $method = self::METHOD_GET
    ) {
        if (!in_array($method, self::ALLOWED_METHODS)) {
            throw new \RuntimeException(sprintf('Controller %s method not allowed', $method));
        }

        if (!class_exists($controller)) {
            throw new \RuntimeException(sprintf('Controller %s does not exist', $controller));
        }

        if (!method_exists($controller, $controllerMethod)) {
            throw new \RuntimeException(sprintf('Method %s of controller %s does not exist', $controller, $method));
        }
    }
}
