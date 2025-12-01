@extends('layouts.app')

@section('content')
    <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom p-3 mb-4 shadow-sm">
        <div class="container-fluid">
            <h1 class="h3 mb-0">👍 Approve Progress</h1>
        </div>
    </nav>

    <div class="p-4">
        <div class="card shadow-sm">
            <div class="card-header fw-bold">Tinjau Laporan Kemajuan Proyek</div>
            <div class="card-body">
                <table class="table table-hover align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>Proyek</th>
                            <th>Laporan dari</th>
                            <th style="width: 30%;">Catatan</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Redesign Website Klien A</td>
                            <td>Tim Desain</td>
                            <td>Sudah selesai 75%, tinggal revisi bagian footer sesuai request klien.</td>
                            <td><span class="badge text-bg-warning text-dark">Pending Review</span></td>
                            <td>
                                <div class="btn-group" role="group">
                                    <button class="btn btn-sm btn-success">Approve</button>
                                    <button class="btn btn-sm btn-danger">Tolak</button>
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <td>Aplikasi Mobile Bank B</td>
                            <td>Tim Backend</td>
                            <td>API untuk login dan register sudah siap dideploy.</td>
                            <td><span class="badge text-bg-success">Approved</span></td>
                            <td>
                                <button class="btn btn-sm btn-secondary" disabled>Approve</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection