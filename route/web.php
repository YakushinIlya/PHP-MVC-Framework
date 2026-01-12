<?php
declare(strict_types=1);

use App\Http\HomeController;
use App\Http\UserController;
use App\Http\AboutController;

return [
    '/' => ['GET', HomeController::class, 'index'],
    '/users/{id}' => ['GET', UserController::class, 'show'],
    '/about' => ['GET', AboutController::class, 'index'],

];