<?php
declare(strict_types=1);

namespace App\Core;

use App\Exceptions\HttpException;

final class Router
{
    private array $routes = [];

    private array $paramTypes = [];
    
    public function __construct(string $routesFile)
    {
        $this->routes = require $routesFile;

        $this->paramTypes = [
            'int' => [
                'pattern' => '[0-9]+',
                'cast' => static fn(string $value): int => (int) $value,
            ],
            'string' => [
                'pattern' => '[^/]+',
                'cast' => static fn(string $value): string => $value,
            ],
            'slug' => [
                'pattern' => '[a-z0-9-]+',
                'cast' => static fn(string $value): string => $value,
            ],
        ];
    }

    private function normalize(string $path): string
    {
        $path = trim($path);
        $path = trim($path, '/');

        return $path === '' ? '/' : $path;
    }


    public function dispatch(Request $request): Response
    {
        $method = $request->getMethod();
        $uri = $this->normalize($request->getUri());

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

    private function match(string $route, string $uri): ?array
    {
        $casts = [];
        $route = $this->normalize($route);

        $pattern = preg_replace_callback(
            '#\{(\w+)(?::(\w+))?\}#',
            function ($matches) use (&$casts) {
                $name = $matches[1];
                $type = $matches[2] ?? 'string';

                if (!isset($this->paramTypes[$type])) {
                    throw new \RuntimeException("Unsupported route parameter type: $type");
                }

                $casts[$name] = $this->paramTypes[$type]['cast'];

                return '(?P<' . $name . '>' . $this->paramTypes[$type]['pattern'] . ')';
            },
            $route
        );

        $pattern = '#^' . $pattern . '$#';

        if (!preg_match($pattern, $uri, $matches)) {
            return null;
        }

        $params = [];

        foreach ($casts as $name => $cast) {
            $params[] = $cast($matches[$name]);
        }

        return $params;
    }
}
