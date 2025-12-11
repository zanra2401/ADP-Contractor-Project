@extends('layouts.app')

@section('content')
    <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom p-3 mb-4 shadow-sm">
        <div class="container-fluid">
            <h1 class="h3 mb-0">👥 Manajemen Admin</h1>
        </div>
    </nav>

    <div class="p-4">
        <div class="card shadow-sm">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span class="fw-bold">Daftar Admin</span>
                <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#tambahModal">
                    + Tambah Admin
                </button>
            </div>

            <div class="card-body">
                <table class="table table-striped table-hover align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>Nama</th>
                            <th>Nomor Telepon</th>
                            <th>Role</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="user-table-body"></tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- MODAL TAMBAH --}}
    <div class="modal fade" id="tambahModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="formTambah">
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Admin</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <input type="text" name="nama" class="form-control mb-2" placeholder="Nama" required>
                        <input type="text" name="nomor_telepon" class="form-control mb-2" placeholder="Nomor Telepon"
                            required>
                        <input type="password" name="password" class="form-control" placeholder="Password" required>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- MODAL EDIT --}}
    <div class="modal fade" id="editModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="formEdit">
                    <input type="hidden" id="edit_id">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Admin</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <input type="text" id="edit_nama" class="form-control mb-2" required>
                        <input type="text" id="edit_nomor_telepon" class="form-control mb-2" required>
                        <input type="password" id="edit_password" class="form-control"
                            placeholder="Kosongkan jika tidak diubah">
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button class="btn btn-warning text-white">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- MODAL HAPUS --}}
    <div class="modal fade" id="hapusModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Hapus Admin</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p>Yakin ingin menghapus user ini?</p>
                    <input type="hidden" id="hapus_id">
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button class="btn btn-danger" onclick="konfirmasiHapus()">Hapus</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', loadUsers);

        let tambahModal, editModal, hapusModal;

        function loadUsers() {
            fetch('/superadmin/users')
                .then(res => res.json())
                .then(data => {
                    let tbody = document.getElementById('user-table-body');
                    tbody.innerHTML = '';
                    data.forEach((user, index) => {
                        tbody.innerHTML += `
                    <tr>
                        <td>${index + 1}</td>
                        <td>${user.nama}</td>
                        <td>${user.nomor_telepon}</td>
                        <td><span class="badge bg-primary">${user.role?.nama_role ?? ''}</span></td>
                        <td>
                            <button class="btn btn-sm btn-warning text-white"
                                onclick="openEdit('${user.id}','${user.nama}','${user.nomor_telepon}')">Edit</button>
                            <button class="btn btn-sm btn-danger"
                                onclick="openHapus('${user.id}')">Hapus</button>
                        </td>
                    </tr>
                `;
                    });
                });
        }

        // TAMBAH
        document.getElementById('formTambah').addEventListener('submit', function(e) {
            e.preventDefault();
            const form = e.target;

            fetch('/superadmin/users', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: new FormData(form)
            }).then(() => {
                bootstrap.Modal.getInstance(document.getElementById('tambahModal')).hide();
                form.reset();
                loadUsers();
            });
        });

        // EDIT
        function openEdit(id, nama, no) {
            document.getElementById('edit_id').value = id;
            document.getElementById('edit_nama').value = nama;
            document.getElementById('edit_nomor_telepon').value = no;
            bootstrap.Modal.getOrCreateInstance(document.getElementById('editModal')).show();
        }

        document.getElementById('formEdit').addEventListener('submit', function(e) {
            e.preventDefault();

            let id = document.getElementById('edit_id').value;

            let formData = new FormData();
            formData.append('nama', document.getElementById('edit_nama').value);
            formData.append('nomor_telepon', document.getElementById('edit_nomor_telepon').value);
            let pw = document.getElementById('edit_password').value;
            if (pw) formData.append('password', pw);
            formData.append('_method', 'PUT');

            fetch(`/superadmin/users/${id}`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: formData
            }).then(() => {
                bootstrap.Modal.getInstance(document.getElementById('editModal')).hide();
                loadUsers();
            });
        });

        // HAPUS
        function openHapus(id) {
            document.getElementById('hapus_id').value = id;
            bootstrap.Modal.getOrCreateInstance(document.getElementById('hapusModal')).show();
        }

        function konfirmasiHapus() {
            let id = document.getElementById('hapus_id').value;

            fetch(`/superadmin/users/${id}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            }).then(() => {
                bootstrap.Modal.getInstance(document.getElementById('hapusModal')).hide();
                loadUsers();
            });
        }
    </script>
@endsection
