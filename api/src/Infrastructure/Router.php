<?php

declare(strict_types=1);

namespace Localization\Infrastructure;

use Localization\Infrastructure\Http\Request;
use Localization\Infrastructure\Http\Response;
use Localization\Infrastructure\Router\Route;

class Router
{
    /**
     * @var array|Route[]
     */
    private static $routes = [];

    public static function init(): void
    {
        foreach (Parameters::getRoutes() as $rawRoute) {
            self::$routes[] = new Route(...$rawRoute);
        }
    }

    public static function process(Request $request): Response
    {
        $route = self::matchWithRequest($request);

        if (!$route) {
            return Response::createNotFound(sprintf('Uri %s does not exist', $request->getUri()));
        }

        $controllerInstance = ServiceContainer::getInstance($route->controller);

        return $controllerInstance->{$route->controllerMethod}($request);
    }

    private static function matchWithRequest(Request $request): ?Route
    {
        $matchedRoutes = array_filter(
            self::$routes,
            fn (Route $route) => (
                    $route->endpoint === $request->getPath() || sscanf($request->getPath(), $route->endpoint)
                )
                && $route->method === $request->getMethod()
        );

        return reset($matchedRoutes) ?: null;
    }
}
