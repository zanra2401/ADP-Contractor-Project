<?php

namespace App\Http\Controllers;

use App\Models\Design;

class HomeController extends Controller
{
    public function index()
    {
        $designs = Design::with(['contents', 'categories'])
            ->latest()
            ->take(6)
            ->get();

        return view('welcome', compact('designs'));
    }
}
