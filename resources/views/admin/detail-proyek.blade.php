@extends('layouts.app')

@section('content')
    <!-- Navbar Atas -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom p-3 mb-4 shadow-sm">
        <div class="container-fluid">
            <div class="d-flex align-items-center">
                <!-- Tombol Kembali -->
                <a href="{{ route('admin.manajemen-proyek') }}" class="btn btn-outline-secondary me-3">
                    &larr; Kembali
                </a>
                <h1 class="h3 mb-0">📄 Detail Proyek</h1>
            </div>
        </div>
    </nav>

    <div class="p-4">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">{{ $project->nama_proyek }}</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <!-- KOLOM KIRI: Informasi Utama -->
                    <div class="col-md-6">
                        <h6 class="text-uppercase text-muted mb-3 fw-bold">Informasi Dasar</h6>

                        <div class="mb-3">
                            <label class="fw-bold d-block">Nama Klien</label>
                            <span>{{ $project->pengunjung->nama ?? '-' }}</span>
                        </div>

                        <div class="mb-3">
                            <label class="fw-bold d-block">Nama Pengawas</label>
                            <span>{{ $project->pengawas->nama ?? '-' }}</span>
                        </div>

                        <div class="mb-3">
                            <label class="fw-bold d-block">Jenis Desain</label>
                            <span class="badge bg-info text-dark">
                                {{ $project->design->nama ?? '-' }}
                            </span>
                        </div>

                        <div class="mb-3">
                            <label class="fw-bold d-block">Alamat Proyek</label>
                            <span>{{ $project->alamat }}</span>
                        </div>
                    </div>

                    <!-- KOLOM KANAN: Teknis & Harga -->
                    <div class="col-md-6">
                        <h6 class="text-uppercase text-muted mb-3 fw-bold">Detail Teknis</h6>

                        <div class="mb-3">
                            <label class="fw-bold d-block">Deskripsi Singkat</label>
                            <p class="text-muted">
                                {{ $project->deskripsi }}
                            </p>
                        </div>

                        <div class="mb-3">
                            <label class="fw-bold d-block">Status Proyek</label>

                            @if ($project->status === 'Completed')
                                <span class="badge bg-success">{{ $project->status }}</span>
                            @elseif($project->status === 'In Progress')
                                <span class="badge bg-warning text-dark">{{ $project->status }}</span>
                            @else
                                <span class="badge bg-secondary">{{ $project->status }}</span>
                            @endif
                        </div>


                        <div class="row">
                            <div class="col-6 mb-3">
                                <label class="fw-bold d-block">Tanggal Mulai</label>
                                <span>{{ \Carbon\Carbon::parse($project->tanggal_mulai)->translatedFormat('d F Y') }}</span>
                            </div>
                            <div class="col-6 mb-3">
                                <label class="fw-bold d-block">Estimasi Selesai</label>
                                <span>{{ \Carbon\Carbon::parse($project->tanggal_selesai)->translatedFormat('d F Y') }}</span>
                            </div>
                        </div>

                        <div class="p-3 bg-light rounded border">
                            <label class="fw-bold d-block text-success">Total Harga Proyek</label>
                            <h3 class="fw-bold text-success mb-0">
                                Rp {{ number_format($project->harga, 0, ',', '.') }}
                            </h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer text-end">
                <button class="btn btn-warning text-white" data-bs-toggle="modal" data-bs-target="#editProjectModal">
                    Edit Data
                </button>
                <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteProjectModal">
                    Hapus
                </button>
                @if (!empty($project->file_path))
                    <a href="{{ asset('storage/' . $project->file_path) }}" target="_blank" class="btn btn-primary">Lihat /
                        Download File</a>
                @else
                    <button class="btn btn-primary" disabled>Tidak ada file</button>
                @endif
            </div>
        </div>
    </div>

    {{-- Payment History --}}
    <div class="p-4 mt-4">
        <div class="card shadow-sm">
            <div class="card-header">
                <h5 class="mb-0">Progres Payment</h5>
            </div>
            <div class="card-body">
                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <div class="mb-3 d-flex gap-2">
                    <button class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#createPPModal">Tambah
                        Progres Payment</button>
                    <button type="button" class="btn btn-sm btn-outline-secondary" onclick="printPaymentProgress()">Cetak
                        Progres</button>
                </div>

                @if (isset($paymentProgress) && $paymentProgress->count())
                    <div id="payment-progress-section" class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Tanggal</th>
                                    <th>Jumlah</th>
                                    <th>Deskripsi</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($paymentProgress as $pp)
                                    <tr>
                                        <td>{{ \Carbon\Carbon::parse($pp->created_at)->translatedFormat('d F Y H:i') }}
                                        </td>
                                        <td>Rp {{ number_format($pp->jumlah, 0, ',', '.') }}</td>
                                        <td>{{ $pp->deskripsi ?? '-' }}</td>
                                        <td>{{ $pp->status ?? '-' }}</td>
                                        <td>
                                            <button class="btn btn-sm btn-outline-primary me-2" data-bs-toggle="modal"
                                                data-bs-target="#editPPModal{{ $pp->id }}">Edit</button>

                                            <form action="{{ route('admin.payment-progress.destroy', $pp->id) }}"
                                                method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-sm btn-danger"
                                                    onclick="return confirm('Hapus entry pembayaran ini?')">Hapus</button>
                                            </form>
                                        </td>
                                    </tr>

                                    <!-- Edit PaymentProgress Modal -->
                                    <div class="modal fade" id="editPPModal{{ $pp->id }}" tabindex="-1"
                                        aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <form action="{{ route('admin.payment-progress.update', $pp->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Edit Pembayaran (Instalment)</h5>
                                                        <button type="button" class="btn-close"
                                                            data-bs-dismiss="modal"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="mb-3">
                                                            <label>Jumlah</label>
                                                            <input type="number" name="jumlah" class="form-control"
                                                                value="{{ $pp->jumlah }}" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label>Deskripsi</label>
                                                            <textarea name="deskripsi" class="form-control" rows="3">{{ $pp->deskripsi }}</textarea>
                                                        </div>

                                                        <div class="mb-3">
                                                            <label>Status</label>
                                                            <select name="status" class="form-select">
                                                                <option value="pending"
                                                                    {{ ($pp->status ?? '') == 'pending' ? 'selected' : '' }}>
                                                                    Pending</option>
                                                                <option value="lunas"
                                                                    {{ ($pp->status ?? '') == 'lunas' ? 'selected' : '' }}>
                                                                    Lunas</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Batal</button>
                                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <p class="text-muted">Belum ada riwayat pembayaran.</p>
                @endif

                <!-- Modal Create Payment Progress -->
                <div class="modal fade" id="createPPModal" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <form action="{{ route('admin.payment-progress.store') }}" method="POST">
                                @csrf
                                <div class="modal-header">
                                    <h5 class="modal-title">Tambah Progres Payment</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                        <input type="hidden" name="payment_id" value="{{ $project->payment?->id }}">

                                    <div class="mb-3">
                                        <label>Jumlah</label>
                                        <input type="number" name="jumlah" class="form-control" required>
                                    </div>

                                    <div class="mb-3">
                                        <label>Deskripsi</label>
                                        <textarea name="deskripsi" class="form-control" rows="3"></textarea>
                                    </div>

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Batal</button>
                                    <button type="submit" class="btn btn-primary">Tambah</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- Modal Edit Proyek -->
                <div class="modal fade" id="editProjectModal" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg">
                        <div class="modal-content">

                            <form action="{{ route('admin.manajemen-proyek.update', $project->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="modal-header">
                                    <h5 class="modal-title">Edit Proyek</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>

                                <div class="modal-body">
                                    <!-- Nama Proyek -->
                                    <div class="mb-3">
                                        <label>Nama Proyek</label>
                                        <input type="text" name="nama_proyek" class="form-control"
                                            value="{{ $project->nama_proyek }}" required>
                                    </div>
                                    <!-- Klien (tidak bisa diubah) -->
                                    <div class="mb-3">
                                        <label>Nama Klien</label>
                                        <div class="form-control-plaintext py-2">
                                            {{ $project->pengunjung->nama ?? '-' }}</div>
                                        <input type="hidden" name="pengunjung_id"
                                            value="{{ $project->pengunjung_id }}">
                                    </div>

                                    <!-- Pengawas -->
                                    <div class="mb-3">
                                        <label>Pengawas</label>
                                        <select name="pengawas_id" class="form-select" required>
                                            @foreach ($pengawas as $p)
                                                <option value="{{ $p->id }}"
                                                    {{ $project->pengawas_id == $p->id ? 'selected' : '' }}>
                                                    {{ $p->nama }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <!-- Desain -->
                                    <div class="mb-3">
                                        <label>Desain</label>
                                        <select name="design_id" class="form-select" required>
                                            @foreach ($designs as $d)
                                                <option value="{{ $d->id }}"
                                                    {{ $project->design_id == $d->id ? 'selected' : '' }}>
                                                    {{ $d->nama }}
                                                </option>
                                            @endforeach
                                        </select>

                                        @if ($project->design && $project->design->cover_image)
                                            <img src="{{ asset('storage/' . $project->design->cover_image) }}"
                                                class="img-fluid rounded mt-2" style="max-height:150px;">
                                        @endif
                                    </div>

                                    <!-- Deskripsi -->
                                    <div class="mb-3">
                                        <label>Deskripsi</label>
                                        <textarea name="deskripsi" class="form-control">{{ $project->deskripsi }}</textarea>
                                    </div>

                                    <!-- Harga -->
                                    <div class="mb-3">
                                        <label>Harga</label>
                                        <input type="number" name="harga" class="form-control"
                                            value="{{ $project->harga }}" required>
                                    </div>

                                    <!-- Status -->
                                    <div class="mb-3">
                                        <label>Status</label>
                                        <select name="status" class="form-select">
                                            <option value="pending" {{ $project->status == 'Pending' ? 'selected' : '' }}>
                                                Pending
                                            </option>
                                            <option value="proses"
                                                {{ $project->status == 'In Progress' ? 'selected' : '' }}>
                                                In
                                                Progress</option>
                                            <option value="selesai"
                                                {{ $project->status == 'Completed' ? 'selected' : '' }}>
                                                Completed
                                            </option>
                                        </select>
                                    </div>

                                    <!-- Alamat -->
                                    <div class="mb-3">
                                        <label>Alamat</label>
                                        <textarea name="alamat" class="form-control">{{ $project->alamat }}</textarea>
                                    </div>

                                    <!-- File Upload -->
                                    <div class="mb-3">
                                        <label>File (Gambar / PDF)</label>

                                        @if (!empty($project->file_path))
                                            @php
                                                $ext = strtolower(pathinfo($project->file_path, PATHINFO_EXTENSION));
                                                $isImage = in_array($ext, ['jpg', 'jpeg', 'png', 'gif', 'webp', 'bmp']);
                                            @endphp

                                            <div class="mb-2 d-flex align-items-center">
                                                @if ($isImage)
                                                    <img src="{{ asset('storage/' . $project->file_path) }}"
                                                        alt="Lampiran" class="rounded me-3" style="max-height:80px;">
                                                @endif

                                                <a href="{{ asset('storage/' . $project->file_path) }}" target="_blank"
                                                    class="btn btn-sm btn-outline-primary me-2">Lihat
                                                    File</a>
                                                <a href="{{ asset('storage/' . $project->file_path) }}" download
                                                    class="btn btn-sm btn-outline-secondary">Download</a>
                                            </div>
                                        @endif

                                        <input type="file" name="file_path" class="form-control"
                                            accept="image/*,.pdf">
                                    </div>

                                    <!-- Tanggal Mulai -->
                                    <div class="mb-3">
                                        <label>Tanggal Mulai</label>
                                        <input type="date" name="tanggal_mulai" class="form-control"
                                            value="{{ $project->tanggal_mulai }}" required>
                                    </div>

                                    <!-- Tanggal Selesai -->
                                    <div class="mb-3">
                                        <label>Tanggal Selesai</label>
                                        <input type="date" name="tanggal_selesai" class="form-control"
                                            value="{{ $project->tanggal_selesai }}" required>
                                    </div>
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Batal</button>
                                    <button type="submit" class="btn btn-primary">Simpan
                                        Perubahan</button>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>

                <!-- Modal Hapus Proyek -->
                <div class="modal fade" id="deleteProjectModal" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <form action="{{ route('admin.manajemen-proyek.delete', $project->id) }}" method="POST">
                                @csrf
                                @method('DELETE')

                                <div class="modal-header bg-danger text-white">
                                    <h5 class="modal-title">Hapus Proyek</h5>
                                    <button type="button" class="btn-close btn-close-white"
                                        data-bs-dismiss="modal"></button>
                                </div>

                                <div class="modal-body text-center">
                                    <p class="mb-0">Yakin ingin menghapus proyek ini?</p>
                                    <strong>{{ $project->nama_proyek }}</strong>
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Batal</button>
                                    <button type="submit" class="btn btn-danger">Ya, Hapus</button>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
                <script>
                    function printPaymentProgress() {
                        const section = document.getElementById('payment-progress-section');
                        if (!section) {
                            alert('Tidak ada data progres untuk dicetak.');
                            return;
                        }

                        const table = section.querySelector('table');
                        if (!table) {
                            alert('Tabel progres tidak ditemukan.');
                            return;
                        }

                        const clone = table.cloneNode(true);
                        let aksiIndex = -1;
                        const headerCells = clone.querySelectorAll('thead th');
                        headerCells.forEach((th, idx) => {
                            if (th.innerText.trim().toLowerCase() === 'aksi') {
                                aksiIndex = idx;
                            }
                        });

                        if (aksiIndex > -1) {
                            clone.querySelectorAll('thead tr').forEach(tr => {
                                if (tr.children[aksiIndex]) tr.removeChild(tr.children[aksiIndex]);
                            });
                            clone.querySelectorAll('tbody tr').forEach(tr => {
                                if (tr.children[aksiIndex]) tr.removeChild(tr.children[aksiIndex]);
                            });
                        }

                        const w = window.open('', '_blank', 'width=900,height=700');
                        const styles = `
            <style>
                body{font-family: Arial, Helvetica, sans-serif; margin:20px}
                table{width:100%; border-collapse: collapse}
                th, td{border:1px solid #ccc; padding:8px; text-align:left}
                th{background:#f5f5f5}
            </style>
        `;

                        w.document.write('<html><head><title>Progres Payment - {{ $project->nama_proyek }}</title>');
                        w.document.write(styles);
                        w.document.write('</head><body>');
                        w.document.write('<h3>Progres Payment - {{ $project->nama_proyek }}</h3>');
                        w.document.write(clone.outerHTML);
                        w.document.write('</body></html>');
                        w.document.close();
                        w.focus();
                        setTimeout(() => {
                            w.print();
                            w.close();
                        }, 300);
                    }
                </script>

            @endsection
