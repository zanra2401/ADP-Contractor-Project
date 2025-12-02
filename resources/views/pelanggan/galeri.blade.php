<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Galeri Desain - ADP Konstruksi</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans">

    {{-- NAVBAR --}}
    <nav class="bg-white shadow-md sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex">
                    <div class="shrink-0 flex items-center">
                        <span class="font-bold text-xl text-blue-600">ADP Konstruksi</span>
                    </div>

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

                <div class="hidden sm:ml-6 sm:flex sm:items-center space-x-4">
                    <span class="text-sm text-gray-700 mr-2">
                        Halo, {{ Auth::user()->name ?? 'Pelanggan' }}!
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
            </div>
        </div>
    </nav>

    {{-- HEADER --}}
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
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">

                @foreach ($designs as $design)
                <div class="bg-white rounded-2xl shadow-xl overflow-hidden hover:shadow-2xl transition-shadow duration-300">

                    {{-- GAMBAR UTAMA --}}
                    <div class="relative h-56">
                        <img class="w-full h-full object-cover"
                             src="{{ asset($design->contents->first()->file_path ?? 'placeholder.jpg') }}"
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
                        <div class="flex items-center gap-2 mb-4">
                            @foreach ($design->categories as $cat)
                                <span class="bg-blue-100 text-blue-800 text-xs font-semibold px-2 py-1 rounded">
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

</body>
</html>
