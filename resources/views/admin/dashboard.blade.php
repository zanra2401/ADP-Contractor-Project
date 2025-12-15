@extends('layouts.app')

@section('content')
<nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom p-3 mb-4 shadow-sm">
    <div class="container-fluid">
        <h1 class="h3 mb-0">🏠 Dashboard</h1>
    </div>
</nav>

<div class="p-4">
    <p class="lead">Selamat datang kembali, Admin!</p>

    <div class="row">
        {{-- TOTAL USER --}}
        <div class="col-md-6">
            <div class="card text-bg-primary mb-3 shadow-sm">
                <div class="card-header">Total User</div>
                <div class="card-body">
                    <h5 class="card-title fs-2">
                        {{ $totalUser }}
                    </h5>
                    <p class="card-text">
                        Pengguna terdaftar
                    </p>
                </div>
            </div>
        </div>

        {{-- TOTAL PROYEK BERJALAN --}}
        <div class="col-md-6">
            <div class="card text-bg-success mb-3 shadow-sm">
                <div class="card-header">Proyek Berjalan</div>
                <div class="card-body">
                    <h5 class="card-title fs-2">
                        {{ $totalProyekBerjalan }}
                    </h5>
                    <p class="card-text">
                        Proyek aktif saat ini
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
