<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Proyek - ADP Konstruksi</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .no-scrollbar::-webkit-scrollbar {
            display: none;
        }
        .no-scrollbar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
    </style>
</head>
<body class="bg-gray-50 font-sans text-gray-800">

    {{-- NAVBAR --}}
    <nav class="bg-white shadow-sm sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex">
                    <div class="flex-shrink-0 flex items-center">
                        <span class="font-bold text-xl text-blue-600">ADP Konstruksi</span>
                    </div>
                    <div class="hidden sm:ml-6 sm:flex sm:space-x-8">
                        <a href="{{ route('pelanggan.dashboard') }}" class="border-transparent text-gray-500 hover:text-blue-600 inline-flex items-center px-1 pt-1 border-b-2 font-medium transition">Dashboard</a>
                        <a href="{{ route('pelanggan.galeri') }}" class="border-transparent text-gray-500 hover:text-blue-600 inline-flex items-center px-1 pt-1 border-b-2 font-medium transition">Galeri Proyek</a>
                        <a href="{{ route('pelanggan.chat') }}" class="border-transparent text-gray-500 hover:text-blue-600 inline-flex items-center px-1 pt-1 border-b-2 font-medium transition">Chat</a>
                    </div>
                </div>
                <div class="hidden sm:ml-6 sm:flex sm:items-center space-x-4">
                    <span class="text-sm text-gray-600">Halo, {{ Auth::user()->name ?? 'Pelanggan' }}!</span>
                    <a href="{{ route('pelanggan.profil') }}" class="text-sm font-medium text-gray-500 hover:text-gray-700">Profil</a>
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="text-sm font-medium text-red-600 hover:text-red-800 ml-2">Logout</button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    {{-- HEADER: STATUS, PROGRESS & BIAYA --}}
    <div class="bg-white border-b border-gray-100 pb-10 pt-6 shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            {{-- Breadcrumb --}}
            <a href="{{ route('pelanggan.dashboard') }}" class="text-sm text-gray-500 hover:text-blue-600 mb-6 inline-flex items-center transition">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Kembali ke Dashboard
            </a>

            {{-- Judul & Status --}}
            <div class="md:flex md:items-start md:justify-between gap-6 mb-8">
                <div class="flex-1 min-w-0">
                    <h2 class="text-3xl font-extrabold text-gray-900 sm:text-4xl tracking-tight">
                        {{ $proyek->nama_proyek ?? 'Belum Ditentukan' }}
                    </h2>
                    <div class="mt-3 flex flex-col sm:flex-row sm:flex-wrap sm:space-x-6 gap-y-2">
                        <div class="flex items-center text-sm text-gray-500">
                            <svg class="flex-shrink-0 mr-1.5 h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                            {{ $proyek->alamat }}
                        </div>
                    </div>
                </div>
                <div class="mt-4 md:mt-0 flex flex-col items-end">
                    <span class="inline-flex items-center px-4 py-1.5 rounded-full text-sm font-bold text-blue-700 bg-blue-50 border border-blue-100 shadow-sm">
                        <span class="w-2 h-2 bg-blue-600 rounded-full mr-2 animate-pulse"></span>
                        {{ $proyek->status }}
                    </span>
                </div>
            </div>
            
            {{-- GRID BARU: PROGRESS BAR (KIRI) & RINGKASAN BIAYA (KANAN) --}}
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-stretch">
                
                {{-- 1. Progress Bar (Mengambil 2 Kolom) --}}
                <div class="lg:col-span-2 flex flex-col justify-center bg-gray-50 rounded-2xl p-6 border border-gray-100">
                    <div class="flex justify-between mb-4 items-end">
                        <div>
                            <span class="text-xs font-bold text-gray-400 uppercase tracking-wider">Progress Realisasi</span>
                            <div class="text-3xl font-extrabold text-gray-900 mt-1">{{ $proyek->progress }}%</div>
                        </div>
                        <span class="text-sm font-medium text-green-600 bg-green-50 px-3 py-1 rounded-full">{{ $proyek->status }}</span>
                    </div>
                    
                    {{-- Bar --}}
                    <div class="w-full bg-gray-200 rounded-full h-4 overflow-hidden shadow-inner">
                        <div class="{{ $proyek->progress == 100.0 ? 'bg-green-600' : 'bg-blue-600' }} h-4 rounded-full shadow-lg relative" style="width: {{ $proyek->progress }}%">
                            <div class="absolute inset-0 bg-white/20 w-full h-full animate-[shimmer_2s_infinite]"></div>
                        </div>
                    </div>
                </div>

                {{-- 2. Card Info Biaya (Mengambil 1 Kolom) --}}
                <div class="lg:col-span-1">
                    <div class="bg-blue-600 shadow-lg shadow-blue-200 rounded-2xl p-6 text-white relative overflow-hidden h-full flex flex-col justify-center">
                        {{-- Dekorasi Bulat --}}
                        <div class="absolute -top-10 -right-10 w-32 h-32 bg-white opacity-10 rounded-full"></div>
                        
                        <h3 class="text-xs font-bold text-blue-100 uppercase tracking-wider mb-4 relative z-10">Ringkasan Biaya</h3>
                        
                        <div class="space-y-4 relative z-10">
                            {{-- Total --}}
                            <div class="flex justify-between items-center border-b border-blue-500/50 pb-3">
                                <span class="text-blue-100 text-sm">Total Kontrak</span>
                                <span class="font-bold text-lg">{{ Number::currency($proyek->harga, "IDR") }}</span>
                            </div>
                            
                            {{-- Terbayar --}}
                            <div class="flex justify-between items-center">
                                <span class="text-blue-100 text-sm">Sudah Dibayar</span>
                                <div class="text-right">
                                    <span class="font-bold text-xl text-white">{{ Number::currency($proyek->sudah_dibayar, "IDR") }}</span>
                                    <span class="text-xs inline-block bg-blue-500 text-white px-1.5 py-0.5 rounded ml-1 font-medium">{{ $proyek->progress }}%</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>

    {{-- KONTEN UTAMA --}}
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

            {{-- KOLOM KIRI: INFO PENGAWAS --}}
            <div class="lg:col-span-1 space-y-6">
                {{-- Card Pengawas --}}
                <div class="bg-white shadow-lg rounded-2xl p-6 border border-gray-100">
                    <h3 class="text-sm font-bold text-gray-400 uppercase tracking-wider mb-4">Pengawas Proyek</h3>
                    <div class="flex items-center">
                        <img class="h-14 w-14 rounded-full object-cover border-2 border-white shadow-md" 
                             src="https://ui-avatars.com/api/?name=Joko+Santoso&background=random" 
                             alt="Foto Pengawas">
                        <div class="ml-4">
                            <h4 class="text-lg font-bold text-gray-900">{{ $proyek->pengawas->nama }}</h4>
                            <p class="text-sm text-blue-600 font-medium">Pengawas Lapangan</p>
                        </div>
                    </div>
                    <div class="mt-6">
                        <a href="{{ route('pelanggan.chat', ['rid' => $proyek->pengawas->id]) }}" class="block w-full bg-white border border-gray-300 text-gray-700 py-2.5 px-4 rounded-xl hover:bg-gray-50 hover:text-blue-600 hover:border-blue-300 transition text-sm font-bold text-center shadow-sm">
                            Chat Aplikasi
                        </a>
                    </div>
                </div>
                
                {{-- (Optional) Bisa tambah widget lain di sini misal Cuaca Lokasi atau Kontak Darurat --}}
            </div>

            {{-- KOLOM KANAN: DESKRIPSI & DOKUMENTASI --}}
            <div class="lg:col-span-2 space-y-8">
                
                {{-- Deskripsi --}}
                <div class="bg-white shadow-lg rounded-2xl p-6 border border-gray-100">
                    <h3 class="text-xl font-bold text-gray-900 mb-4">Deskripsi Pekerjaan</h3>
                    <p class="text-gray-600 leading-relaxed text-justify">
                        {{ $proyek->deskripsi }}
                    </p>
                </div>
            </div>
        </div>

        {{-- SECTION: TABEL PEMBAYARAN --}}
        <div class="mt-16">
            <h2 class="text-2xl font-bold text-gray-900 mb-6 border-l-4 border-blue-600 pl-4">Rincian Pembayaran</h2>
            
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100">
                <div class="overflow-x-auto no-scrollbar">
                    <table class="w-full text-left border-collapse min-w-[600px]">
                        <thead>
                            <tr class="bg-gray-50 text-gray-500 text-xs uppercase tracking-wider border-b border-gray-100">
                                <th class="px-6 py-4 font-bold text-center w-16">No</th>
                                <th class="px-6 py-4 font-bold">Deskripsi Tagihan</th>
                                <th class="px-6 py-4 font-bold">Total Harga</th>
                                <th class="px-6 py-4 font-bold text-center">Status</th>
                                <th class="px-6 py-4 font-bold text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @foreach ($proyek->payment->progresses as $index => $payment)
                                <tr class="hover:bg-gray-50 transition duration-150">
                                    <td class="px-6 py-5 text-center font-medium text-gray-400">{{ $index + 1 }}</td>
                                    <td class="px-6 py-5 text-gray-700">
                                        <div class="font-bold text-gray-900">{{ $paymeny->deskripsi ?? "-" }}</div>
                                        <span class="text-xs text-gray-400 mt-1 block">Pembayaran awal proyek</span>
                                    </td>
                                    <td class="px-6 py-5 font-bold text-gray-900">{{ Number::currency($payment->jumlah, 'IDR') }}</td>
                                    <td class="px-6 py-5 text-center">
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-green-100 text-green-700 border border-green-200">
                                            {{ $payment->status }}
                                        </span>
                                    </td>
                                    @if ($payment->status == 'lunas')
                                        <td class="px-6 py-5 text-center">
                                            <button class="text-gray-500 hover:text-blue-600 text-xs font-bold underline decoration-2 underline-offset-4 transition">
                                                Cetak Invoice
                                            </button>
                                        </td>
                                    @else
                                        <td class="px-6 py-5 text-center">
                                            <a href="{{ route('pelanggan.pembayaran') }}" class="inline-block bg-blue-600 hover:bg-blue-700 text-white text-xs font-bold py-2.5 px-5 rounded-lg shadow-md shadow-blue-200 transition transform hover:-translate-y-0.5">
                                                Bayar Sekarang
                                            </a>
                                        </td>
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </main>

</body>
</html>