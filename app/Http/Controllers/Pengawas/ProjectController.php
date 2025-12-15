<?php

namespace App\Http\Controllers\Pengawas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProjectController extends Controller
{
    // public function __construct()
    // {
    //     // Use the application's custom AuthMiddleware (same used in routes)
    //     $this->middleware(\App\Http\Middleware\AuthMiddleware::class);
    // }

    public function show($id)
    {
        $project = Project::with(['design', 'pengunjung', 'payment.progresses', 'pengawas'])->findOrFail($id);

        // compute paid summary similar to pelanggan controller
        $sudahDibayar = $project->payment?->progresses->sum('jumlah');
        $project['progress'] = $sudahDibayar ? ($project->harga ? ($sudahDibayar / $project->harga * 100) : 0) : 0;
        $project['sudah_dibayar'] = $sudahDibayar ?? 0;

        return view('pengawas.detail-proyek', compact('project'));
    }

    public function update(Request $request, $id)
    {
        $project = Project::findOrFail($id);

        $data = $request->validate([
            'nama_proyek' => 'nullable|string|max:150',
            'deskripsi' => 'nullable|string',
            'harga' => 'nullable|numeric',
            'status' => 'nullable|in:disetujui,pending,proses,selesai',
            'alamat' => 'nullable|string',
            'file_path' => 'nullable|file|max:10240',
        ]);

        // Handle file upload if present
        if ($request->hasFile('file_path')) {
            $file = $request->file('file_path');
            $path = $file->store('projects', 'public');
            $data['file_path'] = $path;
        }

        $project->update($data);

        return redirect()->route('pengawas.detail-proyek', ['id' => $project->id])->with('success', 'Data proyek berhasil diperbarui.');
    }
}
