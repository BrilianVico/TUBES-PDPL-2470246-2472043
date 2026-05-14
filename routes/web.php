<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\OrtuAuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DataSiswaController;
use App\Http\Controllers\TagihanController;
use App\Http\Controllers\BeasiswaController;

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
| Orang Tua Authentication
|--------------------------------------------------------------------------
*/

Route::get('/login-ortu', [OrtuAuthController::class, 'showLoginForm'])
    ->name('login.ortu');

Route::post('/login-ortu', [OrtuAuthController::class, 'login'])
    ->name('login.ortu.process');

Route::post('/logout-ortu', [OrtuAuthController::class, 'logout'])
    ->name('logout.ortu');

/*
|--------------------------------------------------------------------------
| Cek Akun Orang Tua
|--------------------------------------------------------------------------
*/

Route::get('/ortu/cek-akun', [OrtuAuthController::class, 'showCekAkun'])
    ->name('ortu.cek-akun');

Route::post('/ortu/cek-akun', [OrtuAuthController::class, 'cekAkun'])
    ->name('ortu.cek-akun.process');

/*
|--------------------------------------------------------------------------
| Lupa Password Orang Tua
|--------------------------------------------------------------------------
*/

Route::get('/ortu/lupa-password', [OrtuAuthController::class, 'showForgotPassword'])
    ->name('ortu.forgot-password');

Route::post('/ortu/lupa-password', [OrtuAuthController::class, 'resetPassword'])
    ->name('ortu.forgot-password.process');

/*
|--------------------------------------------------------------------------
| Protected Routes - Admin
|--------------------------------------------------------------------------
*/

Route::middleware('admin.auth')->group(function () {

    /*
    |--------------------------------------------------------------------------
    | Dashboard Admin
    |--------------------------------------------------------------------------
    */
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    /*
    |--------------------------------------------------------------------------
    | Data Master Siswa
    |--------------------------------------------------------------------------
    */
    Route::get('/admin/data-siswa', [DataSiswaController::class, 'index'])
        ->name('admin.data-siswa');

    /*
    |--------------------------------------------------------------------------
    | CRUD Tagihan
    |--------------------------------------------------------------------------
    */
    Route::resource('admin/tagihan', TagihanController::class)
        ->names('admin.tagihan');

    /*
    |--------------------------------------------------------------------------
    | CRUD Beasiswa
    |--------------------------------------------------------------------------
    */
    Route::resource('admin/beasiswa', BeasiswaController::class)
        ->names('admin.beasiswa');
});

/*
|--------------------------------------------------------------------------
| Protected Routes - Orang Tua
|--------------------------------------------------------------------------
*/

Route::middleware('ortu.auth')->group(function () {
    Route::get('/dashboard-ortu', function () {
        return view('dashboard_ortu');
    })->name('dashboard.ortu');
});
