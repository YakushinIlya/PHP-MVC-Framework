<?php
declare(strict_types=1);

namespace App\Core;

use App\Exceptions\HttpException;

final class Router
{
    private array $routes = [];

    public function __construct(string $routeFile)
    {
        if (!file_exists($routeFile)) {
            throw new \RuntimeException("Route file not found: $routeFile");
        }

        $this->routes = require $routeFile;
    }

    public function dispatch(Request $request): Response
    {
        $method = $request->getMethod();
        $uri = trim($request->getUri(), '/');

        foreach ($this->routes as $routePath => [$routeMethod, $controllerClass, $action]) {
            if ($method !== $routeMethod) {
                continue;
            }

            $params = $this->match($routePath, $uri);
            if ($params === null) {
                continue;
            }

            $controller = new $controllerClass();

            return $controller->$action($request, ...$params);
        }

        throw new HttpException('Page not found', 404);
    }

    private function match(string $routePath, string $uri): ?array
    {
        $routeParts = explode('/', trim($routePath, '/'));
        $uriParts = explode('/', $uri);

        if (count($routeParts) !== count($uriParts)) {
            return null;
        }

        $params = [];

        foreach ($routeParts as $index => $part) {
            if (preg_match('/^{(.+)}$/', $part, $matches)) {
                $params[] = $uriParts[$index];
                continue;
            }

            if ($part !== $uriParts[$index]) {
                return null;
            }
        }

        return $params;
    }
}
