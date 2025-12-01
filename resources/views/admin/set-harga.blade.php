@extends('layouts.app')

@section('content')
    <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom p-3 mb-4 shadow-sm">
        <div class="container-fluid">
            <h1 class="h3 mb-0">💲 Set Harga Proyek</h1>
        </div>
    </nav>

    <div class="p-4">
        <div class="card shadow-sm">
            <div class="card-header fw-bold">Atur Harga Proyek</div>
            <div class="card-body">
                
                <form action="#" method="POST">
                    @csrf <div class="mb-3">
                        <label for="pilihProyek" class="form-label">Pilih Proyek</label>
                        <select class="form-select" id="pilihProyek" name="project_id" required>
                            <option selected disabled>-- Pilih Proyek --</option>
                            <option value="1">Redesign Website Klien A</option>
                            <option value="2">Aplikasi Mobile Bank B</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="harga" class="form-label">Total Harga (Rp)</label>
                        <div class="input-group">
                            <span class="input-group-text">Rp</span>
                            <input type="number" class="form-control" id="harga" name="price" placeholder="Contoh: 10000000" min="0" required>
                        </div>
                        <div class="form-text">Masukkan angka saja tanpa titik atau koma.</div>
                    </div>

                    <button type="submit" class="btn btn-primary">Simpan Harga</button>
                </form>

            </div>
        </div>
    </div>
@endsection