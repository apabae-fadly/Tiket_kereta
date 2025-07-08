<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckSessionExpiry
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Jika user sudah login, cek apakah session masih valid
        if (Auth::check()) {
            $user = Auth::user();
            
            // Cek apakah session sudah expired (lebih dari 24 jam)
            $sessionLifetime = config('session.lifetime', 1440); // 24 jam dalam menit
            $lastActivity = session('last_activity', now()->timestamp);
            
            if (now()->timestamp - $lastActivity > ($sessionLifetime * 60)) {
                // Session expired, logout user
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();
                
                if ($request->expectsJson()) {
                    return response()->json([
                        'message' => 'Session expired',
                        'redirect' => route('login')
                    ], 401);
                }
                
                return redirect()->route('login')->with('error', 'Session Anda telah berakhir. Silakan login kembali.');
            }
            
            // Update last activity
            session(['last_activity' => now()->timestamp]);
        }
        
        return $next($request);
    }
} 