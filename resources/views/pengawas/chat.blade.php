@php
    function readIndicator($status) {
        if ($status === 'dibaca') {
            return '<span class="text-xs text-blue-400 ml-1">dibaca</span>';
        }
        return '<span class="text-xs text-gray-400 ml-1">terkirim</span>';
    }
@endphp

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat - ADP Konstruksi</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* CSS Tambahan untuk menyembunyikan scrollbar tapi tetap bisa scroll */
        .no-scrollbar::-webkit-scrollbar {
            display: none;
        }
        .no-scrollbar {
            -ms-overflow-style: none;  /* IE and Edge */
            scrollbar-width: none;  /* Firefox */
        }
    </style>
</head>
<body class="bg-gray-100 h-screen flex flex-col overflow-hidden">

    <nav class="bg-white shadow-md flex-shrink-0 z-50 relative">
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
                           class="{{ request()->routeIs('pengawas.dashboard') ? 'border-blue-500 text-gray-900' : 'border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700' }} inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                            Proyek Saya
                        </a>
                        <a href="{{ route('pengawas.chat') }}" 
                           class="border-blue-500 text-gray-900 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                            Chat Pelanggan
                        </a>
                    </div>
                </div>
                
                <div class="hidden sm:ml-6 sm:flex sm:items-center space-x-4">
                    <span class="text-sm text-gray-700 mr-2">Halo, {{ Auth::user()->name ?? 'Pengawas' }}!</span>
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="text-sm font-medium text-red-600 hover:text-red-800 ml-2">Logout</button>
                    </form>
                </div>

                <div class="-mr-2 flex items-center sm:hidden">
                    <button type="button" onclick="toggleNavbar()" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <div class="hidden sm:hidden bg-white border-t border-gray-200 absolute w-full z-40 shadow-lg" id="mobile-nav">
            <div class="pt-2 pb-3 space-y-1">
                <a href="{{ route('pengawas.dashboard') }}" class="block pl-3 pr-4 py-2 border-l-4 border-transparent text-base font-medium text-gray-600 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-800">Proyek Saya</a>
                <a href="{{ route('pengawas.chat') }}" class="block pl-3 pr-4 py-2 border-l-4 border-blue-500 text-base font-medium text-blue-700 bg-blue-50">Chat Pelanggan</a>
            </div>
            <div class="pt-4 pb-3 border-t border-gray-200">
                <div class="px-4">
                    <div class="text-base font-medium text-gray-800">Halo, {{ Auth::user()->name ?? 'Pengawas' }}</div>
                </div>
                <div class="mt-3 space-y-1">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="block w-full text-left px-4 py-2 text-base font-medium text-red-600 hover:text-red-800 hover:bg-gray-100">Logout</button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <div class="flex-1 max-w-7xl mx-auto w-full sm:px-6 lg:px-8 sm:py-6 flex flex-col" style="height: calc(100vh - 4rem);">

        <header class="mb-4 px-4 sm:px-0 flex-shrink-0">
            <a href="{{ route('pengawas.dashboard') }}" class="text-blue-600 hover:text-blue-800 text-sm font-medium flex items-center transition">
                <svg class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Kembali ke Proyek
            </a>
            <h1 class="text-2xl font-bold text-gray-900 mt-2">Chat Pelanggan</h1>
            <p class="text-gray-600 text-sm">Diskusikan proyek dengan klien Anda.</p>
        </header>

        <main class="flex-1 w-full relative overflow-hidden">
            <div class="flex h-full bg-white rounded-lg shadow-lg overflow-hidden border border-gray-200">
                
                <div id="contactList" class="w-full md:w-1/3 border-r border-gray-200 flex flex-col bg-white h-full z-10 absolute md:static top-0 left-0">
                    <div class="p-4 border-b border-gray-200 bg-gray-50 flex-shrink-0">
                        <h2 class="text-lg font-semibold text-gray-700">Daftar Kontak</h2>
                    </div>
                    <ul class="divide-y divide-gray-200 overflow-y-auto flex-1 no-scrollbar">
                        @foreach ($contacts as $contact)
                            <li>
                                {{-- Menggunakan onclick untuk switch view di mobile --}}
                                <a href="{{ route('pengawas.chat', ['rid' => $contact->id]) }}" 
                                    class="p-4 flex items-center cursor-pointer {{ $rid == $contact->id ? 'border-l-4 border-blue-600 bg-blue-50' : '' }} hover:bg-blue-100 transition">
                                    
                                    <img class="h-10 w-10 rounded-full" src="https://ui-avatars.com/api/?name={{ $contact->nama }}&background=random" alt="<?= $contact->role->nama ?>">
                                    <div class="ml-3 flex-1 min-w-0">
                                        <div class="flex justify-between">
                                            <p class="text-sm font-medium text-gray-900 truncate"><?= $contact->nama ?></p>
                                            <span class="text-xs text-gray-500">{{ $contact['last_time'] ? $contact['last_time'] : '' }}</span>
                                        </div>
                                        <p class="text-sm text-gray-600 truncate">{{ $contact['last_message'] ? $contact['last_message'] : 'Mulai chat...' }}</p>
                                    </div>
                                    @if($contact['unread'] > 0)
                                        <span class="ml-2 bg-blue-600 text-white text-xs font-bold rounded-full h-5 w-5 flex items-center justify-center"> {{ $contact['unread'] }} </span>
                                    @endif
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
                
                <div id="chatWindow" class="w-full md:w-2/3 h-full bg-gray-50 absolute md:static top-0 left-0 z-20 {{ $rid ? 'flex flex-col' : 'hidden md:flex flex-col' }}">
                    
                    @if ($rid)
                        {{-- KONTEN CHAT AKTIF --}}
                        <div class="p-3 sm:p-4 border-b border-gray-200 bg-white flex justify-between items-center shadow-sm z-10 flex-shrink-0">
                            <div class="flex items-center">
                                <button onclick="backToContacts()" class="md:hidden mr-3 p-2 rounded-full text-gray-600 hover:bg-gray-100">
                                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                                    </svg>
                                </button>
                                <div>
                                    <h2 class="text-sm sm:text-lg font-bold text-gray-800" id="currentChatTitle">{{ $rcontact->nama }}</h2>
                                    <p class="text-xs text-green-600 flex items-center" id="currentChatStatus">
                                        <span class="h-2 w-2 bg-green-500 rounded-full mr-1"></span> Online
                                    </p>
                                </div>
                            </div>
                        </div>
                        
                        <div id='message-container' class="flex-1 p-6 space-y-4 overflow-y-auto bg-gray-50 no-scrollbar">
                            @foreach ($messages as $message)
                                @php
                                    $isMine = ($rid != $message->pengirim_id);
                                    $isImage = $message->media_path && preg_match('/\.(jpg|jpeg|png|gif|webp)$/i', $message->media_path);
                                @endphp

                                <div class="flex {{ $isMine ? 'justify-end' : '' }}">
                                    <div class="p-3 rounded-lg max-w-[85%] sm:max-w-xs shadow-sm 
                                                {{ $isMine ? 'bg-blue-600 text-white rounded-tr-none' : 'bg-white border border-gray-200 text-gray-800 rounded-tl-none' }}">

                                        {{-- Jika ada media --}}
                                        @if ($message->media_path)
                                            @if ($isImage)
                                                <img src="{{ asset('storage/' . $message->media_path) }}" class="rounded mb-2 max-h-48 object-cover cursor-pointer" onclick="viewMedia('{{ asset('storage/' . $message->media_path) }}', 'image')">
                                            @else
                                                <a href="{{ asset('storage/' . $message->media_path) }}" target="_blank" class="underline text-sm block mb-2 {{ $isMine ? 'text-blue-200' : 'text-blue-600' }}">
                                                    Download File
                                                </a>
                                            @endif
                                        @endif
                                        
                                        @if ($message->pesan)
                                            <p class="text-sm">{{ $message->pesan }}</p>
                                        @endif
                                        
                                        <span class="text-xs block text-right mt-1 {{ $isMine ? 'text-blue-100' : 'text-gray-400' }}">
                                            {{ \Illuminate\Support\Carbon::parse($message->waktu_kirim)->format("H:i") }}
                                            @if($isMine)
                                                {!! readIndicator($message->status) !!}
                                            @endif
                                        </span>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="p-4 bg-white border-t border-gray-200 flex-shrink-0">
                            
                            <div id="previewArea" class="mb-3 hidden">
                                <div class="relative inline-block">
                                    <div id="previewContent" class="inline-block"></div>
                                    <button id="removePreview" type="button" class="absolute top-1 right-1 bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center text-xs hover:bg-red-600">
                                        ×
                                    </button>
                                </div>
                            </div>

                            <form id="chatForm" enctype="multipart/form-data" class="flex items-center space-x-3">
                                
                                <input type="hidden" name="penerima_id" value="{{ $rid }}">

                                <input 
                                    type="text" 
                                    name="pesan"
                                    placeholder="Ketik balasan Anda..."
                                    class="flex-1 px-4 py-2 border border-gray-300 rounded-full
                                    focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                >

                                <label id="fileBtn" class="p-3 rounded-full bg-gray-200 text-gray-700 
                                    hover:bg-gray-300 cursor-pointer transition shadow-sm flex-shrink-0">
                                    <input 
                                        type="file" 
                                        name="media"
                                        id="fileInput"
                                        class="hidden"
                                        accept="image/*,video/*"
                                    >

                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.827 6.175A2.31 2.31 0 015.186 7.23c-.38.054-.757.112-1.134.175C2.999 7.58 2.25 8.507 2.25 9.574V18a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18V9.574c0-1.067-.75-1.994-1.802-2.169a47.865 47.865 0 00-1.134-.175 2.31 2.31 0 01-1.64-1.055l-.822-1.316a2.192 2.192 0 00-1.736-1.039 48.774 48.774 0 00-5.232 0 2.192 2.192 0 00-1.736 1.039l-.821 1.316z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 12.75a4.5 4.5 0 11-9 0 4.5 4.5 0 019 0zM18.75 10.5h.008v.008h-.008V10.5z" />
                                    </svg>
                                </label>

                                <button 
                                    type="submit"
                                    class="inline-flex justify-center p-3 rounded-full text-white bg-blue-600 
                                    hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 
                                    focus:ring-blue-500 shadow-md transition flex-shrink-0"
                                >
                                    <svg class="h-5 w-5 transform rotate-90" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5-1.429A1 1 0 009 15.571V11a1 1 0 112 0v4.571a1 1 0 00.725.962l5 1.428a1 1 0 001.17-1.408l-7-14z" />
                                    </svg>
                                </button>

                            </form>
                        </div>
                    @else
                        {{-- KONTEN CHAT KOSONG (Saat belum ada RID yang dipilih) --}}
                         <div class="w-full h-full flex justify-center items-center text-center p-10">
                            <div class="text-gray-500">
                                <svg class="w-16 h-16 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 4v-4z" />
                                </svg>
                                <p class="text-lg font-semibold">Silakan pilih kontak untuk memulai chat.</p>
                                <p class="text-sm">Gunakan menu di samping kiri Anda.</p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </main>
    </div>

    {{-- MODAL MEDIA VIEW (Placeholder) --}}
    <div id="mediaModal" class="fixed inset-0 bg-black bg-opacity-75 hidden justify-center items-center p-4 z-[60]">
        <div class="relative max-w-full max-h-full">
            <button onclick="closeMediaModal()" class="absolute top-4 right-4 text-white text-3xl font-bold bg-gray-800 bg-opacity-50 rounded-full p-2 hover:bg-opacity-80 transition z-50">
                &times;
            </button>
            <div id="mediaContent" class="max-w-full max-h-full">
                {{-- Konten media akan dimuat di sini --}}
            </div>
        </div>
    </div>


