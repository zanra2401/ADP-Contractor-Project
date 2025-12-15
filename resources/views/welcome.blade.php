<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PT. Adi Guna Perkasa - Contractor & Developer</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700;800&display=swap" rel="stylesheet">

    <style>
        body { font-family: 'Poppins', sans-serif; margin: 0; padding: 0; }
        .navbar { padding: 1rem 0; }
        .navbar-brand img { height: 50px; }
        .navbar-brand-text { font-size: 1rem; font-weight: 700; color: #333; line-height: 1.2; }
        .navbar-brand-subtext { font-size: 0.75rem; font-weight: 400; color: #777; }
        .nav-link { font-weight: 600; color: #333 !important; text-transform: uppercase; font-size: 0.85rem; margin: 0 0.5rem; }
        
        /* Tombol Registrasi (Kanan) */
        .btn-registrasi { background-color: #ff9100; color: white; font-weight: 700; text-transform: uppercase; padding: 0.6rem 1.5rem; border-radius: 4px; font-size: 0.85rem; text-decoration: none; transition: 0.3s; }
        .btn-registrasi:hover { background-color: #e68200; color: white; }

        /* --- HERO SECTION --- */
        #hero { background-image: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), url('https://images.unsplash.com/photo-1541888946425-d81bb19240f5?fit=crop&w=1920&q=80'); background-size: cover; background-position: center; height: 85vh; display: flex; align-items: center; text-align: center; color: white; }
        .hero-title { font-weight: 800; font-size: 3.5rem; text-transform: uppercase; line-height: 1.1; margin-bottom: 1.5rem; }
        .hero-description { font-size: 1.1rem; max-width: 850px; margin: 0 auto 2.5rem auto; line-height: 1.6; opacity: 0.9; }
        .btn-hero { background-color: #ff9100; color: white; font-weight: 700; text-transform: uppercase; padding: 0.9rem 2rem; border-radius: 4px; text-decoration: none; display: inline-block; transition: 0.3s; }
        .btn-hero:hover { background-color: #e68200; color: white; transform: translateY(-2px); }

        .transition-hover { transition: transform 0.3s ease; }
        .transition-hover:hover { transform: translateY(-5px); }
        .text-warning { color: #ff9100 !important; }
        
        @media (max-width: 768px) {
            .hero-title { font-size: 2rem; }
            #hero { height: auto; padding: 100px 0; }
        }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-white sticky-top shadow-sm">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}">
                <img src="{{ asset('img/image.png') }}" alt="Logo" class="me-3">
                <div>
                    <div class="navbar-brand-text">PT. ADI GUNA PERKASA</div>
                    <div class="navbar-brand-subtext">CONTRACTOR & DEVELOPER</div>
                </div>
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav align-items-center">
                    <li class="nav-item"><a class="nav-link" href="{{ url('/') }}">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('pelanggan.galeri') }}">Galeri Proyek</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Layanan Renovasi</a></li>
                    
                    <li class="nav-item ms-lg-3">
                        <a href="{{ route('login') }}" class="nav-link text-primary">Masuk</a>
                    </li>
                    
                    <li class="nav-item mt-3 mt-lg-0">
                        <a href="{{ route('pelanggan.register') }}" class="btn-registrasi">Registrasi</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <section id="hero">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-11">
                    <h1 class="hero-title">Wujudkan Bangunan Impian Anda Bersama Adi Guna Perkasa</h1>
                    <p class="hero-description">
                        Kualitas terjamin, progres transparan, dan harga kompetitif. Kami adalah mitra terpercaya Anda di bidang jasa konstruksi, arsitektur, dan interior di Bali.
                    </p>
                    <a href="{{ route('pelanggan.galeri') }}" class="btn-hero">
                        LIHAT DESAIN UNGGULAN
                    </a>
                </div>
            </div>
        </div>
    </section>

    <section class="py-5 bg-white">
        <div class="container py-md-5">
            <div class="text-center mb-5">
                <h2 class="fw-bold text-uppercase" style="letter-spacing: 2px;">Jasa Yang Kami Tawarkan</h2>
                <p class="text-muted">Satu perusahaan untuk seluruh kebutuhan bangunan Anda!</p>
            </div>
            <div class="row g-4 justify-content-center">
                <div class="col-md-4">
                    <div class="p-4 d-flex align-items-start shadow-sm h-100 transition-hover" style="background-color: #0B132B; color: white; border-radius: 4px;">
                        <div class="me-3"><h2 class="text-warning mb-0"><i class="bi bi-building"></i></h2></div>
                        <div>
                            <h6 class="fw-bold mb-2">KONSTRUKSI PEMBANGUNAN</h6>
                            <p class="small mb-0 opacity-75">Pembangunan Rumah, Villa, Gedung, dan Bangunan Komersil.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="p-4 d-flex align-items-start shadow-sm h-100 transition-hover" style="background-color: #0B132B; color: white; border-radius: 4px;">
                        <div class="me-3"><h2 class="text-warning mb-0"><i class="bi bi-pencil-square"></i></h2></div>
                        <div>
                            <h6 class="fw-bold mb-2 text-uppercase">Perencanaan & Arsitektur</h6>
                            <p class="small mb-0 opacity-75">Konsultasi desain arsitek dan perencanaan tata ruang.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="p-4 d-flex align-items-start shadow-sm h-100 transition-hover" style="background-color: #0B132B; color: white; border-radius: 4px;">
                        <div class="me-3"><h2 class="text-warning mb-0"><i class="bi bi-palette"></i></h2></div>
                        <div>
                            <h6 class="fw-bold mb-2 text-uppercase">Design & Custom Interior</h6>
                            <p class="small mb-0 opacity-75">Pembuatan furniture kustom dan penataan interior estetis.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-5 overflow-hidden bg-light">
        <div class="container py-md-5">
            <div class="row align-items-center g-5">
                <div class="col-lg-6 position-relative" style="z-index: 10;">
                    <div class="bg-white p-4 p-md-5 shadow-lg" style="margin-right: -50px; border-radius: 4px;">
                        <div class="mb-3">
                            <span class="px-3 py-1 border border-warning text-warning fw-bold small text-uppercase">Introduction</span>
                        </div>
                        <h2 class="fw-bold mb-4" style="font-size: 2.5rem; color: #0B132B;">TENTANG KAMI</h2>
                        <p class="text-muted mb-4" style="line-height: 1.8;">
                            Kami adalah perusahaan yang berdiri tahun 2024 dan bergerak dibidang jasa konstruksi, design arsitek, custom interior, dan developer property. Kantor kami beralamat di Jalan Griya Anyar No. 58b. Kel. Pamogan, Denpasar Selatan, Bali.
                        </p>
                        <ul class="list-unstyled">
                            <li class="mb-3 d-flex align-items-center"><span class="text-warning me-3 fw-bold">―</span> Jaminan Kepuasan 100% & Sistem Kontrol Berkualitas</li>
                            <li class="mb-3 d-flex align-items-center"><span class="text-warning me-3 fw-bold">―</span> Staf Profesional dengan Pengujian Akurat</li>
                            <li class="mb-3 d-flex align-items-center"><span class="text-warning me-3 fw-bold">―</span> Hasil Kerja Profesional dan Berkualitas Tinggi</li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-6 position-relative">
                    <div class="position-relative">
                        <div class="position-absolute d-none d-md-block" style="width: 80%; height: 80%; top: -20px; right: -20px; z-index: 1; background-color: #ff9100 !important;"></div>
                        <img src="{{ asset('img/worker.png') }}" alt="Worker" class="img-fluid position-relative shadow" style="z-index: 2; border-radius: 4px;">
                        <div class="position-absolute d-none d-md-block shadow-lg" style="bottom: 450px; left: -750px; width: 650px; z-index: 1; border: 5px solid white;">
                            <img src="{{ asset('img/rumah.jpg') }}" alt="Project" class="img-fluid">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-5 bg-white">
        <div class="container py-5">
            <div class="text-center mb-5">
                <span class="text-warning fw-bold small text-uppercase border-start border-end border-warning px-3">Gallery</span>
                <h2 class="fw-bold mt-2" style="font-size: 2.5rem; color: #0B132B;">DESAIN UNGGULAN</h2>
            </div>
            
            <div class="row g-4">
                @foreach($designs as $design)
                    @php $cover = $design->contents->first()->file_path ?? null; @endphp
                    <div class="col-md-4">
                        <div class="card h-100 border-0 shadow-sm transition-hover overflow-hidden">
                            <img src="{{ $cover ? asset('storage/' . $cover) : asset('placeholder.jpg') }}" class="card-img-top" style="height: 250px; object-fit: cover;" alt="{{ $design->nama }}">
                            <div class="card-body">
                                <h5 class="fw-bold text-dark">{{ $design->nama }}</h5>
                                <div class="mb-2">
                                    @foreach($design->categories as $cat)
                                        <span class="badge bg-light text-primary border">{{ $cat->nama }}</span>
                                    @endforeach
                                </div>
                                <p class="text-muted small line-clamp-2">{{ $design->deskripsi }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="text-center mt-5">
                <a href="{{ route('pelanggan.galeri') }}" class="text-decoration-none fw-bold" style="color: #ff9100;">
                    Lihat Semua Desain <i class="bi bi-arrow-right"></i>
                </a>
            </div>
        </div>
    </section>

    <footer class="bg-dark text-white py-5 mt-5">
        <div class="container text-center">
            <p class="mb-0">&copy; 2025 PT. Adi Guna Perkasa. All rights reserved.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>