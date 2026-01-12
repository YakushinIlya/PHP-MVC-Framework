<?php
declare(strict_types=1);

namespace App\Http;

use App\Core\Response;
use App\Core\View;

abstract class Controller
{
    protected function view(string $template, array $params = []): Response
    {
        return (new View($template, $params))->render();
    }
}
