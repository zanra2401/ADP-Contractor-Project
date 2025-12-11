@extends('layouts.app')

@section('content')
<nav class="navbar navbar-light bg-white border-bottom p-3 shadow-sm mb-4">
    <h4 class="m-0">📁 Manajemen Desain</h4>
</nav>

<div class="p-4">
    <a href="{{ route('admin.design.create') }}" class="btn btn-primary mb-3">+ Tambah Desain</a>

    <div class="card shadow-sm">
        <div class="card-body">

            <table class="table table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>Gambar</th>
                        <th>Nama</th>
                        <th>Kategori</th>
                        <th>Spesifikasi</th>
                        <th>Deskripsi</th>
                        <th>Harga</th>
                        <th>Aksi</th>
                    </tr>
                </thead>


                <tbody>
                @foreach ($designs as $d)
                    <tr>
                        <td>
                            <img
                                src="{{ asset('storage/' . ($d->contents->first()->file_path ?? 'placeholder.jpg')) }}"
                                alt="{{ $d->nama }}"
                                style="width:100px;height:60px;object-fit:cover;border-radius:8px;"
                            >
                        </td>
                        <td>{{ $d->nama }}</td>

                        <td>
                            @foreach ($d->categories as $c)
                                <span class="badge bg-info">{{ $c->nama }}</span>
                            @endforeach
                        </td>
                        <td>
                            <ul class="mb-0 ps-3">
                                @foreach($d->specs as $s)
                                    <li>{{ $s->spesifikasi }}</li>
                                @endforeach
                            </ul>
                        </td>


                        <td>{{ Str::limit($d->deskripsi, 50) }}</td>

                        <td>Rp {{ number_format($d->harga,0,',','.') }}</td>

                        <td>
                            <a href="{{ route('admin.design.edit', $d->id) }}" class="btn btn-warning btn-sm">Edit</a>

                            <form action="{{ route('admin.design.destroy',$d->id) }}" method="POST" class="d-inline">
                                @csrf @method('DELETE')
                                <button onclick="return confirm('Hapus desain?')" class="btn btn-danger btn-sm">
                                    Hapus
                                </button>
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
