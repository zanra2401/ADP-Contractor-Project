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
                            <th>Nama Proyek</th>
                            <th>Klien</th>
                            <th>Status</th>
                            <th>Detail</th>
                        </tr>
                    </thead>
                    <tbody id="projectTableBody">
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
                <form id="projectForm" action="#" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" id="projectId">

                        <!-- NAMA PROYEK -->
                        <div class="mb-3">
                            <label>Nama Proyek</label>
                            <input type="text" class="form-control" id="nama_proyek" required>
                        </div>

                        <!-- KLIEN / PENGUNJUNG -->
                        <div class="mb-3">
                            <label>Klien (Pengunjung)</label>
                            <select id="pengunjung_id" class="form-select" required>
                                <option value="">-- Pilih Klien --</option>
                            </select>
                        </div>

                        <!-- PENGAWAS -->
                        <div class="mb-3">
                            <label>Pengawas</label>
                            <select id="pengawas_id" class="form-select" required>
                                <option value="">-- Pilih Pengawas --</option>
                            </select>
                        </div>

                        <!-- DESIGN -->
                        <div class="mb-3">
                            <label>Design</label>
                            <select id="design_id" class="form-select" required>
                                <option value="">-- Pilih Desain --</option>
                            </select>

                            <div class="mt-2">
                                <img id="designPreview" src="" class="img-fluid rounded d-none"
                                    style="max-height:150px;">
                            </div>
                        </div>

                        <!-- DESKRIPSI -->
                        <div class="mb-3">
                            <label>Deskripsi</label>
                            <textarea id="deskripsi" class="form-control"></textarea>
                        </div>

                        <!-- HARGA -->
                        <div class="mb-3">
                            <label>Harga</label>
                            <input type="number" id="harga" class="form-control" required>
                        </div>

                        <!-- STATUS -->
                        <div class="mb-3">
                            <label>Status</label>
                            <select id="status" class="form-select">
                                <option value="Pending">Pending</option>
                                <option value="In Progress">In Progress</option>
                                <option value="Completed">Completed</option>
                            </select>
                        </div>

                        <!-- ALAMAT -->
                        <div class="mb-3">
                            <label>Alamat</label>
                            <textarea id="alamat" class="form-control"></textarea>
                        </div>

                        <!-- FILE UPLOAD -->
                        <div class="mb-3">
                            <label>File (Gambar / PDF)</label>
                            <input type="file" id="file_path" class="form-control" accept="image/*,.pdf">
                        </div>

                        <!-- TANGGAL MULAI -->
                        <div class="mb-3">
                            <label>Tanggal Mulai</label>
                            <input type="date" id="tanggal_mulai" class="form-control" required>
                        </div>

                        <!-- TANGGAL SELESAI -->
                        <div class="mb-3">
                            <label>Tanggal Selesai</label>
                            <input type="date" id="tanggal_selesai" class="form-control" required>
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


@endsection

@push('scripts')
    <script>
        const API_URL = "{{ url('/admin/api/projects') }}";
        const USER_API = "{{ url('/admin/api/users') }}";
        const DESIGN_API = "{{ url('/admin/api/designs') }}";


        let projectModal;

        document.addEventListener('DOMContentLoaded', function() {
            projectModal = new bootstrap.Modal(document.getElementById('projectModal'));
            loadProjects();
        });

        // ================================
        // LOAD DATA (HANYA VIEW)
        // ================================
        async function loadProjects() {
            try {
                const res = await fetch(API_URL + "?_=" + Date.now(), {
                    headers: {
                        "X-CSRF-TOKEN": "{{ csrf_token() }}",
                        "Accept": "application/json"
                    }
                });

                const json = await res.json();
                console.log("API Response:", json);

                const tbody = document.getElementById("projectTableBody");
                tbody.innerHTML = "";

                json.data.forEach(project => {
                    tbody.innerHTML += `
                <tr>
                    <td>${project.nama_proyek}</td>
                    <td>${project.pengunjung?.nama ?? '-'}</td>
                    <td><span class="badge bg-info">${project.status}</span></td>
                    <td>
                        <button class="btn btn-warning btn-sm"
                            onclick="window.location.href='{{ url('/admin/manajemen-proyek') }}/${project.id}'">
                            Lihat Detail
                        </button>
                    </td>
                </tr>
            `;
                });

            } catch (err) {
                console.error("Gagal load proyek:", err);
            }
        }

        async function loadPengunjung() {
            const res = await fetch(USER_API + '?role=pengunjung');
            const json = await res.json();

            const select = document.getElementById('pengunjung_id');
            select.innerHTML = '<option value="">-- Pilih Klien --</option>';

            json.data.forEach(user => {
                select.innerHTML += `<option value="${user.id}">${user.nama}</option>`;
            });
        }

        async function loadPengawas() {
            const res = await fetch(USER_API + '?role=pengawas');
            const json = await res.json();

            const select = document.getElementById('pengawas_id');
            select.innerHTML = '<option value="">-- Pilih Pengawas --</option>';

            json.data.forEach(user => {
                select.innerHTML += `<option value="${user.id}">${user.nama}</option>`;
            });
        }

        async function loadDesigns() {
            const res = await fetch(DESIGN_API);
            const json = await res.json();

            const select = document.getElementById('design_id');
            select.innerHTML = '<option value="">-- Pilih Design --</option>';

            json.data.forEach(design => {
                select.innerHTML += `
            <option value="${design.id}" data-cover="${design.cover_image}">
                ${design.nama}
            </option>`;
            });
        }

        document.getElementById('design_id').addEventListener('change', function() {
            const selected = this.options[this.selectedIndex];
            const img = selected.getAttribute('data-cover');

            const preview = document.getElementById('designPreview');

            if (img) {
                preview.src = '/storage/' + img;
                preview.classList.remove('d-none');
            } else {
                preview.classList.add('d-none');
            }
        });


        // ================================
        // MODAL CREATE
        // ================================
        async function showCreateProjectModal() {
            document.getElementById('projectModalLabel').innerText = "Buat Proyek Baru";

            document.getElementById('projectForm').reset();
            document.getElementById('designPreview').classList.add('d-none');

            await loadPengunjung();
            await loadPengawas();
            await loadDesigns();

            projectModal.show();
        }


        // ================================
        // SUBMIT CREATE ONLY
        // ================================
        document.getElementById('projectForm').addEventListener('submit', async function(e) {
            e.preventDefault();

            const formData = new FormData();

            formData.append('pengunjung_id', document.getElementById('pengunjung_id').value);
            formData.append('pengawas_id', document.getElementById('pengawas_id').value);
            formData.append('design_id', document.getElementById('design_id').value);
            formData.append('nama_proyek', document.getElementById('nama_proyek').value);
            formData.append('deskripsi', document.getElementById('deskripsi').value);
            formData.append('harga', document.getElementById('harga').value);
            formData.append('status', document.getElementById('status').value);
            formData.append('alamat', document.getElementById('alamat').value);
            formData.append('tanggal_mulai', document.getElementById('tanggal_mulai').value);
            formData.append('tanggal_selesai', document.getElementById('tanggal_selesai').value);


            const file = document.getElementById('file_path').files[0];
            if (file) formData.append('file_path', file);

            await fetch(API_URL, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: formData
            });

            projectModal.hide();
            loadProjects();
        });
    </script>
@endpush
