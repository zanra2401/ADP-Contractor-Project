@extends('layouts.app')

@section('content')

<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom p-3 mb-4 shadow-sm">
    <div class="container-fluid">
        <h1 class="h3 mb-0">👥 Manajemen User</h1>
    </div>
</nav>

<div class="p-4">
    <p class="lead">Kelola semua akun pengguna dan administrator.</p>

    <div class="card shadow-sm">
        <div class="card-header d-flex justify-content-between align-items-center">
            <span class="fw-bold">Daftar Pengguna</span>
            <button type="button" class="btn btn-primary btn-sm" onclick="showCreateModal()">
                Tambah User Baru +
            </button>
        </div>

        <div class="card-body">
            <table class="table table-striped table-hover align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Nomor Telepon</th>
                        <th>Role</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $user->nama }}</td>
                            <td>{{ $user->nomor_telepon ?? '-' }}</td>
                            <td>
                                <span class="badge text-bg-primary">
                                    {{ $user->role->nama_role }}
                                </span>
                            </td>
                            <td>
                                <button 
                                    class="btn btn-sm btn-warning text-white btn-edit"
                                    data-id="{{ $user->id }}">
                                    Edit
                                </button>

                                <button 
                                    class="btn btn-sm btn-danger btn-delete"
                                    data-id="{{ $user->id }}">
                                    Hapus
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>

            </table>
        </div>
    </div>
</div>

<!-- =========================== -->
<!-- MODAL FORM TAMBAH / EDIT    -->
<!-- =========================== -->
<div class="modal fade" id="userModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            
            <div class="modal-header">
                <h5 class="modal-title" id="userModalLabel">Tambah User Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <input type="hidden" id="userId">

                <div class="mb-3">
                    <label class="form-label">Nama Lengkap</label>
                    <input type="text" id="name" class="form-control">
                </div>

                <div class="mb-3">
                    <label class="form-label">Nomor Telepon</label>
                    <input type="text" id="nomor_telepon" class="form-control">
                </div>

                <div class="mb-3">
                    <label class="form-label">Role</label>
                    <select id="role" class="form-select">
                        <option value="pengawas">Pengawas</option>
                        <option value="customer_service">Customer Service</option>
                        <option value="pengunjung">Pengunjung</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" id="password" class="form-control">
                    <small class="text-muted d-none" id="passHelp">
                        Kosongkan jika tidak ingin mengubah password.
                    </small>
                </div>
            </div>

            <div class="modal-footer">
                <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button class="btn btn-primary" onclick="submitUser()">Simpan</button>
            </div>

        </div>
    </div>
</div>

<script>
let userModal;

// Init modal
document.addEventListener('DOMContentLoaded', function() {
    userModal = new bootstrap.Modal(document.getElementById('userModal'));

    // Event: tombol EDIT
    document.querySelectorAll('.btn-edit').forEach(btn => {
        btn.addEventListener('click', function() {
            loadAndShowEditModal(this.dataset.id);
        });
    });

    // Event: tombol HAPUS
    document.querySelectorAll('.btn-delete').forEach(btn => {
        btn.addEventListener('click', function() {
            confirmDelete(this.dataset.id);
        });
    });
});

/* ============================
   SHOW CREATE MODAL
=============================== */
function showCreateModal() {
    document.getElementById('userModalLabel').innerText = "Tambah User Baru";

    document.getElementById('userId').value = "";
    document.getElementById('name').value = "";
    document.getElementById('nomor_telepon').value = "";
    document.getElementById('role').value = "pengunjung";
    document.getElementById('password').value = "";
    document.getElementById('passHelp').classList.add('d-none');

    userModal.show();
}

// load data dan show edit modal
function loadAndShowEditModal(id) {
    fetch(`/api/admin/users/${id}`)
        .then(res => res.json())
        .then(user => {
            document.getElementById('userModalLabel').innerText = "Edit User";
            document.getElementById('userId').value = user.id;
            document.getElementById('name').value = user.nama;
            document.getElementById('nomor_telepon').value = user.nomor_telepon;
            document.getElementById('role').value = user.role.nama_role;
            document.getElementById('password').value = "";
            document.getElementById('passHelp').classList.remove('d-none');

            userModal.show();
        })
        .catch(err => {
            console.error(err);
            Swal.fire("Error", "Gagal memuat data user!", "error");
        });
}

// submit (create / edit)
function submitUser() {
    let id = document.getElementById('userId').value;

    let payload = {
        nama: document.getElementById('name').value,
        nomor_telepon: document.getElementById('nomor_telepon').value,
        role: document.getElementById('role').value,
        password: document.getElementById('password').value
    };

    let url = id ? `/api/admin/users/${id}` : `/api/admin/users`;
    let method = id ? "PUT" : "POST";

    fetch(url, {
        method: method,
        headers: { "Content-Type": "application/json", "Accept": "application/json" },
        body: JSON.stringify(payload)
    })
    .then(res => res.json().then(data => ({status: res.status, body: data})))
    .then(({status, body}) => {
        if (status >= 400) {
            Swal.fire("Gagal", body.message || "Terjadi kesalahan", "error");
            return;
        }
        Swal.fire("Berhasil", body.message, "success").then(() => {
            location.reload();
        });
    });
}

// delete
function confirmDelete(id) {

    Swal.fire({
        title: 'Yakin ingin menghapus user ini?',
        text: "Aksi ini tidak dapat dibatalkan!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Hapus',
        cancelButtonText: 'Batal',
        confirmButtonColor: '#d33'
    }).then(result => {

        if (result.isConfirmed) {
            fetch(`/api/admin/users/${id}`, {
                method: "DELETE",
                headers: { "Accept": "application/json" }
            })
            .then(res => res.json())
            .then(data => {
                Swal.fire("Berhasil", data.message, "success").then(() => location.reload());
            })
            .catch(() => {
                Swal.fire("Error", "Gagal menghapus user", "error");
            });
        }

    });
}
</script>

@endsection
