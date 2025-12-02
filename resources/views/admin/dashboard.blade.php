@extends('layouts.app')

@section('content')
    <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom p-3 mb-4 shadow-sm">
        <div class="container-fluid">
            <h1 class="h3 mb-0">🏠 Dashboard</h1>
            
            <div class="ms-auto d-flex align-items-center">
                <div class="dropdown">
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="#">Notifikasi 1: Proyek A selesai.</a></li>
                        <li><a class="dropdown-item" href="#">Notifikasi 2: User B mengirim pesan.</a></li>
                        <li><a class="dropdown-item" href="#">Notifikasi 3: Pembayaran diterima.</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <div class="p-4">
        <p class="lead">Selamat datang kembali, Admin!</p>
        
        <div class="row">
            <div class="col-md-4">
                <div class="card text-bg-primary mb-3 shadow-sm">
                    <div class="card-header">Total User</div>
                    <div class="card-body">
                        <h5 class="card-title fs-2">1,250</h5>
                        <p class="card-text">Pengguna terdaftar</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-bg-success mb-3 shadow-sm">
                    <div class="card-header">Total Proyek</div>
                    <div class="card-body">
                        <h5 class="card-title fs-2">82</h5>
                        <p class="card-text">Proyek sedang berjalan</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-bg-warning mb-3 shadow-sm">
                    <div class="card-header">Pesan Baru</div>
                    <div class="card-body">
                        <h5 class="card-title fs-2">12</h5>
                        <p class="card-text">Pesan belum dibaca</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection