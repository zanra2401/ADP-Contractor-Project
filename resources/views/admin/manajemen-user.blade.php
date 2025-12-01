@extends('layouts.app')

@section('content')
    <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom p-3 mb-4 shadow-sm">
        <div class="container-fluid">
            <h1 class="h3 mb-0">👥 Manajemen User</h1>
        </div>
    </nav>

    <div class="p-4">
        <p class="lead">Kelola semua akun pengguna dan administrator.</p>
        
        <div class="card shadow-sm">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span class="fw-bold">Daftar Pengguna</span>
                <button class="btn btn-primary btn-sm">Tambah User Baru +</button>
            </div>
            <div class="card-body">
                <table class="table table-striped table-hover align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Budi Santoso</td>
                            <td>budi@example.com</td>
                            <td><span class="badge text-bg-primary">Admin</span></td>
                            <td><span class="badge text-bg-success">Aktif</span></td>
                            <td>
                                <button class="btn btn-sm btn-warning text-white">Edit</button>
                                <button class="btn btn-sm btn-danger">Hapus</button>
                            </td>
                        </tr>
                        
                        <tr>
                            <td>2</td>
                            <td>Citra Lestari</td>
                            <td>citra@example.com</td>
                            <td><span class="badge text-bg-secondary">User</span></td>
                            <td><span class="badge text-bg-success">Aktif</span></td>
                            <td>
                                <button class="btn btn-sm btn-warning text-white">Edit</button>
                                <button class="btn btn-sm btn-danger">Hapus</button>
                            </td>
                        </tr>

                        <tr>
                            <td>3</td>
                            <td>Doni Saputra</td>
                            <td>doni@example.com</td>
                            <td><span class="badge text-bg-secondary">User</span></td>
                            <td><span class="badge text-bg-danger">Banned</span></td>
                            <td>
                                <button class="btn btn-sm btn-warning text-white">Edit</button>
                                <button class="btn btn-sm btn-success">Unban</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection