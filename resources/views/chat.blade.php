@extends('layouts.app')

@section('content')
    <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom p-3 mb-4 shadow-sm">
        <div class="container-fluid">
            <h1 class="h3 mb-0">💬 Chat Admin</h1>
        </div>
    </nav>

    <div class="p-4">
        <p class="lead">Balas pesan dari pengguna.</p>
        
        <div class="row">
            <div class="col-md-4">
                <div class="card shadow-sm mb-3">
                    <div class="card-header fw-bold">Daftar Pesan</div>
                    <ul class="list-group list-group-flush">
                        <a href="#" class="list-group-item list-group-item-action active" aria-current="true">
                            <div class="d-flex w-100 justify-content-between">
                                <strong class="mb-1">Citra Lestari</strong>
                                <small>Baru saja</small>
                            </div>
                            <small class="mb-1">OK, terima kasih infonya...</small>
                        </a>

                        <a href="#" class="list-group-item list-group-item-action">
                            <div class="d-flex w-100 justify-content-between">
                                <strong class="mb-1">Budi Santoso</strong>
                                <small>5 min</small>
                            </div>
                            <small class="text-muted">Halo admin, saya mau tanya...</small>
                        </a>

                        <a href="#" class="list-group-item list-group-item-action">
                            <div class="d-flex w-100 justify-content-between">
                                <strong class="mb-1">Doni Saputra</strong>
                                <small>1 jam</small>
                            </div>
                            <small class="text-muted">Pesanan saya...</small>
                        </a>
                    </ul>
                </div>
            </div>

            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-header bg-white">
                        <strong>Chat dengan Citra Lestari</strong>
                    </div>
                    
                    <div class="card-body" style="height: 500px; overflow-y: auto; background-color: #f0f2f5;">
                        
                        <div class="d-flex justify-content-start mb-3">
                            <div class="p-3 bg-white rounded shadow-sm border" style="max-width: 70%;">
                                <strong class="d-block text-secondary small mb-1">Citra</strong>
                                Halo admin, pesanan saya #123 kok belum sampai ya?
                                <div class="text-end mt-1"><small class="text-muted" style="font-size: 0.7em;">10:00</small></div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end mb-3">
                            <div class="p-3 bg-primary text-white rounded shadow-sm" style="max-width: 70%;">
                                <strong class="d-block text-white-50 small mb-1">Admin</strong>
                                Halo kak Citra, sedang kami cek.
                                <div class="text-end mt-1"><small class="text-white-50" style="font-size: 0.7em;">10:05</small></div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-start mb-3">
                            <div class="p-3 bg-white rounded shadow-sm border" style="max-width: 70%;">
                                <strong class="d-block text-secondary small mb-1">Citra</strong>
                                OK, terima kasih infonya.
                                <div class="text-end mt-1"><small class="text-muted" style="font-size: 0.7em;">10:06</small></div>
                            </div>
                        </div>

                    </div>

                    <div class="card-footer bg-white">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Ketik balasan...">
                            <button class="btn btn-primary" type="button">Kirim ➤</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection