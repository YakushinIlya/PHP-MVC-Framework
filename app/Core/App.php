<?php
declare(strict_types=1);

namespace App\Core;

use App\Exceptions\HttpException;

final class App
{
    public function run(): void
    {
        try {
            $request = new Request();
            $router = new Router(dirname(__DIR__, 2) . '/route/web.php');
            $response = $router->dispatch($request);
        } catch (HttpException $e) {
            $response = new Response($e->getMessage(), $e->getStatusCode());
        }

        $response->send();
    }
}
