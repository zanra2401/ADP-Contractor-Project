<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Desain - ADP Konstruksi</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .carousel-slide {
            transition: opacity 0.7s ease-in-out;
        }
        /* Custom scrollbar untuk tabel responsive agar terlihat rapi */
        .scrollbar-hide::-webkit-scrollbar {
            display: none;
        }
        /* Transisi untuk Modal */
        .modal-transition {
            transition: opacity 0.3s ease-out;
        }
    </style>
</head>
<body class="bg-gray-50 font-sans text-gray-800">

    {{-- NAVBAR --}}
    <nav class="bg-white sticky top-0 z-40 shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <span class="font-bold text-xl text-blue-600">ADP Konstruksi</span>
                </div>
                <div class="flex items-center">
                    <a href="{{ route('pelanggan.galeri') }}"
                        class="text-sm font-medium text-gray-500 hover:text-gray-900 flex items-center transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                        </svg>
                        <span class="hidden sm:inline">Kembali</span>
                    </a>
                </div>
            </div>
        </div>
    </nav>

    {{-- MAIN CONTENT --}}
    <main class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-8 relative">
        {{-- ================= CARD UTAMA ================= --}}
        <div class="bg-white rounded-none overflow-hidden mb-12">
            
            {{-- CAROUSEL GAMBAR --}}
            <div id="carousel-container" class="relative w-full h-72 sm:h-96 lg:h-[550px] bg-gray-200 group">
                <div class="relative w-full h-full">
                    @foreach ($design->contents as $index => $content)
                        <div class="carousel-slide absolute inset-0 w-full h-full {{ $index === 0 ? 'opacity-100 z-10' : 'opacity-0 z-0' }}">
                            <img src="{{ asset($content->file_path) }}"
                                 alt="{{ $design->nama }} - Slide {{ $index + 1 }}"
                                 class="w-full h-full object-cover">
                        </div>
                    @endforeach
                </div>

                {{-- Navigasi Carousel --}}
                @if($design->contents->count() > 1)
                    <button id="prevBtn" class="absolute left-4 top-1/2 -translate-y-1/2 z-20 bg-black/30 hover:bg-black/50 text-white p-3 rounded-full backdrop-blur-md transition-all duration-300 opacity-0 group-hover:opacity-100 focus:opacity-100 sm:opacity-100">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" /></svg>
                    </button>
                    <button id="nextBtn" class="absolute right-4 top-1/2 -translate-y-1/2 z-20 bg-black/30 hover:bg-black/50 text-white p-3 rounded-full backdrop-blur-md transition-all duration-300 opacity-0 group-hover:opacity-100 focus:opacity-100 sm:opacity-100">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" /></svg>
                    </button>
                @endif

                {{-- Kategori Badge --}}
                <div class="absolute bottom-4 left-4 flex gap-2 z-20">
                    @foreach ($design->categories as $cat)
                        <span class="bg-white/90 backdrop-blur-sm text-gray-800 text-xs font-bold px-3 py-1.5 rounded-full shadow-sm">{{ $cat->nama }}</span>
                    @endforeach
                </div>
            </div>

            {{-- CONTENT DETAIL --}}
            <div class="p-6 sm:p-10">
                {{-- Judul & Harga --}}
                <div class="flex flex-col md:flex-row justify-between items-start md:items-end mb-8 gap-4">
                    <div>
                        <h1 class="text-3xl sm:text-4xl font-extrabold text-gray-900 leading-tight">{{ $design->nama }}</h1>
                        <p class="text-gray-400 text-sm mt-1">Kode Desain: #ADP-{{ $design->id }}</p>
                    </div>
                    <div class="text-left md:text-right bg-blue-50 px-5 py-3 rounded-2xl">
                        <p class="text-xs text-blue-600 font-semibold uppercase tracking-wider mb-1">Estimasi Biaya</p>
                        <p class="text-2xl font-bold text-blue-700">Rp {{ number_format($design->harga, 0, ',', '.') }}</p>
                    </div>
                </div>

                {{-- Deskripsi & Specs --}}
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
                    <div class="lg:col-span-2">
                        <h3 class="text-lg font-bold text-gray-900 mb-4">Tentang Desain Ini</h3>
                        <div class="prose prose-blue text-gray-600 leading-relaxed text-base">
                            {!! nl2br(e($design->deskripsi)) !!}
                        </div>
                    </div>
                    <div class="bg-gray-100/70 p-6 rounded-2xl h-fit">
                        <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 011.414.414l5 5a1 1 0 01.414 1.414V19a2 2 0 01-2 2z"></path></svg>
                            Spesifikasi
                        </h3>
                        <ul class="space-y-4">
                            @foreach ($design->specs as $spec)
                            <li class="flex items-start text-gray-700">
                                <span class="w-2 h-2 mt-2 mr-3 bg-blue-500 rounded-full flex-shrink-0"></span>
                                <span class="text-sm font-medium">{{ $spec->spesifikasi }}</span>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>

                {{-- Tombol Aksi --}}
                <div class="mt-12 flex flex-col sm:flex-row gap-4">
                    {{-- TOMBOL TRIGGER MODAL --}}
                    <button onclick="openModal()" class="flex-1 py-4 px-6 rounded-xl bg-gray-100 text-gray-700 font-bold hover:bg-gray-200 transition duration-300 transform hover:-translate-y-0.5">
                        Buat Proyek
                    </button>
                    <a href="{{ route('pelanggan.chat') }}" class="flex-[2] py-4 px-6 rounded-xl bg-blue-600 text-white font-bold text-center hover:bg-blue-700 transition duration-300 shadow-lg shadow-blue-200 transform hover:-translate-y-0.5">
                        Konsultasi Sekarang
                    </a>
                </div>
            </div>
        </div>
        {{-- ================= END CARD UTAMA ================= --}}


    </main>

    {{-- ================= MODAL BUAT PROYEK ================= --}}
    <div id="projectModal" class="fixed inset-0 z-50 hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        
        {{-- Backdrop (Overlay Gelap) --}}
        <div class="fixed inset-0 bg-gray-900/75 transition-opacity opacity-0 backdrop-blur-sm" id="modalBackdrop"></div>

        {{-- Container Modal Center --}}
        <div class="fixed inset-0 z-10 overflow-y-auto">
            <div class="flex min-h-full items-center justify-center p-4 text-center sm:p-0">
                
                {{-- Panel Modal --}}
                <div class="relative transform overflow-hidden rounded-2xl bg-white text-left shadow-2xl transition-all sm:my-8 sm:w-full sm:max-w-lg opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" id="modalPanel">
                    
                    {{-- Header Modal --}}
                    <div class="bg-blue-600 px-4 py-4 sm:px-6 flex justify-between items-center">
                        <h3 class="text-lg font-bold leading-6 text-white" id="modal-title">Buat Proyek Baru</h3>
                        <button type="button" onclick="closeModal()" class="text-blue-200 hover:text-white transition">
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>

                    {{-- Form Body --}}
                    <div class="px-4 py-6 sm:p-6 bg-white">
                        <form action="" method="POST">
                            @csrf
                            <div class="space-y-5">
                                
                                {{-- Field: Pilih Desain --}}
                                <div>
                                    <label for="design_id" class="block text-sm font-bold text-gray-700 mb-1">Pilih Desain</label>
                                    <div class="relative">
                                        <select id="design_id" name="design_id" class="block w-full rounded-xl border-gray-300 bg-gray-50 py-3 pl-3 pr-10 text-gray-900 focus:border-blue-500 focus:ring-blue-500 sm:text-sm shadow-sm appearance-none border">
                                            <option value="">-- Pilih Desain --</option>
                                            {{-- Contoh data statis untuk dropdown --}}
                                            <option value="{{ $design->id }}" selected>{{ $design->nama }} (Terpilih)</option>
                                            <option value="2">Rumah Minimalis Type 36</option>
                                            <option value="3">Ruko Modern 2 Lantai</option>
                                            <option value="4">Villa Tropis Bali</option>
                                        </select>
                                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-500">
                                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" /></svg>
                                        </div>
                                    </div>
                                </div>

                                <!-- {{-- Field: Nama Proyek --}}
                                <div>
                                    <label for="nama_proyek" class="block text-sm font-bold text-gray-700 mb-1">Nama Proyek</label>
                                    <input type="text" name="nama_proyek" id="nama_proyek" class="block w-full rounded-xl border-gray-300 bg-gray-50 py-3 px-3 text-gray-900 focus:border-blue-500 focus:ring-blue-500 sm:text-sm shadow-sm border" placeholder="Contoh: Renovasi Rumah Bapak Budi">
                                </div> -->

                                {{-- Field: Deskripsi --}}
                                <div>
                                    <label for="deskripsi" class="block text-sm font-bold text-gray-700 mb-1">Deskripsi & Kebutuhan</label>
                                    <textarea id="deskripsi" name="deskripsi" rows="3" class="block w-full rounded-xl border-gray-300 bg-gray-50 py-3 px-3 text-gray-900 focus:border-blue-500 focus:ring-blue-500 sm:text-sm shadow-sm border" placeholder="Jelaskan detail kebutuhan renovasi/pembangunan Anda..."></textarea>
                                </div>

                                {{-- Field: Alamat --}}
                                <div>
                                    <label for="alamat" class="block text-sm font-bold text-gray-700 mb-1">Alamat Lokasi Proyek</label>
                                    <textarea id="alamat" name="alamat" rows="2" class="block w-full rounded-xl border-gray-300 bg-gray-50 py-3 px-3 text-gray-900 focus:border-blue-500 focus:ring-blue-500 sm:text-sm shadow-sm border" placeholder="Alamat lengkap lokasi pengerjaan..."></textarea>
                                </div>

                            </div>
                            
                            {{-- Footer Modal --}}
                            <div class="mt-8 sm:grid sm:grid-flow-row-dense sm:grid-cols-2 sm:gap-3">
                                <button type="submit" class="inline-flex w-full justify-center rounded-xl bg-blue-600 px-3 py-3 text-sm font-bold text-white shadow-sm hover:bg-blue-700 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600 sm:col-start-2">
                                    Ajukan Proyek
                                </button>
                                <button type="button" onclick="closeModal()" class="mt-3 inline-flex w-full justify-center rounded-xl bg-white px-3 py-3 text-sm font-bold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:col-start-1 sm:mt-0">
                                    Batal
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- ================= END MODAL ================= --}}


    {{-- SCRIPT JAVASCRIPT --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // --- LOGIKA CAROUSEL ---
            const slides = document.querySelectorAll('.carousel-slide');
            const prevBtn = document.getElementById('prevBtn');
            const nextBtn = document.getElementById('nextBtn');
            let currentSlide = 0;

            if (slides.length > 1 && prevBtn && nextBtn) {
                function showSlide(index) {
                    if (index < 0) currentSlide = slides.length - 1;
                    else if (index >= slides.length) currentSlide = 0;
                    else currentSlide = index;

                    slides.forEach((slide, i) => {
                        if (i === currentSlide) {
                            slide.classList.remove('opacity-0', 'z-0');
                            slide.classList.add('opacity-100', 'z-10');
                        } else {
                            slide.classList.remove('opacity-100', 'z-10');
                            slide.classList.add('opacity-0', 'z-0');
                        }
                    });
                }
                prevBtn.addEventListener('click', () => showSlide(currentSlide - 1));
                nextBtn.addEventListener('click', () => showSlide(currentSlide + 1));
            }
        });

        // --- LOGIKA MODAL ---
        const modal = document.getElementById('projectModal');
        const backdrop = document.getElementById('modalBackdrop');
        const panel = document.getElementById('modalPanel');

        function openModal() {
            modal.classList.remove('hidden');
            // Animasi Masuk (Fade In & Zoom In)
            setTimeout(() => {
                backdrop.classList.remove('opacity-0');
                backdrop.classList.add('opacity-100');
                panel.classList.remove('opacity-0', 'translate-y-4', 'sm:translate-y-0', 'sm:scale-95');
                panel.classList.add('opacity-100', 'translate-y-0', 'sm:scale-100');
            }, 10);
        }

        function closeModal() {
            // Animasi Keluar
            backdrop.classList.remove('opacity-100');
            backdrop.classList.add('opacity-0');
            panel.classList.remove('opacity-100', 'translate-y-0', 'sm:scale-100');
            panel.classList.add('opacity-0', 'translate-y-4', 'sm:translate-y-0', 'sm:scale-95');

            // Sembunyikan div setelah animasi selesai (300ms sesuai CSS)
            setTimeout(() => {
                modal.classList.add('hidden');
            }, 300);
        }

        // Tutup modal jika klik di luar panel (di backdrop)
        window.onclick = function(event) {
            if (event.target == backdrop || event.target.closest('#modalBackdrop')) {
                closeModal();
            }
        }
    </script>
</body>
</html>