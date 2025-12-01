@extends('layouts.app')

@section('content')
    <!-- 1. Navbar Atas (Khusus Laporan) -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom p-3 mb-4 shadow-sm">
        <div class="container-fluid">
            <h1 class="h3 mb-0">📈 Laporan</h1>
            
            <div class="ms-auto d-flex align-items-center">
                <div class="dropdown">
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="#">Notifikasi 1: Proyek A selesai.</a></li>
                        <li><a class="dropdown-item" href="#">Notifikasi 2: User B mengirim pesan.</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <!-- 2. Konten Grafik -->
    <div class="p-4">
        <div class="card shadow-sm mb-4">
            <div class="card-header">
                Grafik Pendaftaran Pengguna (7 Hari Terakhir)
            </div>
            <div class="card-body">
                <!-- Canvas untuk Chart.js -->
                <canvas id="userChart"></canvas>
            </div>
        </div>
    </div>
@endsection

<!-- 3. Bagian Script Khusus (Dikirim ke stack di layout) -->
@push('scripts')
    <!-- Library Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- Logic Grafik -->
    <script>
        const ctxUser = document.getElementById('userChart');
        new Chart(ctxUser, {
            type: 'line',
            data: {
                labels: ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'],
                datasets: [{
                    label: 'Pendaftaran Baru',
                    data: [12, 19, 3, 5, 2, 3, 7],
                    fill: false,
                    borderColor: 'rgb(75, 192, 192)',
                    tension: 0.1
                }]
            },
            options: {
                responsive: true
            }
        });
    </script>
@endpush