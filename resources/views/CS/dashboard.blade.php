@php
    // Fungsi indikator centang
    function readIndicator($status) {
        if ($status === 'dibaca') {
            return '<span class="text-xs text-blue-400 ml-1">✔✔</span>';
        }
        return '<span class="text-xs text-gray-400 ml-1">✔</span>';
    }

    // SIMULASI DATA DUMMY (Akan muncul jika database kosong)
    if ($contacts->isEmpty()) {
        $contacts = collect([
            (object)[
                'id' => 'dummy-1',
                'nama' => 'Andi Pratama',
                'last_time' => '10:30',
                'last_message' => 'Pak, proyek ruko saya sudah sampai mana ya?',
                'unread' => 2
            ],
            (object)[
                'id' => 'dummy-2',
                'nama' => 'Siti Aminah',
                'last_time' => 'Kemarin',
                'last_message' => 'Terima kasih informasinya.',
                'unread' => 0
            ],
            (object)[
                'id' => 'dummy-3',
                'nama' => 'Budi Santoso',
                'last_time' => '08:15',
                'last_message' => 'Saya ingin konsultasi desain minimalis.',
                'unread' => 1
            ],
        ]);
    }
@endphp

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard CS - ADP Konstruksi</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
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
            <div class="flex h-[82vh] bg-white rounded-2xl shadow-2xl overflow-hidden border border-gray-200">
                
                <div class="{{ $rid ? 'hidden' : 'flex' }} md:flex w-full md:w-80 lg:w-96 border-r border-gray-200 flex-col bg-white">
                    <div class="p-5 border-b border-gray-100 flex justify-between items-center">
                        <h2 class="text-xl font-black text-gray-800">Obrolan</h2>
                        <span class="bg-blue-100 text-blue-600 text-xs font-bold px-2.5 py-1 rounded-full">{{ $contacts->count() }} Orang</span>
                    </div>
                    
                    <ul class="divide-y divide-gray-50 overflow-y-auto flex-1">
                        @foreach ($contacts as $contact)
                            <li>
                                <a href="{{ route('cs.dashboard', ['rid' => $contact->id]) }}" 
                                   class="p-4 flex items-center hover:bg-blue-50 transition-all duration-200 {{ $rid == $contact->id ? 'bg-blue-50 border-l-4 border-blue-600' : '' }}">
                                    <div class="relative shrink-0">
                                        <img class="h-12 w-12 rounded-full border-2 border-white shadow-sm" src="https://ui-avatars.com/api/?name={{ urlencode($contact->nama) }}&background=random&color=fff" alt="">
                                        <div class="absolute bottom-0 right-0 h-3.5 w-3.5 bg-green-500 border-2 border-white rounded-full"></div>
                                    </div>
                                    <div class="ml-4 flex-1 min-w-0">
                                        <div class="flex justify-between items-baseline">
                                            <p class="text-sm font-bold text-gray-900 truncate">{{ $contact->nama }}</p>
                                            <span class="text-[10px] font-bold text-gray-400 uppercase">{{ $contact->last_time ?? 'Baru' }}</span>
                                        </div>
                                        <p class="text-xs text-gray-500 truncate mt-0.5">{{ $contact->last_message ?? 'Klik untuk membalas...' }}</p>
                                    </div>
                                    @if(isset($contact->unread) && $contact->unread > 0)
                                        <span class="ml-2 bg-blue-600 text-white text-[10px] font-black rounded-full h-5 w-5 flex items-center justify-center animate-pulse">{{ $contact->unread }}</span>
                                    @endif
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
                
                <div class="{{ $rid ? 'flex' : 'hidden' }} md:flex w-full md:flex-1 flex-col bg-[#F3F4F6]">
                    @if ($rid)
                        <div class="p-3 md:p-4 border-b border-gray-200 bg-white flex items-center justify-between shadow-sm z-10">
                            <div class="flex items-center">
                                <a href="{{ route('cs.dashboard') }}" class="md:hidden mr-3 p-2 text-blue-600 bg-blue-50 rounded-full hover:bg-blue-100 transition">
                                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M15 19l-7-7 7-7" />
                                    </svg>
                                </a>
                                <img class="h-10 w-10 rounded-full border shadow-sm" src="https://ui-avatars.com/api/?name={{ urlencode($rcontact->nama ?? 'User') }}&background=random">
                                <div class="ml-3">
                                    <h2 class="text-sm md:text-base font-black text-gray-800 leading-none">{{ $rcontact->nama ?? 'Pelanggan' }}</h2>
                                    <p class="text-[10px] md:text-xs text-green-500 font-bold mt-1">● Online</p>
                                </div>
                            </div>
                        </div>
                        
                        <div id='message-container' class="flex-1 p-4 md:p-6 space-y-4 overflow-y-auto scroll-smooth bg-[url('https://i.pinimg.com/originals/ab/ab/60/abab600f72320383397144650c317d36.jpg')] bg-contain">
                            
                            <div class="flex justify-start">
                                <div class="bg-white text-gray-800 p-3 rounded-2xl rounded-tl-none max-w-[85%] md:max-w-md shadow-sm border border-gray-100">
                                    <p class="text-sm font-semibold text-blue-600 mb-1">Pelanggan</p>
                                    <p class="text-sm">Halo, saya ingin menanyakan progres pengerjaan di CitraLand.</p>
                                    <span class="text-[9px] text-gray-400 block text-right mt-1">08:00</span>
                                </div>
                            </div>

                            @foreach ($messages ?? [] as $message)
                                @php
                                    $isMe = ($rid != $message->pengirim_id);
                                @endphp
                                <div class="flex {{ $isMe ? 'justify-end' : 'justify-start' }}">
                                    <div class="{{ $isMe ? 'bg-blue-600 text-white rounded-tr-none' : 'bg-white text-gray-800 rounded-tl-none border border-gray-100' }} p-3 rounded-2xl max-w-[85%] md:max-w-md shadow-md">
                                        @if ($message->media_path)
                                            <div class="mb-2">
                                                <img src="{{ asset('storage/' . $message->media_path) }}" class="rounded-lg max-h-60 w-full object-cover">
                                            </div>
                                        @endif
                                        <p class="text-sm leading-relaxed">{{ $message->pesan }}</p>
                                        <div class="flex items-center justify-end mt-1 space-x-1">
                                            <span class="text-[9px] {{ $isMe ? 'text-blue-100' : 'text-gray-400' }} font-bold">
                                                {{ \Illuminate\Support\Carbon::parse($message->waktu_kirim)->format("H:i") }}
                                            </span>
                                            @if($isMe) {!! readIndicator($message->status) !!} @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="p-3 md:p-4 bg-white border-t border-gray-100">
                            <form id="chatForm" class="flex items-center space-x-2 md:space-x-4">
                                <label class="p-2.5 rounded-full bg-gray-100 text-gray-500 hover:bg-gray-200 cursor-pointer transition">
                                    <input type="file" name="media" id="fileInput" class="hidden">
                                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                                </label>
                                <input type="text" name="pesan" placeholder="Ketik balasan..." class="flex-1 px-5 py-3 border border-gray-200 rounded-2xl focus:ring-4 focus:ring-blue-100 focus:border-blue-500 outline-none text-sm transition-all shadow-inner bg-gray-50">
                                <button type="submit" class="p-3.5 bg-blue-600 text-white rounded-2xl hover:bg-blue-700 shadow-lg hover:shadow-blue-200 transition-all transform active:scale-95 shrink-0">
                                    <svg class="h-6 w-6 transform rotate-90" fill="currentColor" viewBox="0 0 20 20"><path d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5-1.429A1 1 0 009 15.571V11a1 1 0 112 0v4.571a1 1 0 00.725.962l5 1.428a1 1 0 001.17-1.408l-7-14z" /></svg>
                                </button>
                            </form>
                        </div>
                    @else
                        <div class="hidden md:flex flex-1 items-center justify-center text-gray-400 flex-col bg-gray-50">
                            <div class="p-10 bg-white rounded-full shadow-inner mb-6">
                                <svg class="h-20 w-20 text-gray-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold text-gray-700">Pilih Kontak</h3>
                            <p class="text-sm text-gray-500 mt-2 text-center max-w-xs">Pilih salah satu orang di panel kiri untuk melihat riwayat obrolan dan membalas pesan mereka.</p>
                        </div>
                    @endif
                </div>
            </div>
        </main>
    </div>

    <script>
        const messageContainer = document.getElementById('message-container');
        if(messageContainer) {
            messageContainer.scrollTop = messageContainer.scrollHeight;
        }
    </script>
</body>
</html>