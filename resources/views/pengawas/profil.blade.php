<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Saya - ADP Konstruksi</title>
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
                        <a href="{{ route('pengawas.dashboard') }}" class="border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                            Proyek Saya
                        </a>
                        
                        <!-- Link Chat Pelanggan -->
                        <a href="{{ route('pengawas.chat') }}" class="border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                            Chat Pelanggan
                        </a>
                    </div>
                </div>
                
                <!-- MENU KANAN -->
                <div class="hidden sm:ml-6 sm:flex sm:items-center">
                    <span class="text-sm text-gray-700 mr-4">
                        Halo, {{ Auth::user()->name ?? 'Pengawas' }}!
                    </span>
                    
                    <!-- Link Profil (Aktif) -->
                    <a href="#" class="border-blue-500 text-gray-900 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium mr-4">
                        Profil Saya
                    </a>
                    
                    <!-- Form Logout -->
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="text-sm font-medium text-gray-500 hover:text-red-600 transition">
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <!-- KONTEN PROFIL -->
    <div class="py-10">
        <header class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-3xl font-bold leading-tight text-gray-900">
                Profil Saya (PS 2)
            </h1>
            <p class="mt-2 text-gray-600">Perbarui informasi akun pribadi Anda.</p>
        </header>
        
        <main class="max-w-xl mx-auto px-4 sm:px-6 lg:px-8 mt-8">
            <div class="bg-white p-8 rounded-lg shadow-lg">
                
                <!-- Form Update Profil -->
                <form class="space-y-6" action="#" method="POST"> <!-- Tambahkan route update nanti -->
                    @csrf
                    @method('PUT')

                    <!-- NAMA LENGKAP -->
                    <div>
                        <label for="full_name" class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                        <input type="text" name="full_name" id="full_name" 
                               class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" 
                               value="{{ Auth::user()->name ?? 'Andi Setiawan' }}">
                    </div>

                    <!-- NOMOR TELEPON -->
                    <div>
                        <label for="phone_number" class="block text-sm font-medium text-gray-700">Nomor Telepon (untuk Login)</label>
                        <input type="text" name="phone_number" id="phone_number" 
                               class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" 
                               value="{{ Auth::user()->phone ?? '081298765432' }}">
                    </div>

                    <div class="pt-4 border-t border-gray-200">
                        <h3 class="text-lg font-medium text-gray-900">Ubah Sandi</h3>
                        <p class="text-sm text-gray-500">Kosongkan jika tidak ingin mengubah sandi.</p>
                    </div>

                    <!-- SANDI SAAT INI -->
                    <div>
                        <label for="current_password" class="block text-sm font-medium text-gray-700">Sandi Saat Ini</label>
                        <input type="password" name="current_password" id="current_password" 
                               class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                    </div>

                    <!-- SANDI BARU -->
                    <div>
                        <label for="new_password" class="block text-sm font-medium text-gray-700">Sandi Baru</label>
                        <input type="password" name="new_password" id="new_password" 
                               class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                    </div>

                    <!-- TOMBOL SIMPAN -->
                    <div class="text-right">
                        <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition">
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </main>
    </div>

</body>
</html>