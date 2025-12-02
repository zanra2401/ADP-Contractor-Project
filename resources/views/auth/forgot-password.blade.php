<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Sandi - ADP Konstruksi</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans">

    <div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full space-y-8 bg-white p-10 rounded-xl shadow-2xl">
            
            <div>
                <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">
                    Pulihkan Akun
                </h2>
                <p class="mt-2 text-center text-sm text-gray-600">
                    @if(session('verified_phone'))
                        Silakan buat kata sandi baru untuk akun Anda.
                    @else
                        Masukkan nomor telepon yang terdaftar untuk mencari akun Anda.
                    @endif
                </p>
            </div>

            <!-- Menampilkan Pesan Error (Misal: Nomor tidak ditemukan) -->
            @if (session('error'))
                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4" role="alert">
                    <p class="font-bold">Kesalahan</p>
                    <p>{{ session('error') }}</p>
                </div>
            @endif

            <!-- LOGIKA TAMPILAN -->
            @if(session('verified_phone'))
                
                <!-- TAHAP 2: INPUT SANDI BARU (Muncul jika nomor HP benar) -->
                <form class="mt-8 space-y-6" action="{{ route('password.update') }}" method="POST">
                    @csrf
                    <!-- Input Hidden untuk membawa nomor HP yang sudah diverifikasi -->
                    <input type="hidden" name="phone" value="{{ session('verified_phone') }}">

                    <div class="rounded-md shadow-sm -space-y-px">
                        <div class="mb-4">
                            <label for="password" class="sr-only">Sandi Baru</label>
                            <input id="password" name="password" type="password" required 
                                   class="appearance-none rounded-t-md relative block w-full px-3 py-3 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-blue-500 focus:border-blue-500 focus:z-10 sm:text-sm" 
                                   placeholder="Sandi Baru">
                            @error('password')
                                <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="password_confirmation" class="sr-only">Konfirmasi Sandi</label>
                            <input id="password_confirmation" name="password_confirmation" type="password" required 
                                   class="appearance-none rounded-b-md relative block w-full px-3 py-3 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-blue-500 focus:border-blue-500 focus:z-10 sm:text-sm" 
                                   placeholder="Ulangi Sandi Baru">
                        </div>
                    </div>

                    <div>
                        <button type="submit" class="group relative w-full flex justify-center py-3 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition duration-150 ease-in-out">
                            Simpan Sandi Baru
                        </button>
                    </div>
                </form>

            @else

                <!-- TAHAP 1: VERIFIKASI NOMOR TELEPON (Default) -->
                <form class="mt-8 space-y-6" action="{{ url('/api/forgot-password') }}" method="POST">
                    @csrf

                    <div class="rounded-md shadow-sm -space-y-px">
                        <div>
                            <label for="phone" class="sr-only">Nomor Telepon</label>
                            <input id="phone" name="phone" type="text" required 
                                   class="appearance-none rounded-md relative block w-full px-3 py-3 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-blue-500 focus:border-blue-500 focus:z-10 sm:text-sm" 
                                   placeholder="Nomor Telepon">
                        </div>
                    </div>

                    <div>
                        <button type="submit" class="group relative w-full flex justify-center py-3 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition duration-150 ease-in-out">
                            Cari Akun
                        </button>
                    </div>
                </form>

            @endif

            <div class="text-center mt-4">
                <a href="{{ route('login') }}" class="font-medium text-gray-600 hover:text-gray-500 transition duration-150 ease-in-out flex justify-center items-center">
                    <span aria-hidden="true">&larr;</span>&nbsp;Kembali ke Login
                </a>
            </div>
        </div>
    </div>

</body>
</html>