@extends('layouts.app')

@section('content')
    <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom p-3 mb-4 shadow-sm">
        <div class="container-fluid">
            <h1 class="h3 mb-0">🎨 Simpan Desain</h1>
        </div>
    </nav>

    <div class="p-4">
        <div class="card shadow-sm">
            <div class="card-header fw-bold">Upload Desain Baru</div>
            <div class="card-body">
                
                <form action="#" method="POST" enctype="multipart/form-data">
                    @csrf <div class="mb-3">
                        <label for="pilihProyek" class="form-label">Pilih Proyek</label>
                        <select class="form-select" id="pilihProyek" name="project_id">
                            <option selected disabled>-- Pilih Proyek --</option>
                            <option value="1">Redesign Website Klien A</option>
                            <option value="2">Aplikasi Mobile Bank B</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="formFileMultiple" class="form-label">Upload File Desain (Bisa lebih dari satu)</label>
                        <input class="form-control" type="file" id="formFileMultiple" name="files[]" multiple>
                        <div class="form-text">Format yang diterima: JPG, PNG, PDF, ZIP.</div>
                    </div>

                    <button type="submit" class="btn btn-primary">Simpan Desain</button>
                </form>

            </div>
        </div>
    </div>
@endsection