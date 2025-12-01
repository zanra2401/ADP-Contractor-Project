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
            <div>
                <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">
                    Selamat Datang di ADP Konstruksi
                </h2>
                <p class="mt-2 text-center text-sm text-gray-600">
                    Silakan masuk ke akun Anda
                </p>
            </div>
            
            <!-- PERUBAHAN PENTING DI SINI -->
            <!-- action mengarah ke route 'login.submit' -->
            <form class="mt-8 space-y-6" action="{{ route('login.submit') }}" method="POST">
                
                <!-- WAJIB ADA: Token keamanan Laravel -->
                @csrf

                <input type="hidden" name="remember" value="true">
                <div class="rounded-md shadow-sm -space-y-px">
                    <div>
                        <label for="phone-number" class="sr-only">Nomor Telepon</label>
                        <!-- Pastikan name="phone" ada -->
                        <input id="phone-number" name="phone" type="text" required class="appearance-none rounded-none relative block w-full px-3 py-3 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 focus:z-10 sm:text-sm" placeholder="Nomor Telepon">
                    </div>
                    <div>
                        <label for="password" class="sr-only">Sandi</label>
                         <!-- Pastikan name="password" ada -->
                        <input id="password" name="password" type="password" autocomplete="current-password" required class="appearance-none rounded-none relative block w-full px-3 py-3 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 focus:z-10 sm:text-sm" placeholder="Sandi">
                    </div>
                </div>
    
                <div class="flex items-center justify-between">
                    <div class="text-sm">
                        <a href="#" class="font-medium text-blue-600 hover:text-blue-500">
                            Lupa sandi?
                        </a>
                    </div>
                </div>
    
                <div>
                    <button type="submit" class="group relative w-full flex justify-center py-3 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Masuk
                    </button>
                </div>
            </form>
             <p class="mt-4 text-center text-sm text-gray-600">
                Belum punya akun?
                <a href="#" class="font-medium text-blue-600 hover:text-blue-500">
                    Daftar di sini
                </a>
            </p>
        </div>
    </div>

</body>
</html>