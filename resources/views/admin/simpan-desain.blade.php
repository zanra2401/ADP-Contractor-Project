@extends('layouts.app')

@section('title', 'Simpan Desain')

@section('content')
    <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom p-3 mb-4 shadow-sm">
        <div class="container-fluid">
            <h1 class="h3 mb-0">🎨 Simpan Desain</h1>
        </div>
    </nav>

    <div class="p-4">
        
        <p class="lead mb-4">Unggah file desain untuk proyek yang sedang berjalan.</p>

        <div class="card shadow-sm mt-4">
            <div class="card-header fw-bold bg-white py-3">
                Daftar Desain
            </div>
            
            <div class="card-body p-0">
                
                <div class="table-responsive" style="overflow-x: auto;">
                    
                    <table class="table table-striped table-hover align-middle mb-0 text-nowrap">
                        <thead class="table-dark">
                            <tr>
                                <th class="ps-4">Nama Desain</th>
                                <th>Kategori</th>
                                <th>Deskripsi</th> <th>Harga</th>     <th class="text-end pe-4">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="ps-4 fw-bold">Rumah Minimalis Tipe 45</td>
                                <td><span class="badge bg-info text-dark">Rumah Tinggal</span></td>
                                <td>
                                    <span class="d-inline-block text-truncate" style="max-width: 200px;">
                                        2 Kamar tidur, 1 Kamar mandi, luas tanah 90m...
                                    </span>
                                </td>
                                <td>Rp 450.000.000</td>
                                <td class="text-end pe-4">
                                    <button class="btn btn-sm btn-warning text-white me-1">Edit</button>
                                    <button class="btn btn-sm btn-danger">Hapus</button>
                                </td>
                            </tr>

                            <tr>
                                <td class="ps-4 fw-bold">Ruko 2 Lantai Modern</td>
                                <td><span class="badge bg-secondary">Komersial</span></td>
                                <td>
                                    <span class="d-inline-block text-truncate" style="max-width: 200px;">
                                        Cocok untuk usaha cafe atau kantor startup...
                                    </span>
                                </td>
                                <td>Rp 850.000.000</td>
                                <td class="text-end pe-4">
                                    <button class="btn btn-sm btn-warning text-white me-1">Edit</button>
                                    <button class="btn btn-sm btn-danger">Hapus</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                </div>
                </div>
        </div>

        <div class="card shadow-sm">
            <div class="card-header fw-bold bg-white py-3">
                Riwayat Upload Terakhir
            </div>
            
            <div class="card-body p-0">
                <div class="table-responsive" style="overflow-x: auto;">
                    <table class="table table-hover align-middle mb-0 text-nowrap">
                        <thead class="table-light">
                            <tr>
                                <th class="ps-4">Proyek</th>
                                <th>Nama File</th>
                                <th>Tanggal</th>
                                <th class="text-end pe-4">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="ps-4">
                                    <span class="d-inline-block text-truncate" style="max-width: 150px;">
                                        Redesign Website Klien A
                                    </span>
                                </td>
                                <td>
                                    <span class="d-inline-block text-truncate" style="max-width: 200px;" title="Mockup_Home_v1.jpg">
                                        Mockup_Home_v1.jpg
                                    </span>
                                </td>
                                <td>10 Des 2024</td>
                                <td class="text-end pe-4">
                                    <button class="btn btn-sm btn-outline-primary">Download</button>
                                </td>
                            </tr>
                            
                            <tr>
                                <td class="ps-4">
                                    <span class="d-inline-block text-truncate" style="max-width: 150px;">
                                        Aplikasi Mobile Bank B
                                    </span>
                                </td>
                                <td>
                                    <span class="d-inline-block text-truncate" style="max-width: 200px;" title="UI_Kit_Mobile_Final_Revision_v3.zip">
                                        UI_Kit_Mobile_Final_Revision_v3.zip
                                    </span>
                                </td>
                                <td>09 Des 2024</td>
                                <td class="text-end pe-4">
                                    <button class="btn btn-sm btn-outline-primary">Download</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
@endsection