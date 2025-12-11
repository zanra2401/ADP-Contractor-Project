@extends('layouts.app')

@section('title', 'Upload Progress')

@section('content')
    <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom p-3 mb-4 shadow-sm">
        <div class="container-fluid">
            <h1 class="h3 mb-0">📤 Upload Progress</h1>
        </div>
    </nav>

    <div class="p-4">
        <div class="card shadow-sm">
            <div class="card-header fw-bold bg-white">Laporkan Kemajuan Proyek</div>
            <div class="card-body">

                {{-- tampilkan error --}}
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                <div class="mb-3 text-end">
                    <a href="{{ route('admin.progress.index') }}" class="btn btn-outline-primary">
                        Lihat Semua Progress
                    </a>
                </div>

                <form action="{{ route('admin.progress.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    {{-- Pilih proyek --}}
                    <div class="mb-3">
                        <label class="form-label">Pilih Proyek</label>
                        <select class="form-select" name="project_id" required>
                            <option disabled selected>-- Pilih Proyek --</option>
                            @foreach ($projects as $project)
                                <option value="{{ $project->id }}">{{ $project->nama_proyek }}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Deskripsi --}}
                    <div class="mb-3">
                        <label class="form-label">Deskripsi</label>
                        <textarea class="form-control" name="deskripsi" rows="3" required></textarea>
                    </div>

                    {{-- Status --}}
                    <div class="mb-3">
                        <label class="form-label">Status Progres</label>
                        <select class="form-select" name="status_publikasi" required>
                            <option disabled selected>-- Pilih Status --</option>
                            <option value="menunggu">Menunggu</option>
                            <option value="disetujui">Disetujui</option>
                            <option value="ditolak">Ditolak</option>
                        </select>
                    </div>

                    {{-- Upload file --}}
                    <div class="mb-4">
                        <label class="form-label">Upload File</label>
                        <input class="form-control" type="file" name="file" accept=".jpg,.png,.jpeg,.mp4,.pdf">
                    </div>

                    <div class="d-flex justify-content-end">
                        <button type="reset" class="btn btn-secondary me-2">Reset</button>
                        <button type="submit" class="btn btn-primary">Kirim Laporan</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection
