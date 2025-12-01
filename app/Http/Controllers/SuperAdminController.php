<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\SuperAdminService;

class SuperAdminController extends Controller
{
    protected $service;

    public function __construct(SuperAdminService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        $users = $this->service->getAllUsers();
        return response()->json($users);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'role_id'       => 'required|string|exists:roles,id',
            'nama'          => 'required|string|max:100',
            'nomor_telepon' => 'required|string|max:12|unique:users,nomor_telepon',
            'password'      => 'required|string|min:6',
        ]);

        $user = $this->service->createUser($validated);
        return response()->json($user, 201);
    }

    public function show($id)
    {
        try {
            $user = $this->service->getUserById($id);
            return response()->json($user);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 404);
        }
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'role_id'       => 'sometimes|string|exists:roles,id',
            'nama'          => 'sometimes|string|max:100',
            'nomor_telepon' => 'sometimes|string|max:12|unique:users,nomor_telepon,' . $id . ',id',
            'password'      => 'sometimes|string|min:6',
        ]);

        try {
            $user = $this->service->updateUser($id, $validated);
            return response()->json($user);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 404);
        }
    }

    public function destroy($id)
    {
        try {
            $this->service->deleteUser($id);
            return response()->json(['message' => 'User berhasil dihapus']);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 404);
        }
    }
}
