<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Desain - ADP Konstruksi</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 font-sans">

    <nav class="bg-white shadow-md sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex">
                    <div class="shrink-0 flex items-center">
                        <span class="font-bold text-xl text-blue-600">ADP Konstruksi</span>
                    </div>
                </div>
                <div class="flex items-center">
                    <a href="{{ route('pelanggan.galeri') }}" class="text-sm font-medium text-gray-500 hover:text-gray-900 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                        </svg>
                        Kembali ke Galeri
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
            <div class="grid grid-cols-1 lg:grid-cols-2">
                
                <div class="h-96 lg:h-auto bg-gray-200 relative">
                    <img src="https://images.unsplash.com/photo-1600585154340-be6161a56a0c?ixlib=rb-1.2.1&auto=format&fit=crop&w=1200&q=80" 
                         alt="Rumah Minimalis Modern" 
                         class="absolute inset-0 w-full h-full object-cover">
                </div>

                <div class="p-8 lg:p-12">
                    <div class="flex justify-between items-start">
                        <div>
                            <h1 class="text-3xl font-extrabold text-gray-900 mb-2">Rumah Minimalis Modern Tipe 45</h1>
                            <div class="flex items-center space-x-2 mb-6">
                                <span class="bg-blue-100 text-blue-800 text-xs font-semibold px-2.5 py-0.5 rounded">Minimalis</span>
                                <span class="bg-green-100 text-green-800 text-xs font-semibold px-2.5 py-0.5 rounded">Eco-Friendly</span>
                            </div>
                        </div>
                        <div class="text-right">
                            <p class="text-sm text-gray-500">Estimasi Biaya</p>
                            <p class="text-2xl font-bold text-blue-600">Rp 350 Jt++</p>
                        </div>
                    </div>

                    <h3 class="text-lg font-semibold text-gray-900 mb-3">Deskripsi Desain</h3>
                    <p class="text-gray-600 mb-6 leading-relaxed">
                        Desain hunian kompak yang dirancang khusus untuk keluarga muda di area perkotaan. Mengutamakan efisiensi ruang tanpa mengorbankan kenyamanan. Dilengkapi dengan jendela besar untuk pencahayaan alami maksimal dan sirkulasi udara yang sehat. Fasad depan menggunakan kombinasi batu alam dan cat putih bersih.
                    </p>

                    <h3 class="text-lg font-semibold text-gray-900 mb-3">Spesifikasi Ruangan</h3>
                    <ul class="grid grid-cols-2 gap-4 mb-8">
                        <li class="flex items-center text-gray-600">
                            <svg class="h-5 w-5 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            2 Kamar Tidur
                        </li>
                        <li class="flex items-center text-gray-600">
                            <svg class="h-5 w-5 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            1 Kamar Mandi
                        </li>
                        <li class="flex items-center text-gray-600">
                            <svg class="h-5 w-5 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            Luas Bangunan 45m²
                        </li>
                        <li class="flex items-center text-gray-600">
                            <svg class="h-5 w-5 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            Carport 1 Mobil
                        </li>
                    </ul>

                    <div class="border-t pt-8 flex flex-col sm:flex-row gap-4">
                        <a href="{{ route('pelanggan.chat') }}" class="flex-1 bg-blue-600 text-white text-center font-bold py-3 px-6 rounded-xl hover:bg-blue-700 transition duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-1">
                            Konsultasi Desain Ini
                        </a>
                        <button class="flex-1 bg-white border-2 border-gray-200 text-gray-700 font-bold py-3 px-6 rounded-xl hover:border-blue-500 hover:text-blue-600 transition duration-300">
                            Simpan ke Favorit
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-10 grid grid-cols-1 md:grid-cols-3 gap-6">
            <img class="rounded-xl shadow-md h-48 w-full object-cover hover:opacity-90 cursor-pointer" src="https://images.unsplash.com/photo-1584622650111-993a426fbf0a?auto=format&fit=crop&w=400&q=80" alt="Interior 1">
            <img class="rounded-xl shadow-md h-48 w-full object-cover hover:opacity-90 cursor-pointer" src="https://images.unsplash.com/photo-1556912172-45b7abe8d7e1?auto=format&fit=crop&w=400&q=80" alt="Interior 2">
            <img class="rounded-xl shadow-md h-48 w-full object-cover hover:opacity-90 cursor-pointer" src="https://images.unsplash.com/photo-1556912173-3db9963f6f39?auto=format&fit=crop&w=400&q=80" alt="Interior 3">
        </div>

    </main>

</body>
</html>