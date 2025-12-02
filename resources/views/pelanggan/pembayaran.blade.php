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
                        <a href="{{ route('pelanggan.dashboard') }}" class="border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">Dashboard</a>
                        <a href="{{ route('pelanggan.galeri') }}" class="border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">Galeri Proyek</a>
                        <!-- Menu Renovasi Dihapus -->
                        <a href="{{ route('pelanggan.chat') }}" class="border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">Chat</a>
                        <!-- Menu Aktif -->
                        <a href="{{ route('pelanggan.pembayaran') }}" class="border-blue-500 text-gray-900 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">Pembayaran</a>
                    </div>
                </div>
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
                Pembayaran Proyek (PG 7)
            </h1>
            <p class="mt-2 text-gray-600">Kelola pembayaran dan lihat riwayat transaksi Anda.</p>
        </header>

        <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-8 space-y-8">
            
            <!-- BAGIAN 1: INPUT PEMBAYARAN -->
            <div class="bg-white p-8 rounded-lg shadow-lg border-l-4 border-blue-600" id="payment-card">
                
                <!-- TAMPILAN FORM AWAL -->
                <div id="payment-form-section">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-2xl font-bold text-gray-900">Input Pembayaran Baru</h2>
                    </div>
                    
                    <!-- Form menggunakan onsubmit JS -->
                    <form onsubmit="event.preventDefault(); submitPayment();"> 
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-start">
                            
                            <!-- Kolom Kiri: Input Data -->
                            <div class="space-y-6">
                                <div>
                                    <label for="payment_id" class="block text-sm font-medium text-gray-700">Payment ID</label>
                                    <input type="text" id="payment_id" required
                                           class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm" 
                                           placeholder="Contoh: 01KBCAX3YM9DSJZP99PGE50QRC">
                                    <p class="mt-1 text-xs text-gray-500">Masukkan ID tagihan yang tertera pada invoice Anda.</p>
                                </div>
    
                                <div>
                                    <label for="jumlah" class="block text-sm font-medium text-gray-700">Jumlah Pembayaran (Rp)</label>
                                    <div class="relative mt-1 rounded-md shadow-sm">
                                        <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                          <span class="text-gray-500 sm:text-sm">Rp</span>
                                        </div>
                                        <input type="number" id="jumlah" required
                                               class="block w-full rounded-md border-gray-300 pl-10 py-2 focus:border-blue-500 focus:ring-blue-500 sm:text-sm" 
                                               placeholder="0">
                                    </div>
                                </div>
    
                                <div class="pt-4">
                                    <button type="submit" class="w-full bg-blue-600 text-white font-bold py-3 px-4 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition duration-150 shadow-md">
                                        Konfirmasi Pembayaran
                                    </button>
                                </div>
                            </div>
    
                            <!-- Kolom Kanan: Tampilan QRIS -->
                            <div class="bg-gray-50 p-6 rounded-lg border-2 border-dashed border-gray-300 flex flex-col justify-center items-center text-center h-full">
                                <h3 class="text-lg font-bold text-gray-900 mb-2">Scan QRIS</h3>
                                <p class="text-sm text-gray-500 mb-4">Gunakan GoPay, OVO, Dana, atau M-Banking</p>
                                
                                <div class="bg-white p-3 rounded-lg shadow-md border inline-block mb-4">
                                    <img src="https://upload.wikimedia.org/wikipedia/commons/d/d0/QR_code_for_mobile_English_Wikipedia.svg" alt="QRIS Code" class="w-48 h-48 object-contain">
                                </div>
                                
                                <div class="space-y-1">
                                    <p class="text-xs font-semibold text-gray-600 uppercase tracking-wider">ADP KONSTRUKSI MERCH</p>
                                    <p class="text-xs text-gray-400">NMID: ID102003292392</p>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- TAMPILAN SUKSES (Awalnya Hidden) -->
                <div id="payment-success-section" class="hidden text-center py-10">
                    <div class="mx-auto flex items-center justify-center h-20 w-20 rounded-full bg-green-100 mb-6">
                        <svg class="h-12 w-12 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                    </div>
                    <h2 class="text-2xl font-bold text-gray-900 mb-2">Pembayaran Berhasil Dikirim!</h2>
                    <p class="text-gray-600 mb-6">Terima kasih. Data pembayaran Anda sedang kami verifikasi. <br>Status transaksi akan berubah dalam 1x24 jam.</p>
                    
                    <div class="bg-gray-50 p-4 rounded-lg inline-block text-left mb-6 border border-gray-200">
                        <p class="text-sm text-gray-500">ID Transaksi: <span class="font-mono font-bold text-gray-800">TRX-78239912</span></p>
                        <p class="text-sm text-gray-500">Metode: <span class="font-bold text-gray-800">QRIS</span></p>
                    </div>

                    <br>
                    <button onclick="resetPaymentForm()" class="text-blue-600 hover:text-blue-800 font-medium underline">
                        Kembali
                    </button>
                </div>

            </div>

            <!-- BAGIAN 2: TABEL RIWAYAT -->
            <div class="bg-white p-8 rounded-lg shadow-lg">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-bold text-gray-900">Riwayat Pembayaran</h2>
                    <span class="px-3 py-1 text-xs font-medium bg-green-100 text-green-800 rounded-full border border-green-200">Terverifikasi</span>
                </div>

                <div class="overflow-x-auto rounded-lg border border-gray-200">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-800 text-white">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">ID</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Payment ID</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Jumlah</th>
                                <!-- <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Metode</th> -->
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Status</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200" id="history-table-body">
                            <!-- Data Dummy -->
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-4 whitespace-nowrap text-xs font-mono text-gray-500">#001</td>
                                <td class="px-6 py-4 whitespace-nowrap text-xs font-mono text-blue-600">01KBCAX3YM9...</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 font-bold">Rp 75.000.000</td>
                                <!-- <td class="px-6 py-4 whitespace-nowrap"><span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800 capitalize">QRIS</span></td> -->
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-yellow-600">Pending</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

        </main>
    </div>

    <!-- SCRIPT INTERAKTIF (DEMO) -->
    <script>
        function submitPayment() {
            // Ambil nilai input (hanya untuk demo)
            const payId = document.getElementById('payment_id').value;
            const amount = document.getElementById('jumlah').value;

            if (!payId || !amount) {
                alert("Mohon lengkapi semua data!");
                return;
            }

            // Efek Loading (Ubah teks tombol)
            const btn = document.querySelector('button[type="submit"]');
            const originalText = btn.innerHTML;
            btn.innerHTML = "Memproses...";
            btn.disabled = true;
            btn.classList.add('opacity-75', 'cursor-not-allowed');

            // Simulasi proses server (1.5 detik)
            setTimeout(() => {
                // Sembunyikan Form, Tampilkan Sukses
                document.getElementById('payment-form-section').classList.add('hidden');
                document.getElementById('payment-success-section').classList.remove('hidden');
                
                // Kembalikan tombol
                btn.innerHTML = originalText;
                btn.disabled = false;
                btn.classList.remove('opacity-75', 'cursor-not-allowed');

                // Tambahkan data baru ke tabel (Efek Realtime)
                addHistoryRow(payId, amount);

            }, 1500);
        }

        function resetPaymentForm() {
            // Reset Form
            document.getElementById('payment_id').value = '';
            document.getElementById('jumlah').value = '';
            
            // Kembalikan Tampilan
            document.getElementById('payment-success-section').classList.add('hidden');
            document.getElementById('payment-form-section').classList.remove('hidden');
        }

        function addHistoryRow(id, amount) {
            const table = document.getElementById('history-table-body');
            const newRow = `
                <tr class="bg-green-50 border-l-4 border-green-500 transition duration-500">
                    <td class="px-6 py-4 whitespace-nowrap text-xs font-mono text-gray-500">#BARU</td>
                    <td class="px-6 py-4 whitespace-nowrap text-xs font-mono text-blue-600">${id}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 font-bold">Rp ${Number(amount).toLocaleString('id-ID')}</td>
                    <td class="px-6 py-4 whitespace-nowrap"><span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800 capitalize">QRIS</span></td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-yellow-600">Verifikasi</td>
                </tr>
            `;
            // Tambahkan di baris pertama
            table.insertAdjacentHTML('afterbegin', newRow);
        }
    </script>

</body>
</html>