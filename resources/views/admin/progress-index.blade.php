@extends('layouts.app')

@section('title', 'Daftar Progress')

@section('content')
    <div class="container p-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="mb-0">📊 Daftar Progress Proyek</h3>
            <a href="{{ route('admin.upload-progress') }}" class="btn btn-secondary">
                ← Kembali
            </a>
        </div>


        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="card shadow-sm">
            <div class="table-responsive">
                <table class="table table-bordered align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Pengunjung</th>
                            <th>Nama Proyek</th>
                            <th>Deskripsi</th>
                            <th>Status</th>
                            <th>File</th>
                            <th>Tanggal</th>
                            <th style="width:140px">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            use Illuminate\Support\Str;
                            $grouped = $progress->groupBy(function ($item) {
                                return optional($item->project->pengunjung)->id;
                            });
                        @endphp

                        @foreach ($grouped as $userId => $items)
                            @php
                                $first = $items->first();
                                $pengunjung = optional($first->project->pengunjung)->nama ?? '-';
                                $rowspan = $items->count();
                            @endphp

                            @foreach ($items as $index => $p)
                                <tr>
                                    {{-- No --}}
                                    @if ($index == 0)
                                        <td rowspan="{{ $rowspan }}" style="vertical-align: middle; font-weight: 600;">
                                            {{ $loop->parent->iteration }}
                                        </td>
                                    @endif


                                    {{-- Nama Pengunjung (hanya tampil sekali pakai rowspan) --}}
                                    @if ($index == 0)
                                        <td rowspan="{{ $rowspan }}" style="vertical-align: middle; font-weight: 600;">
                                            {{ $pengunjung }}
                                        </td>
                                    @endif

                                    {{-- Nama Proyek --}}
                                    <td>{{ $p->project->nama_proyek ?? '-' }}</td>

                                    {{-- Deskripsi --}}
                                    <td>{{ $p->deskripsi }}</td>

                                    {{-- Status --}}
                                    <td>
                                        <span class="badge bg-secondary">
                                            {{ ucfirst($p->status_publikasi) }}
                                        </span>
                                    </td>

                                    {{-- File --}}
                                    <td>
                                        @if ($p->file_path)
                                            <a href="{{ asset('storage/' . $p->file_path) }}" target="_blank">Lihat</a>
                                        @else
                                            -
                                        @endif
                                    </td>

                                    {{-- Tanggal --}}
                                    <td>{{ \Carbon\Carbon::parse($p->tanggal_upload)->format('d/m/Y') }}</td>

                                    {{-- Aksi --}}
                                    <td>
                                        <button class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#editModal{{ $p->id }}">
                                            Edit
                                        </button>

                                        <button class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#deleteModal{{ $p->id }}">
                                            Hapus
                                        </button>
                                    </td>
                                </tr>

                                {{-- Modal Edit --}}
                                <div class="modal fade" id="editModal{{ $p->id }}" tabindex="-1">
                                    <div class="modal-dialog modal-lg">
                                        <form action="{{ route('admin.progress.update', $p->id) }}" method="POST"
                                            enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')

                                            <div class="modal-content">
                                                <div class="modal-header bg-warning">
                                                    <h5 class="modal-title text-dark">Edit Progress</h5>
                                                    <button type="button" class="btn-close"
                                                        data-bs-dismiss="modal"></button>
                                                </div>

                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label>Deskripsi</label>
                                                        <textarea name="deskripsi" class="form-control" required>{{ $p->deskripsi }}</textarea>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label>File (optional)</label>
                                                        <input type="file" name="file" class="form-control">
                                                        @if ($p->file_path)
                                                            <small class="text-muted">
                                                                File lama:
                                                                <a href="{{ asset('storage/' . $p->file_path) }}"
                                                                    target="_blank">Lihat</a>
                                                            </small>
                                                        @endif
                                                    </div>

                                                    <div class="mb-3">
                                                        <label>Status</label>
                                                        <select name="status_publikasi" class="form-control">
                                                            <option value="menunggu"
                                                                {{ $p->status_publikasi == 'menunggu' ? 'selected' : '' }}>
                                                                Menunggu</option>
                                                            <option value="disetujui"
                                                                {{ $p->status_publikasi == 'disetujui' ? 'selected' : '' }}>
                                                                Disetujui</option>
                                                            <option value="ditolak"
                                                                {{ $p->status_publikasi == 'ditolak' ? 'selected' : '' }}>
                                                                Ditolak</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="modal-footer">
                                                    <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                    <button class="btn btn-warning text-dark">Simpan Perubahan</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>

                                {{-- Modal Hapus --}}
                                <div class="modal fade" id="deleteModal{{ $p->id }}" tabindex="-1">
                                    <div class="modal-dialog">
                                        <form action="{{ route('admin.progress.destroy', $p->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')

                                            <div class="modal-content">
                                                <div class="modal-header bg-danger text-white">
                                                    <h5 class="modal-title">Konfirmasi Hapus</h5>
                                                    <button type="button" class="btn-close"
                                                        data-bs-dismiss="modal"></button>
                                                </div>

                                                <div class="modal-body">
                                                    <p>Yakin mau hapus progress ini?</p>
                                                    <p><strong>{{ $p->deskripsi }}</strong></p>
                                                </div>

                                                <div class="modal-footer">
                                                    <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                    <button class="btn btn-danger">Ya, Hapus</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
