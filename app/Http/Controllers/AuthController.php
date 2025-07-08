<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthController extends Controller
{
    /**
     * Display the login view.
     */
    public function showLoginForm(): View
    {
        // Clear any existing session data
        session()->flush();
        
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function login(LoginRequest $request): RedirectResponse
    {
        try {
            $request->authenticate();

            // Regenerate session untuk keamanan
            $request->session()->regenerate();

            // Set session lifetime yang lebih panjang untuk Railway
            config(['session.lifetime' => 1440]); // 24 jam

            // Set remember me cookie jika diperlukan
            if ($request->boolean('remember')) {
                $request->session()->put('remember_me', true);
            }

            return redirect()->intended(route('dashboard', absolute: false));
        } catch (\Exception $e) {
            // Log error untuk debugging
            \Log::error('Login error: ' . $e->getMessage());
            
            return back()->withErrors([
                'email' => 'Login gagal. Silakan coba lagi.',
            ])->withInput($request->only('email'));
        }
    }

    /**
     * Handle logout.
     */
    public function logout(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }

    /**
     * Check if user session is still valid.
     */
    public function checkSession(Request $request): \Illuminate\Http\JsonResponse
    {
        if (Auth::check()) {
            return response()->json([
                'authenticated' => true,
                'user' => Auth::user()->only(['id', 'name', 'email'])
            ]);
        }

        return response()->json([
            'authenticated' => false,
            'message' => 'Session expired'
        ], 401);
    }

    /**
     * Refresh session untuk Railway.
     */
    public function refreshSession(Request $request): \Illuminate\Http\JsonResponse
    {
        if (Auth::check()) {
            $request->session()->regenerate();
            
            return response()->json([
                'success' => true,
                'message' => 'Session refreshed'
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'User not authenticated'
        ], 401);
    }
} 