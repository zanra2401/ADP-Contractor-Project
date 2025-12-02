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

    <!-- NAVBAR PELANGGAN -->
    <nav class="bg-white shadow-md sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex">
                    <div class="flex-shrink-0 flex items-center">
                        <span class="font-bold text-xl text-blue-600">ADP Konstruksi</span>
                    </div>
                    <div class="hidden sm:ml-6 sm:flex sm:space-x-8">
                        <a href="{{ route('pelanggan.dashboard') }}" class="border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                            Dashboard
                        </a>
                        <a href="{{ route('pelanggan.galeri') }}" class="border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                            Galeri Proyek
                        </a>
                        <a href="{{ route('pelanggan.chat') }}" class="border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                            Chat
                        </a>
                    </div>
                </div>
                
                <!-- MENU KANAN -->
                <div class="hidden sm:ml-6 sm:flex sm:items-center">
                    <!-- Nama User -->
                    <span class="text-sm text-gray-700 mr-4">
                        Halo, {{ Auth::user()->nama ?? Auth::user()->name ?? 'Pelanggan' }}!
                    </span>
                    
                    <!-- Link Profil (Aktif) -->
                    <a href="{{ route('pelanggan.profil') }}" class="border-blue-500 text-gray-900 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium mr-4">
                        Profil Saya
                    </a>
                    
                    <!-- Logout -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-sm font-medium text-gray-500 hover:text-red-600">
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
                Profil Saya
            </h1>
            <p class="mt-2 text-gray-600">Perbarui informasi akun pribadi Anda.</p>
        </header>
        
        <main class="max-w-xl mx-auto px-4 sm:px-6 lg:px-8 mt-8">
            <div class="bg-white p-8 rounded-lg shadow-lg">
                
                <!-- Form Update Profil -->
                <form class="space-y-6" action="#" method="POST">
                    @csrf
                    <!-- Method PUT biasanya digunakan untuk update data -->
                    @method('PUT') 

                    <!-- NAMA LENGKAP -->
                    <div>
                        <label for="nama" class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                        <input type="text" name="nama" id="nama" 
                               class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" 
                               value="{{ Auth::user()->nama ?? Auth::user()->name }}">
                    </div>

                    <!-- NOMOR TELEPON -->
                    <div>
                        <label for="nomor_telepon" class="block text-sm font-medium text-gray-700">Nomor Telepon (Login)</label>
                        <input type="text" name="nomor_telepon" id="nomor_telepon" 
                               class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" 
                               value="{{ Auth::user()->nomor_telepon ?? Auth::user()->phone }}">
                    </div>

                    <!-- EMAIL (Opsional, jika ada di database) -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700">Alamat Email</label>
                        <input type="email" name="email" id="email" 
                               class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" 
                               value="{{ Auth::user()->email ?? '' }}" placeholder="contoh@email.com">
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
                        <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </main>
    </div>

</body>
</html>