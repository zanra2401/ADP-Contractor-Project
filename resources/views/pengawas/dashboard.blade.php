<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Pengawas - ADP Konstruksi</title>
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
                            class="{{ request()->routeIs('pengawas.chat') ? 'border-blue-500 text-gray-900' : 'border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700' }} inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                            Chat Pelanggan
                        </a>
                    </div>
                </div>

                <div class="hidden sm:ml-6 sm:flex sm:items-center space-x-4">
                    <span class="text-sm text-gray-700 mr-2">
                        Halo, {{ Auth::user()->name ?? 'Pengawas' }}!
                    </span>

                    <a href="{{ route('pengawas.profil') }}"
                        class="text-sm font-medium text-gray-500 hover:text-gray-700">Profil Saya</a>

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
                    <a href="{{ route('pengawas.profil') }}"
                        class="block px-4 py-2 text-base font-medium text-gray-500 hover:text-gray-800 hover:bg-gray-100">Profil
                        Saya</a>
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
            <h1 class="text-3xl font-bold leading-tight text-gray-900">
                Proyek Aktif Saya
            </h1>
            <p class="mt-2 text-gray-600">Daftar proyek konstruksi yang sedang Anda tangani.</p>
        </header>

        <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-8">

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @if (isset($recentProjects) && $recentProjects->count())
                    @foreach ($recentProjects as $project)
                        <div class="bg-white rounded-xl shadow-lg overflow-hidden flex flex-col">
                            @php
                                $cover = optional($project->design)->cover_image;
                            @endphp
                            <img class="h-48 w-full object-cover"
                                src="{{ $cover ? asset('storage/' . $cover) : 'https://via.placeholder.com/800x480?text=No+Image' }}"
                                alt="{{ $project->nama_proyek ?? 'Proyek' }}">

                            <div class="p-6 flex-grow flex flex-col">
                                <h3 class="text-xl font-semibold text-gray-900">{{ $project->nama_proyek ?? '-' }}</h3>
                                <p class="mt-1 text-sm text-gray-600">Klien: <span
                                        class="font-medium">{{ optional($project->pengunjung)->nama ?? '-' }}</span>
                                </p>
                                <p class="mt-2 text-sm text-gray-600">Status: <span
                                        class="font-medium {{ $project->status === 'selesai' ? 'text-green-600' : ($project->status === 'proses' ? 'text-yellow-600' : 'text-gray-600') }}">{{ ucfirst($project->status) }}</span>
                                </p>

                                <div class="mt-6 flex-shrink-0">
                                    <a href="{{ route('pengawas.detail-proyek', ['id' => $project->id]) }}"
                                        class="w-full text-center block py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 transition">
                                        Kelola Progres
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="col-span-1 sm:col-span-2 lg:col-span-3 bg-white rounded-xl shadow p-6 text-center">
                        Belum ada proyek untuk ditampilkan.
                    </div>
                @endif
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
