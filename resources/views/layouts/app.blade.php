<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    
    <style>
        /* CSS Tambahan agar sidebar rapi di Desktop */
        @media (min-width: 992px) {
            .sidebar {
                width: 280px;
                height: 100vh;
                position: sticky;
                top: 0;
            }
        }
    </style>
</head>
<body>

    <div class="d-flex min-vh-100">

        <div class="offcanvas-lg offcanvas-start text-bg-dark sidebar d-flex flex-column flex-shrink-0" tabindex="-1" id="sidebarMenu" aria-labelledby="sidebarMenuLabel">
            
            <div class="d-flex align-items-center justify-content-between p-3">
                <a href="{{ route('admin.dashboard') }}" class="d-flex align-items-center text-white text-decoration-none">
                    <span class="fs-4 fw-bold">Admin Panel</span>
                </a>
                <button type="button" class="btn-close btn-close-white d-lg-none" data-bs-dismiss="offcanvas" data-bs-target="#sidebarMenu" aria-label="Close"></button>
            </div>
            
            <hr class="my-0">

            <div class="offcanvas-body d-block p-3">
                <ul class="nav nav-pills flex-column mb-auto">
                    <li class="nav-item">
                        <a href="{{ route('admin.dashboard') }}" class="nav-link text-white {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                            🏠 Dashboard
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.laporan') }}" class="nav-link text-white {{ request()->routeIs('admin.laporan') ? 'active' : '' }}">
                            📈 Laporan
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.manajemen-konten') }}" class="nav-link text-white {{ request()->routeIs('admin.manajemen-konten') ? 'active' : '' }}">
                            📝 Manajemen Konten
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.manajemen-proyek') }}" class="nav-link text-white {{ request()->routeIs('admin.manajemen-proyek') ? 'active' : '' }}">
                            🗂️ Manajemen Proyek
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.manajemen-user') }}" class="nav-link text-white {{ request()->routeIs('admin.manajemen-user') ? 'active' : '' }}">
                            👥 Manajemen User
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.payment') }}" class="nav-link text-white {{ request()->routeIs('admin.payment') ? 'active' : '' }}">
                            💳 UI Payment
                        </a>
                    </li>
                    
                    <li class="nav-item mt-3 mb-1">
                        <span class="fs-6 text-secondary text-uppercase fw-bold" style="font-size: 0.8rem;">Fitur Proyek</span>
                    </li>
                    
                     <li>
                        <a href="{{ route('admin.design.index') }}" class="nav-link text-white {{ request()->routeIs('admin.design.index') ? 'active' : '' }}">
                            🎨 Manajemen Design
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.kategori.index') }}" class="nav-link text-white {{ request()->routeIs('admin.kategori.index') ? 'active' : '' }}">
                            📂 Manajemen Kategori
                        </a>
                    </li>
                     <li>
                        <a href="{{ route('admin.upload-progress') }}" class="nav-link text-white {{ request()->routeIs('admin.upload-progress') ? 'active' : '' }}">
                            📤 UI Upload Progress
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.approve-progress') }}" class="nav-link text-white {{ request()->routeIs('admin.approve-progress') ? 'active' : '' }}">
                            👍 UI Approve Progress
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.set-harga') }}" class="nav-link text-white {{ request()->routeIs('admin.set-harga') ? 'active' : '' }}">
                            💲 UI Set Harga
                        </a>
                    </li>
                    
                    <li class="nav-item mt-4 border-top border-secondary pt-3">
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="nav-link text-white w-100 text-start bg-transparent border-0">
                                🚪 Logout
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>

        <main class="flex-grow-1" style="background-color: #f8f9fa; min-height: 100vh;">
            
            <nav class="navbar navbar-light bg-white shadow-sm d-lg-none mb-4 p-3">
                <div class="container-fluid">
                    <span class="navbar-brand mb-0 h1">Admin Dashboard</span>
                    <button class="btn btn-dark" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu">
                        ☰ Menu
                    </button>
                </div>
            </nav>

            <div class="container-fluid">
                @yield('content')
            </div>

        </main>
        
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    @stack('scripts')
</body>
</html>