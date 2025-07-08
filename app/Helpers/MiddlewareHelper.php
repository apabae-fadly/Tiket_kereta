<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Auth;

class MiddlewareHelper
{
    public static function isSessionExpired($sessionLifetime = 1440)
    {
        $lastActivity = session('last_activity', now()->timestamp);
        return (now()->timestamp - $lastActivity > ($sessionLifetime * 60));
    }

    public static function isAdmin()
    {
        return Auth::check() && Auth::user()->role === 'admin';
    }
}
