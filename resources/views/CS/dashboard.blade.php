<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard CS - ADP Konstruksi</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        .bubble {
            border-radius: 12px;
            padding: 10px 14px;
            max-width: 20rem;
            word-wrap: break-word;
        }
        .bubble-me {
            background: #1f56e0;
            color: #fff;
        }
        .bubble-other {
            background: #fff;
            color: #1f1f1f;
            border: 1px solid #e6e6e6;
        }
        .contact-active {
            background: #e9f1ff;
            border-left: 6px solid #1f56e0;
            padding-left: 10px;
        }
        .contact-item {
            display: flex;
            padding: 12px 16px;
            align-items: center;
            cursor: pointer;
            transition: all 0.2s;
        }
        .contact-item:hover {
            background: #f0f4ff;
        }
    </style>
</head>
<body class="bg-gray-100 font-sans" x-data="{ openMenu: false }">

    <nav class="bg-white shadow-md sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <div class="shrink-0 flex items-center">
                        <span class="font-extrabold text-2xl text-blue-600 tracking-tighter">ADP<span class="text-gray-800 font-normal">Panel</span></span>
                    </div>
                </div>

                <div class="hidden md:flex md:items-center space-x-8">
                    <a href="{{ route('cs.dashboard') }}" class="{{ request()->routeIs('cs.dashboard') ? 'text-blue-600 border-b-2 border-blue-600' : 'text-gray-500 hover:text-blue-600' }} px-1 pt-1 text-sm font-bold transition">Chat Masuk</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="bg-red-50 text-red-600 px-4 py-1.5 rounded-full text-sm font-bold hover:bg-red-600 hover:text-white transition">Logout</button>
                    </form>
                </div>

                <div class="flex items-center md:hidden">
                    <button @click="openMenu = !openMenu" class="p-2 rounded-lg text-gray-500 hover:bg-gray-100 focus:outline-none transition">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path x-show="!openMenu" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            <path x-show="openMenu" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <div x-show="openMenu" x-transition class="md:hidden bg-white border-t border-gray-100 shadow-xl">
            <div class="px-4 pt-2 pb-4 space-y-2">
                <a href="{{ route('cs.dashboard') }}" class="block px-3 py-3 rounded-xl text-base font-bold text-gray-700 hover:bg-blue-50 hover:text-blue-600">Chat Masuk</a>
                <hr class="my-2">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full text-left px-3 py-3 rounded-xl text-base font-bold text-red-600 bg-red-50">Logout</button>
                </form>
            </div>
        </div>
    </nav>

    <div class="py-4 md:py-8">
        <main class="max-w-7xl mx-auto px-2 sm:px-6 lg:px-8">
            <div class="flex h-[calc(100vh-170px)] bg-white rounded-lg shadow-lg overflow-hidden">
                
                <!-- Contact List -->
                <div class="{{ $rid ? 'hidden' : 'flex' }} md:flex w-full md:w-1/3 flex-col bg-[#f8fbff]">
                    <div class="p-4 border-b border-gray-200 bg-white">
                        <h2 class="text-xl font-bold text-gray-800">Pesan</h2>
                        <span class="text-sm text-gray-500">{{ $contacts->count() }} Kontak</span>
                    </div>
                    
                    <div class="overflow-y-auto flex-1">
                        @foreach ($contacts as $contact)
                            <a href="{{ route('cs.dashboard', ['rid' => $contact->id]) }}" 
                               class="contact-item {{ $rid == $contact->id ? 'contact-active' : '' }}">
                                <div class="relative flex-shrink-0">
                                    <img class="h-12 w-12 rounded-full" 
                                         src="https://ui-avatars.com/api/?name={{ urlencode($contact->nama) }}&background=4F46E5&color=fff" 
                                         alt="{{ $contact->nama }}">
                                    <div class="absolute bottom-0 right-0 h-3 w-3 bg-green-400 border-2 border-white rounded-full"></div>
                                </div>
                                <div class="ml-3 flex-1 min-w-0">
                                    <div class="flex justify-between items-baseline">
                                        <p class="text-sm font-semibold text-gray-900 truncate">{{ $contact->nama }}</p>
                                        <span class="text-xs text-gray-500">{{ $contact->last_time ?? '' }}</span>
                                    </div>
                                    <p class="text-xs text-gray-600 truncate mt-1">{{ $contact->last_message ?? 'Belum ada pesan' }}</p>
                                </div>
                                @if(isset($contact->unread) && $contact->unread > 0)
                                    <span class="ml-2 bg-blue-600 text-white text-xs font-bold rounded-full h-5 w-5 flex items-center justify-center flex-shrink-0">
                                        {{ $contact->unread }}
                                    </span>
                                @endif
                            </a>
                        @endforeach
                    </div>
                </div>
                
                <!-- Chat Window -->
                <div class="{{ $rid ? 'flex' : 'hidden' }} md:flex w-full md:w-2/3 flex-col bg-[#f6f8fb]">
                    @if ($rid)
                        <!-- Header -->
                        <div class="p-4 border-b border-gray-200 bg-white flex items-center">
                            <button onclick="window.location.href='{{ route('cs.dashboard') }}'" class="md:hidden mr-3 text-blue-600">
                                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                                </svg>
                            </button>
                            <img class="h-10 w-10 rounded-full" 
                                 src="https://ui-avatars.com/api/?name={{ urlencode($rcontact->nama ?? 'User') }}&background=4F46E5&color=fff">
                            <div class="ml-3">
                                <h2 class="text-base font-bold text-gray-800">{{ $rcontact->nama ?? 'Pelanggan' }}</h2>
                                <p class="text-xs text-green-500">● Online</p>
                            </div>
                        </div>
                        
                        <!-- Messages -->
                        <div id='message-container' class="flex-1 p-4 space-y-3 overflow-y-auto">
                            @if($messages && count($messages) > 0)
                                @foreach ($messages as $message)
                                    @php
                                        $isMine = ($rid != $message->pengirim_id);
                                    @endphp
                                    <div class="flex {{ $isMine ? 'justify-end' : 'justify-start' }}">
                                        <div class="bubble {{ $isMine ? 'bubble-me' : 'bubble-other' }}">
                                            @if ($message->media_path)
                                                <img src="{{ asset('storage/' . $message->media_path) }}" 
                                                     class="rounded-lg max-h-48 mb-2 cursor-pointer"
                                                     onclick="viewMedia('{{ asset('storage/' . $message->media_path) }}')">
                                            @endif
                                            @if($message->pesan)
                                                <p class="text-sm">{{ $message->pesan }}</p>
                                            @endif
                                            <div class="flex items-center justify-end mt-1 space-x-1">
                                                <span class="text-xs {{ $isMine ? 'text-blue-200' : 'text-gray-500' }}">
                                                    {{ \Carbon\Carbon::parse($message->waktu_kirim)->format('H:i') }}
                                                </span>
                                                @if($isMine)
                                                    <span class="text-xs {{ $message->status === 'dibaca' ? 'text-blue-300' : 'text-blue-200' }}">
                                                        {{ $message->status === 'dibaca' ? '✔✔' : '✔' }}
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <div class="flex flex-col items-center justify-center h-full text-gray-400">
                                    <svg class="h-16 w-16 mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" 
                                              d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                                    </svg>
                                    <p class="text-sm">Belum ada pesan</p>
                                </div>
                            @endif
                        </div>

                        <!-- Input Form -->
                        <div class="p-4 bg-white border-t border-gray-200">
                            <form id="chatForm" class="flex items-center space-x-3">
                                <input type="hidden" name="penerima_id" value="{{ $rid }}">
                                <label class="cursor-pointer text-gray-500 hover:text-blue-600">
                                    <input type="file" name="media" id="fileInput" class="hidden" accept="image/*">
                                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                              d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                </label>
                                <input type="text" name="pesan" placeholder="Ketik pesan..." 
                                       class="flex-1 px-4 py-2 border border-gray-300 rounded-full focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <button type="submit" class="bg-blue-600 text-white p-2 rounded-full hover:bg-blue-700">
                                    <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5-1.429A1 1 0 009 15.571V11a1 1 0 112 0v4.571a1 1 0 00.725.962l5 1.428a1 1 0 001.17-1.408l-7-14z"/>
                                    </svg>
                                </button>
                            </form>
                            <div id="imagePreview" class="mt-2 hidden">
                                <img id="previewImg" class="h-20 rounded-lg">
                                <button onclick="clearPreview()" class="text-red-500 text-xs ml-2">Hapus</button>
                            </div>
                        </div>
                    @else
                        <div class="hidden md:flex flex-1 items-center justify-center flex-col bg-[#f6f8fb]">
                            <svg class="h-20 w-20 text-gray-300 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" 
                                      d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                            </svg>
                            <h3 class="text-lg font-semibold text-gray-600 mb-2">Pilih kontak untuk memulai chat</h3>
                            <p class="text-sm text-gray-500">Klik salah satu kontak di sebelah kiri</p>
                        </div>
                    @endif
                </div>
            </div>
        </main>
    </div>

    <script>
        // Scroll to bottom
        const messageContainer = document.getElementById('message-container');
        if(messageContainer) {
            messageContainer.scrollTop = messageContainer.scrollHeight;
        }

        // File upload preview
        document.getElementById('fileInput')?.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('previewImg').src = e.target.result;
                    document.getElementById('imagePreview').classList.remove('hidden');
                };
                reader.readAsDataURL(file);
            }
        });

        function clearPreview() {
            document.getElementById('fileInput').value = '';
            document.getElementById('imagePreview').classList.add('hidden');
        }

        function viewMedia(url) {
            window.open(url, '_blank');
        }

        // AJAX form submit
        document.getElementById('chatForm')?.addEventListener('submit', function(e) {
            e.preventDefault();
            const formData = new FormData(this);
            
            // Pastikan file terkirim
            const fileInput = document.getElementById('fileInput');
            if (fileInput && fileInput.files.length > 0) {
                formData.set('media', fileInput.files[0]);
            }
            
            fetch('{{ route("message.send") }}', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                // Reset form dan reload
                this.reset();
                clearPreview();
                location.reload();
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Gagal mengirim pesan');
            });
        });
    </script>
</body>
</html>