<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Helpers\UserHelper;
use App\Helpers\ResponseHelper;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!UserHelper::IsAdmin()) {
            return ResponseHelper::errorRedirect('Akses ditolak. Hanya admin yang diizinkan.');
        }
        return $next($request);
    }
}
