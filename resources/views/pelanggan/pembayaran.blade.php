<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran - ADP Konstruksi</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

    <nav class="bg-white shadow-md sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                
                {{-- KIRI: LOGO & MENU DESKTOP --}}
                <div class="flex">
                    <div class="flex-shrink-0 flex items-center">
                        <span class="font-bold text-xl text-blue-600">ADP Konstruksi</span>
                    </div>
                    
                    {{-- Menu Navigasi Desktop (hidden di HP) --}}
                    <div class="hidden sm:ml-6 sm:flex sm:space-x-8">
                        <a href="{{ route('pelanggan.dashboard') }}" class="border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">Dashboard</a>
                        <a href="{{ route('pelanggan.galeri') }}" class="border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">Galeri Proyek</a>
                        <a href="{{ route('pelanggan.chat') }}" class="border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">Chat</a>
                        <a href="{{ route('pelanggan.pembayaran') }}" class="border-blue-500 text-gray-900 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">Pembayaran</a>
                    </div>
                </div>
                
                <div class="hidden sm:ml-6 sm:flex sm:items-center space-x-4">
                    <span class="text-sm text-gray-700 mr-2">Halo, {{ Auth::user()->nama ?? 'Pelanggan' }}!</span>
                    <a href="{{ route('pelanggan.profil') }}" class="text-sm font-medium text-gray-500 hover:text-gray-700">Profil Saya</a>
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="text-sm font-medium text-red-600 hover:text-red-800 ml-2">Logout</button>
                    </form>
                </div>

                <div class="flex items-center sm:hidden">
                    <button type="button" onclick="toggleMobileMenu()" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <div class="hidden sm:hidden bg-white border-t border-gray-200 absolute w-full z-40 shadow-lg" id="mobile-menu">
            <div class="pt-2 pb-3 space-y-1">
                <a href="{{ route('pelanggan.dashboard') }}" class="block pl-3 pr-4 py-2 border-l-4 border-transparent text-base font-medium text-gray-600 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-800">Dashboard</a>
                <a href="{{ route('pelanggan.galeri') }}" class="block pl-3 pr-4 py-2 border-l-4 border-transparent text-base font-medium text-gray-600 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-800">Galeri Proyek</a>
                <a href="{{ route('pelanggan.chat') }}" class="block pl-3 pr-4 py-2 border-l-4 border-transparent text-base font-medium text-gray-600 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-800">Chat</a>
                <a href="{{ route('pelanggan.pembayaran') }}" class="block pl-3 pr-4 py-2 border-l-4 border-blue-500 text-base font-medium text-blue-700 bg-blue-50">Pembayaran</a>
            </div>
            <div class="pt-4 pb-3 border-t border-gray-200">
                <div class="px-4">
                    <div class="text-base font-medium text-gray-800">Halo, {{ Auth::user()->name ?? 'Pelanggan' }}</div>
                </div>
                <div class="mt-3 space-y-1">
                    <a href="{{ route('pelanggan.profil') }}" class="block px-4 py-2 text-base font-medium text-gray-500 hover:text-gray-800 hover:bg-gray-100">Profil Saya</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="block w-full text-left px-4 py-2 text-base font-medium text-red-600 hover:text-red-800 hover:bg-gray-100">Logout</button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <div class="py-10">
        <header class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-3xl font-bold leading-tight text-gray-900">
                Pembayaran Proyek ({{ Auth::user()->name ?? 'Pelanggan' }})
            </h1>
            <p class="mt-2 text-gray-600">Kelola pembayaran dan lihat riwayat transaksi Anda.</p>
        </header>

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
                                
                                {{-- Row 1: Menunggu Pembayaran (Contoh) --}}
                                <tr class="bg-blue-50/50 hover:bg-blue-50 transition duration-150">
                                    <td class="px-6 py-5 text-center font-medium text-blue-500">1</td>
                                    <td class="px-6 py-5 text-gray-700">
                                        <div class="font-bold text-blue-900">Pembayaran Tahap Akhir</div>
                                        <span class="text-xs text-gray-500 mt-1 block">Finishing & Serah Terima</span>
                                    </td>
                                    <td class="px-6 py-5 font-bold text-blue-700">Rp 45.000.000</td>
                                    <td class="px-6 py-5 text-center">
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-yellow-100 text-yellow-700 border border-yellow-200 animate-pulse">
                                            Menunggu Pembayaran
                                        </span>
                                    </td>
                                    <td class="px-6 py-5 text-center">
                                        <a href="{{ route('pelanggan.pembayaran') }}" class="inline-block bg-blue-600 hover:bg-blue-700 text-white text-xs font-bold py-2.5 px-5 rounded-lg shadow-md shadow-blue-200 transition transform hover:-translate-y-0.5">
                                            Bayar Sekarang
                                        </a>
                                    </td>
                                </tr>

                                {{-- Row 2: Lunas (Contoh) --}}
                                <tr class="hover:bg-gray-50 transition duration-150">
                                    <td class="px-6 py-5 text-center font-medium text-gray-400">2</td>
                                    <td class="px-6 py-5 text-gray-700">
                                        <div class="font-bold text-gray-900">Uang Muka (DP)</div>
                                        <span class="text-xs text-gray-400 mt-1 block">Pembayaran awal proyek</span>
                                    </td>
                                    <td class="px-6 py-5 font-bold text-gray-900">Rp 105.000.000</td>
                                    <td class="px-6 py-5 text-center">
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-green-100 text-green-700 border border-green-200">
                                            Lunas
                                        </span>
                                    </td>
                                    <td class="px-6 py-5 text-center">
                                        <button class="text-gray-500 hover:text-blue-600 text-xs font-bold underline decoration-2 underline-offset-4 transition">
                                            Cetak Invoice
                                        </button>
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </main>
    </div>

</body>
</html>