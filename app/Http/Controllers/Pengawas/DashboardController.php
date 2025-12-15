<?php

namespace App\Http\Controllers\Pengawas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Payment;
use App\Models\ProgressLog;

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
        $recentProjects = Project::with(['design', 'pengunjung'])
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        return view('pengawas.dashboard', compact(
            'totalProjects',
            'totalPayments',
            'totalProgressLogs',
            'recentProjects'
        ));
    }
}
