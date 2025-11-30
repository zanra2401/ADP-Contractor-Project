<?php

use App\Http\Controllers\UserController;
use App\Http\Middleware\EnsurePasswordSecure;
use App\Http\Middleware\EnsureTelpNumValid;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Support\Facades\Route;



// RUTE PENGGUNA
Route::controller(UserController::class)->group(function () {
    
    Route::post('/user/pengunjung/register', 'createPengunjung')->withoutMiddleware(VerifyCsrfToken::class);

    Route::get('/halaman-welcome', 'welcome');

});

// RUTE ADMIN

// Login
Route::get('/login', function () {
    return view('login');
})->name('login');

// Proses Login
Route::post('/login', function (Request $request) {
    // Ambil data inputan
    $phone = $request->input('phone');
    $password = $request->input('password');

    // Cek logika sederhana (Hardcode dulu untuk belajar)
    if ($phone == '08123' && $password == 'admin') {
        // Jika benar, lempar ke Dashboard
        return redirect()->route('dashboard');
    } else {
        // Jika salah, kembalikan ke login
        return redirect()->back()->with('error', 'Nomor atau Sandi salah!');
    }
})->name('login.submit');

// dasbor
Route::get('/', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/laporan', function () {
    return view('laporan');
})->name('laporan');

Route::get('/manajemen-konten', function () {
    return view('manajemen-konten');
})->name('manajemen.konten');

Route::get('/manajemen-proyek', function () {
    return view('manajemen-proyek');
})->name('manajemen.proyek');

Route::get('/manajemen-user', function () {
    return view('manajemen-user');
})->name('manajemen.user');

Route::get('/chat-admin', function () {
    return view('chat');
})->name('chat.admin');

Route::get('/payment', function () {
    return view('payment');
})->name('payment');

Route::get('/simpan-desain', function () {
    return view('simpan-desain');
})->name('simpan.desain');

Route::get('/upload-progress', function () {
    return view('upload-progress');
})->name('upload.progress');

Route::get('/approve-progress', function () {
    return view('approve-progress');
})->name('approve.progress');

Route::get('/set-harga', function () {
    return view('set-harga');
})->name('set.harga');