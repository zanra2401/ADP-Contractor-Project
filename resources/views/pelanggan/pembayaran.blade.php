<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran - ADP Konstruksi</title>
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
                        <a href="{{ route('pelanggan.renovasi') }}" class="{{ request()->routeIs('pelanggan.renovasi') ? 'border-blue-500 text-gray-900' : 'border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700' }} inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                            Renovasi
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

    <!-- KONTEN UTAMA -->
    <div class="py-10">
        <header class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-3xl font-bold leading-tight text-gray-900">
                Pembayaran Proyek
            </h1>
            <p class="mt-2 text-gray-600">Selesaikan pembayaran untuk memulai proyek Anda.</p>
        </header>

        <main class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 mt-8">
            <div class="bg-white p-8 rounded-lg shadow-lg">
                <h2 class="text-2xl font-semibold text-gray-900">Detail Tagihan</h2>
                
                <div class="mt-6 border-t border-gray-200 pt-6">
                    <dl class="space-y-4">
                        <div class="flex justify-between">
                            <dt class="text-sm font-medium text-gray-500">Proyek</dt>
                            <dd class="text-sm font-medium text-gray-900">Rumah Tipe 70 - Citraland</dd>
                        </div>
                        <div class="flex justify-between">
                            <dt class="text-sm font-medium text-gray-500">Klien</dt>
                            <!-- Nama Klien Dinamis -->
                            <dd class="text-sm font-medium text-gray-900">{{ Auth::user()->name ?? 'Bpk. Ahmad' }}</dd>
                        </div>
                        <div class="flex justify-between">
                            <dt class="text-sm font-medium text-gray-500">Total Harga Proyek</dt>
                            <dd class="text-sm font-medium text-gray-900">Rp 450.000.000</dd>
                        </div>
                        <div class="flex justify-between border-t pt-4">
                            <dt class="text-lg font-semibold text-gray-900">Tagihan Saat Ini (DP 30%)</dt>
                            <dd class="text-lg font-semibold text-blue-600">Rp 135.000.000</dd>
                        </div>
                    </dl>
                </div>

                <!-- FORM PEMBAYARAN -->
                <form action="#" method="POST" class="mt-8">
                    @csrf
                    <h3 class="text-lg font-medium text-gray-900">Pilih Metode Pembayaran</h3>
                    
                    <fieldset class="mt-4">
                        <legend class="sr-only">Metode Pembayaran</legend>
                        <div class="space-y-4">
                            
                            <!-- Opsi BCA -->
                            <div class="flex items-center p-3 border border-gray-200 rounded-md hover:bg-gray-50 cursor-pointer">
                                <input id="transfer_bca" name="payment_method" type="radio" value="bca" checked 
                                       class="focus:ring-blue-500 h-4 w-4 text-blue-600 border-gray-300">
                                <label for="transfer_bca" class="ml-3 block text-sm font-medium text-gray-700 w-full cursor-pointer">
                                    Virtual Account BCA
                                </label>
                            </div>

                            <!-- Opsi Mandiri -->
                            <div class="flex items-center p-3 border border-gray-200 rounded-md hover:bg-gray-50 cursor-pointer">
                                <input id="transfer_mandiri" name="payment_method" type="radio" value="mandiri" 
                                       class="focus:ring-blue-500 h-4 w-4 text-blue-600 border-gray-300">
                                <label for="transfer_mandiri" class="ml-3 block text-sm font-medium text-gray-700 w-full cursor-pointer">
                                    Virtual Account Mandiri
                                </label>
                            </div>

                            <!-- Opsi Kartu Kredit -->
                            <div class="flex items-center p-3 border border-gray-200 rounded-md hover:bg-gray-50 cursor-pointer">
                                <input id="credit_card" name="payment_method" type="radio" value="cc" 
                                       class="focus:ring-blue-500 h-4 w-4 text-blue-600 border-gray-300">
                                <label for="credit_card" class="ml-3 block text-sm font-medium text-gray-700 w-full cursor-pointer">
                                    Kartu Kredit (Visa/Mastercard)
                                </label>
                            </div>
                        </div>
                    </fieldset>

                    <div class="mt-10 text-right">
                        <button type="submit" class="inline-flex justify-center py-3 px-8 border border-transparent shadow-sm text-base font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition duration-150">
                            Bayar Sekarang
                        </button>
                    </div>
                </form>
            </div>
        </main>
    </div>

</body>
</html>