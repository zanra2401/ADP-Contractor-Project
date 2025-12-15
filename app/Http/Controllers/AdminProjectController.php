<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Services\ProjectService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controller as BaseController;

class AdminProjectController extends BaseController
{
    protected $service;

    public function __construct(ProjectService $service)
    {
        $this->service = $service;

        // Hanya admin yang boleh
        $this->middleware('auth');
    }

    // === SHOW PROJECT DETAIL PAGE ===
    public function showPage($id)
    {
        $project = \App\Models\Project::with(['pengunjung', 'pengawas', 'design'])->findOrFail($id);

        // load payments related to this project
        $payments = \App\Models\Payment::where('project_id', $id)->with('progresses')->get();

        // load payment progress entries for this project's payments
        $paymentProgress = \App\Models\PaymentProgress::whereHas('payment', function ($q) use ($id) {
            $q->where('project_id', $id);
        })->with('payment')->get();

        $users = \App\Models\User::whereHas('role', fn($q) => $q->where('nama_role', 'pengunjung'))->get();
        $pengawas = \App\Models\User::whereHas('role', fn($q) => $q->where('nama_role', 'pengawas'))->get();
        $designs = \App\Models\Design::all();

        return view('admin.detail-proyek', compact(
            'project',
            'users',
            'pengawas',
            'designs',
            'payments',
            'paymentProgress'
        ));
    }

    // Update a payment (admin)
    public function updatePayment(Request $request, $id)
    {
        $this->authorizeAdmin();

        $payment = \App\Models\Payment::findOrFail($id);

        $validated = $request->validate([
            'total_harga' => 'required|numeric',
            'status' => 'required|string',
        ]);

        $payment->update($validated);

        return redirect()->back()->with('success', 'Payment updated successfully.');
    }

    // Delete a payment
    public function deletePayment($id)
    {
        $this->authorizeAdmin();

        $payment = \App\Models\Payment::findOrFail($id);
        $payment->delete();

        return redirect()->back()->with('success', 'Payment deleted successfully.');
    }

    // Update a payment progress entry
    public function updatePaymentProgress(Request $request, $id)
    {
        $this->authorizeAdmin();

        $pp = \App\Models\PaymentProgress::findOrFail($id);

        $validated = $request->validate([
            'jumlah' => 'required|numeric',
            'deskripsi' => 'nullable|string',
            'status' => 'nullable|in:pending,lunas'
        ]);

        $updateData = [
            'jumlah' => $validated['jumlah'],
            'deskripsi' => $validated['deskripsi'] ?? null,
            'status' => $validated['status'] ?? null,
        ];

        $pp->update($updateData);

        return redirect()->back()->with('success', 'Payment progress updated successfully.');
    }

    // Store a new payment progress entry
    public function storePaymentProgress(Request $request)
    {
        $this->authorizeAdmin();

        $validated = $request->validate([
            'payment_id' => 'required|string|exists:payments,id',
            'jumlah' => 'required|numeric',
            'deskripsi' => 'nullable|string',
            'status' => 'nullable|in:pending,lunas'
        ]);

        $data = [
            'payment_id' => $validated['payment_id'],
            'jumlah' => $validated['jumlah'],
            'deskripsi' => $validated['deskripsi'] ?? null,
            // DB requires 'metode' enum; set a safe default when creating (kept for backward compatibility)
            'metode' => 'cash',
            // default status to 'pending' when not provided to avoid NOT NULL DB error
            'status' => $validated['status'] ?? 'pending',
        ];

        \App\Models\PaymentProgress::create($data);

        return redirect()->back()->with('success', 'Payment progress created successfully.');
    }

    // Delete a payment progress entry
    public function deletePaymentProgress($id)
    {
        $this->authorizeAdmin();

        $pp = \App\Models\PaymentProgress::findOrFail($id);
        $pp->delete();

        return redirect()->back()->with('success', 'Payment progress deleted successfully.');
    }

    // === LIST ALL PROJECTS ===
    public function index()
    {
        $this->authorizeAdmin();

        $projects = \App\Models\Project::with('pengunjung')
            ->latest()
            ->get();

        return response()->json([
            'status' => 'success',
            'data' => $projects
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
        ]);

        $project = $this->service->create($validated);

        return response()->json([
            'status' => 'created',
            'data'   => $project
        ], 201);
    }

    // === UPDATE ===
    public function updatePage(Request $request, $id)
    {
        $project = Project::findOrFail($id);

        $validated = $request->validate([
            'nama_proyek' => 'required|string',
            'pengunjung_id' => 'required',
            'pengawas_id' => 'required',
            'design_id' => 'required',
            'deskripsi' => 'nullable|string',
            'harga' => 'required|numeric',
            'status' => 'required|string',
            'alamat' => 'nullable|string',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date'
        ]);

        // update data
        $project->update($validated);

        // kalau upload file baru
        if ($request->hasFile('file_path')) {
            $file = $request->file('file_path')->store('projects', 'public');
            $project->file_path = $file;
            $project->save();
        }

        return redirect()
            ->route('admin.proyek.detail', $id)
            ->with('success', 'Proyek berhasil diperbarui!');
    }

    // === DELETE ===
    public function deletePage($id)
    {
        $project = \App\Models\Project::findOrFail($id);
        $project->delete();

        return redirect()
            ->route('admin.manajemen-proyek')
            ->with('success', 'Proyek berhasil dihapus.');
    }
    private function authorizeAdmin()
    {
        if (!Auth::check()) {
            abort(403);
        }

        if (Auth::user()->role->nama_role !== 'admin') {
            abort(403, 'Only admins can access this endpoint.');
        }
    }
    
    // === GET USERS FOR DROPDOWN ===
    public function users(Request $request)
    {
        $this->authorizeAdmin();

        $role = $request->query('role');

        $users = \App\Models\User::with('role')
            ->whereHas('role', function ($q) use ($role) {
                $q->where('nama_role', $role);
            })
            ->get(['id', 'nama']);

        return response()->json([
            'status' => 'success',
            'data' => $users
        ]);
    }

    // === GET DESIGNS FOR DROPDOWN ===
    public function designs()
    {
        $this->authorizeAdmin();

        $designs = \App\Models\Design::select('id', 'nama', 'cover_image')->get();

        return response()->json([
            'status' => 'success',
            'data' => $designs
        ]);
    }
}
