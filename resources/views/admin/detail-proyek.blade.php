@extends('layouts.app')

@section('content')
    <!-- Navbar Atas -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom p-3 mb-4 shadow-sm">
        <div class="container-fluid">
            <div class="d-flex align-items-center">
                <!-- Tombol Kembali -->
                <a href="{{ route('admin.manajemen-proyek') }}" class="btn btn-outline-secondary me-3">
                    &larr; Kembali
                </a>
                <h1 class="h3 mb-0">📄 Detail Proyek</h1>
            </div>
        </div>
    </nav>

    <div class="p-4">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Redesign Website Klien A</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <!-- KOLOM KIRI: Informasi Utama -->
                    <div class="col-md-6">
                        <h6 class="text-uppercase text-muted mb-3 fw-bold">Informasi Dasar</h6>
                        
                        <div class="mb-3">
                            <label class="fw-bold d-block">Nama Klien</label>
                            <span>PT. Maju Jaya</span>
                        </div>

                        <div class="mb-3">
                            <label class="fw-bold d-block">Nama Pengawas</label>
                            <span>Budi Santoso (Site Manager)</span>
                        </div>

                        <div class="mb-3">
                            <label class="fw-bold d-block">Jenis Desain</label>
                            <span class="badge bg-info text-dark">Minimalis Modern</span>
                        </div>

                        <div class="mb-3">
                            <label class="fw-bold d-block">Alamat Proyek</label>
                            <span>Jl. Jendral Sudirman No. 45, Jakarta Selatan</span>
                        </div>
                    </div>

                    <!-- KOLOM KANAN: Teknis & Harga -->
                    <div class="col-md-6">
                        <h6 class="text-uppercase text-muted mb-3 fw-bold">Detail Teknis</h6>

                        <div class="mb-3">
                            <label class="fw-bold d-block">Deskripsi Singkat</label>
                            <p class="text-muted">
                                Renovasi total tampilan depan ruko menjadi gaya modern, termasuk penggantian fasad kaca dan pengecatan ulang interior lantai 1.
                            </p>
                        </div>

                        <div class="row">
                            <div class="col-6 mb-3">
                                <label class="fw-bold d-block">Tanggal Mulai</label>
                                <span>01 Januari 2024</span>
                            </div>
                            <div class="col-6 mb-3">
                                <label class="fw-bold d-block">Estimasi Selesai</label>
                                <span>30 Maret 2024</span>
                            </div>
                        </div>

                        <div class="p-3 bg-light rounded border">
                            <label class="fw-bold d-block text-success">Total Harga Proyek</label>
                            <h3 class="fw-bold text-success mb-0">Rp 150.000.000</h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer text-end">
                <button class="btn btn-warning text-white">Edit Data</button>
                <button class="btn btn-primary">Download Kontrak PDF</button>
            </div>
        </div>
    </div>
@endsection