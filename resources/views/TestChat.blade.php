@vite(['resources/css/app.css', 'resources/js/app.js'])
<script type="module">
    Echo.channel('chat.01KBAC7QZ6D5Y6RWZGH07YD3PV.01KBAC7RN9EPWGEEWF1Q73CV8F')
        .listen('MessageSent', (e) => {
            console.log('Berhasil connect!');
            console.log('Data diterima:', e);
        });;
</script>