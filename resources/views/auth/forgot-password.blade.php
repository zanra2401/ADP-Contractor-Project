<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Sandi - ADP Konstruksi</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="bg-gray-100 font-sans">

    <div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full space-y-8 bg-white p-10 rounded-xl shadow-2xl transition-all duration-300">

            <!-- HEADER -->
            <div class="text-center">
                <h2 class="mt-2 text-3xl font-extrabold text-gray-900">
                    Pulihkan Akun
                </h2>
                <p class="mt-2 text-sm text-gray-600" id="header-text">
                    Tahap 1: Masukkan nomor telepon Anda.
                </p>
            </div>

            <!-- ========================================== -->
            <!-- TAHAP 1: INPUT NOMOR TELEPON               -->
            <!-- ========================================== -->
            <div id="step-1">
                <form class="mt-8 space-y-6" onsubmit="event.preventDefault(); sendPhone();">
                    <div class="rounded-md shadow-sm -space-y-px">
                        <div>
                            <label for="phone" class="sr-only">Nomor Telepon</label>
                            <input id="phone" name="phone" type="text" required
                                class="appearance-none rounded-md relative block w-full px-3 py-3 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-blue-500 focus:border-blue-500 focus:z-10 sm:text-sm"
                                placeholder="Nomor Telepon (WhatsApp)">
                        </div>
                    </div>

                    <button type="submit"
                        class="group relative w-full flex justify-center py-3 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition duration-150 ease-in-out">
                        Kirim Kode OTP
                    </button>
                </form>
            </div>

            <!-- ========================================== -->
            <!-- TAHAP 2: VERIFIKASI OTP                    -->
            <!-- ========================================== -->
            <div id="step-2" class="hidden">
                <div class="bg-blue-50 border border-blue-200 rounded-md p-4 mb-4">
                    <p class="text-sm text-blue-800 text-center">
                        Kode verifikasi telah dikirim ke WhatsApp Anda. <br>
                        (Simulasi: Masukkan kode bebas)
                    </p>
                </div>

                <form class="mt-8 space-y-6" onsubmit="event.preventDefault(); verifyCode();">
                    <div class="rounded-md shadow-sm -space-y-px">
                        <div>
                            <label for="otp" class="sr-only">Kode Verifikasi</label>
                            <input id="otp" name="otp" type="text" required
                                class="appearance-none rounded-md relative block w-full px-3 py-3 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-blue-500 focus:border-blue-500 focus:z-10 sm:text-sm text-center tracking-[0.5em] font-bold text-xl"
                                placeholder="XXXXXX" maxlength="6">
                        </div>
                    </div>

                    <button type="submit"
                        class="group relative w-full flex justify-center py-3 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition duration-150 ease-in-out">
                        Verifikasi Kode
                    </button>
                </form>

                <div class="text-center mt-2">
                    <button type="button" onclick="alert('Kode dikirim ulang!')"
                        class="text-xs text-blue-600 hover:underline">
                        Kirim ulang kode
                    </button>
                </div>
            </div>

            <!-- ========================================== -->
            <!-- TAHAP 3: BUAT SANDI BARU                   -->
            <!-- ========================================== -->
            <div id="step-3" class="hidden">
                <form class="mt-8 space-y-6" onsubmit="event.preventDefault(); saveNewPassword();">
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

                    <button type="submit"
                        class="group relative w-full flex justify-center py-3 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition duration-150 ease-in-out">
                        Simpan Sandi Baru
                    </button>
                </form>
            </div>

            <!-- FOOTER -->
            <div class="text-center mt-4 border-t pt-4">
                <a href="{{ route('login') }}"
                    class="font-medium text-gray-600 hover:text-gray-500 transition duration-150 ease-in-out flex justify-center items-center">
                    <span aria-hidden="true">&larr;</span>&nbsp;Kembali ke Login
                </a>
            </div>
        </div>
    </div>

    <!-- JAVASCRIPT SEDERHANA UNTUK SIMULASI ALUR -->
    <script>
        function goToStep(step) {
            document.getElementById('step-1').classList.add('hidden');
            document.getElementById('step-2').classList.add('hidden');
            document.getElementById('step-3').classList.add('hidden');

            document.getElementById('step-' + step).classList.remove('hidden');

            const headerText = document.getElementById('header-text');
            if (step === 1) headerText.innerText = "Tahap 1: Masukkan nomor telepon Anda.";
            if (step === 2) headerText.innerText = "Tahap 2: Masukkan kode verifikasi.";
            if (step === 3) headerText.innerText = "Tahap 3: Buat kata sandi baru.";
        }

        async function sendPhone() {
            let phone = document.getElementById('phone').value;

            let response = await fetch("{{ route('forgot.request') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                body: JSON.stringify({
                    nomor_telepon: phone
                })
            });

            let data = await response.json();

            if (!response.ok) {
                Swal.fire({
                    icon: "error",
                    title: "Gagal",
                    text: data.message,
                });
                return;
            }

            Swal.fire({
                icon: "success",
                title: "Kode OTP Dikirim",
                text: "Silakan cek WhatsApp Anda.",
                timer: 1800,
                showConfirmButton: false
            });

            goToStep(2);
        }

        let kodeOTP = null;

        async function verifyCode() {
            kodeOTP = document.getElementById('otp').value;

            let response = await fetch("{{ route('forgot.verify') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                body: JSON.stringify({
                    code: kodeOTP
                })
            });

            let data = await response.json();

            if (!response.ok) {
                Swal.fire({
                    icon: "error",
                    title: "Kode Salah",
                    text: data.message,
                });
                return;
            }

            Swal.fire({
                icon: "success",
                title: "Berhasil",
                text: "Kode OTP valid.",
                timer: 1500,
                showConfirmButton: false
            });

            goToStep(3);
        }

        async function saveNewPassword() {
            let password = document.getElementById('password').value;

            let response = await fetch("{{ route('forgot.reset') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                body: JSON.stringify({
                    code: kodeOTP,
                    password: password
                })
            });

            let data = await response.json();

            if (!response.ok) {
                Swal.fire({
                    icon: "error",
                    title: "Gagal",
                    text: data.message,
                });
                return;
            }

            Swal.fire({
                icon: "success",
                title: "Password Berhasil Diubah",
                text: "Anda akan diarahkan ke halaman login.",
                timer: 2000,
                showConfirmButton: false
            });

            setTimeout(() => {
                window.location.href = "{{ route('login') }}";
            }, 2000);
        }
    </script>


</body>

</html>
