<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Design;
use App\Http\Requests\Admin\DesignStoreRequest;
use App\Http\Requests\Admin\DesignUpdateRequest;

class DesignController extends Controller
{
    public function index()
    {
        return response()->json(Design::all());
    }

    public function store(DesignStoreRequest $request)
    {
        $design = Design::create($request->validated());

        return response()->json([
            'message' => 'Design created successfully',
            'data' => $design
        ], 201);
    }

    public function show($id)
    {
        $design = Design::find($id);

        if (!$design) {
            return response()->json(['message' => 'Design not found'], 404);
        }

        return response()->json($design);
    }

    public function update(DesignUpdateRequest $request, $id)
    {
        $design = Design::find($id);

        if (!$design) {
            return response()->json(['message' => 'Design not found'], 404);
        }

        $design->update($request->validated());

        return response()->json([
            'message' => 'Design updated successfully',
            'data' => $design
        ]);
    }

    public function destroy($id)
    {
        $design = Design::find($id);

        if (!$design) {
            return response()->json(['message' => 'Design not found'], 404);
        }

        $design->delete();

        return response()->json(['message' => 'Design deleted successfully']);
    }
}
