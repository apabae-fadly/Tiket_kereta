<?php

namespace App\Helpers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\JsonResponse;

class ResponseHelper
{
    /**
     * Response sukses dengan redirect
     */
    public static function successRedirect(string $message, string $route = '/'): RedirectResponse
    {
        return redirect($route)->with('success', $message);
    }

    /**
     * Response error dengan redirect
     */
    public static function errorRedirect(string $message, string $route = '/'): RedirectResponse
    {
        return redirect($route)->with('error', $message);
    }

    /**
     * Response sukses JSON
     */
    public static function successJson(string $message, $data = null, int $code = 200): JsonResponse
    {
        return response()->json([
            'success' => true,
            'message' => $message,
            'data' => $data
        ], $code);
    }

    /**
     * Response error JSON
     */
    public static function errorJson(string $message, int $code = 400): JsonResponse
    {
        return response()->json([
            'success' => false,
            'message' => $message
        ], $code);
    }

    /**
     * Response not found JSON
     */
    public static function notFoundJson(string $message = 'Data tidak ditemukan'): JsonResponse
    {
        return self::errorJson($message, 404);
    }

    /**
     * Response unauthorized JSON
     */
    public static function unauthorizedJson(string $message = 'Akses ditolak'): JsonResponse
    {
        return self::errorJson($message, 401);
    }

    /**
     * Response forbidden JSON
     */
    public static function forbiddenJson(string $message = 'Akses dilarang'): JsonResponse
    {
        return self::errorJson($message, 403);
    }

    /**
     * Response validation error JSON
     */
    public static function validationErrorJson(array $errors): JsonResponse
    {
        return response()->json([
            'success' => false,
            'message' => 'Validasi gagal',
            'errors' => $errors
        ], 422);
    }

    /**
     * Flash message sukses
     */
    public static function flashSuccess(string $message): void
    {
        session()->flash('success', $message);
    }

    /**
     * Flash message error
     */
    public static function flashError(string $message): void
    {
        session()->flash('error', $message);
    }

    /**
     * Flash message warning
     */
    public static function flashWarning(string $message): void
    {
        session()->flash('warning', $message);
    }

    /**
     * Flash message info
     */
    public static function flashInfo(string $message): void
    {
        session()->flash('info', $message);
    }

    /**
     * Cek apakah ada flash message
     */
    public static function hasFlash(string $type = null): bool
    {
        if ($type) {
            return session()->has($type);
        }
        
        return session()->has('success') || 
               session()->has('error') || 
               session()->has('warning') || 
               session()->has('info');
    }

    /**
     * Dapatkan flash message
     */
    public static function getFlash(string $type): ?string
    {
        return session($type);
    }
} 