<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ProgressService;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class ProgressController extends Controller
{
    protected ProgressService $service;

    public function __construct(ProgressService $service)
    {
        $this->service = $service;

        // Ensure user is authenticated for all endpoints in this controller (adjust middleware if you use Sanctum/session)
        $this->middleware('auth:sanctum')->except([]); // or 'auth' for session-based
    }

    // Create new progress (admin only).
    // POST /api/progress
    public function store(Request $request)
    {
        // check role admin
        if (!$this->isAdmin()) {
            return response()->json(['message' => 'Forbidden: only admin can create progress'], 403);
        }

        // validate request
        $rules = [
            'project_id' => 'required|string|exists:projects,id',
            'deskripsi'  => 'nullable|string',
            'file'       => 'nullable|file|mimes:jpg,jpeg,png,mp4,avi,pdf|max:20480', // adjust as needed
            'status_publikasi' => 'nullable|in:menunggu,disetujui,ditolak',
            'tanggal_upload' => 'nullable|date',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['message' => 'Validation failed', 'errors' => $validator->errors()], 422);
        }

        $data = $validator->validated();

        // handle file upload
        if ($request->hasFile('file')) {
            $path = $this->service->storeUploadedFile($request->file('file'));
            $data['file_path'] = $path;
        }

        // set default tanggal_upload if not provided
        if (empty($data['tanggal_upload'])) {
            $data['tanggal_upload'] = now();
        }

        $progress = $this->service->create($data);

        return response()->json([
            'message' => 'Progress created',
            'data' => $progress
        ], 201);
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
    public function show(int $id)
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
    public function update(Request $request, int $id)
    {
        if (!$this->isAdmin()) {
            return response()->json(['message' => 'Forbidden: only admin can update progress'], 403);
        }

        $rules = [
            'deskripsi'  => 'nullable|string',
            'file'       => 'nullable|file|mimes:jpg,jpeg,png,mp4,avi,pdf|max:20480',
            'status_publikasi' => 'nullable|in:menunggu,disetujui,ditolak',
            'tanggal_upload' => 'nullable|date',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['message' => 'Validation failed', 'errors' => $validator->errors()], 422);
        }

        $data = $validator->validated();

        if ($request->hasFile('file')) {
            $path = $this->service->storeUploadedFile($request->file('file'));
            $data['file_path'] = $path;
        }

        $updated = $this->service->update($id, $data);

        return response()->json([
            'message' => 'Progress updated',
            'data' => $updated
        ]);
    }

    // Delete progress (admin only).
    // DELETE /api/progress/{id}
    public function destroy(int $id)
    {
        if (!$this->isAdmin()) {
            return response()->json(['message' => 'Forbidden: only admin can delete progress'], 403);
        }

        $this->service->delete($id);

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
