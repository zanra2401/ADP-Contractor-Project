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


                {{-- ================= SPESIFIKASI ================= --}}
                <label class="mt-4 fw-bold">Spesifikasi</label>

                <div id="specContainer" class="mb-3">

                    @foreach ($design->specs as $spec)
                        <div class="input-group mb-2">
                            <input type="text" name="spesifikasi[]" value="{{ $spec->spesifikasi }}" class="form-control">
                            <button type="button" class="btn btn-danger removeSpec">X</button>
                        </div>
                    @endforeach

                    {{-- dummy kosong --}}
                    <div class="input-group mb-2">
                        <input type="text" name="spesifikasi[]" class="form-control" placeholder="Tambah spesifikasi baru">
                        <button type="button" class="btn btn-danger removeSpec d-none">X</button>
                    </div>
                </div>

                <button type="button" onclick="addSpec()" class="btn btn-outline-primary btn-sm mb-3">
                    + Tambah Spesifikasi
                </button>



                <button class="btn btn-success mt-4">Simpan Perubahan</button>
            </form>

        </div>
    </div>


</div>


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
