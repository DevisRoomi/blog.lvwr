<div class="min-h-screen bg-zinc-50 dark:bg-zinc-950 text-zinc-900 dark:text-zinc-100 antialiased">
    <!-- Navbar -->
    <header class="border-b border-zinc-200 dark:border-zinc-800 bg-white/80 dark:bg-zinc-900/80 backdrop-blur sticky top-0 z-50">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between">
            <a href="{{ route('home') }}" class="text-sm font-medium text-zinc-600 dark:text-zinc-400 hover:text-indigo-600 transition flex items-center gap-1">
                &larr; Kembali ke Beranda
            </a>
            <a href="{{ route('home') }}" class="text-lg font-bold tracking-tight text-indigo-600 dark:text-indigo-400">
                DevBlog
            </a>
        </div>
    </header>

    <!-- Konten Artikel Lengkap -->
    <main class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <article class="bg-white dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-800 rounded-2xl p-6 sm:p-10 shadow-sm">
            <!-- Header Artikel -->
          <div class="flex items-center gap-2 text-xs text-zinc-500 mb-3">
    <span>Diterbitkan {{ $post->created_at->format('d M Y') }}</span>
    <span>&bull;</span>
    <span>Penulis: {{ $post->user->name ?? 'Admin' }}</span>
    <span>&bull;</span>
    <span class="inline-flex items-center gap-1 text-indigo-600 dark:text-indigo-400 font-medium">
        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
        </svg>
        {{ number_format($post->views_count) }} {{ Str::plural('view', $post->views_count) }}
    </span>
</div>
                <h1 class="text-3xl sm:text-4xl font-extrabold text-zinc-900 dark:text-zinc-100 tracking-tight leading-tight">
                    {{ $post->title }}
                </h1>
            </header>

            <!-- Isi Artikel (Render HTML dari Trix) -->
            <div class="prose dark:prose-invert max-w-none text-zinc-700 dark:text-zinc-300 leading-relaxed">
                {!! $post->content !!}
            </div>
        </article>
    </main>
</div>