<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Galeri Desain - ADP Konstruksi</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans">

    {{-- NAVBAR RESPONSIVE --}}
    <nav class="bg-white shadow-md sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                
                {{-- KIRI: LOGO & MENU DESKTOP --}}
                <div class="flex">
                    <div class="shrink-0 flex items-center">
                        <span class="font-bold text-xl text-blue-600">ADP Konstruksi</span>
                    </div>

                    {{-- MENU NAVIGASI DESKTOP --}}
                    <div class="hidden sm:ml-6 sm:flex sm:space-x-8">
                        <a href="{{ route('pelanggan.dashboard') }}"
                            class="border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                            Dashboard
                        </a>
                        <a href="{{ route('pelanggan.galeri') }}"
                            class="border-blue-500 text-gray-900 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                            Galeri Proyek
                        </a>
                        <a href="{{ route('pelanggan.chat') }}"
                            class="border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                            Chat
                        </a>
                    </div>
                </div>

                {{-- KANAN: USER INFO & LOGOUT DESKTOP --}}
                <div class="hidden sm:ml-6 sm:flex sm:items-center space-x-4">
                    <span class="text-sm text-gray-700 mr-2">
                        Halo, {{ Auth::user()->nama ?? 'Pelanggan' }}!
                    </span>

                    <a href="{{ route('pelanggan.profil') }}"
                        class="text-sm font-medium text-gray-500 hover:text-gray-700">
                        Profil Saya
                    </a>

                    <form method="POST" action="#" class="inline">
                        @csrf
                        <button type="submit"
                            class="text-sm font-medium text-red-600 hover:text-red-800 ml-2">
                            Logout
                        </button>
                    </form>
                </div>

                {{-- TOMBOL HAMBURGER MOBILE --}}
                <div class="flex items-center sm:hidden">
                    <button type="button" onclick="toggleMobileMenu()" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
        
        {{-- MOBILE MENU DROPDOWN --}}
        <div class="hidden sm:hidden bg-white border-t border-gray-200 absolute w-full z-40 shadow-lg" id="mobile-menu">
            <div class="pt-2 pb-3 space-y-1">
                {{-- Nav Links --}}
                <a href="{{ route('pelanggan.dashboard') }}"
                    class="block pl-3 pr-4 py-2 border-l-4 border-transparent text-base font-medium text-gray-600 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-800">
                    Dashboard
                </a>
                <a href="{{ route('pelanggan.galeri') }}"
                    class="block pl-3 pr-4 py-2 border-l-4 border-blue-500 text-base font-medium text-blue-700 bg-blue-50">
                    Galeri Proyek
                </a>
                <a href="{{ route('pelanggan.chat') }}"
                    class="block pl-3 pr-4 py-2 border-l-4 border-transparent text-base font-medium text-gray-600 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-800">
                    Chat
                </a>
            </div>
             {{-- User Info & Logout Mobile --}}
            <div class="pt-4 pb-3 border-t border-gray-200">
                <div class="px-4">
                    <div class="text-base font-medium text-gray-800">Halo, {{ Auth::user()->name ?? 'Pelanggan' }}</div>
                    <div class="text-sm font-medium text-gray-500">{{ Auth::user()->email ?? 'email@contoh.com' }}</div>
                </div>
                <div class="mt-3 space-y-1">
                    <a href="{{ route('pelanggan.profil') }}" class="block px-4 py-2 text-base font-medium text-gray-500 hover:text-gray-800 hover:bg-gray-100">
                        Profil Saya
                    </a>
                    <form method="POST" action="#">
                        @csrf
                        <button type="submit" class="block w-full text-left px-4 py-2 text-base font-medium text-red-600 hover:text-red-800 hover:bg-gray-100">
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>
    
    <div class="py-10">
        <header class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-8">
            <h1 class="text-3xl font-bold leading-tight text-gray-900">
                Galeri Desain Proyek
            </h1>
            <p class="mt-2 text-lg text-gray-600">
                Temukan inspirasi desain hunian impian Anda dari koleksi terbaik kami.
            </p>
        </header>

        {{-- GRID LIST --}}
        <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                {{-- Mengubah md:grid-cols-2 menjadi sm:grid-cols-2 agar grid segera aktif di tablet/landscape mobile --}}

                @foreach ($designs as $design)
                <div class="bg-white rounded-2xl shadow-xl overflow-hidden hover:shadow-2xl transition-shadow duration-300">

                    {{-- GAMBAR UTAMA --}}
                    <div class="relative h-56">
                        <img class="w-full h-full object-cover"
                            src="{{ asset('storage/' . ($design->contents->first()->file_path ?? 'placeholder.jpg')) }}"
                            alt="{{ $design->nama }}">

                        {{-- Label Terpopuler untuk item pertama --}}
                        @if ($loop->iteration == 1)
                            <div class="absolute top-0 right-0 bg-blue-600 text-white px-3 py-1 rounded-bl-lg font-semibold text-sm">
                                Terpopuler
                            </div>
                        @endif
                    </div>

                    {{-- CARD BODY --}}
                    <div class="p-6">
                        {{-- NAMA DESIGN --}}
                        <h3 class="text-xl font-bold text-gray-900 leading-tight mb-2">
                            {{ $design->nama }}
                        </h3>

                        {{-- KATEGORI --}}
                        <div class="flex flex-wrap items-center gap-2 mb-4">
                            @foreach ($design->categories as $cat)
                                <span class="bg-blue-100 text-blue-800 text-xs font-semibold px-2 py-1 rounded flex-shrink-0">
                                    {{ $cat->nama }}
                                </span>
                            @endforeach
                        </div>

                        {{-- DESKRIPSI --}}
                        <p class="text-gray-600 text-sm mb-6 line-clamp-3">
                            {{ $design->deskripsi }}
                        </p>

                        {{-- LINK BUTTON --}}
                        <a href="{{ route('pelanggan.galeri.detail', $design->id) }}"
                           class="block w-full text-center bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-4 rounded-xl transition-colors duration-200">
                            Lihat Detail Desain
                        </a>
                    </div>

                </div>
                @endforeach

            </div>
        </main>
    </div>
    
    <script>
        function toggleMobileMenu() {
            const menu = document.getElementById('mobile-menu');
            menu.classList.toggle('hidden');
        }
    </script>
</body>
</html>