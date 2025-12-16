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
                        <a href="{{ route('pelanggan.dashboard') }}" class="{{ request()->routeIs('pelanggan.dashboard') ? 'border-blue-500 text-gray-900' : 'border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700' }} inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                            Dashboard
                        </a>
                        <a href="{{ route('pelanggan.galeri') }}" class="{{ request()->routeIs('pelanggan.galeri') ? 'border-blue-500 text-gray-900' : 'border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700' }} inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                            Galeri Proyek
                        </a>
                        <a href="{{ route('pelanggan.chat') }}" class="{{ request()->routeIs('pelanggan.chat') ? 'border-blue-500 text-gray-900' : 'border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700' }} inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                            Chat
                        </a>
                    </div>
                </div>
                
                <!-- MENU KANAN -->
                <div class="hidden sm:ml-6 sm:flex sm:items-center space-x-4">
                    <span class="text-sm text-gray-700 mr-2">Halo, {{ Auth::user()->nama ?? 'Pelanggan' }}!</span>
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="text-sm font-medium text-red-600 hover:text-red-800 ml-2">Logout</button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <!-- KONTEN CHAT -->
    <div class="py-10">
        <header class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-3xl font-bold leading-tight text-gray-900">
                Hubungi Kami
            </h1>
            <p class="mt-2 text-gray-600">Diskusikan proyek Anda dengan tim kami.</p>
        </header>
        
        <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-8">
            <div class="flex h-[70vh] bg-white rounded-lg shadow-lg overflow-hidden border border-gray-200">
                
                <!-- DAFTAR KONTAK (KIRI) -->
                <div class="w-1/3 border-r border-gray-200 flex flex-col">
                    <div class="p-4 border-b border-gray-200 bg-gray-50">
                        <h2 class="text-lg font-semibold text-gray-700">Kontak Saya</h2>
                    </div>
                    <ul class="divide-y divide-gray-200 overflow-y-auto flex-1">
                        @foreach ($contacts as $contact)
                            <li>
                                <a href="{{ route('pelanggan.chat', ['rid' => $contact->id]) }}" class="p-4 flex items-cente cursor-pointer {{ $rid == $contact->id ? 'border-l-4 border-blue-600 bg-blue-50' : '' }} hover:bg-blue-100 transition">
                                    <img class="h-10 w-10 rounded-full" src="https://ui-avatars.com/api/?name={{ $contact->nama }}&background=random" alt=<?= $contact->role->nama ?>>
                                    <div class="ml-3 flex-1 min-w-0">
                                        <div class="flex justify-between">
                                            <p class="text-sm font-medium text-gray-900 truncate"><?= $contact->nama ?></p>
                                            <span class="text-xs text-gray-500">{{ $contact['last_message'] ? $contact['last_time'] : '' }}</span>
                                        </div>
                                        <p class="text-sm text-gray-600 truncate">{{ $contact['last_message'] ? $contact['last_message'] : '...' }}</p>
                                    </div>
                                    @if($contact['unread'] > 0)
                                        <span class="ml-2 bg-blue-600 text-white text-xs font-bold rounded-full h-5 w-5 flex items-center justify-center"> {{ $contact['unread'] }} </span>
                                    @endif
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
                
                <!-- JENDELA CHAT (KANAN) -->
                @if ($rid)
                        <div class="w-2/3 flex flex-col">
                            <!-- Header Chat -->
                            <div class="p-4 border-b border-gray-200 bg-white flex justify-between items-center shadow-sm z-10">
                                <div>
                                    <h2 class="text-lg font-bold text-gray-800">{{ $rcontact->nama }}</h2>
                                    <p class="text-xs text-green-600 flex items-center">
                                        <span class="h-2 w-2 bg-green-500 rounded-full mr-1"></span> Online
                                    </p>
                                </div>
                            </div>
                            
                            <!-- Isi Chat -->
                            <div id='message-container' class="flex-1 p-6 space-y-4 overflow-y-auto bg-gray-50">
                                @foreach ($messages as $message)

                                    @php
                                        $isImage = $message->media_path && preg_match('/\.(jpg|jpeg|png|gif|webp)$/i', $message->media_path);
                                    @endphp

                                    @if ($rid != $message->pengirim_id)
                                        <!-- Chat Saya (Kanan) -->
                                        <div class="flex justify-end">
                                            <div class="bg-blue-600 text-white p-3 rounded-lg rounded-tr-none max-w-xs shadow-md">

                                                {{-- Jika ada media --}}
                                                @if ($message->media_path)
                                                    @if ($isImage)
                                                        <img src="{{ asset('storage/' . $message->media_path) }}" class="rounded mb-2 max-h-48 object-cover">
                                                    @else
                                                        <a href="{{ asset('storage/' . $message->media_path) }}" target="_blank" class="underline text-blue-200 text-sm block mb-2">
                                                            Download File
                                                        </a>
                                                    @endif
                                                @endif
                                                
                                                @if ($message->pesan)
                                                    <p class="text-sm">{{ $message->pesan }}</p>
                                                @endif
                                                <span class="text-xs text-blue-100 block text-right mt-1">
                                                    {{ \Illuminate\Support\Carbon::parse($message->waktu_kirim)->format("H:i") }}
                                                    {!! readIndicator($message->status) !!}
                                                </span>
                                            </div>
                                        </div>
                                    @else
                                        <!-- Chat Lawan (Kiri) -->
                                        <div class="flex">
                                            <div class="bg-white border border-gray-200 text-gray-800 p-3 rounded-lg rounded-tl-none max-w-xs shadow-sm">

                                                {{-- Jika ada media --}}
                                                @if ($message->media_path)
                                                    @if ($isImage)
                                                        <img src="{{ asset('storage/' . $message->media_path) }}" class="rounded mb-2 max-h-48 object-cover">
                                                    @else
                                                        <a href="{{ asset('storage/' . $message->media_path) }}" target="_blank" class="underline text-blue-600 text-sm block mb-2">
                                                            Download File
                                                        </a>
                                                    @endif
                                                @endif
                                                @if ($message->pesan)
                                                    <p class="text-sm">{{ $message->pesan }}</p>
                                                @endif
                                                <span class="text-xs text-gray-400 block text-right mt-1">
                                                    {{ \Illuminate\Support\Carbon::parse($message->waktu_kirim)->format('H:i') }}
                                                    {!! readIndicator($message->status) !!}
                                                </span>
                                            </div>
                                        </div>
                                    @endif

                                @endforeach
                            </div>

                            
                            <!-- Input Chat -->
                            <div class="p-4 bg-white border-t border-gray-200">
                                    <!-- Preview Area -->
                                    <div id="previewArea" class="mb-3 hidden">
                                        <div class="relative inline-block">
                                            <div id="previewContent"></div>
                                            <button id="removePreview" type="button" class="absolute top-1 right-1 bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center text-xs hover:bg-red-600">
                                                ×
                                            </button>
                                        </div>
                                    </div>

                                    <form id="chatForm" enctype="multipart/form-data" class="flex items-center space-x-3">

                                        <!-- Input teks -->
                                        <input 
                                            type="text" 
                                            name="pesan"
                                            placeholder="Ketik balasan Anda..."
                                            class="flex-1 px-4 py-2 border border-gray-300 rounded-full
                                            focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                        >

                                        <!-- Tombol upload file -->
                                        <label id="fileBtn" class="p-2 rounded-full bg-gray-200 text-gray-700 
                                            hover:bg-gray-300 cursor-pointer transition shadow-sm">
                                            <input 
                                                type="file" 
                                                name="media"
                                                id="fileInput"
                                                class="hidden"
                                                accept="image/*,video/*"
                                            >

                                            <!-- Icon upload -->
                                            <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M4 3a2 2 0 00-2 2v8a2 2 0 002 2h4v-2H4V5h12v8h-4v2h4a2 2 0 002-2V5a2 2 0 00-2-2H4z"/>
                                                <path d="M9 12V7a1 1 0 112 0v5h2l-3 3-3-3h2z"/>
                                            </svg>
                                        </label>

                                        <!-- Tombol kirim -->
                                        <button 
                                            type="submit"
                                            class="inline-flex justify-center p-2 rounded-full text-white bg-blue-600 
                                            hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 
                                            focus:ring-blue-500 shadow-md transition"
                                        >
                                            <svg class="h-5 w-5 transform rotate-90" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5-1.429A1 1 0 009 15.571V11a1 1 0 112 0v4.571a1 1 0 00.725.962l5 1.428a1 1 0 001.17-1.408l-7-14z" />
                                            </svg>
                                        </button>

                                    </form>
                                </div>


                        </div>
                    </div>
                @endif
        </main>
    </div>
