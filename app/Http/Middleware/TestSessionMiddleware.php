<?php

namespace App\Http\Middleware;

use Closure;

class TestSessionMiddleware
{
    public function handle($request, Closure $next)
    {
        return $next($request);
    }
}
