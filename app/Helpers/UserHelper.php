<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Auth;
use App\Models\User;

class UserHelper
{
    /**
     * Cek apakah user yang sedang login adalah admin
     */
    public static function IsAdmin(): bool
    {
        return Auth::check() && Auth::user() && Auth::user()->IsAdmin();
    }

    /**
     * Cek apakah user yang sedang login adalah user biasa
     */
    public static function isUser(): bool
    {
        return Auth::check() && Auth::user() && Auth::user()->role === 'user';
    }

    /**
     * Dapatkan user yang sedang login
     */
    public static function currentUser(): ?User
    {
        return Auth::user();
    }

    /**
     * Dapatkan ID user yang sedang login
     */
    public static function currentUserId(): ?int
    {
        return Auth::id();
    }

    /**
     * Cek apakah user sudah login
     */
    public static function isLoggedIn(): bool
    {
        return Auth::check();
    }

    /**
     * Cek apakah user memiliki role tertentu
     */
    public static function hasRole(string $role): bool
    {
        return Auth::check() && Auth::user() && Auth::user()->role === $role;
    }

    /**
     * Dapatkan nama user yang sedang login
     */
    public static function currentUserName(): string
    {
        return Auth::user() ? Auth::user()->name : 'Guest';
    }

    /**
     * Dapatkan email user yang sedang login
     */
    public static function currentUserEmail(): string
    {
        return Auth::user() ? Auth::user()->email : '';
    }

    /**
     * Redirect dengan pesan error jika bukan admin
     */
    public static function requireAdmin()
    {
        if (!self::IsAdmin()) {
            return redirect('/')->with('error', 'Akses ditolak. Hanya admin yang diizinkan.');
        }
        return null;
    }

    /**
     * Redirect dengan pesan error jika belum login
     */
    public static function requireLogin()
    {
        if (!self::isLoggedIn()) {
            return redirect('/login')->with('error', 'Silakan login terlebih dahulu.');
        }
        return null;
    }
}

if (!function_exists('user_helper')) {
    function user_helper() {
        return app('user.helper');
    }
} 
