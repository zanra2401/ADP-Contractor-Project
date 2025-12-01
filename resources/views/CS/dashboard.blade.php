<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard CS - ADP Konstruksi</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

    <!-- NAVBAR CS -->
    <nav class="bg-white shadow-md sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex">
                    <div class="flex-shrink-0 flex items-center">
                        <span class="font-bold text-xl text-blue-600">ADP - Panel CS</span>
                    </div>
                    <div class="hidden sm:ml-6 sm:flex sm:space-x-8">
                        <!-- Link Chat Masuk (Aktif) -->
                        <a href="{{ route('cs.dashboard') }}" class="{{ request()->routeIs('cs.dashboard') ? 'border-blue-500 text-gray-900' : 'border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700' }} inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                            Chat Masuk
                        </a>
                        
                        <!-- Link Profil -->
                        <a href="{{ route('cs.profil') }}" class="{{ request()->routeIs('cs.profil') ? 'border-blue-500 text-gray-900' : 'border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700' }} inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                            Profil Saya
                        </a>
                    </div>
                </div>
                
                <!-- MENU KANAN -->
                <div class="hidden sm:ml-6 sm:flex sm:items-center space-x-4">
                    <span class="text-sm text-gray-700 mr-2">Halo, {{ Auth::user()->name ?? 'CS Budi' }}!</span>
                    
                    <!-- Form Logout -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-sm font-medium text-gray-500 hover:text-red-600 transition">
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <!-- KONTEN UTAMA -->
    <div class="py-10">
        <header class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-3xl font-bold leading-tight text-gray-900">
                Chat Masuk dari Pengunjung
            </h1>
        </header>
        
        <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-8">
            <div class="flex h-[70vh] bg-white rounded-lg shadow-lg overflow-hidden">
                
                <!-- DAFTAR KONTAK (KIRI) -->
                <div class="w-1/3 border-r border-gray-200 flex flex-col">
                    <div class="p-4 border-b border-gray-200">
                        <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Cari pengunjung...">
                    </div>
                    <ul class="divide-y divide-gray-200 overflow-y-auto flex-1">
                        <!-- Kontak 1 (Aktif) -->
                        <li class="p-4 flex items-center bg-blue-50 cursor-pointer border-l-4 border-blue-600">
                            <img class="h-10 w-10 rounded-full" src="https://ui-avatars.com/api/?name=Rina&background=random" alt="Rina">
                            <div class="ml-3 flex-1 min-w-0">
                                <div class="flex justify-between">
                                    <p class="text-sm font-medium text-gray-900 truncate">Rina (Pengunjung)</p>
                                    <span class="text-xs text-gray-500">10:30</span>
                                </div>
                                <p class="text-sm text-blue-600 font-semibold truncate">Halo, saya mau tanya...</p>
                            </div>
                            <span class="ml-2 bg-blue-600 text-white text-xs font-bold rounded-full h-5 w-5 flex items-center justify-center">1</span>
                        </li>
                        
                        <!-- Kontak 2 -->
                        <li class="p-4 flex items-center hover:bg-gray-50 cursor-pointer transition">
                            <img class="h-10 w-10 rounded-full" src="https://ui-avatars.com/api/?name=Joko&background=random" alt="Joko">
                            <div class="ml-3 flex-1 min-w-0">
                                <div class="flex justify-between">
                                    <p class="text-sm font-medium text-gray-900 truncate">Joko (Pengunjung)</p>
                                    <span class="text-xs text-gray-500">Kemarin</span>
                                </div>
                                <p class="text-sm text-gray-500 truncate">Oke, terima kasih infonya.</p>
                            </div>
                        </li>
                        
                        <!-- Kontak 3 -->
                        <li class="p-4 flex items-center hover:bg-gray-50 cursor-pointer transition">
                            <img class="h-10 w-10 rounded-full" src="https://ui-avatars.com/api/?name=Ahmad&background=random" alt="Ahmad">
                            <div class="ml-3 flex-1 min-w-0">
                                <div class="flex justify-between">
                                    <p class="text-sm font-medium text-gray-900 truncate">Bpk. Ahmad (Klien)</p>
                                    <span class="text-xs text-gray-500">Kemarin</span>
                                </div>
                                <p class="text-sm text-gray-500 truncate">Saya ada masalah pembayaran...</p>
                            </div>
                        </li>
                    </ul>
                </div>
                
                <!-- JENDELA CHAT (KANAN) -->
                <div class="w-2/3 flex flex-col">
                    <!-- Header Chat -->
                    <div class="p-4 border-b border-gray-200 bg-gray-50 flex justify-between items-center">
                        <h2 class="text-lg font-semibold text-gray-900">Rina (Pengunjung Baru)</h2>
                        <span class="px-2 py-1 bg-green-100 text-green-800 text-xs font-semibold rounded-full">Online</span>
                    </div>
                    
                    <!-- Isi Chat -->
                    <div class="flex-1 p-6 space-y-4 overflow-y-auto bg-gray-50">
                        <!-- Chat dari Pengunjung -->
                        <div class="flex">
                            <div class="bg-white border border-gray-200 text-gray-800 p-3 rounded-lg rounded-tl-none max-w-xs shadow-sm">
                                <p class="text-sm">Halo, saya mau tanya, untuk renovasi dapur kira-kira harganya berapa ya?</p>
                                <span class="text-xs text-gray-400 block text-right mt-1">10:30</span>
                            </div>
                        </div>
                        
                        <!-- Chat dari CS (Anda) -->
                        <div class="flex justify-end">
                            <div class="bg-blue-600 text-white p-3 rounded-lg rounded-tr-none max-w-xs shadow-md">
                                <p class="text-sm">Selamat pagi, Ibu Rina. Tentu, untuk renovasi harganya bervariasi tergantung luas dan material yang digunakan.</p>
                                <span class="text-xs text-blue-100 block text-right mt-1">10:31</span>
                            </div>
                        </div>
                        
                        <!-- Chat dari CS (Anda) -->
                         <div class="flex justify-end">
                            <div class="bg-blue-600 text-white p-3 rounded-lg rounded-tr-none max-w-xs shadow-md">
                                <p class="text-sm">Apakah Ibu sudah memiliki desain atau ukuran ruangannya?</p>
                                <span class="text-xs text-blue-100 block text-right mt-1">10:31</span>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Input Chat -->
                    <div class="p-4 bg-white border-t border-gray-200">
                        <div class="flex items-center space-x-3">
                            <input type="text" class="flex-1 px-4 py-2 border border-gray-300 rounded-full focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="Ketik balasan Anda...">
                            <button class="inline-flex justify-center p-2 rounded-full text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
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