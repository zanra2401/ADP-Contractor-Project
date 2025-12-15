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
        $proyek = Project::where('pengawas_id', Auth::id())->get();
        foreach ($proyek as $p) {
            // Jika tidak ada design atau content, gunakan blueprint placeholder
            // dd($p->design?->contents->first()?->file_path);
            $p['content_path'] = $p->design?->contents->first()?->file_path ?? 'blueprint-placeholder';
            $p['progress'] = $p->payment ? $p->harga / $p->payment?->progresses->sum('jumlah') * 100 : 0;
        }
        
        

        return view('pengawas.dashboard', compact(
            'totalProjects',
            'totalPayments',
            'totalProgressLogs',
            'proyek'
        ));
    }
}
