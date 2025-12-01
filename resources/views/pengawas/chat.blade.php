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

    <!-- NAVBAR PENGAWAS -->
    <nav class="bg-white shadow-md sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex">
                    <div class="flex-shrink-0 flex items-center">
                        <span class="font-bold text-xl text-blue-600">ADP - Panel Pengawas</span>
                    </div>
                    <div class="hidden sm:ml-6 sm:flex sm:space-x-8">
                        <!-- Link Proyek Saya -->
                        <a href="{{ route('pengawas.dashboard') }}" 
                           class="{{ request()->routeIs('pengawas.dashboard') ? 'border-blue-500 text-gray-900' : 'border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700' }} inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                            Proyek Saya
                        </a>
                        
                        <!-- Link Chat Pelanggan (Aktif) -->
                        <a href="{{ route('pengawas.chat') }}" 
                           class="{{ request()->routeIs('pengawas.chat') ? 'border-blue-500 text-gray-900' : 'border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700' }} inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                            Chat Pelanggan
                        </a>
                    </div>
                </div>
                
                <!-- MENU KANAN -->
                <div class="hidden sm:ml-6 sm:flex sm:items-center space-x-4">
                    <span class="text-sm text-gray-700 mr-2">
                        Halo, {{ Auth::user()->name ?? 'Pengawas' }}!
                    </span>
                    
                    <!-- Link Profil (Placeholder jika belum ada route profil) -->
                    <a href="#" class="text-sm font-medium text-gray-500 hover:text-gray-700">Profil Saya</a>
                    
                    <!-- Form Logout -->
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="text-sm font-medium text-red-600 hover:text-red-800 ml-2">
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <!-- KONTEN CHAT -->
    <div class="py-10">
        <header class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-3xl font-bold leading-tight text-gray-900">
                Chat Pelanggan (PS 3)
            </h1>
        </header>
        
        <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-8">
            <div class="flex h-[70vh] bg-white rounded-lg shadow-lg overflow-hidden border border-gray-200">
                
                <!-- DAFTAR KONTAK (KIRI) -->
                <div class="w-1/3 border-r border-gray-200 flex flex-col">
                    <div class="p-4 border-b border-gray-200 bg-gray-50">
                        <input type="text" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="Cari kontak...">
                    </div>
                    <ul class="divide-y divide-gray-200 overflow-y-auto flex-1">
                        <!-- Kontak 1 (Aktif) -->
                        <li class="p-4 flex items-center bg-blue-50 cursor-pointer border-l-4 border-blue-600 hover:bg-blue-100 transition">
                            <img class="h-10 w-10 rounded-full" src="https://ui-avatars.com/api/?name=Ahmad&background=random" alt="Ahmad">
                            <div class="ml-3 flex-1 min-w-0">
                                <div class="flex justify-between">
                                    <p class="text-sm font-medium text-gray-900 truncate">Bpk. Ahmad</p>
                                    <span class="text-xs text-gray-500">09:16</span>
                                </div>
                                <p class="text-xs text-gray-500 truncate">Proyek Tipe 70</p>
                                <p class="text-sm text-gray-600 truncate">Oke, Pak. Ditunggu foto progresnya...</p>
                            </div>
                        </li>
                        
                        <!-- Kontak 2 -->
                        <li class="p-4 flex items-center hover:bg-gray-50 cursor-pointer transition">
                            <img class="h-10 w-10 rounded-full" src="https://ui-avatars.com/api/?name=Sinta&background=random" alt="Sinta">
                            <div class="ml-3 flex-1 min-w-0">
                                <div class="flex justify-between">
                                    <p class="text-sm font-medium text-gray-900 truncate">Ibu Sinta</p>
                                    <span class="text-xs text-gray-500">Kemarin</span>
                                </div>
                                <p class="text-xs text-gray-500 truncate">Renovasi Dapur</p>
                                <p class="text-sm text-gray-500 truncate">Apakah bisa tambah stopkontak?</p>
                            </div>
                        </li>
                        
                        <!-- Kontak 3 -->
                        <li class="p-4 flex items-center hover:bg-gray-50 cursor-pointer transition">
                            <img class="h-10 w-10 rounded-full" src="https://ui-avatars.com/api/?name=PT+Maju+Jaya&background=random" alt="PT Maju Jaya">
                            <div class="ml-3 flex-1 min-w-0">
                                <div class="flex justify-between">
                                    <p class="text-sm font-medium text-gray-900 truncate">PT. Maju Jaya</p>
                                    <span class="text-xs text-gray-500">Kemarin</span>
                                </div>
                                <p class="text-xs text-gray-500 truncate">Ruko 2 Lantai</p>
                                <p class="text-sm text-gray-500 truncate">Mohon segera kirimkan RAB-nya.</p>
                            </div>
                        </li>
                    </ul>
                </div>
                
                <!-- JENDELA CHAT (KANAN) -->
                <div class="w-2/3 flex flex-col">
                    <!-- Header Chat -->
                    <div class="p-4 border-b border-gray-200 bg-white flex justify-between items-center shadow-sm z-10">
                        <div>
                            <h2 class="text-lg font-bold text-gray-800">Bpk. Ahmad (Proyek Tipe 70)</h2>
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
                        <div class="flex items-center space-x-3">
                            <input type="text" class="flex-1 px-4 py-2 border border-gray-300 rounded-full focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="Ketik balasan Anda...">
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