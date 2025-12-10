<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Proyek - ADP Konstruksi</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

    <nav class="bg-white shadow-md sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                
                {{-- KIRI: LOGO & MENU DESKTOP --}}
                <div class="flex">
                    <div class="flex-shrink-0 flex items-center">
                        <span class="font-bold text-xl text-blue-600">ADP - Panel Pengawas</span>
                    </div>
                    
                    {{-- Menu Navigasi Desktop (hidden di HP) --}}
                    <div class="hidden sm:ml-6 sm:flex sm:space-x-8">
                        <a href="{{ route('pengawas.dashboard') }}" 
                           class="border-blue-500 text-gray-900 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                            Proyek Saya
                        </a>
                        <a href="{{ route('pengawas.chat') }}" 
                           class="border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                            Chat Pelanggan
                        </a>
                    </div>
                </div>
                
                <div class="hidden sm:ml-6 sm:flex sm:items-center space-x-4">
                    <span class="text-sm text-gray-700 mr-2">
                        Halo, {{ Auth::user()->name ?? 'Pengawas' }}!
                    </span>
                    
                    <a href="{{ route('pengawas.profil') }}" class="text-sm font-medium text-gray-500 hover:text-gray-700">Profil Saya</a>
                    
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="text-sm font-medium text-red-600 hover:text-red-800 ml-2">
                            Logout
                        </button>
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
                 <a href="{{ route('pengawas.dashboard') }}" class="block pl-3 pr-4 py-2 border-l-4 border-blue-500 text-base font-medium text-blue-700 bg-blue-50">Proyek Saya</a>
                <a href="{{ route('pengawas.chat') }}" class="block pl-3 pr-4 py-2 border-l-4 border-transparent text-base font-medium text-gray-600 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-800">Chat Pelanggan</a>
            </div>
            <div class="pt-4 pb-3 border-t border-gray-200">
                <div class="px-4">
                    <div class="text-base font-medium text-gray-800">Halo, {{ Auth::user()->name ?? 'Pengawas' }}</div>
                </div>
                <div class="mt-3 space-y-1">
                    <a href="{{ route('pengawas.profil') }}" class="block px-4 py-2 text-base font-medium text-gray-500 hover:text-gray-800 hover:bg-gray-100">Profil Saya</a>
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
            <a href="{{ route('pengawas.dashboard') }}" class="text-sm font-medium text-blue-600 hover:text-blue-800 flex items-center transition">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Kembali ke Daftar Proyek
            </a>
            <h1 class="text-3xl font-bold leading-tight text-gray-900 mt-2">
                Rumah Tipe 70 - Citraland
            </h1>
            <p class="mt-1 text-lg text-gray-600">Klien: Bpk. Ahmad (08123456789)</p>
        </header>

        <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-8 grid grid-cols-1 md:grid-cols-3 gap-8">

            <div class="md:col-span-2 space-y-8">
                
                <div class="bg-white p-6 rounded-xl shadow-lg">
                    <h3 class="text-xl font-semibold text-gray-900">Update Progres Proyek</h3>
                    <form class="space-y-4 mt-4" action="#" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div>
                            <label for="progress_title" class="block text-sm font-medium text-gray-700">Judul Update</label>
                            <input type="text" name="progress_title" id="progress_title" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" placeholder="Contoh: Pemasangan Tiang Pancang Selesai">
                        </div>
                        <div>
                            <label for="progress_description" class="block text-sm font-medium text-gray-700">Deskripsi (Teks)</label>
                            <textarea id="progress_description" name="progress_description" rows="3" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" placeholder="Tuliskan detail pekerjaan yang telah dilakukan..."></textarea>
                        </div>
                        <div>
                            <label for="progress_image" class="block text-sm font-medium text-gray-700">Unggah Foto (Image)</label>
                            <input type="file" name="progress_image" id="progress_image" class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                        </div>
                         <div>
                            <label for="progress_video" class="block text-sm font-medium text-gray-700">Unggah Video (Opsional)</label>
                            <input type="file" name="progress_video" id="progress_video" accept="video/*" class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                        </div>
                        <div class="text-right">
                            <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 transition">
                                Kirim Update
                            </button>
                        </div>
                    </form>
                </div>

                <div class="bg-white p-6 rounded-xl shadow-lg">
                    <h3 class="text-xl font-semibold text-gray-900">Riwayat Progres</h3>
                    <ul class="divide-y divide-gray-200 mt-4">
                        <li class="py-4 flex flex-col sm:flex-row justify-between items-start sm:items-center">
                            <div>
                                <p class="text-sm font-medium text-gray-900">Pengerjaan Pondasi Dimulai</p>
                                <p class="text-sm text-gray-500 mt-1">Update: 3 hari lalu (Teks, 2 Foto)</p>
                            </div>
                            <div class="mt-2 sm:mt-0 flex space-x-2">
                                <a href="#" class="text-sm font-medium text-indigo-600 hover:text-indigo-900">Edit</a>
                                <a href="#" class="text-sm font-medium text-red-600 hover:text-red-900">Hapus</a>
                            </div>
                        </li>
                        <li class="py-4 flex flex-col sm:flex-row justify-between items-start sm:items-center">
                            <div>
                                <p class="text-sm font-medium text-gray-900">Pembersihan Lahan Selesai</p>
                                <p class="text-sm text-gray-500 mt-1">Update: 1 minggu lalu (Teks, 1 Video)</p>
                            </div>
                            <div class="mt-2 sm:mt-0 flex space-x-2">
                                <a href="#" class="text-sm font-medium text-indigo-600 hover:text-indigo-900">Edit</a>
                                <a href="#" class="text-sm font-medium text-red-600 hover:text-red-900">Hapus</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="md:col-span-1">
                <div class="bg-white p-6 rounded-xl shadow-lg sticky top-20">
                    <h3 class="text-xl font-semibold text-gray-900">Harga Proyek</h3>
                    <form class="space-y-4 mt-4" action="#" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div>
                            <label for="project_price" class="block text-sm font-medium text-gray-700">Total Harga Proyek (Rp)</label>
                            <input type="number" name="project_price" id="project_price" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" placeholder="Contoh: 500000000">
                        </div>
                        <div>
                            <label for="rab_file" class="block text-sm font-medium text-gray-700">Unggah File RAB (PDF/XLSX)</label>
                            <input type="file" name="rab_file" id="rab_file" class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-purple-50 file:text-purple-700 hover:file:bg-purple-100">
                        </div>
                        <div class="text-right">
                            <button type="submit" class="w-full inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-purple-600 hover:bg-purple-700 transition">
                                Tetapkan Harga
                            </button>
                        </div>
                    </form>
                </div>
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