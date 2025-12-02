@extends('layouts.app')

@section('title', 'Manajemen Proyek')

@section('content')
    <!-- TOP NAVBAR -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom p-3 mb-4 shadow-sm">
        <div class="container-fluid">
            <h1 class="h3 mb-0">🗂️ Manajemen Proyek</h1>
            
            <div class="ms-auto d-flex align-items-center">
                <div class="dropdown">
                    <a href="#" class="nav-link text-dark" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        🔔 <span class="badge rounded-pill bg-danger">3</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="#">Notifikasi 1: Proyek baru ditambahkan.</a></li>
                        <li><a class="dropdown-item" href="#">Notifikasi 2: Progress proyek diupdate.</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <div class="p-4">
        <p class="lead mb-4">Kelola semua proyek yang sedang berjalan atau sudah selesai.</p>
        
        <div class="card shadow-sm">
            <div class="card-header d-flex justify-content-between align-items-center bg-white">
                <h5 class="mb-0">Daftar Proyek</h5>
                <!-- TOMBOL TAMBAH PROYEK (Trigger Modal) -->
                <button type="button" class="btn btn-primary btn-sm" onclick="showCreateProjectModal()">
                    <span class="me-1">+</span> Buat Proyek Baru
                </button>
            </div>
            <div class="card-body p-0">
                <table class="table table-striped table-hover align-middle mb-0">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col" class="ps-4">Nama Proyek</th>
                            <th scope="col">Klien</th>
                            <th style="width: 30%;">Progress</th>
                            <th>Status</th>
                            <th class="text-end pe-4">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="ps-4">Redesign Website Klien A</td>
                            <td>PT. Maju Jaya</td>
                            <td>
                                <div class="progress" role="progressbar" style="height: 10px;">
                                    <div class="progress-bar" style="width: 75%">75%</div>
                                </div>
                            </td>
                            <td><span class="badge text-bg-info text-white">In Progress</span></td>
                            <td class="text-end pe-4">
                                <!-- Tombol Edit -->
                                <button type="button" class="btn btn-sm btn-outline-warning me-1"
                                    onclick="showEditProjectModal(1, 'Redesign Website Klien A', 'PT. Maju Jaya', 75, 'In Progress')">
                                    Edit
                                </button>
                                <!-- Tombol Hapus -->
                                <button type="button" class="btn btn-sm btn-outline-danger"
                                    onclick="showDeleteProjectModal(1, 'Redesign Website Klien A')">
                                    Hapus
                                </button>
                            </td>
                        </tr>
                        
                        <tr>
                            <td class="ps-4">Aplikasi Mobile Bank B</td>
                            <td>Bank B</td>
                            <td>
                                <div class="progress" role="progressbar" style="height: 10px;">
                                    <div class="progress-bar bg-success" style="width: 100%">100%</div>
                                </div>
                            </td>
                            <td><span class="badge text-bg-success">Completed</span></td>
                            <td class="text-end pe-4">
                                <button type="button" class="btn btn-sm btn-outline-warning me-1"
                                    onclick="showEditProjectModal(2, 'Aplikasi Mobile Bank B', 'Bank B', 100, 'Completed')">
                                    Edit
                                </button>
                                <button type="button" class="btn btn-sm btn-outline-danger"
                                    onclick="showDeleteProjectModal(2, 'Aplikasi Mobile Bank B')">
                                    Hapus
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- ================================ -->
    <!-- MODAL: FORM TAMBAH/EDIT PROYEK   -->
    <!-- ================================ -->
    <div class="modal fade" id="projectModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg"> <!-- modal-lg agar lebih lebar -->
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="projectModalLabel">Buat Proyek Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="#" method="POST">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" id="projectId" name="id">
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="nama_proyek" class="form-label">Nama Proyek</label>
                                <input type="text" class="form-control" id="nama_proyek" name="nama_proyek" placeholder="Contoh: Renovasi Rumah Tipe 36" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="klien" class="form-label">Nama Klien</label>
                                <input type="text" class="form-control" id="klien" name="klien" placeholder="Contoh: Bpk. Ahmad" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="status" class="form-label">Status Proyek</label>
                                <select class="form-select" id="status" name="status">
                                    <option value="Pending">Pending</option>
                                    <option value="In Progress">In Progress</option>
                                    <option value="Completed">Completed</option>
                                    <option value="On Hold">On Hold</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="progress" class="form-label">Progress (%)</label>
                                <div class="input-group">
                                    <input type="number" class="form-control" id="progress" name="progress" min="0" max="100" value="0">
                                    <span class="input-group-text">%</span>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="deskripsi" class="form-label">Deskripsi / Catatan</label>
                            <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3" placeholder="Tambahkan detail proyek..."></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan Proyek</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- ================================ -->
    <!-- MODAL: KONFIRMASI HAPUS PROYEK   -->
    <!-- ================================ -->
    <div class="modal fade" id="deleteProjectModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-danger">Konfirmasi Hapus</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Apakah Anda yakin ingin menghapus proyek <strong id="deleteProjectName"></strong>?</p>
                    <p class="text-muted small mb-0">Tindakan ini tidak dapat dibatalkan. Semua data terkait proyek ini akan hilang.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <form action="#" method="POST">
                        @csrf
                        @method('DELETE')
                        <input type="hidden" id="deleteProjectId" name="id">
                        <button type="submit" class="btn btn-danger">Ya, Hapus</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
<script>
    let projectModal;
    let deleteProjectModal;

    document.addEventListener('DOMContentLoaded', function () {
        projectModal = new bootstrap.Modal(document.getElementById('projectModal'));
        deleteProjectModal = new bootstrap.Modal(document.getElementById('deleteProjectModal'));
    });

    function showCreateProjectModal() {
        document.getElementById('projectModalLabel').innerText = "Buat Proyek Baru";
        document.getElementById('projectId').value = "";
        document.getElementById('nama_proyek').value = "";
        document.getElementById('klien').value = "";
        document.getElementById('status').value = "Pending";
        document.getElementById('progress').value = "0";
        document.getElementById('deskripsi').value = "";
        
        projectModal.show();
    }

    function showEditProjectModal(id, nama, klien, progress, status) {
        document.getElementById('projectModalLabel').innerText = "Edit Data Proyek";
        document.getElementById('projectId').value = id;
        document.getElementById('nama_proyek').value = nama;
        document.getElementById('klien').value = klien;
        document.getElementById('progress').value = progress;
        document.getElementById('status').value = status;
        
        projectModal.show();
    }

    function showDeleteProjectModal(id, nama) {
        document.getElementById('deleteProjectId').value = id;
        document.getElementById('deleteProjectName').innerText = nama;
        deleteProjectModal.show();
    }
</script>
@endpush