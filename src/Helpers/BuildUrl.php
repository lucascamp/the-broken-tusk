<?php

namespace Tracksale\Helpers;

use Tracksale\Configuration\Http;
use Tracksale\Configuration\Routes;
use Tracksale\Exception\InvalidRouteException;
use ReflectionException;
use ReflectionClass;

class BuildUrl
{
    /**
     * @param string $route
     * @return string
     * @throws InvalidRouteException
     * @throws ReflectionException
     */
    public static function getUrlByRoute(string $route): string
    {
        if (! static::routeExists($route)) {
            throw new InvalidRouteException("Invalid route: " . $route);
        }
        return sprintf("%s/%s", trim(Http::BASE_URL, "/"), trim($route, "/"));
    }

    /**
     * @param string $route
     * @return bool
     * @throws ReflectionException
     * @throws ReflectionException
     */
    private static function routeExists(string $route): bool
    {
        $reflection = new ReflectionClass(Routes::class);
        foreach ($reflection->getConstants() as $constant) {
            if ($route == $constant) {
                return true;
            }
        }

        return false;
    }
}
