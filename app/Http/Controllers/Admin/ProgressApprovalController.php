<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProgressLog;
use Illuminate\Http\Request;

class ProgressApprovalController extends Controller
{
    // Ambil progress yang masih menunggu
    public function pending()
    {
        $progress = ProgressLog::where('status_publikasi', 'menunggu')->get();

        return response()->json([
            'message' => 'Daftar progress yang menunggu persetujuan',
            'data' => $progress
        ]);
    }

    // Admin menyetujui progress
    public function approve($id)
    {
        $progress = ProgressLog::find($id);

        if (!$progress) {
            return response()->json(['message' => 'Progress tidak ditemukan'], 404);
        }

        $progress->update([
            'status_publikasi' => 'disetujui'
        ]);

        return response()->json([
            'message' => 'Progress berhasil disetujui',
            'data' => $progress
        ]);
    }

    // Admin menolak progress
    public function reject($id)
    {
        $progress = ProgressLog::find($id);

        if (!$progress) {
            return response()->json(['message' => 'Progress tidak ditemukan'], 404);
        }

        $progress->update([
            'status_publikasi' => 'ditolak'
        ]);

        return response()->json([
            'message' => 'Progress berhasil ditolak',
            'data' => $progress
        ]);
    }
}
