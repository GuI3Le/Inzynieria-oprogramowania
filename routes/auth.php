<?php

use App\Http\Controllers\Auth\Auth\VerifyEmailController;
use App\Http\Controllers\Auth\CustomerAuthController;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Route::middleware('guest')->group(function () {
    Volt::route('login', 'auth.login')
        ->name('login');

    Volt::route('register', 'auth.register')
        ->name('register');

    Volt::route('forgot-password', 'auth.forgot-password')
        ->name('password.request');

    Volt::route('reset-password/{token}', 'auth.reset-password')
        ->name('password.reset');

});

//Route::middleware('auth')->group(function () {
//    Volt::route('verify-email', 'auth.verify-email')
//        ->name('verification.notice');
//
//    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
//        ->middleware(['signed', 'throttle:6,1'])
//        ->name('verification.verify');
//
//    Volt::route('confirm-password', 'auth.confirm-password')
//        ->name('password.confirm');
//});

Route::prefix('customer')->group(function () {
    // Guest routes (not authenticated)
    Route::middleware('guest:customer')->group(function () {
        Route::get('/login', [CustomerAuthController::class, 'showLoginForm'])->name('customer.login');
        Route::post('/login', [CustomerAuthController::class, 'login']);
        Route::get('/register', [CustomerAuthController::class, 'showRegistrationForm'])->name('customer.register');
        Route::post('/register', [CustomerAuthController::class, 'register']);
    });

    // Authenticated customer routes
    Route::middleware('auth:customer')->group(function () {
        Route::get('/dashboard', [CustomerAuthController::class, 'dashboard'])->name('customer.dashboard');
        Route::post('/logout', [CustomerAuthController::class, 'logout'])->name('customer.logout');
    });
});

Route::post('logout', App\Livewire\Actions\Logout::class)
    ->name('logout');
