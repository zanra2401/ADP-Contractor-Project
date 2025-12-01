<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>

    <div class="d-flex">

        <nav class="d-flex flex-column flex-shrink-0 p-3 text-bg-dark" style="width: 280px; min-height: 100vh;">
            <a href="{{ route('dashboard') }}" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                <span class="fs-4">Admin Panel</span>
            </a>
            <hr>
            <ul class="nav nav-pills flex-column mb-auto">
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}" class="nav-link active" aria-current="page">
                        🏠 Dashboard
                    </a>
                </li>
                <li>
                    <a href="{{ route('laporan') }}" class="nav-link text-white">
                        📈 Laporan
                    </a>
                </li>
                <li>
                    <a href="{{ route('manajemen.konten') }}" class="nav-link text-white">
                        📝 Manajemen Konten
                    </a>
                </li>
                <li>
                    <a href="{{ route('manajemen.proyek') }}" class="nav-link text-white">
                        🗂️ Manajemen Proyek
                    </a>
                </li>
                <li>
                    <a href="{{ route('manajemen.user') }}" class="nav-link text-white">
                        👥 Manajemen User
                    </a>
                </li>
                 <li>
                    <a href="{{ route('chat.admin') }}" class="nav-link text-white">
                        💬 Chat Admin
                    </a>
                </li>
                <li>
                    <a href="{{ route('payment') }}" class="nav-link text-white">
                        💳 UI Payment
                    </a>
                </li>
                <li class="nav-item mt-2">
                    <span class="fs-6 text-secondary">Fitur Proyek</span>
                </li>
                 <li>
                    <a href="{{ route('simpan.desain') }}" class="nav-link text-white">
                        🎨 UI Simpan desain
                    </a>
                </li>
                 <li>
                    <a href="{{ route('upload.progress') }}" class="nav-link text-white">
                        📤 UI Upload Progress
                    </a>
                </li>
                <li>
                    <a href="{{ route('approve.progress') }}" class="nav-link text-white">
                        👍 UI Approve Progress
                    </a>
                </li>
                <li>
                    <a href="{{ route('set.harga') }}" class="nav-link text-white">
                        💲 UI Set Harga proyek
                    </a>
                </li>
            </ul>
        </nav>

        <main class="flex-grow-1" style="background-color: #f8f9fa;">
            
            @yield('content')

        </main>
        
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    @stack('scripts')
</body>
</html>