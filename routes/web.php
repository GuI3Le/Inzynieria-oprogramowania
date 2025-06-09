<?php

use App\Http\Controllers\Auth\CustomerAuthController;
use App\Http\Controllers\Auth\EmployeeAuthController;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::prefix('customer')->group(function () {
    Route::middleware('guest:customer')->group(function () {
        Route::get('/login', [CustomerAuthController::class, 'showLoginForm'])->name('customer.showLoginForm');
        Route::post('/login', [CustomerAuthController::class, 'login'])->name('customer.submitLogin');
        Route::get('/register', [CustomerAuthController::class, 'showRegistrationForm'])->name('customer.showRegistrationForm');
        Route::post('/register', [CustomerAuthController::class, 'register'])->name('customer.submitRegistration');
    });

    Route::middleware('auth:customer')->group(function () {
        Route::get('/dashboard', [CustomerAuthController::class, 'dashboard'])->name('customer.dashboard');
        Route::post('/logout', [EmployeeAuthController::class, 'logout'])->name('customer.logout');
        Route::get('/schedule', [CustomerAuthController::class, 'schedule'])->name('customer.schedule');
        Route::post('/class/register/{classId}', [CustomerAuthController::class, 'registerForClass'])
    ->name('customer.class.register')
    ->middleware('auth:customer');
        Route::delete('/class/unregister/{classId}', [CustomerAuthController::class, 'unregisterFromClass'])
    ->name('customer.class.unregister')
    ->middleware('auth:customer');
        Route::get('/customer/profile/edit', [CustomerAuthController::class, 'editProfile'])->name('customer.profile.edit');
        Route::put('/customer/profile/update', [CustomerAuthController::class, 'updateProfile'])->name('customer.profile.update');
    });
        Route::get('/customer/memberships', [CustomerAuthController::class, 'memberships'])->name('customer.memberships');
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
        Route::get('/schedule', [EmployeeAuthController::class, 'schedule'])->name('employee.schedule');
        Route::post('/schedule/add', [EmployeeAuthController::class, 'addClass'])->name('employee.schedule.add');
        Route::post('/schedule/edit', [EmployeeAuthController::class, 'editClass'])->name('employee.schedule.edit');
        Route::post('/schedule/delete', [EmployeeAuthController::class, 'deleteClass'])->name('employee.schedule.delete');
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
