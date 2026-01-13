<?php
declare(strict_types=1);

use App\Http\HomeController;
use App\Http\UserController;
use App\Http\AboutController;

return [
    '/' => ['GET', HomeController::class, 'index'],
    '/about' => ['GET', AboutController::class, 'index'],
    '/users/{id:int}/{status:string}' => ['GET', UserController::class, 'show'],
];