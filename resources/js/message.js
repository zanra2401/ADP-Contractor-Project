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
    console.log(e);
    if (e.message.pengirim_id != window.my_id) {
        messageContainer.innerHTML = messageContainer.innerHTML + otherChat(e.message.pesan, e.message.waktu_kirim);
        messageContainer.scroll(0, messageContainer.scrollHeight);
    } else {
        messageContainer.innerHTML = messageContainer.innerHTML + myChat(e.message.pesan, e.message.waktu_kirim);
        messageContainer.scroll(0, messageContainer.scrollHeight);
    }
});


function myChat(pesan, waktu) {
    const date = new Date(waktu);
    const hour = String(date.getHours()).padStart(2, '0');
    const minute = String(date.getMinutes()).padStart(2, '0');

    return `<div class="flex justify-end">
        <div class="bg-blue-600 text-white p-3 rounded-lg rounded-tr-none max-w-xs shadow-md">
            <p class="text-sm">${pesan}</p>
            <span class="text-xs text-blue-100 block text-right mt-1">${hour}:${minute}</span>
        </div>
    </div>`
}

function otherChat(pesan, waktu) {
    const date = new Date(waktu);
    const hour = String(date.getHours()).padStart(2, '0');
    const minute = String(date.getMinutes()).padStart(2, '0');

    return `<div class="flex justify-start">
        <div class="bg-white border border-gray-200 text-gray-800 p-3 rounded-lg rounded-tl-none max-w-xs shadow-sm">
            <p class="text-sm">${pesan}</p>
            <span class="text-xs text-blue-100 block text-right mt-1">${hour}:${minute}</span>
        </div>
    </div>`;
}
