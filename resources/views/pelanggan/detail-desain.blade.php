<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Desain - ADP Konstruksi</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 font-sans">

    {{-- NAVBAR RESPONSIVE --}}
    <nav class="bg-white shadow-md sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                
                {{-- KIRI: LOGO --}}
                <div class="flex items-center">
                    <div class="shrink-0 flex items-center">
                        <span class="font-bold text-xl text-blue-600">ADP Konstruksi</span>
                    </div>
                </div>

                {{-- KANAN: TOMBOL KEMBALI (Desktop Only) & HAMBURGER (Mobile Only) --}}
                <div class="flex items-center">
                    
                    {{-- Tombol Kembali Desktop --}}
                    <a href="{{ route('pelanggan.galeri') }}"
                        class="hidden sm:flex text-sm font-medium text-gray-500 hover:text-gray-900 items-center transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z"
                                clip-rule="evenodd" />
                        </svg>
                        Kembali ke Galeri
                    </a>

                    {{-- Tombol Kembali Mobile (untuk memanggil mobile menu) --}}
                    <button type="button" onclick="toggleMobileMenu()" class="sm:hidden inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
        
        {{-- MOBILE MENU DROPDOWN (Sangat minimalis) --}}
        <div class="hidden sm:hidden bg-white border-t border-gray-200 absolute w-full z-40 shadow-lg" id="mobile-menu">
            <div class="pt-2 pb-3 space-y-1">
                <a href="{{ route('pelanggan.galeri') }}"
                    class="block pl-3 pr-4 py-2 border-l-4 border-blue-500 text-base font-medium text-blue-700 bg-blue-50">
                    &larr; Kembali ke Galeri
                </a>
            </div>
        </div>
    </nav>

    {{-- MAIN CONTENT --}}
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

        {{-- CARD DETAIL --}}
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
            <div class="grid grid-cols-1 lg:grid-cols-2">

                {{-- GAMBAR UTAMA --}}
                <div class="h-96 lg:h-auto bg-gray-200 relative">
                    <img src="{{ asset($design->contents->first()->content_path) }}
"
"
                         alt="{{ $design->nama }}"
                         class="absolute inset-0 w-full h-full object-cover">
                </div>

                {{-- SECTION KANAN --}}
                <div class="p-6 sm:p-8 lg:p-12">
                    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center">
                        
                        {{-- NAMA DESIGN & KATEGORI --}}
                        <div class="mb-4 sm:mb-0 w-full">
                            <h1 class="text-2xl sm:text-3xl font-extrabold text-gray-900 mb-2">
                                {{ $design->nama }}
                            </h1>
                            <div class="flex flex-wrap items-center gap-2">
                                @foreach ($design->categories as $cat)
                                    <span class="bg-blue-100 text-blue-800 text-xs font-semibold px-2.5 py-0.5 rounded">
                                        {{ $cat->nama }}
                                    </span>
                                @endforeach
                            </div>
                        </div>

                        {{-- HARGA --}}
                        <div class="text-left sm:text-right w-full sm:w-auto border-t pt-4 sm:border-t-0 sm:pt-0">
                            <p class="text-sm text-gray-500">Estimasi Biaya</p>
                            <p class="text-2xl font-bold text-blue-600">
                                Rp {{ number_format($design->harga, 0, ',', '.') }}
                            </p>
                        </div>
                    </div>

                    <hr class="my-6">

                    {{-- DESKRIPSI --}}
                    <h3 class="text-lg font-semibold text-gray-900 mb-3">Deskripsi Desain</h3>
                    <p class="text-gray-600 mb-6 leading-relaxed text-sm">
                        {{ $design->deskripsi }}
                    </p>

                    {{-- SPESIFIKASI --}}
                    <h3 class="text-lg font-semibold text-gray-900 mb-3">Spesifikasi Ruangan</h3>

                    <ul class="grid grid-cols-2 gap-x-4 gap-y-3 mb-8 text-sm">
                        @foreach ($design->specs as $spec)
                        <li class="flex items-start text-gray-700">
                            <svg class="h-4 w-4 mt-1 mr-2 text-blue-500 flex-shrink-0"
                                 fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M5 13l4 4L19 7"></path>
                            </svg>
                            {{ $spec->spesifikasi }}
                        </li>
                        @endforeach
                    </ul>

                    {{-- BUTTONS (Akan menumpuk di HP dan berdampingan di Tablet/Desktop) --}}
                    <div class="border-t pt-8 flex flex-col sm:flex-row gap-4">

                        <a href="{{ route('pelanggan.chat') }}"
                            class="flex-1 bg-blue-600 text-white text-center font-bold py-3 px-6 rounded-xl 
                            hover:bg-blue-700 transition duration-300 shadow-lg transform hover:-translate-y-0.5">
                            Konsultasi Desain Ini
                        </a>

                        <button
                            class="flex-1 bg-white border-2 border-gray-200 text-gray-700 font-bold py-3 px-6 rounded-xl
                            hover:border-blue-500 hover:text-blue-600 transition duration-300 transform hover:-translate-y-0.5">
                            Simpan ke Favorit
                        </button>
                    </div>

                </div>
            </div>
        </div>

        {{-- GALERI GAMBAR TAMBAHAN --}}
        <div class="mt-10">
            <h2 class="text-2xl font-bold text-gray-900 mb-5">Galeri Tambahan</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">

                @foreach ($design->contents->skip(1) as $img)
                    <img class="rounded-xl shadow-md h-48 w-full object-cover hover:opacity-90 cursor-pointer transition"
                         src="{{ asset($img->file_path) }}"
                         alt="Detail Gambar">
                @endforeach
            </div>
        </div>

    </main>

    <script>
        function toggleMobileMenu() {
            const menu = document.getElementById('mobile-menu');
            menu.classList.toggle('hidden');
        }
    </script>
</body>
</html>