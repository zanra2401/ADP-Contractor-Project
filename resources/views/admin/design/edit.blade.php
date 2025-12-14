@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">

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

                {{-- ================= BAGIAN KATEGORI (CHECKBOX) ================= --}}
                <label class="mt-3">Kategori</label>
                
                {{-- Container Checkbox agar rapi dan ada border --}}
                <div class="border rounded p-3" style="max-height: 200px; overflow-y: auto; background-color: #f8f9fa;">
                    
                    @foreach ($categories as $cat)
                        <div class="form-check mb-2">
                            <input class="form-check-input" type="checkbox" 
                                name="kategori[]" 
                                value="{{ $cat->id }}" 
                                id="cat_{{ $cat->id }}"
                                {{-- Cek jika kategori ini sudah dipilih sebelumnya --}}
                                @if ($design->categories->contains($cat->id)) checked @endif
                            >
                            <label class="form-check-label" for="cat_{{ $cat->id }}">
                                {{ $cat->nama }}
                            </label>
                        </div>
                    @endforeach

                </div>
                <small class="text-muted d-block mt-1">* Anda dapat memilih lebih dari satu kategori.</small>
                {{-- =============================================================== --}}


                <label class="mt-4 fw-bold">Spesifikasi</label>

                <div id="specContainer" class="mb-3">
                    @foreach ($design->specs as $spec)
                        <div class="input-group mb-2">
                            <input type="text" name="spesifikasi[]" value="{{ $spec->spesifikasi }}" class="form-control">
                            <button type="button" class="btn btn-danger removeSpec">
                                <i class="bi bi-trash"></i>
                            </button>
                        </div>
                    @endforeach

                    @if($design->specs->isEmpty())
                    <div class="input-group mb-2">
                        <input type="text" name="spesifikasi[]" class="form-control" placeholder="Tambah spesifikasi baru">
                        <button type="button" class="btn btn-danger removeSpec">
                            <i class="bi bi-trash"></i>
                        </button>
                    </div>
                    @endif
                </div>

                <button type="button" onclick="addSpec()" class="btn btn-outline-primary w-100 mb-4 border-dashed">
                    <i class="bi bi-plus-lg"></i> Tambah Spesifikasi
                </button>

                <hr>

                <div class="d-flex justify-content-end mt-3">
                    <button class="btn btn-success px-4">
                        <i class="bi bi-save me-1"></i> Simpan Perubahan
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
    /* Style tambahan untuk checkbox container agar terlihat seperti input group */
    .form-check-input:checked {
        background-color: #0d6efd;
        border-color: #0d6efd;
    }
</style>

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
        e.target.parentElement.remove();
    }
});
</script>

@endsection