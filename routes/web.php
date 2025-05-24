<?php

use App\Http\Controllers\Auth\CustomerAuthController;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/signup', function () {
    return view('signup');
})->name('signup');

Route::get('/signin', function () {
    return view('signin');
})->name('signin');

Route::post('/signin', [CustomerAuthController::class, 'login'])->name('signin');

Route::post('/signup', [CustomerAuthController::class, 'register'])->name('signup');

Route::get('/customer/dashboard', [CustomerAuthController::class, 'dashboard'])->name('customer.dashboard');

//Route::view('/signup', 'signup');

//Route::middleware('auth:customer')->group(function () {
//    Route::get('/customer/dashboard', function (){
//        return view('/customer/dashboard');
//    })->name('dashboard');
//    Route::get('/logout', [CustomerAuthController::class, 'logout'])->name('logout');
//});

//Route::view('dashboard', '/customer/dashboard')
//    ->middleware(['auth', 'verified'])
//    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});

//Route::middleware(['auth:customer'])->group(function () {})

require __DIR__.'/auth.php';
