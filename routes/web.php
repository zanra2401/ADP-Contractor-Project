<?php

use App\Http\Controllers\MessageController;
use App\Http\Middleware\EnsurePasswordSecure;
use App\Http\Middleware\EnsureTelpNumValid;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Middleware\AuthMiddleware;
use App\Http\Middleware\LoginMiddleware;
use App\Http\Controllers\Pelanggan\PelangganController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\CSMiddleware;
use App\Http\Middleware\PelangganMiddleware;
use App\Http\Controllers\Admin\UserManagementController;

// use App\Http\Controllers\ForgotPasswordController;

/*
|--------------------------------------------------------------------------
| 1. ROUTE BACKEND - USER (REGISTER PENGUNJUNG)
|--------------------------------------------------------------------------
*/


Route::controller(AuthController::class)->group(function () {
    Route::post('/login', 'auth')->name('login');
});

Route::get('/login', fn() => view('auth.login'))->name('login')->middleware([
    LoginMiddleware::class
]);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');



/*
|--------------------------------------------------------------------------
| 2. ROUTE AUTENTIKASI & HALAMAN DEPAN
|--------------------------------------------------------------------------
*/

// LANDING PAGE
Route::get('/', fn() => view('welcome'))->name('home');

// Logout


// FORGOT PASSWORD PROSES
// Route::post('/forgot-password/verify', [ForgotPasswordController::class, 'verifyPhone'])
//     ->name('password.verify-phone');

// Route::post('/forgot-password/update', [ForgotPasswordController::class, 'updatePassword'])
//     ->name('password.update');

/*
|--------------------------------------------------------------------------
| 3. ROUTE DASHBOARD PER ROLE
|--------------------------------------------------------------------------
*/

/* --------------------- ADMIN ---------------------- */
Route::prefix('admin')->name('admin.')->group(function () {
    Route::middleware([AuthMiddleware::class, AdminMiddleware::class])->group(function () {
        Route::get('/dashboard', fn() => view('admin.dashboard'))->name('dashboard');
        Route::get('/laporan', fn() => view('admin.laporan'))->name('laporan');
        Route::get('/manajemen-konten', fn() => view('admin.manajemen-konten'))->name('manajemen-konten');
        Route::get('/manajemen-proyek', fn() => view('admin.manajemen-proyek'))->name('manajemen-proyek');
        Route::get('/manajemen-proyek/detail', fn() => view('admin.detail-proyek'))->name('proyek.detail');
        Route::get('/manajemen-user', [UserManagementController::class, 'index'])->name('manajemen-user');
        Route::get('/chat', fn() => view('admin.chat'))->name('chat');
        Route::get('/payment', fn() => view('admin.payment'))->name('payment');
        Route::get('/simpan-desain', fn() => view('admin.simpan-desain'))->name('simpan-desain');
        Route::get('/upload-progress', fn() => view('admin.upload-progress'))->name('upload-progress');
        Route::get('/approve-progress', fn() => view('admin.approve-progress'))->name('approve-progress');
        Route::get('/set-harga', fn() => view('admin.set-harga'))->name('set-harga');
    });
});

/* --------------------- PELANGGAN ---------------------- */
Route::prefix('pelanggan')->name('pelanggan.')->group(function () {

    Route::controller(PelangganController::class)->group(function () {
        Route::post('/register', 'register')->name('register');
    });


    Route::get('/pembayaran', fn() => view('pelanggan.pembayaran'))->name('pembayaran');



    Route::get('/register', fn() => view('auth.register'))->name('register');
    Route::get('/forgot-password', fn() => view('auth.forgot-password'))->name('password.request');

    Route::middleware([AuthMiddleware::class, PelangganMiddleware::class])->group(function () {
        Route::get('/dashboard', fn() => view('pelanggan.dashboard'))
            ->name('dashboard')
            ->middleware([AuthMiddleware::class]);
    
        Route::get('/galeri', fn() => view('pelanggan.galeri'))->name('galeri');
        Route::get('/chat', fn() => view('pelanggan.chat'))->name('chat');
        Route::get('/pembayaran', fn() => view('pelanggan.pembayaran'))->name('pembayaran');
        Route::get('/profil', fn() => view('pelanggan.profil'))->name('profil');
        Route::get('/galeri/detail', fn() => view('pelanggan.detail-desain'))->name('galeri.detail');
    });
});

/* --------------------- PENGAWAS ---------------------- */
Route::prefix('pengawas')->name('pengawas.')->group(function () {

    Route::get('/dashboard', fn() => view('pengawas.dashboard'))->name('dashboard');
    Route::get('/chat', fn() => view('pengawas.chat'))->name('chat');
    Route::get('/detail-proyek', fn() => view('pengawas.detail-proyek'))->name('detail-proyek');
    Route::get('/profil', fn() => view('pengawas.profil'))->name('profil');
    // Route::post('/admin/projects', [AdminProjectController::class, 'store']);
});

/* --------------------- CUSTOMER SERVICE ---------------------- */
Route::prefix('cs')->name('cs.')->group(function () {    
    Route::middleware([AuthMiddleware::class, CSMiddleware::class])->group(function () {
        Route::get('/dashboard', fn() => view('CS.dashboard'))->name('dashboard');
        Route::get('/profil', fn() => view('CS.profil'))->name('profil');
    });
});

/* --------------------- SUPERADMIN ---------------------- */
Route::prefix('superadmin')->name('superadmin.')->group(function () {
    Route::get('/manajemen-admin', fn() => view('superadmin.manajemen-admin'))->name('manajemen-admin');
});