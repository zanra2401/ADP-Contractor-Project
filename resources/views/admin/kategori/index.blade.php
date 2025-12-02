@extends('layouts.app')

@section('content')
<nav class="navbar navbar-light bg-white border-bottom p-3 shadow-sm mb-4">
    <h4 class="m-0">📦 Manajemen Kategori</h4>
</nav>

<div class="p-4">
    <a href="{{ route('admin.kategori.create') }}" class="btn btn-primary mb-3">+ Tambah Kategori</a>

    <div class="card shadow-sm">
        <div class="card-body">
            <table class="table table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>Nama</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($categories as $cat)
                    <tr>
                        <td>{{ $cat->nama }}</td>
                        <td>
                            <a href="{{ route('admin.kategori.edit', $cat->id) }}" class="btn btn-warning btn-sm">Edit</a>

                            <form method="POST" action="{{ route('admin.kategori.destroy', $cat->id) }}" class="d-inline">
                                @csrf @method('DELETE')
                                <button class="btn btn-danger btn-sm" onclick="return confirm('Hapus kategori?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>

            </table>
        </div>
    </div>
</div>
@endsection
