<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>@yield('title', 'Admin Dashboard')</title>
    <script src="https://cdn.tailwindcss.com"></script>

    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        /* Sidebar Desktop Styling */
        @media (min-width: 992px) {
            .sidebar {
                width: 250px;
                height: 100vh;
                position: sticky;
                top: 0;
                overflow-y: auto; /* Agar sidebar bisa di-scroll jika menu panjang */
            }
            .main-content {
                flex: 1; /* Mengisi sisa ruang */
                width: calc(100% - 250px); /* Mencegah overflow */
            }
        }

        /* Sidebar Mobile Styling */
        @media (max-width: 991.98px) {
            .sidebar {
                width: 100%; /* Offcanvas mengambil alih */
            }
            .main-content {
                width: 100%;
            }
        }
        
        /* Global Fix */
        body { background-color: #f8f9fa; }
    </style>
</head>
<body>

    <div class="d-flex flex-column flex-lg-row min-vh-100">

        <div class="offcanvas-lg offcanvas-start bg-dark text-white sidebar d-flex flex-column p-3" tabindex="-1" id="sidebarMenu" aria-labelledby="sidebarMenuLabel">
            
            <div class="d-flex align-items-center justify-content-between mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                <span class="fs-4 fw-bold">Admin Panel</span>
                <button type="button" class="btn-close btn-close-white d-lg-none" data-bs-dismiss="offcanvas" data-bs-target="#sidebarMenu" aria-label="Close"></button>
            </div>
            
            <hr>
            
            <ul class="nav nav-pills flex-column mb-auto">
                <li class="nav-item">
                    <a href="{{ route('admin.dashboard') }}" class="nav-link text-white {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                        <i class="bi bi-speedometer2 me-2"></i> Dashboard
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.laporan') }}" class="nav-link text-white {{ request()->routeIs('admin.laporan') ? 'active' : '' }}">
                        <i class="bi bi-graph-up me-2"></i> Laporan
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.manajemen-konten') }}" class="nav-link text-white {{ request()->routeIs('admin.manajemen-konten') ? 'active' : '' }}">
                        <i class="bi bi-file-text me-2"></i> Manajemen Konten
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.manajemen-proyek') }}" class="nav-link text-white {{ request()->routeIs('admin.manajemen-proyek') ? 'active' : '' }}">
                        <i class="bi bi-briefcase me-2"></i> Manajemen Proyek
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.manajemen-user') }}" class="nav-link text-white {{ request()->routeIs('admin.manajemen-user') ? 'active' : '' }}">
                        <i class="bi bi-people me-2"></i> Manajemen User
                    </a>
                </li>
                
                <li class="nav-item mt-3"><small class="text-uppercase text-secondary fw-bold">Fitur Lain</small></li>
                
                <li>
                    <a href="{{ route('admin.design.index') }}" class="nav-link text-white {{ request()->routeIs('admin.design.index') ? 'active' : '' }}">
                        <i class="bi bi-palette me-2"></i> Desain
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.chat.index') }}" class="nav-link text-white {{ request()->routeIs('admin.chat.index') ? 'active' : '' }}">
                        <i class="bi bi-chat-dots me-2"></i> Chat
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.kategori.index') }}" class="nav-link text-white {{ request()->routeIs('admin.kategori.index') ? 'active' : '' }}">
                        <i class="bi bi-tags me-2"></i> Kategori
                    </a>
                </li>
                 <li>
                    <a href="{{ route('admin.payment') }}" class="nav-link text-white {{ request()->routeIs('admin.payment') ? 'active' : '' }}">
                        <i class="bi bi-credit-card me-2"></i> Payment
                    </a>
                </li>
                 <li>
                    <a href="{{ route('admin.upload-progress') }}" class="nav-link text-white {{ request()->routeIs('admin.upload-progress') ? 'active' : '' }}">
                        <i class="bi bi-cloud-upload me-2"></i> Upload Progress
                    </a>
                </li>
                 <li>
                    <a href="{{ route('admin.approve-progress') }}" class="nav-link text-white {{ request()->routeIs('admin.approve-progress') ? 'active' : '' }}">
                        <i class="bi bi-check-circle me-2"></i> Approve Progress
                    </a>
                </li>
                
                <li class="mt-4 pt-3 border-top">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="nav-link text-white w-100 text-start bg-transparent border-0">
                            <i class="bi bi-box-arrow-right me-2"></i> Logout
                        </button>
                    </form>
                </li>
            </ul>
        </div>

        <main class="main-content">
            
            <nav class="navbar navbar-light bg-white shadow-sm d-lg-none p-3 mb-3">
                <div class="container-fluid">
                    <button class="btn btn-dark" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu">
                        <i class="bi bi-list"></i> Menu
                    </button>
                    <span class="fw-bold">ADP Panel</span>
                </div>
            </nav>

            <div class="container-fluid"> @yield('content')
            </div>
            
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>