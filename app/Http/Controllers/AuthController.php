<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    // Dummy function biar gak error
    public function login() {
        return "Ini proses Login (Logic belum ada)";
    }

    public function logout() {
        return redirect('/');
    }
}