<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\AuthController;

Route::get('/', [HomeController::class, 'index'])->name('home');

// Auth routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

// Session management untuk Railway
Route::get('/check-session', [AuthController::class, 'checkSession'])->name('session.check');
Route::post('/refresh-session', [AuthController::class, 'refreshSession'])->name('session.refresh');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // CRUD kereta hanya untuk admin
    Route::middleware(['isAdmin'])->group(function () {
        Route::resource('trains', App\Http\Controllers\TrainController::class);
        Route::resource('schedules', App\Http\Controllers\ScheduleController::class)->except(['index','show']);
        Route::get('bookings/{booking}/edit', [App\Http\Controllers\BookingController::class, 'edit'])->name('bookings.edit');
        Route::put('bookings/{booking}', [App\Http\Controllers\BookingController::class, 'update'])->name('bookings.update');
    });

    // Route yang bisa diakses semua user login
    Route::resource('bookings', App\Http\Controllers\BookingController::class)->except(['edit', 'update']);
    Route::get('/schedules', [App\Http\Controllers\ScheduleController::class, 'index'])->name('schedules.index');
    Route::resource('tickets', App\Http\Controllers\TicketController::class)->only(['index', 'show']);
    Route::post('/bookings/{id}/bayar', [App\Http\Controllers\BookingController::class, 'bayar'])->name('bookings.bayar');
    Route::post('/bookings/{id}/konfirmasi-pembayaran', [App\Http\Controllers\BookingController::class, 'konfirmasiPembayaran'])->name('bookings.konfirmasiPembayaran');
    Route::get('/tickets', [TicketController::class, 'index'])->name('tickets.index');
    Route::get('/tickets/{ticket}', [TicketController::class, 'show'])->name('tickets.show');
    Route::get('/tickets/{id}/download', [App\Http\Controllers\TicketController::class, 'download'])->name('tickets.download');

    // Route test untuk cek middleware
    Route::get('/test-middleware', function() {
        return 'middleware jalan';
    });
});

require __DIR__.'/auth.php';
