@extends('layouts.app')

@section('title', 'Manajemen Proyek')

@section('content')
    <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom p-3 mb-4 shadow-sm">
        <div class="container-fluid">
            <h1 class="h3 mb-0">🗂️ Manajemen Proyek</h1>
            </div>
    </nav>

    <div class="p-4">
        <p class="lead mb-4">Kelola semua proyek yang sedang berjalan atau sudah selesai.</p>
        
        <div class="card shadow-sm">
            <div class="card-header d-flex flex-wrap justify-content-between align-items-center bg-white py-3 gap-2">
                <h5 class="mb-0">Daftar Proyek</h5>
                <button type="button" class="btn btn-primary btn-sm" onclick="showCreateProjectModal()">
                    <span class="me-1">+</span> Buat Proyek Baru
                </button>
            </div>
            
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-striped table-hover align-middle mb-0 text-nowrap">
                        <thead class="table-dark">
                            <tr>
                                <th class="ps-4">Nama Proyek</th>
                                <th>Klien</th>
                                <th style="min-width: 150px;">Progress</th> 
                                <th>Status</th>
                                <th class="text-end pe-4">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="ps-4 fw-bold">Redesign Website Klien A</td>
                                <td>PT. Maju Jaya</td>
                                <td>
                                    <div class="progress" role="progressbar" style="height: 10px;">
                                        <div class="progress-bar" style="width: 75%">75%</div>
                                    </div>
                                    <small class="text-muted">75% Complete</small>
                                </td>
                                <td><span class="badge text-bg-info text-white">In Progress</span></td>
                                <td class="text-end pe-4">
                                    <a href="{{ route('admin.proyek.detail') }}" class="btn btn-sm btn-info text-white me-1" title="Lihat Detail">
                                        👁️
                                    </a>
                                    <button class="btn btn-sm btn-warning text-white me-1" 
                                        onclick="showEditProjectModal(1, 'Redesign Website Klien A', 'PT. Maju Jaya', 75, 'In Progress')" title="Edit Proyek">
                                        ✏️
                                    </button>
                                    <button class="btn btn-sm btn-danger" 
                                        onclick="showDeleteProjectModal(1, 'Redesign Website Klien A')" title="Hapus Proyek">
                                        🗑️
                                    </button>
                                </td>
                            </tr>
                            
                            <tr>
                                <td class="ps-4 fw-bold">Aplikasi Mobile Bank B</td>
                                <td>Bank B</td>
                                <td>
                                    <div class="progress" role="progressbar" style="height: 10px;">
                                        <div class="progress-bar bg-success" style="width: 100%">100%</div>
                                    </div>
                                    <small class="text-muted">Completed</small>
                                </td>
                                <td><span class="badge text-bg-success">Completed</span></td>
                                <td class="text-end pe-4">
                                    <a href="{{ route('admin.proyek.detail') }}" class="btn btn-sm btn-info text-white me-1">
                                        👁️
                                    </a>
                                    <button class="btn btn-sm btn-warning text-white me-1" 
                                        onclick="showEditProjectModal(2, 'Aplikasi Mobile Bank B', 'Bank B', 100, 'Completed')">
                                        ✏️
                                    </button>
                                    <button class="btn btn-sm btn-danger" 
                                        onclick="showDeleteProjectModal(2, 'Aplikasi Mobile Bank B')">
                                        🗑️
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            
            <div class="card-footer bg-white">
                <nav>
                    <ul class="pagination justify-content-end mb-0">
                        <li class="page-item disabled"><a class="page-link">Prev</a></li>
                        <li class="page-item active"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">Next</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>

    <div class="modal fade" id="projectModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
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
                                <input type="text" class="form-control" id="nama_proyek" name="nama_proyek" placeholder="Contoh: Renovasi Rumah" required>
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