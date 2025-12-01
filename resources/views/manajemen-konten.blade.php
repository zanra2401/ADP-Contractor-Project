@extends('layouts.app')

@section('content')
    <!-- Navbar Atas (Opsional, jika ingin konsisten dengan Dashboard) -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom p-3 mb-4 shadow-sm">
        <div class="container-fluid">
            <h1 class="h3 mb-0">📝 Manajemen Konten</h1>
        </div>
    </nav>

    <!-- Konten Utama -->
    <div class="p-4">
        <p class="lead">Kelola semua artikel, berita, atau postingan di sini.</p>

        <div class="card shadow-sm">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span class="fw-bold">Daftar Artikel</span>
                <button class="btn btn-primary btn-sm">Tambah Baru +</button>
            </div>
            <div class="card-body">
                <table class="table table-striped table-hover align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>Judul</th>
                            <th>Kategori</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Baris 1 -->
                        <tr>
                            <td>1</td>
                            <td>Cara Menggunakan Bootstrap 5</td>
                            <td>Tutorial</td>
                            <td><span class="badge text-bg-success">Published</span></td>
                            <td>
                                <button class="btn btn-sm btn-warning text-white">Edit</button>
                                <button class="btn btn-sm btn-danger">Hapus</button>
                            </td>
                        </tr>
                        <!-- Baris 2 -->
                        <tr>
                            <td>2</td>
                            <td>Update Sistem Terbaru</td>
                            <td>Berita</td>
                            <td><span class="badge text-bg-secondary">Draft</span></td>
                            <td>
                                <button class="btn btn-sm btn-warning text-white">Edit</button>
                                <button class="btn btn-sm btn-danger">Hapus</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection