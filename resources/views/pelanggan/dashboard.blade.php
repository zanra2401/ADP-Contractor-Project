<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Pelanggan - ADP Konstruksi</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Transisi halus untuk modal */
        .modal-transition {
            transition: opacity 0.3s ease-out, transform 0.3s ease-out;
        }
        /* Memperbaiki tampilan backdrop agar transisi bekerja */
        .modal-backdrop {
             transition: opacity 0.3s ease-out;
        }
        .modal-panel {
            transition: opacity 0.3s ease-out, transform 0.3s ease-out;
        }
    </style>
</head>
<body class="bg-gray-100 font-sans text-gray-800">

    <nav class="bg-white shadow-md sticky top-0 z-40">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                
                {{-- KIRI: LOGO & MENU DESKTOP --}}
                <div class="flex">
                    <div class="flex-shrink-0 flex items-center">
                        <span class="font-bold text-xl text-blue-600">ADP Konstruksi</span>
                    </div>
                    
                    {{-- Menu Navigasi Desktop (hidden di HP) --}}
                    <div class="hidden sm:ml-6 sm:flex sm:space-x-8">
                        <a href="{{ route('pelanggan.dashboard') }}" 
                           class="border-blue-500 text-gray-900 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                            Dashboard
                        </a>
                        <a href="{{ route('pelanggan.galeri') }}" 
                           class="border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                            Galeri Proyek
                        </a>
                        <a href="{{ route('pelanggan.chat') }}" 
                           class="border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                            Chat
                        </a>

                    </div>
                </div>

                <div class="hidden sm:ml-6 sm:flex sm:items-center space-x-4">
                    <span class="text-sm text-gray-700 mr-2">Halo, {{ Auth::user()->nama ?? 'Pelanggan' }}!</span>
                    <a href="{{ route('pelanggan.profil') }}" class="text-sm font-medium text-gray-500 hover:text-gray-700">Profil Saya</a>
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="text-sm font-medium text-red-600 hover:text-red-800 ml-2">Logout</button>
                    </form>
                </div>
                
                <div class="flex items-center sm:hidden">
                    <button type="button" onclick="toggleMobileMenu()" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
        
        <div class="hidden sm:hidden bg-white border-t border-gray-200 absolute w-full z-30 shadow-lg" id="mobile-menu">
            <div class="pt-2 pb-3 space-y-1">
                <a href="{{ route('pelanggan.dashboard') }}" class="block pl-3 pr-4 py-2 border-l-4 border-blue-500 text-base font-medium text-blue-700 bg-blue-50">Dashboard</a>
                <a href="{{ route('pelanggan.galeri') }}" class="block pl-3 pr-4 py-2 border-l-4 border-transparent text-base font-medium text-gray-600 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-800">Galeri Proyek</a>
                <a href="{{ route('pelanggan.chat') }}" class="block pl-3 pr-4 py-2 border-l-4 border-transparent text-base font-medium text-gray-600 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-800">Chat</a>
                <a href="{{ route('pelanggan.pembayaran') }}" class="block pl-3 pr-4 py-2 border-l-4 border-transparent text-base font-medium text-gray-600 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-800">Pembayaran</a>
            </div>
            <div class="pt-4 pb-3 border-t border-gray-200">
                <div class="px-4">
                    <div class="text-base font-medium text-gray-800">Halo, {{ Auth::user()->name ?? 'Pelanggan' }}</div>
                </div>
                <div class="mt-3 space-y-1">
                    <a href="{{ route('pelanggan.profil') }}" class="block px-4 py-2 text-base font-medium text-gray-500 hover:text-gray-800 hover:bg-gray-100">Profil Saya</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="block w-full text-left px-4 py-2 text-base font-medium text-red-600 hover:text-red-800 hover:bg-gray-100">
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>
    
    <div class="py-10">
        <header class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex justify-between items-center">
            <div>
                <h1 class="text-3xl font-bold leading-tight text-gray-900">
                    Proyek Saya
                </h1>
                <p class="mt-2 text-gray-600">Pantau progres pembangunan proyek Anda secara real-time.</p>
            </div>
        </header>

        <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-8">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

                    <div class="bg-white rounded-xl shadow-lg overflow-hidden border-2 border-dashed border-gray-300 flex flex-col justify-center items-center p-6 min-h-[400px] hover:border-blue-400 transition cursor-pointer" onclick="openModal()">
                    <div class="text-center">
                        <div class="mx-auto flex items-center justify-center h-16 w-16 rounded-full bg-blue-100 mb-4">
                            <svg class="h-8 w-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                        </div>
                        <h3 class="text-lg font-medium text-gray-900">Mulai Proyek Baru</h3>
                        <p class="mt-2 text-sm text-gray-500 px-4">
                            Punya rencana pembangunan lain? Ajukan proyek baru Anda di sini dan kami akan segera menghubungi Anda.
                        </p>
                        <button type="button" class="mt-6 inline-flex items-center px-6 py-3 border border-transparent text-sm font-medium rounded-xl text-white bg-blue-600 hover:bg-blue-700 shadow-md">
                            Buat Proyek
                        </button>
                    </div>
                </div>
                
                @foreach ($proyek as $p)
                    <div class="bg-white rounded-xl shadow-lg overflow-hidden flex flex-col transition hover:shadow-xl">
                        <img class="h-48 w-full object-cover" src="{{ storage_path($p['content_path']) }}" alt="Rumah Tipe 70">
                        <div class="p-6 flex-grow flex flex-col justify-between">
                            <div>
                                <h3 class="text-xl font-semibold text-gray-900">{{ $p->nama_proyek ? $p->nama_proyek : '-' }}</h3>
                                <p class="mt-2 text-sm text-gray-600">Status: <span class="font-medium text-yellow-600">{{ $p->status }}</span></p>
                            </div>
                            <div class="mt-4 flex-shrink-0">
                                <span class="text-sm font-medium text-gray-700">Progres Keseluruhan: {{ $p->progress }}%</span>
                                <div class="w-full bg-gray-200 rounded-full h-2.5 mt-1">
                                    <div class="{{ $p->progress == 100.0 ? 'bg-green-600' : 'bg-blue-600' }} h-2.5 rounded-full" style="width: {{ $p->progress }}%"></div>
                                </div>
                            </div>    
                            @if ($p->progress == 100.0)
                                <div class="mt-6 flex-shrink-0">
                                    <a href="{{ route('pelanggan.detail-proyek', ['id' => $p->id]) }}" class="w-full text-center block py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 transition">
                                        Lihat Detail Proyek
                                    </a>
                                </div>
                            @else
                                <div class="mt-6">
                                    <a href="{{ route('pelanggan.detail-proyek', ['id' => $p->id]) }}" class="w-full text-center block py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700">
                                        Lihat Detail Proyek
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach

    
            </div>
        </main>
    </div>

    {{-- ================= MODAL FORM BUAT PROYEK ================= --}}
    <div id="projectModal" class="fixed inset-0 z-50 hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        
        {{-- Backdrop Gelap --}}
        <div class="fixed inset-0 bg-gray-900/75 modal-backdrop transition-opacity opacity-0 backdrop-blur-sm" id="modalBackdrop"></div>

        {{-- Container Modal (dibuat responsif) --}}
        <div class="fixed inset-0 z-10 overflow-y-auto">
            <div class="flex min-h-full items-center justify-center p-4 text-center sm:p-0">
                
                {{-- Panel Modal (dibuat responsif dengan transisi) --}}
                <div class="relative transform overflow-hidden rounded-2xl bg-white text-left shadow-2xl modal-panel transition-all w-full sm:my-8 sm:max-w-lg opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" id="modalPanel">
                    
                    {{-- Header Modal --}}
                    <div class="bg-blue-600 px-4 py-4 sm:px-6 flex justify-between items-center flex-shrink-0">
                        <h3 class="text-lg font-bold leading-6 text-white" id="modal-title">Form Pengajuan Proyek</h3>
                        <button type="button" onclick="closeModal()" class="text-blue-200 hover:text-white transition">
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>

                    {{-- Form Body --}}
                    <div class="px-4 py-6 sm:p-6 bg-white max-h-[80vh] overflow-y-auto">
                        <form action="{{ route('project.create') }}" method="POST" class="space-y-5">
                            @csrf
                            
                            {{-- Field: Pilih Desain --}}
                            <div>
                                <label for="design_id" class="block text-sm font-bold text-gray-700 mb-1">Pilih Desain Referensi</label>
                                <div class="relative">
                                    <select id="design_id" name="design_id" class="block w-full rounded-xl border-gray-300 bg-gray-50 py-3 pl-3 pr-10 text-gray-900 focus:border-blue-500 focus:ring-blue-500 sm:text-sm shadow-sm border appearance-none">
                                        <option value="">Pilih Desain</option>
                                        @foreach ($designs as $design)
                                            <option value="{{ $design->id }}">{{ $design->nama }}</option>
                                        @endforeach
                                    </select>
                                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-500">
                                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" /></svg>
                                    </div>
                                </div>
                            </div>

                            {{-- Field: Nama Proyek --}}
                            <div>
                                <label for="nama_proyek" class="block text-sm font-bold text-gray-700 mb-1">Nama Proyek</label>
                                <input type="text" name="nama_proyek" id="nama_proyek" class="block w-full rounded-xl border-gray-300 bg-gray-50 py-3 px-3 text-gray-900 focus:border-blue-500 focus:ring-blue-500 sm:text-sm shadow-sm border" placeholder="Cth: Renovasi Rumah Pak Budi">
                            </div>

                            {{-- Field: Deskripsi --}}
                            <div>
                                <label for="deskripsi" class="block text-sm font-bold text-gray-700 mb-1">Deskripsi Lengkap</label>
                                <textarea id="deskripsi" name="deskripsi" rows="3" class="block w-full rounded-xl border-gray-300 bg-gray-50 py-3 px-3 text-gray-900 focus:border-blue-500 focus:ring-blue-500 sm:text-sm shadow-sm border" placeholder="Jelaskan kebutuhan Anda (Luas tanah, jumlah kamar, dll)..."></textarea>
                            </div>

                            {{-- Field: Alamat --}}
                            <div>
                                <label for="alamat" class="block text-sm font-bold text-gray-700 mb-1">Alamat Lokasi Proyek</label>
                                <textarea required id="alamat" name="alamat" rows="2" class="block w-full rounded-xl border-gray-300 bg-gray-50 py-3 px-3 text-gray-900 focus:border-blue-500 focus:ring-blue-500 sm:text-sm shadow-sm border" placeholder="Alamat lengkap lokasi pembangunan..."></textarea>
                            </div>

                            {{-- Footer Form --}}
                            <div class="sm:grid sm:grid-flow-row-dense sm:grid-cols-2 sm:gap-3">
                                <button type="submit" class="inline-flex w-full justify-center rounded-xl bg-blue-600 px-3 py-3 text-sm font-bold text-white shadow-sm hover:bg-blue-700 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600 sm:col-start-2 order-1">
                                    Ajukan Proyek
                                </button>
                                <button type="button" onclick="closeModal()" class="mt-3 inline-flex w-full justify-center rounded-xl bg-white px-3 py-3 text-sm font-bold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:col-start-1 sm:mt-0 order-2">
                                    Batal
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- ================= END MODAL ================= --}}

    {{-- SCRIPTS --}}
    <script>
        const modal = document.getElementById('projectModal');
        const backdrop = document.getElementById('modalBackdrop');
        const panel = document.getElementById('modalPanel');
        const mobileNav = document.getElementById('mobile-menu');

        function toggleMobileMenu() {
            mobileNav.classList.toggle('hidden');
        }

        function openModal() {
            modal.classList.remove('hidden');
            // Animasi Masuk
            setTimeout(() => {
                // Backdrop
                backdrop.classList.remove('opacity-0');
                backdrop.classList.add('opacity-100');
                
                // Panel
                panel.classList.remove('opacity-0', 'translate-y-4', 'sm:translate-y-0', 'sm:scale-95');
                panel.classList.add('opacity-100', 'translate-y-0', 'sm:scale-100');
            }, 10);
        }

        function closeModal() {
            // Animasi Keluar
            backdrop.classList.remove('opacity-100');
            backdrop.classList.add('opacity-0');
            
            panel.classList.remove('opacity-100', 'translate-y-0', 'sm:scale-100');
            panel.classList.add('opacity-0', 'translate-y-4', 'sm:translate-y-0', 'sm:scale-95');

            setTimeout(() => {
                modal.classList.add('hidden');
            }, 300);
        }

        // Tutup jika klik backdrop
        window.onclick = function(event) {
            if (event.target == backdrop) {
                closeModal();
            }
        }
    </script>
</body>
</html>