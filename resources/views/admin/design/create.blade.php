@extends('layouts.app')

@section('content')
<nav class="navbar navbar-light bg-white border-bottom p-3 shadow-sm mb-4">
    <h4 class="m-0">➕ Tambah Desain</h4>
</nav>

<div class="p-4">
    <div class="card shadow-sm">
        <div class="card-body">

            {{-- ALERT ERROR --}}
            @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>Terjadi kesalahan:</strong>
                    <ul class="mt-2 mb-0">
                        @foreach ($errors->all() as $err)
                            <li>{{ $err }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.design.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                {{-- NAMA --}}
                <label class="mt-3">Nama Desain</label>
                <input type="text" name="nama" class="form-control" value="{{ old('nama') }}">
                @error('nama')
                    <small class="text-danger">{{ $message }}</small>
                @enderror

                {{-- DESKRIPSI --}}
                <label class="mt-3">Deskripsi</label>
                <textarea name="deskripsi" class="form-control" rows="4">{{ old('deskripsi') }}</textarea>
                @error('deskripsi')
                    <small class="text-danger">{{ $message }}</small>
                @enderror

                {{-- HARGA --}}
                <label class="mt-3">Harga</label>
                <input type="number" name="harga" class="form-control" value="{{ old('harga') }}">
                @error('harga')
                    <small class="text-danger">{{ $message }}</small>
                @enderror

                {{-- KATEGORI --}}
                <label class="mt-3">Kategori</label>
                <select name="kategori[]" class="form-select" multiple>
                    @foreach ($categories as $cat)
                        <option value="{{ $cat->id }}">{{ $cat->nama }}</option>
                    @endforeach
                </select>
                @error('kategori')
                    <small class="text-danger">{{ $message }}</small>
                @enderror

                {{-- UPLOAD GAMBAR --}}
                <label class="mt-3">Upload Gambar (bisa banyak)</label>
                <input type="file" name="files[]" class="form-control" multiple>
                @error('files')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
                @error('files.*')
                    <small class="text-danger">{{ $message }}</small>
                @enderror

                {{-- BUTTON --}}
                <button class="btn btn-primary mt-4">Simpan</button>
            </form>

        </div>
    </div>
</div>
@endsection
