@extends('layouts.app')

@section('title', 'Payment')

@section('content')
    <!-- TOP NAVBAR -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom p-3 mb-4 shadow-sm">
        <div class="container-fluid">
            <h1 class="h3 mb-0">💳 Payment</h1>
            
            <div class="ms-auto d-flex align-items-center">
                <div class="dropdown">
                    <a href="#" class="nav-link text-dark" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        🔔 <span class="badge rounded-pill bg-danger">3</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="#">Notifikasi 1: Pembayaran baru diterima.</a></li>
                        <li><a class="dropdown-item" href="#">Notifikasi 2: Invoice INV-003 jatuh tempo.</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <div class="p-4">
        <p class="lead mb-4">Pantau status pembayaran dari klien.</p>

        <div class="card shadow-sm">
            <div class="card-header d-flex justify-content-between align-items-center bg-white">
                <h5 class="mb-0">Daftar Transaksi</h5>
                <button class="btn btn-outline-secondary btn-sm">
                    <span class="me-1">⬇️</span> Export Excel
                </button>
            </div>
            <div class="card-body p-0">
                <table class="table table-striped table-hover align-middle mb-0">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col" class="ps-4">ID Invoice</th>
                            <th>Klien</th>
                            <th>Jumlah</th>
                            <th>Status</th>
                            <th class="text-end pe-4">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="ps-4 fw-bold">INV-001</td>
                            <td>PT. Maju Jaya</td>
                            <td>Rp 10.000.000</td>
                            <td><span class="badge text-bg-success">Paid</span></td>
                            <td class="text-end pe-4">
                                <button class="btn btn-sm btn-info text-white" 
                                    onclick="showInvoiceModal('INV-001', 'PT. Maju Jaya', 'Rp 10.000.000', 'Paid', '10 Nov 2025')">
                                    Lihat Invoice
                                </button>
                            </td>
                        </tr>
                        
                        <tr>
                            <td class="ps-4 fw-bold">INV-002</td>
                            <td>Bank B</td>
                            <td>Rp 5.000.000</td>
                            <td><span class="badge text-bg-warning text-dark">Pending</span></td>
                            <td class="text-end pe-4">
                                <button class="btn btn-sm btn-info text-white"
                                    onclick="showInvoiceModal('INV-002', 'Bank B', 'Rp 5.000.000', 'Pending', '-')">
                                    Lihat Invoice
                                </button>
                            </td>
                        </tr>

                        <tr>
                            <td class="ps-4 fw-bold">INV-003</td>
                            <td>CV. Sejahtera</td>
                            <td>Rp 2.500.000</td>
                            <td><span class="badge text-bg-danger">Cancelled</span></td>
                            <td class="text-end pe-4">
                                <button class="btn btn-sm btn-info text-white"
                                    onclick="showInvoiceModal('INV-003', 'CV. Sejahtera', 'Rp 2.500.000', 'Cancelled', '-')">
                                    Lihat Invoice
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- ================================ -->
    <!-- MODAL: DETAIL INVOICE            -->
    <!-- ================================ -->
    <div class="modal fade" id="invoiceModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-light">
                    <h5 class="modal-title">Detail Invoice: <span id="modalInvId"></span></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3 row">
                        <label class="col-sm-4 col-form-label fw-bold">Klien</label>
                        <div class="col-sm-8">
                            <input type="text" readonly class="form-control-plaintext" id="modalClient">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label class="col-sm-4 col-form-label fw-bold">Jumlah</label>
                        <div class="col-sm-8">
                            <input type="text" readonly class="form-control-plaintext fs-5 fw-bold text-primary" id="modalAmount">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label class="col-sm-4 col-form-label fw-bold">Status</label>
                        <div class="col-sm-8">
                            <span id="modalStatusBadge" class="badge"></span>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label class="col-sm-4 col-form-label fw-bold">Tanggal Bayar</label>
                        <div class="col-sm-8">
                            <input type="text" readonly class="form-control-plaintext" id="modalDate">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="button" class="btn btn-primary" onclick="window.print()">Cetak</button>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
<script>
    let invoiceModal;

    document.addEventListener('DOMContentLoaded', function () {
        invoiceModal = new bootstrap.Modal(document.getElementById('invoiceModal'));
    });

    function showInvoiceModal(id, client, amount, status, date) {
        // Isi data ke modal
        document.getElementById('modalInvId').innerText = id;
        document.getElementById('modalClient').value = client;
        document.getElementById('modalAmount').value = amount;
        document.getElementById('modalDate').value = date;

        // Atur warna badge status
        const badge = document.getElementById('modalStatusBadge');
        badge.innerText = status;
        badge.className = 'badge'; // Reset class
        
        if(status === 'Paid') {
            badge.classList.add('text-bg-success');
        } else if(status === 'Pending') {
            badge.classList.add('text-bg-warning', 'text-dark');
        } else {
            badge.classList.add('text-bg-danger');
        }

        // Tampilkan modal
        invoiceModal.show();
    }
</script>
@endpush