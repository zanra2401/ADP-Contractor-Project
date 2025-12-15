<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;
use App\Models\Project;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\RedirectResponse;

class ProjectController extends Controller
{
    public function createProject(Request $request): RedirectResponse
    {
        $request->validate([
            'nama_proyek' => 'required|string|max:255',
            'alamat' => 'required|string',
            'design_id' => 'nullable|exists:designs,id',
        ]);

        Project::create([
            'pengunjung_id' => Auth::id(),
            'design_id' => $request->input('design_id') ?? null,
            'nama_proyek' => $request->input('nama_proyek'),
            'deskripsi' => $request->input('deskripsi'),
            'alamat' => $request->input('alamat'),
            'status' => 'pending',
        ]);

        return redirect()->route('pelanggan.dashboard')->with('success', 'Proyek berhasil dibuat!');
    }
}