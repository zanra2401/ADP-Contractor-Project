<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - ADP Konstruksi</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

    <div class="min-h-screen flex items-center justify-center bg-gray-100 py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full space-y-8 bg-white p-10 rounded-xl shadow-lg">
            
            <!-- HEADER -->
            <div>
                <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">
                    Selamat Datang di ADP Konstruksi
                </h2>
                <p class="mt-2 text-center text-sm text-gray-600">
                    Silakan masuk ke akun Anda
                </p>
                
                <!-- Pesan Error Global (Misal: Akun tidak ditemukan) -->
                @if (session('error'))
                    <div class="mt-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                        <span class="block sm:inline">{{ session('error') }}</span>
                    </div>
                @endif
            </div>

            <!-- FORM LOGIN -->
            <form class="mt-8 space-y-6" action="{{ route('pelanggan.login') }}" method="POST">
                
                @csrf
                <!-- Input hidden remember (opsional, sesuaikan kebutuhan) -->
                <input type="hidden" name="remember" value="true">

                <div class="rounded-md shadow-sm -space-y-px">
                    
                    <!-- INPUT NOMOR TELEPON -->
                    <div class="mb-4">
                        <label for="phone-number" class="sr-only">Nomor Telepon</label>
                        <input id="phone-number" name="nomor_telepon" type="text" 
                               value="{{ old('nomor_telepon') }}" 
                               required 
                               class="appearance-none rounded-none relative block w-full px-3 py-3 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 focus:z-10 sm:text-sm @error('phone') border-red-500 @enderror" 
                               placeholder="Nomor Telepon">
                        
                        @error('nomor_telepon')
                            <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    
                    <!-- INPUT PASSWORD -->
                    <div>
                        <label for="password" class="sr-only">Sandi</label>
                        <input id="password" name="password" type="password" 
                               autocomplete="current-password" 
                               required 
                               class="appearance-none rounded-none relative block w-full px-3 py-3 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 focus:z-10 sm:text-sm @error('password') border-red-500 @enderror" 
                               placeholder="Sandi">
                        
                         @error('password')
                            <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
    
                <!-- LUPA SANDI -->
                <div class="flex items-center justify-between">
                    <div class="text-sm">
                        <a href="{{ route('pelanggan.password.request') }}" class="font-medium text-blue-600 hover:text-blue-500">
                            Lupa sandi?
                        </a>
                    </div>
                </div>
    
                <!-- TOMBOL LOGIN -->
                <div>
                    <button type="submit" class="group relative w-full flex justify-center py-3 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Masuk
                    </button>
                </div>
            </form>

            <!-- LINK DAFTAR -->
            <p class="mt-4 text-center text-sm text-gray-600">
                Belum punya akun?
                <a href="{{ route('pelanggan.register') }}" class="font-medium text-blue-600 hover:text-blue-500">
                    Daftar di sini
                </a>
            </p>
        </div>
    </div>

</body>
</html>