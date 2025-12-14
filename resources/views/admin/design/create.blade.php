@extends('layouts.app')

@section('content')
{{-- Load Icon Bootstrap --}}
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">

<nav class="navbar navbar-light bg-white border-bottom p-3 shadow-sm mb-4">
    <h4 class="m-0">➕ Tambah Desain</h4>
</nav>

<div class="p-4">
    <div class="card shadow-sm mb-4">
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
                <input type="text" name="nama" class="form-control" value="{{ old('nama') }}" placeholder="Masukkan nama desain...">

                {{-- DESKRIPSI --}}
                <label class="mt-3">Deskripsi</label>
                <textarea name="deskripsi" class="form-control" rows="4">{{ old('deskripsi') }}</textarea>

                {{-- HARGA --}}
                <label class="mt-3">Harga</label>
                <input type="number" name="harga" class="form-control" value="{{ old('harga') }}" placeholder="0">

                {{-- KATEGORI (CHECKBOX STYLE) --}}
                <label class="mt-3">Kategori</label>
                <div class="border rounded p-3" style="max-height: 200px; overflow-y: auto; background-color: #f8f9fa;">
                    @foreach ($categories as $cat)
                        <div class="form-check mb-2">
                            <input class="form-check-input" type="checkbox" 
                                name="kategori[]" 
                                value="{{ $cat->id }}" 
                                id="cat_{{ $cat->id }}"
                                {{-- Agar checkbox tetap terpilih jika terjadi error validasi --}}
                                @if(is_array(old('kategori')) && in_array($cat->id, old('kategori'))) checked @endif
                            >
                            <label class="form-check-label" for="cat_{{ $cat->id }}">
                                {{ $cat->nama }}
                            </label>
                        </div>
                    @endforeach
                </div>
                <small class="text-muted">* Pilih satu atau lebih kategori.</small>

                {{-- UPLOAD GAMBAR --}}
                <label class="mt-3">Upload Gambar</label>
                <input type="file" name="files[]" class="form-control" multiple>
                <small class="text-muted d-block mb-3">* Bisa memilih banyak gambar sekaligus.</small>

                {{-- ====================== SPESIFIKASI ====================== --}}
                <label class="mt-4 fw-bold">Spesifikasi</label>

                <div id="specContainer" class="mb-3">
                    {{-- Input Pertama (Default) --}}
                    <div class="input-group mb-2">
                        <input type="text" name="spesifikasi[]" class="form-control" placeholder="contoh: 2 Kamar Tidur">
                        <button type="button" class="btn btn-danger removeSpec">
                            <i class="bi bi-trash"></i>
                        </button>
                    </div>
                </div>

                {{-- Tombol Tambah Spesifikasi --}}
                <button type="button" onclick="addSpec()" class="btn btn-outline-primary w-100 mb-4 border-dashed">
                    <i class="bi bi-plus-lg"></i> Tambah Spesifikasi
                </button>

                <hr>

                {{-- Tombol Simpan di Kanan --}}
                <div class="d-flex justify-content-end mt-3">
                    <button class="btn btn-primary px-4">
                        <i class="bi bi-save me-1"></i> Simpan Data
                    </button>
                </div>

            </form>

        </div>
    </div>
</div>

<style>
    .border-dashed {
        border-style: dashed;
        border-width: 2px;
    }
    .removeSpec i {
        pointer-events: none;
    }
    .form-check-input:checked {
        background-color: #0d6efd;
        border-color: #0d6efd;
    }
</style>

{{--===== JAVASCRIPT =====--}}
<script>
function addSpec(){
    let html = `
        <div class="input-group mb-2">
            <input type="text" name="spesifikasi[]" class="form-control" placeholder="contoh: 2 Kamar Tidur">
            <button type="button" class="btn btn-danger removeSpec">
                <i class="bi bi-trash"></i>
            </button>
        </div>
    `;
    document.getElementById('specContainer').insertAdjacentHTML('beforeend', html);
}

document.addEventListener('click', function(e){
    if(e.target.classList.contains('removeSpec')){
        // Cek agar minimal sisa 1 input (opsional, jika ingin wajib ada 1 spec)
        // Jika boleh kosong semua, baris if di bawah bisa dihapus
        if(document.querySelectorAll('input[name="spesifikasi[]"]').length > 1){
            e.target.parentElement.remove();
        } else {
            // Jika tinggal 1, hanya kosongkan nilainya
            e.target.parentElement.querySelector('input').value = '';
        }
    }
});
</script>

@endsection