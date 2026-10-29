<div class="min-h-screen bg-zinc-50 dark:bg-zinc-950 text-zinc-900 dark:text-zinc-100 antialiased selection:bg-indigo-500 selection:text-white">
    <!-- Navbar Publik -->
    <header class="border-b border-zinc-200 dark:border-zinc-800 bg-white/80 dark:bg-zinc-900/80 backdrop-blur sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between">
            <a href="{{ route('home') }}" class="text-xl font-bold tracking-tight text-indigo-600 dark:text-indigo-400">
                DevBlog
            </a>
            <div class="flex items-center gap-4">
                @auth
                    <a href="{{ route('dashboard') }}" wire:navigate class="text-sm font-medium hover:text-indigo-600 transition">
                        Dashboard &rarr;
                    </a>
                @else
                    <a href="{{ route('login') }}" class="text-sm font-medium hover:text-indigo-600 transition">
                        Log in
                    </a>
                @endauth
            </div>
        </div>
    </header>

    <!-- Hero Section -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="text-center max-w-2xl mx-auto mb-16">
            <h1 class="text-4xl font-extrabold tracking-tight sm:text-5xl">
                Artikel & Berita Terbaru
            </h1>
            <p class="mt-4 text-base text-zinc-600 dark:text-zinc-400">
                Kumpulan tulisan dan tutorial seputar pengembangan web, Laravel 12, dan Livewire 4.
            </p>
        </div>

        <!-- Grid Kartu Artikel -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($posts as $post)
                <article class="flex flex-col bg-white dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-800 rounded-2xl overflow-hidden shadow-sm hover:shadow-md transition">
                    <div class="p-6 flex flex-col flex-1 justify-between">
                        <div>
                            <div class="flex items-center gap-2 text-xs text-zinc-500 mb-3">
    <span>{{ $post->created_at->format('d M Y') }}</span>
    <span>&bull;</span>
    <span>Oleh {{ $post->user->name ?? 'Penulis' }}</span>
    <span>&bull;</span>
    <span>{{ number_format($post->views_count) }} {{ Str::plural('view', $post->views_count) }}</span>
</div>
                            <h2 class="text-xl font-bold text-zinc-900 dark:text-zinc-100 hover:text-indigo-600 transition">
                                {{ $post->title }}
                            </h2>
                            <div class="mt-3 text-sm text-zinc-600 dark:text-zinc-400 line-clamp-3 prose dark:prose-invert">
                                {!! Str::limit(strip_tags($post->content), 120) !!}
                            </div>
                        </div>

                        <div class="mt-6 pt-4 border-t border-zinc-100 dark:border-zinc-800/80 flex items-center justify-between">
                            <span class="text-xs font-medium text-emerald-600 dark:text-emerald-400 bg-emerald-50 dark:bg-emerald-950/50 px-2.5 py-1 rounded-full">
                                Publik
                            </span>
                         <a href="{{ route('posts.show', $post->slug) }}" wire:navigate class="text-xs font-semibold text-indigo-600 dark:text-indigo-400 hover:underline">
    Baca Selengkapnya &rarr;
</a>
                        </div>
                    </div>
                </article>
            @empty
                <div class="col-span-full py-16 text-center text-zinc-500 dark:text-zinc-400">
                    <p class="text-lg">Belum ada artikel yang dipublikasikan.</p>
                    <p class="text-sm mt-1">Pastikan status postingan diatur ke "Published" pada dashboard.</p>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        @if($posts->hasPages())
            <div class="mt-12">
                {{ $posts->links() }}
            </div>
        @endif
        <!-- Form Langganan Newsletter -->
        <livewire:subscribe-form />\
    </main>
</div>
