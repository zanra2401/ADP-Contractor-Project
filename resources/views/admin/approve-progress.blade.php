@extends('layouts.app')

@section('title', 'Approve Progress')

@section('content')

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom p-3 mb-4 shadow-sm">
    <div class="container-fluid">
        <h1 class="h3 mb-0">👍 Approve Progress</h1>
    </div>
</nav>

<div class="p-4">
    <div class="card shadow-sm">
        <div class="card-header fw-bold bg-white py-3">
            Tinjau Laporan Kemajuan Proyek
        </div>

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover table-striped align-middle mb-0 text-nowrap" id="progressTable">
                    <thead class="table-dark">
                        <tr>
                            <th class="ps-4">Proyek</th>
                            <th>Laporan dari</th>
                            <th>Catatan</th>
                            <th>Status</th>
                            <th class="text-end pe-4">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="progressBody">
                        <tr>
                            <td colspan="5" class="text-center py-5">
                                <div class="spinner-border text-primary" role="status">
                                    <span class="visually-hidden">Loading...</span>
                                </div>
                                <p class="mt-2 text-muted">Memuat data...</p>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
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
            let data = result.data; // Pastikan format API mengembalikan { data: [...] }

            if (!data || data.length === 0) {
                rows = `
                    <tr>
                        <td colspan="5" class="text-center text-muted py-5">
                            <h4 class="mb-2">✅</h4>
                            <span class="fw-bold">Semua Aman!</span><br>
                            Tidak ada progress yang menunggu persetujuan saat ini.
                        </td>
                    </tr>`;
            } else {
                data.forEach(item => {
                    // Safety check null value
                    let proyek = item.proyek ? item.proyek : 'Nama Proyek Belum Ada';
                    let pengirim = item.dari ? item.dari : 'Tidak diketahui';
                    let catatan = item.catatan ? item.catatan : '<span class="text-muted fst-italic">- Tidak ada catatan -</span>';

                    rows += `
                        <tr>
                            <td class="ps-4 fw-bold">${proyek}</td>
                            <td>${pengirim}</td>
                            <td>${catatan}</td>
                            <td>
                                <span class="badge text-bg-warning text-dark">Pending Review</span>
                            </td>
                            <td class="text-end pe-4">
                                <div class="btn-group" role="group">
                                    <button class="btn btn-sm btn-success text-white" onclick="approve(${item.id})">
                                        ✔ Approve
                                    </button>
                                    <button class="btn btn-sm btn-outline-danger" onclick="reject(${item.id})">
                                        ✖ Tolak
                                    </button>
                                </div>
                            </td>
                        </tr>
                    `;
                });
            }

            document.getElementById("progressBody").innerHTML = rows;
        })
        .catch(() => {
            document.getElementById("progressBody").innerHTML = `
                <tr><td colspan="5" class="text-center text-danger py-4">Gagal memuat data progress.</td></tr>
            `;
        });
}

/* =====================================================
   2️⃣ APPROVE
===================================================== */
function approve(id) {
    Swal.fire({
        title: "Setujui progress ini?",
        text: "Data akan diperbarui ke status disetujui.",
        icon: "question",
        showCancelButton: true,
        confirmButtonText: "Ya, Setujui",
        cancelButtonText: "Batal",
        confirmButtonColor: "#198754",
        cancelButtonColor: "#6c757d"
    }).then(result => {
        if (!result.isConfirmed) return;

        // Ambil CSRF Token agar tidak Error 419
        let token = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

        fetch(`/api/admin/progress/${id}/approve`, {
            method: "POST",
            headers: { 
                "Accept": "application/json",
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": token 
            }
        })
        .then(res => res.json())
        .then(data => {
            if(data.success || data.status === 'success') {
                Swal.fire("Berhasil!", data.message, "success").then(loadProgress);
            } else {
                Swal.fire("Gagal!", data.message || "Terjadi kesalahan.", "error");
            }
        })
        .catch(() => Swal.fire("Error", "Gagal menghubungi server.", "error"));
    });
}

/* =====================================================
   3️⃣ REJECT
===================================================== */
function reject(id) {
    Swal.fire({
        title: "Tolak progress ini?",
        text: "User akan diminta untuk merevisi laporan.",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Ya, Tolak",
        cancelButtonText: "Batal",
        confirmButtonColor: "#dc3545",
        cancelButtonColor: "#6c757d"
    }).then(result => {
        if (!result.isConfirmed) return;

        let token = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

        fetch(`/api/admin/progress/${id}/reject`, {
            method: "POST",
            headers: { 
                "Accept": "application/json",
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": token
            }
        })
        .then(res => res.json())
        .then(data => {
            Swal.fire("Ditolak!", data.message, "success").then(loadProgress);
        })
        .catch(() => Swal.fire("Error", "Gagal menghubungi server.", "error"));
    });
}
</script>

@endsection