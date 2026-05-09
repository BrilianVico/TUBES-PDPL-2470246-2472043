<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\SiswaAuthController;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('auth.landing');
})->name('home');

Route::get('/login-menu', function () {
    return view('auth.pilih-login');
})->name('login.menu');

Route::get('/register-sekolah', function () {
    return view('auth.register-sekolah');
})->name('register.sekolah');

/*
|--------------------------------------------------------------------------
| Admin Authentication
|--------------------------------------------------------------------------
*/

Route::get('/login', [AdminAuthController::class, 'showLoginForm'])
    ->name('login');

Route::post('/login', [AdminAuthController::class, 'login'])
    ->name('login.process');

Route::post('/logout', [AdminAuthController::class, 'logout'])
    ->name('logout');

/*
|--------------------------------------------------------------------------
| Siswa Authentication
|--------------------------------------------------------------------------
*/

Route::get('/login-siswa', [SiswaAuthController::class, 'showLoginForm'])
    ->name('login.siswa');

Route::post('/login-siswa', [SiswaAuthController::class, 'login'])
    ->name('login.siswa.process');

Route::post('/logout-siswa', [SiswaAuthController::class, 'logout'])
    ->name('logout.siswa');

/*
|--------------------------------------------------------------------------
| Orang Tua Authentication
|--------------------------------------------------------------------------
*/

Route::get('/login-ortu', function () {
    return view('auth.login-ortu');
})->name('login.ortu');

Route::post('/login-ortu', function () {
    // Nanti bisa diganti dengan OrtuAuthController
    return back()->with('error', 'Fitur login orang tua belum diimplementasikan.');
})->name('login.ortu.process');

/*
|--------------------------------------------------------------------------
| Protected Routes
|--------------------------------------------------------------------------
*/

Route::middleware('admin.auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
