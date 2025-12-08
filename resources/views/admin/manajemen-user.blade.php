@extends('layouts.app')

@section('title', 'Manajemen User')

@section('content')

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom p-3 mb-4 shadow-sm">
    <div class="container-fluid">
        <h1 class="h3 mb-0">👥 Manajemen User</h1>
    </div>
</nav>

<div class="p-4">
    <p class="lead mb-4">Kelola semua akun pengguna dan administrator.</p>

    <div class="card shadow-sm">
        <div class="card-header d-flex flex-wrap justify-content-between align-items-center bg-white py-3 gap-2">
            <h5 class="mb-0">Daftar Pengguna</h5>
            <button type="button" class="btn btn-primary btn-sm" onclick="showCreateModal()">
                <span class="me-1">+</span> Tambah User Baru
            </button>
        </div>

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-striped table-hover align-middle mb-0 text-nowrap">
                    <thead class="table-dark">
                        <tr>
                            <th class="ps-4" style="width: 50px;">No</th>
                            <th>Nama</th>
                            <th>Nomor Telepon</th>
                            <th>Role</th>
                            <th class="text-end pe-4">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($users as $user)
                            <tr>
                                <td class="ps-4">{{ $loop->iteration }}</td>
                                <td><strong>{{ $user->nama }}</strong></td>
                                <td>{{ $user->nomor_telepon ?? '-' }}</td>
                                <td>
                                    @php
                                        $badgeColor = match($user->role->nama_role) {
                                            'superadmin' => 'bg-danger',
                                            'admin' => 'bg-warning text-dark',
                                            'pengawas' => 'bg-info text-dark',
                                            default => 'bg-primary'
                                        };
                                    @endphp
                                    <span class="badge {{ $badgeColor }}">
                                        {{ ucfirst($user->role->nama_role) }}
                                    </span>
                                </td>
                                <td class="text-end pe-4">
                                    <button class="btn btn-sm btn-outline-warning me-1 btn-edit" data-id="{{ $user->id }}">
                                        Edit
                                    </button>

                                    <button class="btn btn-sm btn-outline-danger btn-delete" data-id="{{ $user->id }}">
                                        Hapus
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-4 text-muted">
                                    Belum ada data user.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        
        <div class="card-footer bg-white">
            <small class="text-muted">Total Pengguna: {{ count($users) }}</small>
        </div>
    </div>
</div>

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
                    <input type="text" id="name" class="form-control" placeholder="Nama Lengkap">
                </div>

                <div class="mb-3">
                    <label class="form-label">Nomor Telepon</label>
                    <input type="text" id="nomor_telepon" class="form-control" placeholder="Contoh: 0812...">
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
                    <input type="password" id="password" class="form-control" placeholder="********">
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

    // Event Delegation untuk tombol Edit & Hapus
    // (Lebih aman jika elemen dirender ulang via JS/AJAX di masa depan)
    document.body.addEventListener('click', function(e) {
        if (e.target.classList.contains('btn-edit')) {
            loadAndShowEditModal(e.target.dataset.id);
        }
        if (e.target.classList.contains('btn-delete')) {
            confirmDelete(e.target.dataset.id);
        }
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
    document.getElementById('role').value = "pengunjung"; // Default value
    document.getElementById('password').value = "";
    document.getElementById('passHelp').classList.add('d-none');

    userModal.show();
}

// load data dan show edit modal
function loadAndShowEditModal(id) {
    // Tampilkan loading swal jika mau (opsional)
    
    fetch(`/api/admin/users/${id}`)
        .then(res => {
            if (!res.ok) throw new Error("Gagal mengambil data");
            return res.json();
        })
        .then(user => {
            document.getElementById('userModalLabel').innerText = "Edit User";
            document.getElementById('userId').value = user.id;
            document.getElementById('name').value = user.nama;
            document.getElementById('nomor_telepon').value = user.nomor_telepon;
            // Pastikan value role sesuai dengan value di <option> select box
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

    // CSRF Token Laravel (Penting untuk metode POST/PUT/DELETE)
    // Pastikan tag <meta name="csrf-token" content="{{ csrf_token() }}"> ada di head layout
    let token = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

    fetch(url, {
        method: method,
        headers: { 
            "Content-Type": "application/json", 
            "Accept": "application/json",
            "X-CSRF-TOKEN": token 
        },
        body: JSON.stringify(payload)
    })
    .then(res => res.json().then(data => ({status: res.status, body: data})))
    .then(({status, body}) => {
        if (status >= 400) {
            Swal.fire("Gagal", body.message || "Terjadi kesalahan validasi", "error");
            return;
        }
        Swal.fire("Berhasil", body.message, "success").then(() => {
            location.reload();
        });
    })
    .catch(err => {
        Swal.fire("Error", "Terjadi kesalahan server", "error");
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
            let token = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
            
            fetch(`/api/admin/users/${id}`, {
                method: "DELETE",
                headers: { 
                    "Accept": "application/json",
                    "X-CSRF-TOKEN": token
                }
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