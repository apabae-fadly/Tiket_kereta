<?php

namespace App\Http\Middleware;

use Closure;

class TestSession
{
    public function handle($request, Closure $next)
    {
        return $next($request);
    }
}
