@vite(['resources/css/app.css', 'resources/js/app.js'])
<script type="module">
    Echo.channel('a')
        .listen('MessageSent', (e) => {
            console.log('Berhasil connect!');
            console.log('Data diterima:', e);
        });;
</script>