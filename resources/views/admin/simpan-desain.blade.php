@extends('layouts.app')

@section('title', 'Simpan Desain')

@section('content')
    <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom p-3 mb-4 shadow-sm">
        <div class="container-fluid">
            <h1 class="h3 mb-0">🎨 Simpan Desain</h1>
        </div>
    </nav>

    <div class="p-4">
        
        <p class="lead mb-4">Unggah file desain untuk proyek yang sedang berjalan.</p>

        <div class="card shadow-sm">
            <div class="card-header fw-bold bg-white py-3">
                Upload Desain Baru
            </div>
            <div class="card-body">
                
                <form action="#" method="POST" enctype="multipart/form-data">
                    @csrf 

                    <div class="row">
                        <div class="col-12 col-md-6 mb-3">
                            <label for="pilihProyek" class="form-label">Pilih Proyek</label>
                            <select class="form-select" id="pilihProyek" name="project_id" required>
                                <option selected disabled>-- Pilih Proyek --</option>
                                <option value="1">Redesign Website Klien A</option>
                                <option value="2">Aplikasi Mobile Bank B</option>
                            </select>
                        </div>

                        <div class="col-12 col-md-6 mb-3">
                            <label for="formFileMultiple" class="form-label">Upload File Desain</label>
                            <input class="form-control" type="file" id="formFileMultiple" name="files[]" multiple required>
                            <div class="form-text">
                                Format: JPG, PNG, PDF, ZIP (Bisa pilih lebih dari satu).
                            </div>
                        </div>
                    </div>

                    <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-3">
                        <button type="reset" class="btn btn-secondary me-md-2">Reset</button>
                        <button type="submit" class="btn btn-primary">Simpan Desain</button>
                    </div>

                </form>

            </div>
        </div>

        <div class="card shadow-sm mt-4">
            <div class="card-header fw-bold bg-white py-3">
                Riwayat Upload Terakhir
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0 text-nowrap">
                        <thead class="table-light">
                            <tr>
                                <th class="ps-4">Proyek</th>
                                <th>Nama File</th>
                                <th>Tanggal Upload</th>
                                <th class="text-end pe-4">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="ps-4">Redesign Website Klien A</td>
                                <td>Mockup_Home_v1.jpg</td>
                                <td>10 Des 2024</td>
                                <td class="text-end pe-4">
                                    <button class="btn btn-sm btn-outline-primary">Download</button>
                                </td>
                            </tr>
                            <tr>
                                <td class="ps-4">Aplikasi Mobile Bank B</td>
                                <td>UI_Kit_Mobile.zip</td>
                                <td>09 Des 2024</td>
                                <td class="text-end pe-4">
                                    <button class="btn btn-sm btn-outline-primary">Download</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
@endsection