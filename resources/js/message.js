import Echo from 'laravel-echo';

import Pusher from 'pusher-js';
window.Pusher = Pusher;


// PENTING: Assign ke window.Echo
window.Echo = new Echo({
    broadcaster: 'reverb', // atau 'pusher'
    key: import.meta.env.VITE_REVERB_APP_KEY,
    wsHost: import.meta.env.VITE_REVERB_HOST,
    wsPort: import.meta.env.VITE_REVERB_PORT,
    wssPort: import.meta.env.VITE_REVERB_PORT,
    forceTLS: (import.meta.env.VITE_REVERB_SCHEME ?? 'https') === 'https',
    enabledTransports: ['ws', 'wss'],
});


const messageContainer = document.getElementById('message-container');

// bisa
window.Echo.channel(window.chtChannel).listen('MessageSent',  (e) => {
    if (e.message.pengirim_id != window.my_id) {
        messageContainer.innerHTML = messageContainer.innerHTML + otherChat(e.message.pesan, e.message.waktu_kirim, e.message.status, e.message.media_path);
        setTimeout(messageContainer.scroll(0, messageContainer.scrollHeight), 100);
    } else {
        messageContainer.innerHTML = messageContainer.innerHTML + myChat(e.message.pesan, e.message.waktu_kirim, e.message.status, e.message.media_path);
        setTimeout(messageContainer.scroll(0, messageContainer.scrollHeight), 100);
    }
});


function renderMedia(media_path) {
    if (!media_path) return "";

    const isImage = /\.(jpg|jpeg|png|gif|webp)$/i.test(media_path);

    if (isImage) {
        return `
            <img src="/storage/${media_path}" 
                 class="rounded mb-2 max-h-48 object-cover">
        `;
    }

    return `
        <a href="/storage/${media_path}" 
           target="_blank" 
           class="underline text-blue-200 text-sm block mb-2">
            Download File
        </a>
    `;
}

function myChat(pesan, waktu, status, media_path = null) {
    const date = new Date(waktu);
    const hour = String(date.getHours()).padStart(2, '0');
    const minute = String(date.getMinutes()).padStart(2, '0');

    return `
    <div class="flex justify-end">
        <div class="bg-blue-600 text-white p-3 rounded-lg rounded-tr-none max-w-xs shadow-md">
            
            ${renderMedia(media_path)}

            ${(pesan) ? '<p class="text-sm">' + pesan + '</p>' : '' }
            <span class="text-xs text-blue-100 block text-right mt-1">
                ${hour}:${minute}
                ${readIndicator(status)}
            </span>
        </div>
    </div>`;
}

function otherChat(pesan, waktu, status, media_path = null) {
    const date = new Date(waktu);
    const hour = String(date.getHours()).padStart(2, '0');
    const minute = String(date.getMinutes()).padStart(2, '0');

    return `
    <div class="flex justify-start">
        <div class="bg-white border border-gray-200 text-gray-800 p-3 rounded-lg rounded-tl-none max-w-xs shadow-sm">

            ${renderMedia(media_path)}
            ${(pesan) ? '<p class="text-sm">' + pesan + '</p>' : '' }
            <span class="text-xs text-gray-400 block text-right mt-1">
                ${hour}:${minute}
                ${readIndicator(status)}
            </span>
        </div>
    </div>`;
}


function readIndicator(status) {
    if (status === "dibaca") {
        return `<span class="text-xs text-blue-300 ml-2">dibaca</span>`;
    }
    return `<span class="text-xs text-gray-300 ml-2">terkirim</span>`;
}