<script>
        // --- Variabel Elemen ---
        const fileInput = document.getElementById('fileInput');
        const previewArea = document.getElementById('previewArea');
        const previewContent = document.getElementById('previewContent');
        const removePreviewBtn = document.getElementById('removePreview');
        const chatForm = document.getElementById('chatForm');
        const messageContainer = document.getElementById('message-container');

        // --- Fungsi Helper: Reset Preview ---
        function clearPreview() {
            fileInput.value = ''; // Reset input file
            previewArea.classList.add('hidden'); // Sembunyikan area preview
            previewContent.innerHTML = ''; // Hapus konten HTML
        }

        // --- Event Listener: Saat File Dipilih ---
        fileInput.addEventListener('change', function (e) {
            const file = this.files[0];
            
            if (file) {
                const fileType = file.type;
                const fileURL = URL.createObjectURL(file);
                
                // Buka area preview
                previewArea.classList.remove('hidden');
                
                // Cek tipe file untuk menentukan tampilan
                if (fileType.startsWith('image/')) {
                    previewContent.innerHTML = `
                        <img src="${fileURL}" class="h-32 w-auto rounded-lg shadow-sm object-cover border border-gray-200">
                    `;
                } else if (fileType.startsWith('video/')) {
                    previewContent.innerHTML = `
                        <video src="${fileURL}" controls class="h-32 w-auto rounded-lg shadow-sm border border-gray-200"></video>
                    `;
                } else {
                    // Fallback jika file bukan gambar/video (misal PDF)
                    previewContent.innerHTML = `
                        <div class="h-16 flex items-center justify-center bg-gray-100 rounded text-sm text-gray-500 px-4">
                            ${file.name}
                        </div>
                    `;
                }
            }
        });

        // --- Event Listener: Tombol Hapus Preview (X) ---
        removePreviewBtn.addEventListener('click', function() {
            clearPreview();
        });

        // --- Event Listener: Submit Form ---
        chatForm.addEventListener('submit', async function(e) {
            e.preventDefault();

            let formData = new FormData(this);
            formData.append('penerima_id', '{{ $rid }}');

            // Debug (Opsional)
            // for (let [key, value] of formData.entries()) { console.log(key, value); }

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
                    // 1. Reset Form Text
                    this.reset();
                    // 2. Reset Preview Gambar/Video
                    clearPreview();
                    
                    
                    // Opsional: Scroll ke bawah manual jika tidak menggunakan realtime listener sementara
                    // messageContainer.scrollTop = messageContainer.scrollHeight;
                } else {
                    console.error('Gagal mengirim:', data);
                    alert('Gagal mengirim pesan.');
                }

            } catch (error) {
                console.error('Error:');
            }
        });

        // --- Setup Awal ---
        window.chtChannel = "{{ 'chat.' . (($rid > Auth::id()) ?  Auth::id() . "." . $rid : $rid . "." . Auth::id()) }}";
        window.my_id = '{{ Auth::id() }}';

        // Scroll otomatis ke bawah saat halaman dimuat
        // Menggunakan arrow function agar tidak tereksekusi langsung
        setTimeout(() => {
            if(messageContainer) {
                messageContainer.scrollTop = messageContainer.scrollHeight;
            }
        }, 100);
    </script>
    @vite(['resources/js/message.js'])
</body>
</html>