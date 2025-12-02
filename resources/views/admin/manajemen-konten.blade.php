@extends('layouts.app')

@section('title', 'Manajemen Konten (Galeri)')

@section('content')
    <!-- TOP NAVBAR -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom p-3 mb-4 shadow-sm">
        <div class="container-fluid">
            <h1 class="h3 mb-0">📝 Manajemen Konten (Galeri)</h1>
            
            <div class="ms-auto d-flex align-items-center">
                <div class="dropdown">
                    <a href="#" class="nav-link text-dark" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        🔔 <span class="badge rounded-pill bg-danger">3</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="#">Notifikasi 1: Klien menyukai desain Rumah Tipe 70.</a></li>
                        <li><a class="dropdown-item" href="#">Notifikasi 2: Pertanyaan baru di kolom komentar.</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <div class="p-4">
        <p class="lead mb-4">Kelola konten galeri desain yang ditampilkan di halaman depan pelanggan.</p>

        <div class="card shadow-sm">
            <div class="card-header d-flex justify-content-between align-items-center bg-white py-3">
                <h5 class="mb-0">Daftar Desain Proyek</h5>
                <!-- Trigger Modal Tambah -->
                <button type="button" class="btn btn-primary btn-sm" onclick="showCreateModal()">
                    <span class="me-1">+</span> Tambah Desain Baru
                </button>
            </div>
            <div class="card-body p-0">
                <table class="table table-striped table-hover align-middle mb-0">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col" class="ps-4" style="width: 50px;">#</th>
                            <th scope="col" style="width: 100px;">Gambar</th>
                            <th scope="col">Nama Desain</th>
                            <th scope="col">Kategori</th>
                            <th scope="col">Harga Mulai</th>
                            <th scope="col">Status</th>
                            <th scope="col" class="text-end pe-4">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Data 1 -->
                        <tr>
                            <td class="ps-4">1</td>
                            <td>
                                <img src="https://images.unsplash.com/photo-1570129477490-d11e74d11d1e?fit=crop&w=100&q=60" alt="Rumah Minimalis" class="rounded" width="60" height="40" style="object-fit: cover;">
                            </td>
                            <td>
                                <strong>Rumah Minimalis Tipe 80</strong>
                                <div class="small text-muted">3 Kamar Tidur, 2 Kamar Mandi</div>
                            </td>
                            <td><span class="badge bg-info text-dark">Rumah Tinggal</span></td>
                            <td>Rp 450.000.000</td>
                            <td><span class="badge text-bg-success">Published</span></td>
                            <td class="text-end pe-4">
                                <button class="btn btn-sm btn-outline-warning me-1"
                                    onclick="showEditModal(1, 'Rumah Minimalis Tipe 80', '3 Kamar Tidur, 2 Kamar Mandi', 'Rumah Tinggal', '450000000', 'Published')">
                                    Edit
                                </button>
                                <button class="btn btn-sm btn-outline-danger"
                                    onclick="showDeleteModal(1, 'Rumah Minimalis Tipe 80')">
                                    Hapus
                                </button>
                            </td>
                        </tr>

                        <!-- Data 2 -->
                        <tr>
                            <td class="ps-4">2</td>
                            <td>
                                <img src="https://images.unsplash.com/photo-1600585154340-be6161a56a0c?fit=crop&w=100&q=60" alt="Rumah Modern" class="rounded" width="60" height="40" style="object-fit: cover;">
                            </td>
                            <td>
                                <strong>Rumah Modern Tipe 120</strong>
                                <div class="small text-muted">4 Kamar Tidur, 3 Kamar Mandi, Kolam Renang</div>
                            </td>
                            <td><span class="badge bg-info text-dark">Rumah Tinggal</span></td>
                            <td>Rp 800.000.000</td>
                            <td><span class="badge text-bg-success">Published</span></td>
                            <td class="text-end pe-4">
                                <button class="btn btn-sm btn-outline-warning me-1"
                                    onclick="showEditModal(2, 'Rumah Modern Tipe 120', '4 Kamar Tidur, 3 Kamar Mandi, Kolam Renang', 'Rumah Tinggal', '800000000', 'Published')">
                                    Edit
                                </button>
                                <button class="btn btn-sm btn-outline-danger"
                                    onclick="showDeleteModal(2, 'Rumah Modern Tipe 120')">
                                    Hapus
                                </button>
                            </td>
                        </tr>

                        <!-- Data 3 -->
                        <tr>
                            <td class="ps-4">3</td>
                            <td>
                                <img src="https://images.unsplash.com/photo-1564013799919-ab600027ffc6?fit=crop&w=100&q=60" alt="Ruko" class="rounded" width="60" height="40" style="object-fit: cover;">
                            </td>
                            <td>
                                <strong>Desain Ruko 3 Lantai</strong>
                                <div class="small text-muted">Area Komersial, 2 Kamar Mandi</div>
                            </td>
                            <td><span class="badge bg-secondary">Komersial</span></td>
                            <td>Rp 1.200.000.000</td>
                            <td><span class="badge text-bg-warning">Draft</span></td>
                            <td class="text-end pe-4">
                                <button class="btn btn-sm btn-outline-warning me-1"
                                    onclick="showEditModal(3, 'Desain Ruko 3 Lantai', 'Area Komersial, 2 Kamar Mandi', 'Komersial', '1200000000', 'Draft')">
                                    Edit
                                </button>
                                <button class="btn btn-sm btn-outline-danger"
                                    onclick="showDeleteModal(3, 'Desain Ruko 3 Lantai')">
                                    Hapus
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="card-footer bg-white">
                <nav aria-label="Page navigation example">
                    <ul class="pagination justify-content-end mb-0">
                        <li class="page-item disabled"><a class="page-link">Previous</a></li>
                        <li class="page-item active"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">Next</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>

    <!-- ================================ -->
    <!-- MODAL: FORM TAMBAH/EDIT KONTEN   -->
    <!-- ================================ -->
    <div class="modal fade" id="kontenModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="kontenModalLabel">Tambah Desain Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="#" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" id="kontenId" name="id">
                        
                        <div class="mb-3">
                            <label for="nama_desain" class="form-label">Nama Desain</label>
                            <input type="text" class="form-control" id="nama_desain" name="nama_desain" placeholder="Contoh: Rumah Minimalis Tipe 45" required>
                        </div>

                        <div class="mb-3">
                            <label for="deskripsi_singkat" class="form-label">Deskripsi Singkat</label>
                            <input type="text" class="form-control" id="deskripsi_singkat" name="deskripsi_singkat" placeholder="Contoh: 2 Kamar Tidur, 1 Kamar Mandi">
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="kategori" class="form-label">Kategori</label>
                                <select class="form-select" id="kategori" name="kategori">
                                    <option value="Rumah Tinggal">Rumah Tinggal</option>
                                    <option value="Komersial">Komersial (Ruko/Kantor)</option>
                                    <option value="Renovasi">Renovasi</option>
                                    <option value="Interior">Interior</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="harga" class="form-label">Harga Mulai (Rp)</label>
                                <div class="input-group">
                                    <span class="input-group-text">Rp</span>
                                    <input type="number" class="form-control" id="harga" name="harga" placeholder="450000000">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="status" class="form-label">Status Publikasi</label>
                                <select class="form-select" id="status" name="status">
                                    <option value="Draft">Draft (Disembunyikan)</option>
                                    <option value="Published">Published (Tampil di Web)</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="gambar" class="form-label">Upload Gambar Utama</label>
                                <input class="form-control" type="file" id="gambar" name="gambar">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan Desain</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- ================================ -->
    <!-- MODAL: KONFIRMASI HAPUS          -->
    <!-- ================================ -->
    <div class="modal fade" id="deleteKontenModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-danger">Konfirmasi Hapus</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Apakah Anda yakin ingin menghapus desain <strong id="deleteKontenTitle"></strong>?</p>
                    <p class="text-muted small mb-0">Tindakan ini tidak dapat dibatalkan. Data akan hilang dari halaman pelanggan.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <form action="#" method="POST">
                        @csrf
                        @method('DELETE')
                        <input type="hidden" id="deleteKontenId" name="id">
                        <button type="submit" class="btn btn-danger">Ya, Hapus</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
<script>
    let kontenModal;
    let deleteKontenModal;

    document.addEventListener('DOMContentLoaded', function () {
        kontenModal = new bootstrap.Modal(document.getElementById('kontenModal'));
        deleteKontenModal = new bootstrap.Modal(document.getElementById('deleteKontenModal'));
    });

    function showCreateModal() {
        document.getElementById('kontenModalLabel').innerText = "Tambah Desain Baru";
        document.getElementById('kontenId').value = "";
        document.getElementById('nama_desain').value = "";
        document.getElementById('deskripsi_singkat').value = "";
        document.getElementById('kategori').value = "Rumah Tinggal";
        document.getElementById('harga').value = "";
        document.getElementById('status').value = "Draft";
        document.getElementById('gambar').value = ""; // Reset file input
        
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
        document.getElementById('deleteKontenId').value = id;
        document.getElementById('deleteKontenTitle').innerText = nama;
        deleteKontenModal.show();
    }
</script>
@endpush