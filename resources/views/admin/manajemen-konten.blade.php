@extends('layouts.app')

@section('title', 'Manajemen Konten')

@section('content')
    <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom p-3 mb-4 shadow-sm">
        <div class="container-fluid">
            <h1 class="h3 mb-0">📝 Manajemen Konten</h1>
        </div>
    </nav>

    <div class="p-4">
        
        <p class="lead mb-4">Kelola konten galeri desain yang ditampilkan di halaman pelanggan.</p>

        <div class="card shadow-sm">
            <div class="card-header d-flex flex-wrap justify-content-between align-items-center bg-white py-3 gap-2">
                <h5 class="mb-0">Daftar Desain Proyek</h5>
                <button type="button" class="btn btn-primary btn-sm" onclick="showCreateModal()">
                    <span class="me-1">+</span> Tambah Desain
                </button>
            </div>
            
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-striped table-hover align-middle mb-0 text-nowrap">
                        <thead class="table-dark">
                            <tr>
                                <th scope="col" class="ps-4">#</th>
                                <th scope="col">Gambar</th>
                                <th scope="col">Nama Desain</th>
                                <th scope="col">Kategori</th>
                                <th scope="col">Harga</th>
                                <th scope="col">Status</th>
                                <th scope="col" class="text-end pe-4">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="ps-4">1</td>
                                <td>
                                    <img src="https://images.unsplash.com/photo-1570129477490-d11e74d11d1e?fit=crop&w=100&q=60" alt="Rumah" class="rounded border" width="60" height="40" style="object-fit: cover;">
                                </td>
                                <td>
                                    <strong>Rumah Minimalis Tipe 80</strong>
                                </td>
                                <td><span class="badge bg-info text-dark">Rumah Tinggal</span></td>
                                <td>Rp 450 Jt</td>
                                <td><span class="badge text-bg-success">Published</span></td>
                                <td class="text-end pe-4">
                                    <button class="btn btn-sm btn-outline-warning me-1" onclick="showEditModal(1, 'Rumah Minimalis Tipe 80', '...', 'Rumah Tinggal', '450000000', 'Published')">Edit</button>
                                    <button class="btn btn-sm btn-outline-danger" onclick="showDeleteModal(1, 'Rumah Minimalis Tipe 80')">Hapus</button>
                                </td>
                            </tr>
                            
                             <tr>
                                <td class="ps-4">2</td>
                                <td>
                                    <img src="https://images.unsplash.com/photo-1600585154340-be6161a56a0c?fit=crop&w=100&q=60" alt="Rumah" class="rounded border" width="60" height="40" style="object-fit: cover;">
                                </td>
                                <td>
                                    <strong>Rumah Modern Tipe 120</strong>
                                </td>
                                <td><span class="badge bg-info text-dark">Rumah Tinggal</span></td>
                                <td>Rp 800 Jt</td>
                                <td><span class="badge text-bg-success">Published</span></td>
                                <td class="text-end pe-4">
                                    <button class="btn btn-sm btn-outline-warning me-1" onclick="showEditModal(2, 'Rumah Modern', '...', 'Rumah Tinggal', '800000000', 'Published')">Edit</button>
                                    <button class="btn btn-sm btn-outline-danger" onclick="showDeleteModal(2, 'Rumah Modern')">Hapus</button>
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

    <div class="modal fade" id="kontenModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="kontenModalLabel">Form Desain</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="#" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" id="kontenId" name="id">
                        <div class="mb-3">
                            <label class="form-label">Nama Desain</label>
                            <input type="text" class="form-control" id="nama_desain" name="nama_desain" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Deskripsi</label>
                            <input type="text" class="form-control" id="deskripsi_singkat" name="deskripsi_singkat">
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Kategori</label>
                                <select class="form-select" id="kategori" name="kategori">
                                    <option value="Rumah Tinggal">Rumah Tinggal</option>
                                    <option value="Komersial">Komersial</option>
                                    <option value="Renovasi">Renovasi</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Harga (Rp)</label>
                                <input type="number" class="form-control" id="harga" name="harga">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Status</label>
                                <select class="form-select" id="status" name="status">
                                    <option value="Draft">Draft</option>
                                    <option value="Published">Published</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Gambar</label>
                                <input class="form-control" type="file" id="gambar" name="gambar">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="deleteKontenModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-danger">Hapus Desain?</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Yakin hapus <strong id="deleteKontenTitle"></strong>?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-danger">Hapus</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    let kontenModal, deleteKontenModal;
    document.addEventListener('DOMContentLoaded', function () {
        kontenModal = new bootstrap.Modal(document.getElementById('kontenModal'));
        deleteKontenModal = new bootstrap.Modal(document.getElementById('deleteKontenModal'));
    });
    function showCreateModal() {
        document.getElementById('kontenModalLabel').innerText = "Tambah Desain";
        document.getElementById('kontenId').value = "";
        document.getElementById('nama_desain').value = "";
        document.getElementById('deskripsi_singkat').value = "";
        document.getElementById('harga').value = "";
        kontenModal.show();
    }
    function showEditModal(id, nama, deskripsi, kategori, harga, status) {
        document.getElementById('kontenModalLabel').innerText = "Edit Desain";
        document.getElementById('kontenId').value = id;
        document.getElementById('nama_desain').value = nama;
        document.getElementById('deskripsi_singkat').value = deskripsi;
        document.getElementById('kategori').value = kategori;
        document.getElementById('harga').value = harga;
        document.getElementById('status').value = status;
        kontenModal.show();
    }
    function showDeleteModal(id, nama) {
        document.getElementById('deleteKontenTitle').innerText = nama;
        deleteKontenModal.show();
    }
</script>
@endpush