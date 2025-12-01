<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Sandi - ADP Konstruksi</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans">

    <div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full space-y-8 bg-white p-10 rounded-xl shadow-2xl">
            
            <!-- HEADER -->
            <div class="text-center">
                <h2 class="mt-2 text-3xl font-extrabold text-gray-900">
                    Pulihkan Akun
                </h2>
                <p class="mt-2 text-sm text-gray-600">
                    @if(session('otp_verified'))
                        Tahap 3: Buat kata sandi baru.
                    @elseif(session('otp_sent'))
                        Tahap 2: Masukkan kode verifikasi.
                    @else
                        Tahap 1: Masukkan nomor telepon Anda.
                    @endif
                </p>
            </div>

            <!-- PESAN ERROR -->
            @if (session('error'))
                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4" role="alert">
                    <p class="font-bold">Kesalahan</p>
                    <p>{{ session('error') }}</p>
                </div>
            @endif

            <!-- PESAN SUKSES (OTP Terkirim) -->
            @if (session('status'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4" role="alert">
                    <p>{{ session('status') }}</p>
                </div>
            @endif


            <!-- ========================================== -->
            <!-- LOGIKA TAMPILAN BERDASARKAN SESSION        -->
            <!-- ========================================== -->

            @if(session('otp_verified'))
                
                <!-- TAHAP 3: FORM INPUT SANDI BARU -->
                <form class="mt-8 space-y-6" action="{{ route('password.update') }}" method="POST">
                    @csrf
                    <input type="hidden" name="phone" value="{{ session('phone') }}">
                    <!-- Token reset bisa ditambahkan jika menggunakan sistem token -->
                    <!-- <input type="hidden" name="token" value="{{ session('reset_token') }}"> -->

                    <div class="rounded-md shadow-sm -space-y-px">
                        <div class="mb-4">
                            <label for="password" class="sr-only">Sandi Baru</label>
                            <input id="password" name="password" type="password" required 
                                   class="appearance-none rounded-t-md relative block w-full px-3 py-3 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-blue-500 focus:border-blue-500 focus:z-10 sm:text-sm" 
                                   placeholder="Sandi Baru">
                        </div>
                        <div>
                            <label for="password_confirmation" class="sr-only">Konfirmasi Sandi</label>
                            <input id="password_confirmation" name="password_confirmation" type="password" required 
                                   class="appearance-none rounded-b-md relative block w-full px-3 py-3 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-blue-500 focus:border-blue-500 focus:z-10 sm:text-sm" 
                                   placeholder="Ulangi Sandi Baru">
                        </div>
                    </div>

                    <button type="submit" class="group relative w-full flex justify-center py-3 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition duration-150 ease-in-out">
                        Simpan Sandi Baru
                    </button>
                </form>

            @elseif(session('otp_sent'))

                <!-- TAHAP 2: FORM VERIFIKASI KODE OTP -->
                <div class="bg-blue-50 border border-blue-200 rounded-md p-4 mb-4">
                    <p class="text-sm text-blue-800 text-center">
                        Kami telah mengirimkan kode 6 digit ke WhatsApp: <br>
                        <strong>{{ session('phone') }}</strong>
                    </p>
                </div>

                <form class="mt-8 space-y-6" action="{{ route('password.verify-otp') }}" method="POST">
                    @csrf
                    <input type="hidden" name="phone" value="{{ session('phone') }}">

                    <div class="rounded-md shadow-sm -space-y-px">
                        <div>
                            <label for="otp" class="sr-only">Kode Verifikasi</label>
                            <input id="otp" name="otp" type="text" required 
                                   class="appearance-none rounded-md relative block w-full px-3 py-3 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-blue-500 focus:border-blue-500 focus:z-10 sm:text-sm text-center tracking-[0.5em] font-bold text-xl" 
                                   placeholder="XXXXXX" maxlength="6">
                        </div>
                    </div>

                    <button type="submit" class="group relative w-full flex justify-center py-3 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition duration-150 ease-in-out">
                        Verifikasi Kode
                    </button>
                </form>
                
                <!-- Tombol Kirim Ulang (Opsional) -->
                <div class="text-center mt-2">
                    <form action="{{ route('password.send-otp') }}" method="POST">
                        @csrf
                        <input type="hidden" name="phone" value="{{ session('phone') }}">
                        <button type="submit" class="text-xs text-blue-600 hover:underline">Kirim ulang kode</button>
                    </form>
                </div>

            @else

                <!-- TAHAP 1: FORM INPUT NOMOR TELEPON -->
                <form class="mt-8 space-y-6" action="{{ route('password.send-otp') }}" method="POST">
                    @csrf

                    <div class="rounded-md shadow-sm -space-y-px">
                        <div>
                            <label for="phone" class="sr-only">Nomor Telepon</label>
                            <input id="phone" name="phone" type="text" required 
                                   class="appearance-none rounded-md relative block w-full px-3 py-3 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-blue-500 focus:border-blue-500 focus:z-10 sm:text-sm" 
                                   placeholder="Nomor Telepon (WhatsApp)">
                        </div>
                    </div>

                    <button type="submit" class="group relative w-full flex justify-center py-3 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition duration-150 ease-in-out">
                        Kirim Kode OTP
                    </button>
                </form>

            @endif

            <div class="text-center mt-4 border-t pt-4">
                <a href="{{ route('login') }}" class="font-medium text-gray-600 hover:text-gray-500 transition duration-150 ease-in-out flex justify-center items-center">
                    <span aria-hidden="true">&larr;</span>&nbsp;Kembali ke Login
                </a>
            </div>
        </div>
    </div>

</body>
</html>