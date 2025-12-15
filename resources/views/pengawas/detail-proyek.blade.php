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
                    <h3 class="text-xl font-semibold text-gray-900">Detail Proyek (Hanya Lihat)</h3>
                    <div class="bg-white border-b border-gray-100 pb-10 pt-6 shadow-sm">
                        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

                            <a href="{{ route('pengawas.dashboard') }}"
                                class="text-sm text-gray-500 hover:text-blue-600 mb-6 inline-flex items-center transition">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                                </svg>
                                Kembali ke Daftar Proyek
                            </a>

                            <div class="md:flex md:items-start md:justify-between gap-6 mb-8">
                                <div class="flex-1 min-w-0">
                                    <h2 class="text-3xl font-extrabold text-gray-900 sm:text-4xl tracking-tight">
                                        {{ $project->nama_proyek ?? 'Belum Ditentukan' }}</h2>
                                    <div class="mt-3 flex flex-col sm:flex-row sm:flex-wrap sm:space-x-6 gap-y-2">
                                        <div class="flex items-center text-sm text-gray-500">
                                            <svg class="flex-shrink-0 mr-1.5 h-5 w-5 text-gray-400" fill="none"
                                                stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                                </path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            </svg>
                                            {{ $project->alamat ?? '-' }}
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-4 md:mt-0 flex flex-col items-end">
                                    <span
                                        class="inline-flex items-center px-4 py-1.5 rounded-full text-sm font-bold text-blue-700 bg-blue-50 border border-blue-100 shadow-sm">
                                        <span class="w-2 h-2 bg-blue-600 rounded-full mr-2 animate-pulse"></span>
                                        {{ $project->status }}
                                    </span>
                                </div>
                            </div>

                            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-stretch">
                                <div
                                    class="lg:col-span-2 flex flex-col justify-center bg-gray-50 rounded-2xl p-6 border border-gray-100">
                                    <div class="flex justify-between mb-4 items-end">
                                        <div>
                                            <span
                                                class="text-xs font-bold text-gray-400 uppercase tracking-wider">Progress
                                                Realisasi</span>
                                            <div class="text-3xl font-extrabold text-gray-900 mt-1">
                                                {{ round($project->progress ?? 0, 2) }}%</div>
                                        </div>
                                        <span
                                            class="text-sm font-medium text-green-600 bg-green-50 px-3 py-1 rounded-full">{{ $project->status }}</span>
                                    </div>
                                    <div class="w-full bg-gray-200 rounded-full h-4 overflow-hidden shadow-inner">
                                        <div class="bg-blue-600 h-4 rounded-full shadow-lg relative"
                                            style="width: {{ min(100, $project->progress ?? 0) }}%"></div>
                                    </div>
                                </div>

                                <div class="lg:col-span-1">
                                    <div
                                        class="bg-blue-600 shadow-lg shadow-blue-200 rounded-2xl p-6 text-white relative overflow-hidden h-full flex flex-col justify-center">
                                        <div
                                            class="absolute -top-10 -right-10 w-32 h-32 bg-white opacity-10 rounded-full">
                                        </div>
                                        <h3
                                            class="text-xs font-bold text-blue-100 uppercase tracking-wider mb-4 relative z-10">
                                            Ringkasan Biaya</h3>
                                        <div class="space-y-4 relative z-10">
                                            <div
                                                class="flex justify-between items-center border-b border-blue-500/50 pb-3">
                                                <span class="text-blue-100 text-sm">Total Kontrak</span>
                                                <span class="font-bold text-lg">Rp
                                                    {{ number_format($project->harga ?? 0, 0, ',', '.') }}</span>
                                            </div>
                                            <div class="flex justify-between items-center">
                                                <span class="text-blue-100 text-sm">Sudah Dibayar</span>
                                                <div class="text-right">
                                                    <span class="font-bold text-xl text-white">Rp
                                                        {{ number_format($project->sudah_dibayar ?? 0, 0, ',', '.') }}</span>
                                                    <span
                                                        class="text-xs inline-block bg-blue-500 text-white px-1.5 py-0.5 rounded ml-1 font-medium">{{ round($project->progress ?? 0, 2) }}%</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
                        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                            <div class="lg:col-span-1 space-y-6">
                                <div class="bg-white shadow-lg rounded-2xl p-6 border border-gray-100">
                                    <h3 class="text-sm font-bold text-gray-400 uppercase tracking-wider mb-4">Pelanggan
                                    </h3>
                                    <div class="flex items-center">
                                        <img class="h-14 w-14 rounded-full object-cover border-2 border-white shadow-md"
                                            src="https://ui-avatars.com/api/?name={{ $project->pengunjung?->nama ?? 'Pelanggan' }}&background=random"
                                            alt="Foto Pelanggan">
                                        <div class="ml-4">
                                            <h4 class="text-lg font-bold text-gray-900">
                                                {{ $project->pengunjung?->nama ?? 'Belum Ditentukan' }}</h4>
                                            <p class="text-sm text-blue-600 font-medium">Klien</p>
                                        </div>
                                    </div>
                                    @if ($project->pengunjung)
                                        <div class="mt-6">
                                            <a href="{{ route('pengawas.chat', ['rid' => $project->pengunjung->id]) }}"
                                                class="block w-full bg-white border border-gray-300 text-gray-700 py-2.5 px-4 rounded-xl hover:bg-gray-50 hover:text-blue-600 hover:border-blue-300 transition text-sm font-bold text-center shadow-sm">
                                                Chat Pelanggan
                                            </a>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div class="lg:col-span-2 space-y-8">
                                <div class="bg-white shadow-lg rounded-2xl p-6 border border-gray-100">
                                    <h3 class="text-xl font-bold text-gray-900 mb-4">Deskripsi Pekerjaan</h3>
                                    <p class="text-gray-600 leading-relaxed text-justify">{{ $project->deskripsi }}
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="mt-16">
                            <h2 class="text-2xl font-bold text-gray-900 mb-6 border-l-4 border-blue-600 pl-4">Rincian
                                Pembayaran</h2>
                            <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100">
                                <div class="overflow-x-auto no-scrollbar">
                                    <table class="w-full text-left border-collapse min-w-[600px]">
                                        <thead>
                                            <tr
                                                class="bg-gray-50 text-gray-500 text-xs uppercase tracking-wider border-b border-gray-100">
                                                <th class="px-6 py-4 font-bold text-center w-16">No</th>
                                                <th class="px-6 py-4 font-bold">Deskripsi Tagihan</th>
                                                <th class="px-6 py-4 font-bold">Total Harga</th>
                                                <th class="px-6 py-4 font-bold text-center">Status</th>
                                            </tr>
                                        </thead>
                                        <tbody class="divide-y divide-gray-100">
                                            @foreach ($project->payment?->progresses ?? [] as $index => $payment)
                                                <tr class="hover:bg-gray-50 transition duration-150">
                                                    <td class="px-6 py-5 text-center font-medium text-gray-400">
                                                        {{ $index + 1 }}</td>
                                                    <td class="px-6 py-5 text-gray-700">
                                                        <div class="font-bold text-gray-900">
                                                            {{ $payment->deskripsi ?? '-' }}</div>
                                                        <span
                                                            class="text-xs text-gray-400 mt-1 block">Pembayaran</span>
                                                    </td>
                                                    <td class="px-6 py-5 font-bold text-gray-900">Rp
                                                        {{ number_format($payment->jumlah, 0, ',', '.') }}</td>
                                                    <td class="px-6 py-5 text-center">
                                                        <span
                                                            class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-green-100 text-green-700 border border-green-200">{{ $payment->status }}</span>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </main>
