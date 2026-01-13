<?php

use App\Core\Env;

function env(string $key, mixed $default = null): mixed
{
    return Env::get($key, $default);
}
