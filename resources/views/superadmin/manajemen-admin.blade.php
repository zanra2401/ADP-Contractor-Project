<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Admin - Superadmin</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" xintegrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>

    <div class="d-flex">

        <!-- ========================== -->
        <!--     SIDEBAR SUPERADMIN     -->
        <!-- ========================== -->
        <nav class="d-flex flex-column flex-shrink-0 p-3 text-bg-dark" style="width: 280px; min-height: 100vh;">
            <a href="#" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                <span class="fs-4 fw-bold text-warning">Super Admin Panel</span>
            </a>
            <hr>
            <ul class="nav nav-pills flex-column mb-auto">
                <!-- Menu Khusus Superadmin -->
                <li class="nav-item">
                    <a href="#" class="nav-link active" aria-current="page">
                        👮‍♂️ Kelola Admin
                    </a>
                </li>
            </ul>
            
            <hr>
            <div class="dropdown">
                <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                    <strong>{{ Auth::user()->name ?? 'Superadmin' }}</strong>
                </a>
                <ul class="dropdown-menu dropdown-menu-dark text-small shadow">
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="dropdown-item">Sign out</button>
                        </form>
                    </li>
                </ul>
            </div>
        </nav>

        <!-- ========================== -->
        <!--      KONTEN UTAMA          -->
        <!-- ========================== -->
        <main class="flex-grow-1" style="background-color: #f8f9fa;">
            
            <!-- TOP NAVBAR -->
            <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom p-3 mb-4 shadow-sm">
                <div class="container-fluid">
                    <h1 class="h3 mb-0">👮‍♂️ Manajemen Admin</h1>
                    <div class="ms-auto">
                         <span class="badge bg-warning text-dark">Superadmin Access</span>
                    </div>
                </div>
            </nav>

            <!-- ISI KONTEN -->
            <div class="p-4">
                <div class="alert alert-info" role="alert">
                    Halaman ini khusus untuk menambahkan, mengedit, atau menghapus akun <strong>Admin</strong> yang akan mengelola sistem.
                </div>

                <div class="card shadow-sm">
                    <div class="card-header d-flex justify-content-between align-items-center bg-white py-3">
                        <h5 class="mb-0">Daftar Admin Terdaftar</h5>
                        <button class="btn btn-success btn-sm">
                            <span class="me-1">+</span> Tambah Admin Baru
                        </button>
                    </div>
                    <div class="card-body p-0">
                        <table class="table table-striped table-hover mb-0 align-middle">
                            <thead class="table-dark">
                                <tr>
                                    <th scope="col" class="ps-4">#</th>
                                    <th scope="col">Nama Lengkap</th>
                                    <th scope="col">Email / No. Telp</th>
                                    <th scope="col">Role</th>
                                    <th scope="col">Status</th>
                                    <th scope="col" class="text-end pe-4">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Contoh Data Admin 1 -->
                                <tr>
                                    <td class="ps-4">1</td>
                                    <td>
                                        <div class="fw-bold">Budi Santoso</div>
                                        <small class="text-muted">ID: ADM-001</small>
                                    </td>
                                    <td>budi@admin.com</td>
                                    <td><span class="badge text-bg-primary">Admin</span></td>
                                    <td><span class="badge text-bg-success">Active</span></td>
                                    <td class="text-end pe-4">
                                        <button class="btn btn-sm btn-outline-warning me-1">Edit</button>
                                        <button class="btn btn-sm btn-outline-danger" onclick="return confirm('Yakin ingin menghapus admin ini?')">Hapus</button>
                                    </td>
                                </tr>

                                <!-- Contoh Data Admin 2 -->
                                <tr>
                                    <td class="ps-4">2</td>
                                    <td>
                                        <div class="fw-bold">Siti Aminah</div>
                                        <small class="text-muted">ID: ADM-002</small>
                                    </td>
                                    <td>siti@admin.com</td>
                                    <td><span class="badge text-bg-primary">Admin</span></td>
                                    <td><span class="badge text-bg-success">Active</span></td>
                                    <td class="text-end pe-4">
                                        <button class="btn btn-sm btn-outline-warning me-1">Edit</button>
                                        <button class="btn btn-sm btn-outline-danger" onclick="return confirm('Yakin ingin menghapus admin ini?')">Hapus</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" xintegrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>