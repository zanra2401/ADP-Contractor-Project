@extends('layouts.app')

@section('content')

<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom p-3 mb-4 shadow-sm">
    <div class="container-fluid">
        <h1 class="h3 mb-0">👍 Approve Progress</h1>
    </div>
</nav>

<div class="p-4">
    <div class="card shadow-sm">
        <div class="card-header fw-bold">Tinjau Laporan Kemajuan Proyek</div>

        <div class="card-body">
            <table class="table table-hover align-middle" id="progressTable">
                <thead class="table-dark">
                    <tr>
                        <th>Proyek</th>
                        <th>Laporan dari</th>
                        <th>Catatan</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody id="progressBody">
                    <!-- Data dari API akan dimasukkan di sini -->
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', loadProgress);

/* =====================================================
   1️⃣ AMBIL DATA PENDING DARI API
===================================================== */
function loadProgress() {
    fetch('/api/admin/progress/pending')
        .then(res => res.json())
        .then(result => {
            let rows = "";
            let data = result.data;

            if (data.length === 0) {
                rows = `
                    <tr>
                        <td colspan="5" class="text-center text-muted p-4">
                            Tidak ada progress yang menunggu persetujuan.
                        </td>
                    </tr>`;
            } else {
                data.forEach(item => {
                    rows += `
                        <tr>
                            <td>${item.proyek ?? 'Nama Proyek Belum Ada'}</td>
                            <td>${item.dari ?? 'Tidak diketahui'}</td>
                            <td>${item.catatan ?? '-'}</td>
                            <td>
                                <span class="badge text-bg-warning text-dark">Pending Review</span>
                            </td>
                            <td>
                                <div class="btn-group">
                                    <button class="btn btn-sm btn-success" onclick="approve(${item.id})">Approve</button>
                                    <button class="btn btn-sm btn-danger" onclick="reject(${item.id})">Tolak</button>
                                </div>
                            </td>
                        </tr>
                    `;
                });
            }

            document.getElementById("progressBody").innerHTML = rows;
        })
        .catch(() => {
            Swal.fire("Error", "Gagal memuat data progress.", "error");
        });
}

/* =====================================================
   2️⃣ APPROVE
===================================================== */
function approve(id) {
    Swal.fire({
        title: "Setujui progress ini?",
        icon: "question",
        showCancelButton: true,
        confirmButtonText: "Ya, Setujui",
        cancelButtonText: "Batal"
    }).then(result => {
        if (!result.isConfirmed) return;

        fetch(`/api/admin/progress/${id}/approve`, {
            method: "POST",
            headers: { "Accept": "application/json" }
        })
        .then(res => res.json())
        .then(data => {
            Swal.fire("Berhasil!", data.message, "success").then(loadProgress);
        })
        .catch(() => Swal.fire("Error", "Gagal menyetujui progress.", "error"));
    });
}

/* =====================================================
   3️⃣ REJECT
===================================================== */
function reject(id) {
    Swal.fire({
        title: "Tolak progress ini?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Ya, Tolak",
        cancelButtonText: "Batal",
        confirmButtonColor: "#d33"
    }).then(result => {
        if (!result.isConfirmed) return;

        fetch(`/api/admin/progress/${id}/reject`, {
            method: "POST",
            headers: { "Accept": "application/json" }
        })
        .then(res => res.json())
        .then(data => {
            Swal.fire("Ditolak!", data.message, "success").then(loadProgress);
        })
        .catch(() => Swal.fire("Error", "Gagal menolak progress.", "error"));
    });
}
</script>

@endsection
