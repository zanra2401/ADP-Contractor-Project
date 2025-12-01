@extends('layouts.app')

@section('content')
    <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom p-3 mb-4 shadow-sm">
        <div class="container-fluid">
            <h1 class="h3 mb-0">💳 Payment</h1>
        </div>
    </nav>

    <div class="p-4">
        <p class="lead">Pantau status pembayaran dari klien.</p>

        <div class="card shadow-sm">
            <div class="card-header fw-bold">Daftar Transaksi</div>
            <div class="card-body">
                <table class="table table-hover align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>ID Invoice</th>
                            <th>Klien</th>
                            <th>Jumlah</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="fw-bold">INV-001</td>
                            <td>PT. Maju Jaya</td>
                            <td>Rp 10.000.000</td>
                            <td><span class="badge text-bg-success">Paid</span></td>
                            <td>
                                <button class="btn btn-sm btn-info text-white">Lihat Invoice</button>
                            </td>
                        </tr>
                        
                        <tr>
                            <td class="fw-bold">INV-002</td>
                            <td>Bank B</td>
                            <td>Rp 5.000.000</td>
                            <td><span class="badge text-bg-warning text-dark">Pending</span></td>
                            <td>
                                <button class="btn btn-sm btn-info text-white">Lihat Invoice</button>
                            </td>
                        </tr>

                         <tr>
                            <td class="fw-bold">INV-003</td>
                            <td>CV. Sejahtera</td>
                            <td>Rp 2.500.000</td>
                            <td><span class="badge text-bg-danger">Cancelled</span></td>
                            <td>
                                <button class="btn btn-sm btn-info text-white">Lihat Invoice</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection