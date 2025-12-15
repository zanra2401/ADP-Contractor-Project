<?php

namespace App\Http\Controllers\Pengawas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Payment;
use App\Models\ProgressLog;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Show supervisor (pengawas) dashboard.
     *
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $totalProjects = Project::count();
        $totalPayments = Payment::count();
        $totalProgressLogs = ProgressLog::count();

        // Eager-load design and pengunjung (client) so the view can access cover_image and client name
        $proyek = Project::where('pengawas_id', Auth::id())->with(['design.contents', 'payment.progresses'])->get();
        foreach ($proyek as $p) {
            // Jika tidak ada design atau content, gunakan blueprint placeholder
            $p['content_path'] = $p->design?->contents->first()?->file_path ?? 'blueprint-placeholder';
            // Progress pembayaran hanya dari yang sudah dibayar (lunas)
            $paid = $p->payment ? $p->payment->progresses->where('status', 'lunas')->sum('jumlah') : 0;
            $p['progress'] = $p->harga && $p->harga > 0 ? ($paid / $p->harga) * 100 : 0;
        }
        
        

        return view('pengawas.dashboard', compact(
            'totalProjects',
            'totalPayments',
            'totalProgressLogs',
            'proyek'
        ));
    }
}
