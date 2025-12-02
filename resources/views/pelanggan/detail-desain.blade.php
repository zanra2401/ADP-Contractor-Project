<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Desain - ADP Konstruksi</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 font-sans">

    {{-- NAVBAR --}}
    <nav class="bg-white shadow-md sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex">
                    <div class="shrink-0 flex items-center">
                        <span class="font-bold text-xl text-blue-600">ADP Konstruksi</span>
                    </div>
                </div>

                <div class="flex items-center">
                    <a href="{{ route('pelanggan.galeri') }}"
                        class="text-sm font-medium text-gray-500 hover:text-gray-900 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z"
                                clip-rule="evenodd" />
                        </svg>
                        Kembali ke Galeri
                    </a>
                </div>
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
                <div class="p-8 lg:p-12">
                    <div class="flex justify-between items-start">
                        <div>
                            {{-- NAMA DESIGN --}}
                            <h1 class="text-3xl font-extrabold text-gray-900 mb-2">
                                {{ $design->nama }}
                            </h1>

                            {{-- KATEGORI --}}
                            <div class="flex items-center space-x-2 mb-6">
                                @foreach ($design->categories as $cat)
                                    <span class="bg-blue-100 text-blue-800 text-xs font-semibold px-2.5 py-0.5 rounded">
                                        {{ $cat->nama }}
                                    </span>
                                @endforeach
                            </div>
                        </div>

                        {{-- HARGA --}}
                        <div class="text-right">
                            <p class="text-sm text-gray-500">Estimasi Biaya</p>
                            <p class="text-2xl font-bold text-blue-600">
                                Rp {{ number_format($design->harga, 0, ',', '.') }}
                            </p>
                        </div>
                    </div>

                    {{-- DESKRIPSI --}}
                    <h3 class="text-lg font-semibold text-gray-900 mb-3">Deskripsi Desain</h3>
                    <p class="text-gray-600 mb-6 leading-relaxed">
                        {{ $design->deskripsi }}
                    </p>

                    {{-- SPESIFIKASI --}}
                    <h3 class="text-lg font-semibold text-gray-900 mb-3">Spesifikasi Ruangan</h3>

                    <ul class="grid grid-cols-2 gap-4 mb-8">
                        @foreach ($design->specs as $spec)
                        <li class="flex items-center text-gray-600">
                            <svg class="h-5 w-5 mr-2 text-blue-500"
                                 fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M5 13l4 4L19 7"></path>
                            </svg>
                            {{ $spec->spesifikasi }}
                        </li>
                        @endforeach
                    </ul>

                    {{-- BUTTONS --}}
                    <div class="border-t pt-8 flex flex-col sm:flex-row gap-4">

                        <a href="{{ route('pelanggan.chat') }}"
                            class="flex-1 bg-blue-600 text-white text-center font-bold py-3 px-6 rounded-xl 
                            hover:bg-blue-700 transition duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-1">
                            Konsultasi Desain Ini
                        </a>

                        <button
                            class="flex-1 bg-white border-2 border-gray-200 text-gray-700 font-bold py-3 px-6 rounded-xl
                            hover:border-blue-500 hover:text-blue-600 transition duration-300">
                            Simpan ke Favorit
                        </button>
                    </div>

                </div>
            </div>
        </div>

        {{-- GALERI GAMBAR TAMBAHAN --}}
        <div class="mt-10 grid grid-cols-1 md:grid-cols-3 gap-6">

            @foreach ($design->contents->skip(1) as $img)
                <img class="rounded-xl shadow-md h-48 w-full object-cover hover:opacity-90 cursor-pointer"
                     src="{{ asset($img->file_path) }}"
                     alt="Detail Gambar">
            @endforeach

        </div>

    </main>

</body>
</html>
