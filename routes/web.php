<?php

use App\Http\Controllers\UserController;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Support\Facades\Route;



// RUTE PENGGUNA
Route::controller(UserController::class)->group(function () {
    
    Route::post('/user/pengunjung/register', 'createPengunjung')->withoutMiddleware(VerifyCsrfToken::class);

});