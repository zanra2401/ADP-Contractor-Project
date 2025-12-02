<?php

namespace App\Http\Controllers\Pelanggan;

use App\Http\Controllers\Controller;
use App\Models\Design;

class GaleriController extends Controller
{
    public function index()
    {
        $designs = Design::with(['categories', 'contents'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('pelanggan.galeri', compact('designs'));
    }
    public function detail($id)
    {
        $design = Design::with(['contents', 'categories', 'specs'])
            ->findOrFail($id);

        return view('pelanggan.detail-desain', compact('design'));
    }
}
