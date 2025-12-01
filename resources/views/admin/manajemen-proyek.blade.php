@extends('layouts.app')

@section('content')
    <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom p-3 mb-4 shadow-sm">
        <div class="container-fluid">
            <h1 class="h3 mb-0">🗂️ Manajemen Proyek</h1>
        </div>
    </nav>

    <div class="p-4">
        <p class="lead">Kelola semua proyek yang sedang berjalan atau sudah selesai.</p>
        
        <div class="card shadow-sm">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span class="fw-bold">Daftar Proyek</span>
                <button class="btn btn-primary btn-sm">Buat Proyek Baru +</button>
            </div>
            <div class="card-body">
                <table class="table table-striped table-hover align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>Nama Proyek</th>
                            <th>Klien</th>
                            <th style="width: 30%;">Progress</th> <th>Status</th>
                            <th>Detail</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Redesign Website Klien A</td>
                            <td>PT. Maju Jaya</td>
                            <td>
                                <div class="progress" role="progressbar" aria-label="Example with label" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100">
                                    <div class="progress-bar" style="width: 75%">75%</div>
                                </div>
                            </td>
                            <td><span class="badge text-bg-info text-white">In Progress</span></td>
                            <td>
                                <a href="{{ route('admin.proyek.detail') }}" class="btn btn-sm btn-warning text-white">
                                    <i class="bi bi-eye"></i> Lihat Detail
                                </a>
                            </td>

                        </tr>
                        
                        <tr>
                            <td>Aplikasi Mobile Bank B</td>
                            <td>Bank B</td>
                            <td>
                                <div class="progress" role="progressbar" aria-label="Success example" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">
                                    <div class="progress-bar bg-success" style="width: 100%">100%</div>
                                </div>
                            </td>
                            <td><span class="badge text-bg-success">Completed</span></td>
                            <td>
                                <a href="{{ route('admin.proyek.detail') }}" class="btn btn-sm btn-warning text-white">
                                    <i class="bi bi-eye"></i> Lihat Detail
                                </a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection