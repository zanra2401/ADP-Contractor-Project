<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ProgressService;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\ProgressLog;

class ProgressController extends Controller
{
    protected ProgressService $service;

    public function __construct(ProgressService $service)
    {
        $this->service = $service;
    }

    //SHOW PROGRESS LIST PAGE (ADMIN ONLY)
    public function index()
    {
        if (!$this->isAdmin()) {
            abort(403);
        }

        $progress = $this->service->getProgressPengunjung();

        return view('admin.progress-index', compact('progress'));
    }


    public function store(Request $request)
    {
        if (!$this->isAdmin()) {
            abort(403, 'Forbidden');
        }

        $data = $request->validate([
            'project_id' => 'required|string|exists:projects,id',
            'deskripsi'  => 'nullable|string',
            'file'       => 'nullable|file|mimes:jpg,jpeg,png,mp4,avi,pdf|max:20480',
            'status_publikasi' => 'nullable|in:menunggu,disetujui,ditolak',
        ]);

        if ($request->hasFile('file')) {
            $data['file_path'] = $this->service->storeUploadedFile($request->file('file'));
        }

        $this->service->create($data);

        return redirect()
            ->route('admin.upload-progress')
            ->with('success', 'Progress berhasil ditambahkan');
    }


    // List progress by project (admin only).
    // GET /api/progress/project/{projectId}
    public function listByProject(string $projectId)
    {
        if (!$this->isAdmin()) {
            return response()->json(['message' => 'Forbidden: only admin can list progress'], 403);
        }

        $items = $this->service->getByProject($projectId);

        return response()->json([
            'message' => 'Progress list',
            'data' => $items
        ]);
    }

    // Get single progress item (admin only).
    // GET /api/progress/{id}
    public function show(string $id)
    {
        if (!$this->isAdmin()) {
            return response()->json(['message' => 'Forbidden: only admin can view progress'], 403);
        }

        $item = $this->service->getById($id);

        return response()->json([
            'message' => 'Progress detail',
            'data' => $item
        ]);
    }

    // Update progress (admin only).
    // PUT /api/progress/{id}
    public function update(Request $request, string $id)
    {
        if (!$this->isAdmin()) {
            if ($request->expectsJson()) {
                return response()->json(['message' => 'Forbidden: only admin can update progress'], 403);
            }
            abort(403);
        }

        $rules = [
            'deskripsi'  => 'nullable|string',
            'file'       => 'nullable|file|mimes:jpg,jpeg,png,mp4,avi,pdf|max:20480',
            'status_publikasi' => 'nullable|in:menunggu,disetujui,ditolak',
            'tanggal_upload' => 'nullable|date',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            if ($request->expectsJson()) {
                return response()->json(['message' => 'Validation failed', 'errors' => $validator->errors()], 422);
            }
            return back()->withErrors($validator)->withInput();
        }

        $data = $validator->validated();

        if ($request->hasFile('file')) {
            $path = $this->service->storeUploadedFile($request->file('file'));
            $data['file_path'] = $path;
        }

        $this->service->update($id, $data);

        if (!$request->expectsJson()) {
            return redirect()->back()->with('success', 'Progress berhasil diperbarui');
        }

        return response()->json([
            'message' => 'Progress updated'
        ]);
    }


    // Delete progress (admin only).
    // DELETE /api/progress/{id}
    public function destroy(Request $request, string $id)
    {
        if (!$this->isAdmin()) {
            if ($request->expectsJson()) {
                return response()->json(['message' => 'Forbidden: only admin can delete progress'], 403);
            }
            abort(403);
        }

        $this->service->delete($id);

        if (!$request->expectsJson()) {
            return redirect()->back()->with('success', 'Progress berhasil dihapus');
        }

        return response()->json([
            'message' => 'Progress deleted'
        ]);
    }


    // Helper: check if authenticated user is admin.
    protected function isAdmin(): bool
    {
        $user = Auth::user();
        if (!$user) return false;
        if (!method_exists($user, 'role')) {
            return false;
        }
        $role = $user->role;
        if (!$role) return false;
        return strtolower($role->nama_role) === 'admin';
    }
}
