@extends('layouts.app')

@section('title', 'Upload Progress')

@section('content')
    <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom p-3 mb-4 shadow-sm">
        <div class="container-fluid">
            <h1 class="h3 mb-0">📤 Upload Progress</h1>
            </div>
    </nav>

    <div class="p-4">
        <div class="card shadow-sm">
            <div class="card-header fw-bold bg-white py-3">
                Laporkan Kemajuan Proyek
            </div>
            <div class="card-body">
                
                <form action="#" method="POST" enctype="multipart/form-data">
                    @csrf 

                    <div class="row">
                        <div class="col-12 col-md-6 mb-3">
                            <label for="pilihProyek" class="form-label">Pilih Proyek</label>
                            <select class="form-select" id="pilihProyek" name="project_id" required>
                                <option selected disabled>-- Pilih Proyek --</option>
                                <option value="1">Pengerjaan Plafond Proyek A</option>
                                <option value="2">Pengerjaan Lantai Proyek B</option>
                            </select>
                        </div>

                        <div class="col-12 col-md-6 mb-3">
                            <label for="status" class="form-label">Status Laporan</label>
                            <select class="form-select" id="status" name="status" required>
                                <option selected disabled>-- Pilih Status --</option>
                                <option value="draft">Belum Dikerjakan</option>
                                <option value="in_progress">Diproses (On Progress)</option>
                                <option value="pending_review">Perlu di-review</option>
                                <option value="completed">Selesai (Finish)</option>
                            </select>
                        </div>
                    </div>

                    <div class="mb-3">

                        <label for="deskripsi" class="form-label">Deskripsi</label>
                        <textarea class="form-control" id="deskripsi" name="description" rows="4" placeholder="Jelaskan detail dokumen atau progress yang diupload..." required></textarea>
                    </div>

                    <!-- 4. STATUS -->
                    <div class="mb-3">
                        <label for="status" class="form-label">Status Progres</label>
                        <select class="form-select" id="status" name="status" required>
                            <option selected disabled>-- Pilih Status --</option>
                            <option value="On Progress">On Progress</option>
                            <option value="Pending Review">Pending Review</option>
                            <option value="Revisi">Revisi</option>
                            <option value="Completed">Completed</option>
                        </select>
                    </div>

                    <!-- 5. UPLOAD GAMBAR -->
                    <div class="mb-4">
                        <label for="gambar" class="form-label">Upload Bukti (Foto/Dokumen)</label>
                        <input class="form-control" type="file" id="gambar" name="image" accept=".jpg,.jpeg,.png,.pdf,.docx" required>
                        <div class="form-text">
                            Format didukung: JPG, PNG, PDF, DOCX (Maks. 5MB).
                        </div>
                    </div>

                    <div class="d-flex justify-content-end gap-2">
                        <button type="reset" class="btn btn-secondary">Reset</button>
                        <button type="submit" class="btn btn-primary">Simpan Progress</button>
                    </div>
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