<script>
    // --- Variabel Elemen ---
    const fileInput = document.getElementById('fileInput');
    const previewArea = document.getElementById('previewArea');
    const previewContent = document.getElementById('previewContent');
    const removePreviewBtn = document.getElementById('removePreview');
    const chatForm = document.getElementById('chatForm');
    const messageContainer = document.getElementById('message-container');
    const contactList = document.getElementById('contactList');
    const chatWindow = document.getElementById('chatWindow');

    // --- LOGIKA NAVBAR ---
    function toggleNavbar() {
        document.getElementById('mobile-nav').classList.toggle('hidden');
    }

    // --- LOGIKA MASTER-DETAIL VIEW ---
    // Di aplikasi nyata, fungsi ini juga akan memicu pemuatan data chat
    function openChatMobile(title, status, rid) {
        // Update data header
        document.getElementById('currentChatTitle').innerText = title;
        document.getElementById('currentChatStatus').innerHTML = status === 'online' 
            ? '<span class="h-2 w-2 bg-green-500 rounded-full mr-1"></span> Online' 
            : 'Offline';
        document.getElementById('currentChatStatus').className = `text-xs ${status === 'online' ? 'text-green-600' : 'text-gray-400'} flex items-center`;

        // Logic Switch CSS untuk Mobile
        if (window.innerWidth < 768) { 
            contactList.classList.add('hidden');
            chatWindow.classList.remove('hidden');
            chatWindow.classList.add('flex');
            // Jika ada tombol Tentukan Harga, mungkin perlu disembunyikan/diubah di sini
        }
    }

    function backToContacts() {
        chatWindow.classList.add('hidden');
        chatWindow.classList.remove('flex');
        contactList.classList.remove('hidden');
    }

    // --- Logika Media Preview/Upload ---
    function clearPreview() {
        if (fileInput) fileInput.value = '';
        previewArea.classList.add('hidden');
        previewContent.innerHTML = '';
    }

    fileInput?.addEventListener('change', function (e) {
        const file = this.files[0];
        if (file) {
            const fileType = file.type;
            const fileURL = URL.createObjectURL(file);
            
            previewArea.classList.remove('hidden');
            
            if (fileType.startsWith('image/')) {
                previewContent.innerHTML = `<img src="${fileURL}" class="h-32 w-auto rounded-lg shadow-sm object-cover border border-gray-200">`;
            } else if (fileType.startsWith('video/')) {
                previewContent.innerHTML = `<video src="${fileURL}" controls class="h-32 w-auto rounded-lg shadow-sm border border-gray-200"></video>`;
            } else {
                previewContent.innerHTML = `<div class="h-16 flex items-center justify-center bg-gray-100 rounded text-sm text-gray-500 px-4">${file.name}</div>`;
            }
        }
    });

    removePreviewBtn?.addEventListener('click', clearPreview);

    // --- Logika Media Modal ---
    function viewMedia(url, type) {
        const mediaContent = document.getElementById('mediaContent');
        if (type === 'image') {
            mediaContent.innerHTML = `<img src="${url}" class="max-h-[80vh] max-w-[90vw] object-contain rounded-lg">`;
        } else if (type === 'video') {
            mediaContent.innerHTML = `<video src="${url}" controls class="max-h-[80vh] max-w-[90vw] object-contain rounded-lg"></video>`;
        }
        document.getElementById('mediaModal').classList.remove('hidden');
        document.getElementById('mediaModal').classList.add('flex');
    }

    function closeMediaModal() {
        document.getElementById('mediaContent').innerHTML = '';
        document.getElementById('mediaModal').classList.remove('flex');
        document.getElementById('mediaModal').classList.add('hidden');
    }

    // --- Setup Awal ---
    window.addEventListener('DOMContentLoaded', () => {
        if(messageContainer) {
            messageContainer.scrollTop = messageContainer.scrollHeight;
        }

        window.addEventListener('resize', function() {
            if (window.innerWidth >= 768) {
                contactList.classList.remove('hidden');
                if (document.getElementById('chatWindow')) {
                    document.getElementById('chatWindow').classList.remove('hidden');
                    document.getElementById('chatWindow').classList.add('flex');
                }
            } else if (!contactList.classList.contains('hidden') && chatWindow.classList.contains('flex')) {
                 chatWindow.classList.add('hidden');
                 chatWindow.classList.remove('flex');
            }
        });
    });

    // --- Logika AJAX Submit (Asli dari User) ---
    chatForm.addEventListener('submit', async function(e) {
        e.preventDefault();

        let formData = new FormData(this);

        try {
            let response = await fetch("{{ route('message.send') }}", { 
                method: "POST",
                headers: {
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                body: formData
            });

            let data = await response.json();

            if (response.ok) {
                this.reset();
                clearPreview();
                // Tambahkan logika untuk menampilkan pesan baru di DOM
            } else {
                alert('Gagal mengirim pesan.');
            }

        } catch (error) {
            console.error('Error:');
            alert('Terjadi kesalahan koneksi.');
        }
    });

    // Variable global dari Blade (Opsional, jika dibutuhkan JS eksternal)
    window.chtChannel = "{{ 'chat.' . (($rid > Auth::id()) ? Auth::id() . "." . $rid : $rid . "." . Auth::id()) }}";
    window.my_id = '{{ Auth::id() }}';
    
</script>
@vite(['resources/js/message.js'])
</body>
</html>