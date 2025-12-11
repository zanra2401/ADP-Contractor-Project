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

                {{-- DESKRIPSI --}}
                <label class="mt-3">Deskripsi</label>
                <textarea name="deskripsi" class="form-control" rows="4">{{ old('deskripsi') }}</textarea>

                {{-- HARGA --}}
                <label class="mt-3">Harga</label>
                <input type="number" name="harga" class="form-control" value="{{ old('harga') }}">

                {{-- KATEGORI --}}
                <label class="mt-3">Kategori</label>
                <select name="kategori[]" class="form-select" multiple>
                    @foreach ($categories as $cat)
                        <option value="{{ $cat->id }}">{{ $cat->nama }}</option>
                    @endforeach
                </select>

                {{-- UPLOAD GAMBAR --}}
                <label class="mt-3">Upload Gambar (bisa banyak)</label>
                <input type="file" name="files[]" class="form-control" multiple>

                {{-- ====================== SPESIFIKASI ====================== --}}
                <label class="mt-4 fw-bold">Spesifikasi</label>

                <div id="specContainer" class="mb-3">

                    <div class="input-group mb-2">
                        <input type="text" name="spesifikasi[]" class="form-control"
                               placeholder="contoh: 2 Kamar Tidur">
                        <button type="button" class="btn btn-danger removeSpec d-none">X</button>
                    </div>

                </div>

                <button type="button" onclick="addSpec()" class="btn btn-outline-primary btn-sm mb-4">
                    + Tambah Spesifikasi
                </button>

                {{-- BUTTON --}}
                <button class="btn btn-primary mt-3">Simpan</button>
            </form>

        </div>
    </div>
</div>

{{--===== JAVASCRIPT =====--}}
<script>
function addSpec(){
    let html = `
        <div class="input-group mb-2">
            <input type="text" name="spesifikasi[]" class="form-control" placeholder="contoh: 2 Kamar Tidur">
            <button type="button" class="btn btn-danger removeSpec">X</button>
        </div>
    `;
    document.getElementById('specContainer').insertAdjacentHTML('beforeend', html);
}

document.addEventListener('click', function(e){
    if(e.target.classList.contains('removeSpec')){
        e.target.parentElement.remove();
    }
});
</script>

@endsection
