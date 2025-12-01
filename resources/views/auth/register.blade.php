<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar - ADP Konstruksi</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans">

    <div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full space-y-8 bg-white p-10 rounded-xl shadow-2xl">
            
            <div>
                <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">
                    Buat Akun Baru
                </h2>
                <p class="mt-2 text-center text-sm text-gray-600">
                    Bergabunglah dengan ADP Konstruksi
                </p>
            </div>

            <!-- Form mengarah ke route 'register.process' -->
            <form class="mt-8 space-y-6" action="{{ route('pelanggan.register') }}" method="POST">
                @csrf

                <div class="rounded-md shadow-sm -space-y-px">
                    
                    <!-- NAMA LENGKAP -->
                    <div class="mb-4">
                        <label for="nama" class="sr-only">Nama Lengkap</label>
                        <input id="nama" name="nama" type="text" value="{{ old('nama') }}" required 
                               class="appearance-none rounded-none relative block w-full px-3 py-3 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 focus:z-10 sm:text-sm" 
                               placeholder="Nama Lengkap">
                        @error('nama')
                            <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- NOMOR TELEPON -->
                    <div class="mb-4">
                        <label for="nomor_telepon" class="sr-only">Nomor Telepon</label>
                        <input id="nomor_telepon" name="nomor_telepon" type="text" value="{{ old('nomor_telepon') }}" required 
                               class="appearance-none relative block w-full px-3 py-3 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-blue-500 focus:border-blue-500 focus:z-10 sm:text-sm" 
                               placeholder="Nomor Telepon (WhatsApp)">
                        @error('nomor_telepon')
                            <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- PASSWORD -->
                    <div class="mb-4">
                        <label for="password" class="sr-only">Sandi</label>
                        <input id="password" name="password" type="password" required 
                               class="appearance-none relative block w-full px-3 py-3 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-blue-500 focus:border-blue-500 focus:z-10 sm:text-sm" 
                               placeholder="Buat Sandi">
                        @error('password')
                            <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- KONFIRMASI PASSWORD -->
                    <div>
                        <label for="password_confirmation" class="sr-only">Konfirmasi Sandi</label>
                        <input id="password_confirmation" name="password_confirmation" type="password" required 
                               class="appearance-none rounded-none relative block w-full px-3 py-3 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 focus:z-10 sm:text-sm" 
                               placeholder="Ulangi Sandi">
                    </div>
                </div>

                <div>
                    <button type="submit" class="group relative w-full flex justify-center py-3 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition duration-150 ease-in-out">
                        Daftar Sekarang
                    </button>
                </div>
            </form>

            <p class="mt-4 text-center text-sm text-gray-600">
                Sudah punya akun?
                <a href="{{ route('pelanggan.login') }}" class="font-medium text-blue-600 hover:text-blue-500 transition duration-150 ease-in-out">
                    Masuk di sini
                </a>
            </p>
        </div>
    </div>

</body>
</html>