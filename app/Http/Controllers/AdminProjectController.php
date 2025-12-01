<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Services\ProjectService;
use Illuminate\Http\Request;

class AdminProjectController extends Controller
{
    protected $service;

    public function __construct(ProjectService $service)
    {
        $this->service = $service;

        // Hanya admin yang boleh
        $this->middleware('auth:sanctum');
    }

    // === LIST ALL PROJECTS ===
    public function index()
    {
        $this->authorizeAdmin();

        return response()->json([
            'status' => 'success',
            'data' => $this->service->list()
        ]);
    }

    // === CREATE PROJECT ===
    public function store(Request $request)
    {
        $this->authorizeAdmin();

        $validated = $request->validate([
            'pengawas_id'     => 'required|string',
            'pengunjung_id'   => 'required|string',
            'design_id'       => 'required|string',
            'nama_proyek'     => 'required|string',
            'deskripsi'       => 'required|string',
            'harga'           => 'required|numeric',
            'alamat'          => 'required|string',
            'tanggal_mulai'   => 'required|date',
            'tanggal_selesai' => 'required|date',
            'materials'       => 'array',
        ]);

        $project = $this->service->create($validated);

        return response()->json([
            'status' => 'created',
            'data'   => $project
        ], 201);
    }

    // === UPDATE ===
    public function update(Request $request, Project $project)
    {
        $this->authorizeAdmin();

        $validated = $request->validate([
            'pengawas_id'     => 'required|string',
            'pengunjung_id'   => 'required|string',
            'design_id'       => 'required|string',
            'nama_proyek'     => 'required|string',
            'deskripsi'       => 'required|string',
            'harga'           => 'required|numeric',
            'alamat'          => 'required|string',
            'tanggal_mulai'   => 'required|date',
            'tanggal_selesai' => 'required|date',
            'materials'       => 'array',
        ]);

        $project = $this->service->update($project, $validated);

        return response()->json([
            'status' => 'updated',
            'data'   => $project
        ]);
    }

    // === DELETE ===
    public function destroy(Project $project)
    {
        $this->authorizeAdmin();

        $this->service->delete($project);

        return response()->json([
            'status' => 'deleted'
        ]);
    }

    private function authorizeAdmin()
    {
        if (auth()->user()->role_id !== 1) {
            abort(403, "Only admins can access this endpoint.");
        }
    }
}
