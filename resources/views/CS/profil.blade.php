<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil CS - ADP Konstruksi</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-gray-100" x-data="{ open: false }">

    <nav class="bg-white shadow-md sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex">
                    <div class="flex-shrink-0 flex items-center">
                        <span class="font-bold text-xl text-blue-600">ADP - Panel CS</span>
                    </div>
                    
                    <div class="hidden sm:ml-8 sm:flex sm:space-x-8">
                        <a href="{{ route('cs.dashboard') }}" class="{{ request()->routeIs('cs.dashboard') ? 'border-blue-500 text-gray-900' : 'border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700' }} inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium transition">
                            Chat Masuk
                        </a>
                        <a href="{{ route('cs.profil') }}" class="{{ request()->routeIs('cs.profil') ? 'border-blue-500 text-gray-900' : 'border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700' }} inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium transition">
                            Profil Saya
                        </a>
                    </div>
                </div>
                
                <div class="hidden sm:flex sm:items-center sm:ml-6 space-x-4">
                    <span class="text-sm text-gray-700">Halo, **{{ Auth::user()->name ?? 'CS Budi' }}**!</span>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-sm font-medium text-gray-500 hover:text-red-600 transition">
                            Logout
                        </button>
                    </form>
                </div>

                <div class="flex items-center sm:hidden">
                    <button @click="open = !open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none transition">
                        <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path :class="{'hidden': open, 'inline-flex': !open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            <path :class="{'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <div x-show="open" x-transition class="sm:hidden bg-white border-t border-gray-200">
            <div class="pt-2 pb-3 space-y-1">
                <a href="{{ route('cs.dashboard') }}" class="block pl-3 pr-4 py-2 border-l-4 text-base font-medium border-transparent text-gray-600 hover:bg-gray-50 hover:border-blue-500 hover:text-gray-800">Chat Masuk</a>
                <a href="{{ route('cs.profil') }}" class="block pl-3 pr-4 py-2 border-l-4 text-base font-medium border-blue-500 text-blue-700 bg-blue-50">Profil Saya</a>
            </div>
            <div class="pt-4 pb-1 border-t border-gray-200">
                <div class="px-4">
                    <div class="text-base font-medium text-gray-800">{{ Auth::user()->name ?? 'CS Budi' }}</div>
                    <div class="text-sm font-medium text-gray-500">Customer Service</div>
                </div>
                <div class="mt-3 space-y-1">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="block w-full text-left px-4 py-2 text-base font-medium text-gray-500 hover:text-red-600 hover:bg-gray-100 transition">
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <div class="py-10">
        <header class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-2xl sm:text-3xl font-bold leading-tight text-gray-900 text-center sm:text-left">
                Profil Saya
            </h1>
            <p class="mt-2 text-gray-600 text-center sm:text-left">Perbarui informasi akun pribadi Anda.</p>
        </header>
        
        <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-8">
            <div class="max-w-xl mx-auto bg-white p-6 sm:p-8 rounded-lg shadow-lg">
                <form class="space-y-6" action="#" method="POST">
                    @csrf
                    
                    <div>
                        <label for="full_name" class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                        <input type="text" name="full_name" id="full_name" 
                               class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" 
                               value="{{ Auth::user()->name ?? 'Budi Santoso' }}">
                    </div>

                    <div>
                        <label for="phone_number" class="block text-sm font-medium text-gray-700">Nomor Telepon (Login)</label>
                        <input type="text" name="phone_number" id="phone_number" 
                               class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" 
                               value="{{ Auth::user()->phone ?? '085678901234' }}">
                    </div>

                    <div class="pt-4 border-t border-gray-200">
                        <h3 class="text-lg font-medium text-gray-900">Ubah Sandi</h3>
                        <p class="text-xs sm:text-sm text-gray-500">Kosongkan jika tidak ingin mengubah sandi.</p>
                    </div>

                    <div>
                        <label for="current_password" class="block text-sm font-medium text-gray-700">Sandi Saat Ini</label>
                        <input type="password" name="current_password" id="current_password" 
                               class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                    </div>

                    <div>
                        <label for="new_password" class="block text-sm font-medium text-gray-700">Sandi Baru</label>
                        <input type="password" name="new_password" id="new_password" 
                               class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                    </div>

                    <div class="flex justify-center sm:justify-end">
                        <button type="submit" class="w-full sm:w-auto inline-flex justify-center py-2 px-6 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition">
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </main>
    </div>

</body>
</html>