<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Project;

class DashboardController extends Controller
{
    public function index()
    {
        $totalUser = User::count();

        $totalProyekBerjalan = Project::where('status', 'proses')->count();

        return view('admin.dashboard', compact(
            'totalUser',
            'totalProyekBerjalan'
        ));
    }
}
