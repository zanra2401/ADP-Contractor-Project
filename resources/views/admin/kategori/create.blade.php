@extends('layouts.app')

@section('content')

<div class="p-4">
    <div class="card shadow-sm">
        <div class="card-header fw-bold">Tambah Kategori</div>

        <div class="card-body">

            <form action="{{ route('admin.kategori.store') }}" method="POST">
                @csrf

                <label>Nama Kategori</label>
                <input type="text" name="nama" class="form-control">

                <button class="btn btn-primary mt-3">Simpan</button>
            </form>

        </div>
    </div>
</div>

@endsection
