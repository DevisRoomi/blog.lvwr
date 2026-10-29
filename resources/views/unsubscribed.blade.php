<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Berhasil Berhenti Berlangganan</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-zinc-100 dark:bg-zinc-950 min-h-screen flex items-center justify-center p-4 text-zinc-900 dark:text-zinc-100">
    <div class="bg-white dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-800 rounded-2xl p-8 max-w-md w-full text-center shadow-sm">
        <div class="w-12 h-12 bg-red-100 dark:bg-red-950/50 text-red-600 rounded-full flex items-center justify-center mx-auto mb-4">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </div>
        <h1 class="text-2xl font-bold mb-2">Berhenti Berlangganan</h1>
        <p class="text-sm text-zinc-600 dark:text-zinc-400 mb-6">
            Alamat email Anda telah berhasil dihapus dari daftar buletin. Anda tidak akan lagi menerima notifikasi artikel baru dari kami.
        </p>
        <a href="{{ route('home') }}" class="inline-block px-5 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white font-medium rounded-lg text-sm transition">
            Kembali ke Beranda
        </a>
    </div>
</body>
</html>