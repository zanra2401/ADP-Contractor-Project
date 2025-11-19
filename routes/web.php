<?php

use App\Http\Controllers\UserController;
use App\Http\Middleware\EnsurePasswordSecure;
use App\Http\Middleware\EnsureTelpNumValid;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Support\Facades\Route;



// RUTE PENGGUNA
Route::controller(UserController::class)->group(function () {
    
    Route::post('/user/pengunjung/register', 'createPengunjung')->withoutMiddleware(VerifyCsrfToken::class)->middleware([EnsurePasswordSecure::class, EnsureTelpNumValid::class]);

});