@extends('layouts.app')

@section('content')

<div class="p-4">
    <div class="card shadow-sm">
        <div class="card-header fw-bold">Edit Kategori</div>

        <div class="card-body">

            <form action="{{ route('admin.kategori.update', $category->id) }}" method="POST">
                @csrf

                <label>Nama Kategori</label>
                <input type="text" name="nama" class="form-control" value="{{ $category->nama }}">

                <button class="btn btn-success mt-3">Update</button>
            </form>

        </div>
    </div>
</div>

@endsection
