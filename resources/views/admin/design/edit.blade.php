@extends('layouts.app')

@section('content')
<nav class="navbar navbar-light bg-white border-bottom p-3 shadow-sm mb-4">
    <h4 class="m-0">✏️ Edit Desain</h4>
</nav>

<div class="p-4">

    <div class="card shadow-sm mb-4">
        <div class="card-body">

            <form action="{{ route('admin.design.update', $design->id) }}" method="POST">
                @csrf

                <label class="mt-3">Nama Desain</label>
                <input type="text" name="nama" value="{{ $design->nama }}" class="form-control">

                <label class="mt-3">Deskripsi</label>
                <textarea name="deskripsi" class="form-control">{{ $design->deskripsi }}</textarea>

                <label class="mt-3">Harga</label>
                <input type="number" name="harga" value="{{ $design->harga }}" class="form-control">

                <label class="mt-3">Kategori</label>
                <select name="kategori[]" multiple class="form-select">
                    @foreach ($categories as $cat)
                        <option value="{{ $cat->id }}"
                            @if ($design->categories->pluck('id')->contains($cat->id)) selected @endif>
                            {{ $cat->nama }}
                        </option>
                    @endforeach
                </select>

                <button class="btn btn-success mt-4">Simpan Perubahan</button>
            </form>

        </div>
    </div>

    {{-- MEDIA GAMBAR --}}
    <div class="card shadow-sm">
        <div class="card-header fw-bold">📸 Gambar Desain</div>
        <div class="card-body">

            <form action="{{ route('admin.design.media.upload',$design->id) }}"
                  method="POST" enctype="multipart/form-data">
                @csrf

                <input type="file" name="file" class="form-control">
                <button class="btn btn-primary mt-3">Upload Gambar</button>
            </form>

            <hr class="my-4">

            <div class="row">
                @foreach ($design->contents as $img)
                <div class="col-md-3 text-center mb-4">
                    <img src="{{ asset('storage/'.$img->file_path) }}"
                         class="img-fluid rounded mb-2" style="height:140px; object-fit:cover;">

                    <form action="{{ route('admin.design.media.delete', $img->id) }}"
                        method="POST">
                        @csrf @method('DELETE')
                        <button class="btn btn-danger btn-sm">Hapus</button>
                    </form>
                </div>
                @endforeach
            </div>

        </div>
    </div>

</div>
@endsection
