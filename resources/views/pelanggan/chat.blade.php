<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat - ADP Konstruksi</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

    <!-- NAVBAR PELANGGAN -->
    <nav class="bg-white shadow-md sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex">
                    <div class="flex-shrink-0 flex items-center">
                        <span class="font-bold text-xl text-blue-600">ADP Konstruksi</span>
                    </div>
                    <div class="hidden sm:ml-6 sm:flex sm:space-x-8">
                        <a href="{{ route('pelanggan.dashboard') }}" class="{{ request()->routeIs('pelanggan.dashboard') ? 'border-blue-500 text-gray-900' : 'border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700' }} inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                            Dashboard
                        </a>
                        <a href="{{ route('pelanggan.galeri') }}" class="{{ request()->routeIs('pelanggan.galeri') ? 'border-blue-500 text-gray-900' : 'border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700' }} inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                            Galeri Proyek
                        </a>
                        <a href="{{ route('pelanggan.chat') }}" class="{{ request()->routeIs('pelanggan.chat') ? 'border-blue-500 text-gray-900' : 'border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700' }} inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                            Chat
                        </a>
                    </div>
                </div>
                
                <!-- MENU KANAN -->
                <div class="hidden sm:ml-6 sm:flex sm:items-center space-x-4">
                    <span class="text-sm text-gray-700 mr-2">Halo, {{ Auth::user()->name ?? 'Pelanggan' }}!</span>
                    <a href="{{ route('pelanggan.profil') }}" class="text-sm font-medium text-gray-500 hover:text-gray-700">Profil Saya</a>
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="text-sm font-medium text-red-600 hover:text-red-800 ml-2">Logout</button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <!-- KONTEN CHAT -->
    <div class="py-10">
        <header class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-3xl font-bold leading-tight text-gray-900">
                Hubungi Kami
            </h1>
            <p class="mt-2 text-gray-600">Diskusikan proyek Anda dengan tim kami.</p>
        </header>
        
        <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-8">
            <div class="flex h-[70vh] bg-white rounded-lg shadow-lg overflow-hidden border border-gray-200">
                
                <!-- DAFTAR KONTAK (KIRI) - STATIC -->
                <div class="w-1/3 border-r border-gray-200 flex flex-col">
                    <div class="p-4 border-b border-gray-200 bg-gray-50">
                        <h2 class="text-lg font-semibold text-gray-700">Kontak Saya</h2>
                    </div>
                    <ul class="divide-y divide-gray-200 overflow-y-auto flex-1">
                        <!-- Kontak 1 (Pengawas) - Aktif -->
                        <li class="p-4 flex items-center bg-blue-50 cursor-pointer border-l-4 border-blue-600 hover:bg-blue-100 transition">
                            <img class="h-10 w-10 rounded-full" src="https://ui-avatars.com/api/?name=Andi+Setiawan&background=random" alt="Pengawas">
                            <div class="ml-3 flex-1 min-w-0">
                                <div class="flex justify-between">
                                    <p class="text-sm font-medium text-gray-900 truncate">Pengawas Andi</p>
                                    <span class="text-xs text-gray-500">09:16</span>
                                </div>
                                <p class="text-xs text-gray-500 truncate">Proyek Tipe 70</p>
                                <p class="text-sm text-gray-600 truncate">Pagi, Pak Ahmad. Sudah 75%...</p>
                            </div>
                        </li>
                        
                        <!-- Kontak 2 (CS) -->
                        <li class="p-4 flex items-center hover:bg-gray-50 cursor-pointer transition">
                            <img class="h-10 w-10 rounded-full" src="https://ui-avatars.com/api/?name=Customer+Service&background=random" alt="CS">
                            <div class="ml-3 flex-1 min-w-0">
                                <div class="flex justify-between">
                                    <p class="text-sm font-medium text-gray-900 truncate">Customer Service</p>
                                    <span class="text-xs text-gray-500">Kemarin</span>
                                </div>
                                <p class="text-sm text-gray-500 truncate">Ada yang bisa kami bantu?</p>
                            </div>
                        </li>
                    </ul>
                </div>
                
                <!-- JENDELA CHAT (KANAN) -->
                <div class="w-2/3 flex flex-col">
                    <!-- Header Chat -->
                    <div class="p-4 border-b border-gray-200 bg-white flex justify-between items-center shadow-sm z-10">
                        <div>
                            <h2 class="text-lg font-bold text-gray-800">Pengawas Andi</h2>
                            <p class="text-xs text-green-600 flex items-center">
                                <span class="h-2 w-2 bg-green-500 rounded-full mr-1"></span> Online
                            </p>
                        </div>
                    </div>
                    
                    <!-- Isi Chat -->
                    <div class="flex-1 p-6 space-y-4 overflow-y-auto bg-gray-50">
                        
                        <!-- Chat Lawan (Kiri) -->
                        <div class="flex">
                            <div class="bg-white border border-gray-200 text-gray-800 p-3 rounded-lg rounded-tl-none max-w-xs shadow-sm">
                                <p class="text-sm">Selamat pagi, Pak. Bagaimana progres pondasinya?</p>
                                <span class="text-xs text-gray-400 block text-right mt-1">09:15</span>
                            </div>
                        </div>
                        
                        <!-- Chat Saya (Kanan) -->
                        <div class="flex justify-end">
                            <div class="bg-blue-600 text-white p-3 rounded-lg rounded-tr-none max-w-xs shadow-md">
                                <p class="text-sm">Pagi, Pak Ahmad. Sudah 75% selesai. Hari ini targetnya selesai gali semua.</p>
                                <span class="text-xs text-blue-100 block text-right mt-1">09:16</span>
                            </div>
                        </div>
                        
                        <!-- Chat Lawan (Kiri) -->
                         <div class="flex">
                            <div class="bg-white border border-gray-200 text-gray-800 p-3 rounded-lg rounded-tl-none max-w-xs shadow-sm">
                                <p class="text-sm">Oke, Pak. Ditunggu foto progresnya nanti sore ya.</p>
                                <span class="text-xs text-gray-400 block text-right mt-1">09:17</span>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Input Chat -->
                    <div class="p-4 bg-white border-t border-gray-200">
                        <div class="flex items-center space-x-2">
                            <input type="text" class="flex-1 px-4 py-2 border border-gray-300 rounded-full focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="Ketik balasan Anda...">
                            
                            <!-- TOMBOL KAMERA (UPLOAD GAMBAR) [BARU] -->
                            <button class="p-2 rounded-full text-gray-500 hover:bg-gray-100 hover:text-blue-600 focus:outline-none transition" title="Kirim Gambar">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </button>

                            <!-- TOMBOL KIRIM -->
                            <button class="inline-flex justify-center p-2 rounded-full text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 shadow-md transition">
                                <svg class="h-5 w-5 transform rotate-90" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5-1.429A1 1 0 009 15.571V11a1 1 0 112 0v4.571a1 1 0 00.725.962l5 1.428a1 1 0 001.17-1.408l-7-14z" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

</body>
</html>