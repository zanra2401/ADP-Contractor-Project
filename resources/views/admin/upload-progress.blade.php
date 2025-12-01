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
                
                <form action="#" method="POST" enctype="multipart/form-data">
                    @csrf 

                    <div class="mb-3">
                        <label for="pilihProyek" class="form-label">Pilih Proyek</label>
                        <select class="form-select" id="pilihProyek" name="project_id" required>
                            <option selected disabled>-- Pilih Proyek --</option>
                            <option value="1">pengerjaan plafond proyek A</option>
                            <option value="2">Pengerjaan lantai proyek B</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="deskripsi" class="form-label">Deskripsi</label>
                        <textarea class="form-control" id="deskripsi" name="description" rows="3" placeholder="Jelaskan detail dokumen atau progress yang diupload..." required></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="fileUpload" class="form-label">Upload File Bukti/Dokumen</label>
                        <input type="file" class="form-control" id="fileUpload" name="file_path" required>
                        <div class="form-text">Format: PDF, JPG, PNG, DOCX (Maks. 5MB)</div>
                    </div>

                    <div class="mb-3">
                        <label for="status" class="form-label">Status Laporan</label>
                        <select class="form-select" id="status" name="status" required>
                            <option selected disabled>-- Pilih Status --</option>
                            <option value="draft">Belum Dikerjakan</option>
                            <option value="in_review">Diproses</option>
                            <option value="approved">Perlu di review</option>
                            <option value="rejected">Finish</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">Simpan Progress</button>
                </form>

            </div>
        </div>
    </div>
@endsection