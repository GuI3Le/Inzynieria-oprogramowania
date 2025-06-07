<?php

use App\Http\Controllers\Auth\CustomerAuthController;
use App\Http\Controllers\Auth\EmployeeAuthController;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::prefix('customer')->group(function () {
    Route::middleware('guest:customer')->group(function () {
        Route::get('/login', [CustomerAuthController::class, 'showLoginForm'])->name('customer.showLoginForm');
        Route::post('/login', [CustomerAuthController::class, 'login'])->name('customer.submitLogin');
        Route::get('/register', [CustomerAuthController::class, 'showRegistrationForm'])->name('customer.showRegistrationForm');
        Route::post('/register', [CustomerAuthController::class, 'register'])->name('customer.submitRegistration');
    });

    Route::middleware('auth:customer')->group(function () {
        Route::get('/dashboard', [CustomerAuthController::class, 'dashboard'])->name('customer.dashboard');
        Route::post('/logout', [CustomerAuthController::class, 'logout'])->name('customer.logout');
    });
});

Route::prefix('employee')->group(function () {
    Route::middleware('guest:employee')->group(function () {
        Route::get('/login', [EmployeeAuthController::class, 'showLoginForm'])->name('employee.showLoginForm');
        Route::post('/login', [EmployeeAuthController::class, 'login'])->name('employee.submitLogin');
        Route::get('/register', [EmployeeAuthController::class, 'showRegistrationForm'])->name('employee.showRegistrationForm');
        Route::post('/register', [EmployeeAuthController::class, 'register'])->name('employee.register.submit');
    });

    Route::middleware('auth:employee')->group(function () {
        Route::get('/dashboard', [EmployeeAuthController::class, 'dashboard'])->name('employee.dashboard');
        Route::post('/logout', [EmployeeAuthController::class, 'logout'])->name('employee.logout');
    });
});

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');
    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});

require __DIR__ . '/auth.php';
