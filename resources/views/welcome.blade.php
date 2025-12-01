<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADP Konstruksi - Bangun Impian Anda</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-white">

    <!-- NAVBAR -->
    <nav class="bg-white shadow-md sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                
                <!-- LOGO & MENU KIRI -->
                <div class="flex">
                    <div class="flex-shrink-0 flex items-center">
                        <span class="font-bold text-xl text-blue-600">ADP Konstruksi</span>
                    </div>
                    <div class="hidden sm:ml-6 sm:flex sm:space-x-8">
                        <a href="{{ url('/') }}" class="border-blue-500 text-gray-900 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                            Home
                        </a>
                        <!-- Link Galeri (Pastikan route ini bisa diakses publik) -->
                        <a href="{{ route('pelanggan.galeri') }}" class="border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                            Galeri Proyek
                        </a>
                        <a href="{{ route('pelanggan.renovasi') }}" class="border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                            Layanan Renovasi
                        </a>
                        <!-- <a href="#" class="border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                            Tentang Kami
                        </a> -->
                    </div>
                </div>

                <!-- TOMBOL LOGIN & REGISTER (KANAN) -->
                <div class="hidden sm:ml-6 sm:flex sm:items-center space-x-4">
                    <!-- Link Login Laravel -->
                    <a href="{{ route('login') }}" class="text-sm font-medium text-gray-700 hover:text-blue-600">
                        Masuk
                    </a>
                    
                    <!-- Link Register Laravel (Pastikan route 'register' ada) -->
                    <a href="{{ route('register') }}" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700">
                        Registrasi
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- HERO SECTION (BANNER) -->
    <header class="relative bg-gray-800 text-white text-center py-40">
        <div class="absolute inset-0">
            <img src="https://images.unsplash.com/photo-1541888946425-d81bb19240f5?fit=crop&w=1920&q=80" alt="Banner Konstruksi" class="w-full h-full object-cover opacity-50">
        </div>
        <div class="relative z-10">
            <h1 class="text-5xl font-extrabold">Wujudkan Bangunan Impian Anda</h1>
            <p class="mt-4 text-xl max-w-2xl mx-auto">Kualitas terjamin, progres transparan, dan harga kompetitif. Bangun bersama kami.</p>
            <a href="{{ route('pelanggan.galeri') }}" class="mt-8 inline-block bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-8 rounded-lg text-lg">
                Lihat Desain
            </a>
        </div>
    </header>

    <!-- KONTEN UTAMA -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <h2 class="text-3xl font-bold text-center text-gray-900">Galeri Desain Unggulan</h2>
        <p class="text-center text-gray-600 mt-2">Temukan inspirasi untuk proyek Anda.</p>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mt-10">
            
            <!-- Item 1 -->
            <div class="bg-white rounded-lg shadow-lg overflow-hidden group">
                <img class="h-64 w-full object-cover group-hover:opacity-75" src="https://images.unsplash.com/photo-1570129477490-d11e74d11d1e?fit=crop&w=800&q=60" alt="Rumah Minimalis">
                <div class="p-5">
                    <h3 class="text-xl font-semibold text-gray-900">Rumah Minimalis Tipe 80</h3>
                    <p class="text-gray-600 mt-1">3 Kamar Tidur, 2 Kamar Mandi</p>
                </div>
            </div>

            <!-- Item 2 -->
            <div class="bg-white rounded-lg shadow-lg overflow-hidden group">
                <img class="h-64 w-full object-cover group-hover:opacity-75" src="https://images.unsplash.com/photo-1600585154340-be6161a56a0c?fit=crop&w=800&q=60" alt="Rumah Modern">
                <div class="p-5">
                    <h3 class="text-xl font-semibold text-gray-900">Rumah Modern Tipe 120</h3>
                    <p class="text-gray-600 mt-1">4 Kamar Tidur, 3 Kamar Mandi, Kolam Renang</p>
                </div>
            </div>

            <!-- Item 3 -->
            <div class="bg-white rounded-lg shadow-lg overflow-hidden group">
                <img class="h-64 w-full object-cover group-hover:opacity-75" src="https://images.unsplash.com/photo-1564013799919-ab600027ffc6?fit=crop&w=800&q=60" alt="Rumah Mediterania">
                <div class="p-5">
                    <h3 class="text-xl font-semibold text-gray-900">Desain Ruko 3 Lantai</h3>
                    <p class="text-gray-600 mt-1">Area Komersial, 2 Kamar Mandi</p>
                </div>
            </div>

        </div>

        <div class="text-center mt-12">
             <a href="{{ route('pelanggan.galeri') }}" class="text-lg font-medium text-blue-600 hover:text-blue-800">
                Lihat Semua Desain &rarr;
            </a>
        </div>
    </main>

    <!-- FOOTER SEDERHANA -->
    <footer class="bg-gray-800 text-white py-8 mt-10">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <p>&copy; 2025 ADP Konstruksi. All rights reserved.</p>
        </div>
    </footer>

</body>
</html>