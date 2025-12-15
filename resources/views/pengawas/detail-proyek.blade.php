<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Proyek - ADP Konstruksi</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

    <nav class="bg-white shadow-md sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">

                {{-- KIRI: LOGO & MENU DESKTOP --}}
                <div class="flex">
                    <div class="flex-shrink-0 flex items-center">
                        <span class="font-bold text-xl text-blue-600">ADP - Panel Pengawas</span>
                    </div>

                    {{-- Menu Navigasi Desktop (hidden di HP) --}}
                    <div class="hidden sm:ml-6 sm:flex sm:space-x-8">
                        <a href="{{ route('pengawas.dashboard') }}"
                            class="border-blue-500 text-gray-900 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                            Proyek Saya
                        </a>
                        <a href="{{ route('pengawas.chat') }}"
                            class="border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                            Chat Pelanggan
                        </a>
                    </div>
                </div>

                <div class="hidden sm:ml-6 sm:flex sm:items-center space-x-4">
                    <span class="text-sm text-gray-700 mr-2">
                        Halo, {{ Auth::user()->name ?? 'Pengawas' }}!
                    </span>
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="text-sm font-medium text-red-600 hover:text-red-800 ml-2">
                            Logout
                        </button>
                    </form>
                </div>

                <div class="flex items-center sm:hidden">
                    <button type="button" onclick="toggleMobileMenu()"
                        class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <div class="hidden sm:hidden bg-white border-t border-gray-200 absolute w-full z-40 shadow-lg" id="mobile-menu">
            <div class="pt-2 pb-3 space-y-1">
                <a href="{{ route('pengawas.dashboard') }}"
                    class="block pl-3 pr-4 py-2 border-l-4 border-blue-500 text-base font-medium text-blue-700 bg-blue-50">Proyek
                    Saya</a>
                <a href="{{ route('pengawas.chat') }}"
                    class="block pl-3 pr-4 py-2 border-l-4 border-transparent text-base font-medium text-gray-600 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-800">Chat
                    Pelanggan</a>
            </div>
            <div class="pt-4 pb-3 border-t border-gray-200">
                <div class="px-4">
                    <div class="text-base font-medium text-gray-800">Halo, {{ Auth::user()->name ?? 'Pengawas' }}</div>
                </div>
                <div class="mt-3 space-y-1">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                            class="block w-full text-left px-4 py-2 text-base font-medium text-red-600 hover:text-red-800 hover:bg-gray-100">Logout</button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <div class="py-10">
        <header class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <a href="{{ route('pengawas.dashboard') }}"
                class="text-sm font-medium text-blue-600 hover:text-blue-800 flex items-center transition">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Kembali ke Daftar Proyek
            </a>
            <h1 class="text-3xl font-bold leading-tight text-gray-900 mt-2">
                {{ $project->nama_proyek ?? 'Detail Proyek' }}
            </h1>
            <p class="mt-1 text-lg text-gray-600">Klien: {{ optional($project->pengunjung)->nama ?? '-' }}
                ({{ optional($project->pengunjung)->nomor_telepon ?? '-' }})</p>
        </header>

        <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-8 grid grid-cols-1 md:grid-cols-4 gap-8">

            <div class="md:col-span-4 space-y-8">

                <div class="bg-white p-6 rounded-xl shadow-lg">
                    <h3 class="text-xl font-semibold text-gray-900">Edit Data Proyek</h3>
                    @if (session('success'))
                        <div class="mb-4 text-sm text-green-700 bg-green-100 p-3 rounded">{{ session('success') }}
                        </div>
                    @endif
                    <form class="space-y-6 mt-6"
                        action="{{ route('pengawas.detail-proyek.update', ['id' => $project->id]) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div>
                            <label for="nama_proyek" class="block text-sm font-medium text-gray-700">Nama Proyek</label>
                            <input type="text" name="nama_proyek" id="nama_proyek"
                                value="{{ old('nama_proyek', $project->nama_proyek) }}"
                                class="mt-2 block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-base">
                        </div>

                        <div>
                            <label for="deskripsi" class="block text-sm font-medium text-gray-700">Deskripsi</label>
                            <textarea id="deskripsi" name="deskripsi" rows="6"
                                class="mt-2 block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-base">{{ old('deskripsi', $project->deskripsi) }}</textarea>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label for="harga" class="block text-sm font-medium text-gray-700">Harga (Rp)</label>
                                <input type="number" name="harga" id="harga"
                                    value="{{ old('harga', $project->harga) }}"
                                    class="mt-2 block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm text-base">
                            </div>
                            <div>
                                <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                                <select name="status" id="status"
                                    class="mt-2 block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm text-base">
                                    @foreach (['disetujui', 'pending', 'proses', 'selesai'] as $s)
                                        <option value="{{ $s }}"
                                            {{ old('status', $project->status) === $s ? 'selected' : '' }}>
                                            {{ ucfirst($s) }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div>
                            <label for="alamat" class="block text-sm font-medium text-gray-700">Alamat</label>
                            <textarea id="alamat" name="alamat" rows="3"
                                class="mt-2 block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm text-base">{{ old('alamat', $project->alamat) }}</textarea>
                        </div>

                        <div>
                            <label for="file_path" class="block text-sm font-medium text-gray-700">File Proyek (RAB /
                                Dokumen)</label>
                            <input type="file" name="file_path" id="file_path"
                                class="mt-2 block w-full text-sm text-gray-500">
                            @if ($project->file_path)
                                <p class="text-xs text-gray-500 mt-2">File saat ini: <a
                                        href="{{ asset('storage/' . $project->file_path) }}" target="_blank"
                                        class="underline">Lihat / Unduh</a></p>
                            @endif
                        </div>

                        <div class="text-right">
                            <button type="submit"
                                class="inline-flex justify-center py-3 px-6 border border-transparent shadow-sm text-base font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 transition">
                                Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </main>
    </div>

    <script>
        function toggleMobileMenu() {
            const menu = document.getElementById('mobile-menu');
            menu.classList.toggle('hidden');
        }
    </script>
</body>

</html>
