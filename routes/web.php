<?php

use App\Http\Controllers\MessageController;
use App\Http\Controllers\Pengunjung\PengunjungController;
use App\Http\Middleware\EnsurePasswordSecure;
use App\Http\Middleware\EnsureTelpNumValid;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Support\Facades\Route;



// RUTE PENGGUNA
Route::controller(PengunjungController::class)->group(function () {
    Route::post('/user/pengunjung/register', 'register')->withoutMiddleware(VerifyCsrfToken::class);
});

// Chat Route
Route::controller(MessageController::class)->group(function () {
    Route::get('/chat', function () {
        return view('TestChat');
    });

    Route::post('/message', 'sendMessage');
});