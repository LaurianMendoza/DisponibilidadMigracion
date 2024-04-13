<?php
namespace App\Http\Middleware;

use Closure;

class BaseMiddleware
{
    protected function getEnvironmentVariable($key, $default = null)
    {
        return env($key, $default);
    }
}
