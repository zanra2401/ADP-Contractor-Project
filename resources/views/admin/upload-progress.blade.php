@extends('layouts.app')

@section('content')
    <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom p-3 mb-4 shadow-sm">
        <div class="container-fluid">
            <h1 class="h3 mb-0">📤 Upload Progress</h1>
        </div>
    </nav>

    <div class="p-4">
        <div class="card shadow-sm">
            <div class="card-header fw-bold">Laporkan Kemajuan Proyek</div>
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
                        <label for="persentase" class="form-label">Persentase Selesai (%)</label>
                        <input type="number" class="form-control" id="persentase" name="percentage" min="0" max="100" placeholder="0 - 100" required>
                    </div>

                    <div class="mb-3">
                        <label for="catatan" class="form-label">Catatan Progress</label>
                        <textarea class="form-control" id="catatan" name="notes" rows="3" placeholder="Jelaskan apa saja yang sudah dikerjakan..." required></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary">Kirim Laporan</button>
                </form>

            </div>
        </div>
    </div>
@endsection