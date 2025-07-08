<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Railway Hosting Configuration
    |--------------------------------------------------------------------------
    |
    | Konfigurasi khusus untuk hosting Railway yang menggunakan
    | ephemeral storage dan stateless deployment.
    |
    */

    'session' => [
        'driver' => env('SESSION_DRIVER', 'database'),
        'lifetime' => env('SESSION_LIFETIME', 1440), // 24 jam
        'expire_on_close' => false,
        'secure' => env('SESSION_SECURE_COOKIE', true),
        'same_site' => 'lax',
    ],

    'cache' => [
        'default' => env('CACHE_DRIVER', 'database'),
        'ttl' => 3600, // 1 jam
    ],

    'database' => [
        'session_table' => 'sessions',
        'cache_table' => 'cache',
    ],
]; 