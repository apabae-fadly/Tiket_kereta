<?php

namespace App\Http\Middleware;

use Closure;
use App\Helpers\MiddlewareHelper;
use Illuminate\Support\Facades\Auth;

class SessionCheckMiddleware
{
    public function handle($request, Closure $next)
    {
        // Cek session expired pakai helper
        if (Auth::check() && MiddlewareHelper::isSessionExpired()) {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            return redirect()->route('login')->with('error', 'Session Anda telah berakhir. Silakan login kembali.');
        }

        // Cek admin pakai helper (jika perlu)
        // if (!MiddlewareHelper::isAdmin()) { ... }

        // Update last activity
        session(['last_activity' => now()->timestamp]);

        return $next($request);
    }
} 