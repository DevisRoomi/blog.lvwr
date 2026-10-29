<div class="min-h-screen">
    <!-- Navbar Minimalis -->
    <header class="border-b border-zinc-200 dark:border-zinc-800/80 bg-white/80 dark:bg-zinc-950/80 backdrop-blur sticky top-0 z-40">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 h-14 flex items-center justify-between">
            <a href="{{ route('home') }}" wire:navigate class="inline-flex items-center gap-2 group">
                <span class="font-mono text-xs px-2 py-0.5 rounded bg-zinc-100 dark:bg-zinc-800 text-zinc-800 dark:text-zinc-200 border border-zinc-300 dark:border-zinc-700 group-hover:border-zinc-400 dark:group-hover:border-zinc-500 transition">~/devblog</span>
            </a>

            <div class="flex items-center gap-4 text-sm">
                @auth
                    <a href="{{ route('dashboard') }}" wire:navigate class="font-mono text-xs text-zinc-700 dark:text-zinc-300 hover:text-zinc-950 dark:hover:text-white transition flex items-center gap-1.5">
                        <span>Dashboard</span>
                        <span aria-hidden="true">&rarr;</span>
                    </a>
                @else
                    <a href="{{ route('login') }}" class="font-mono text-xs text-zinc-600 dark:text-zinc-400 hover:text-zinc-900 dark:hover:text-white transition">
                        Masuk
                    </a>
                @endauth
            </div>
        </div>
    </header>

    <main class="max-w-5xl mx-auto px-4 sm:px-6 py-12">
        <!-- Hero Editorial -->
        <div class="mb-10">
            <h1 class="text-3xl sm:text-4xl font-bold tracking-tight text-zinc-950 dark:text-zinc-50">
                Catatan & Jurnal Teknis
            </h1>
            <p class="mt-2 text-sm sm:text-base text-zinc-600 dark:text-zinc-400 max-w-xl leading-relaxed">
                Eksplorasi rekayasa perangkat lunak, arsitektur sistem modern, Laravel, dan Livewire.
            </p>

            <!-- Search Bar Realtime -->
            <div class="mt-6 max-w-md relative">
                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                    <svg class="h-4 w-4 text-zinc-400" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M9 3.5a5.5 5.5 0 100 11 5.5 5.5 0 000-11zM2 9a7 7 0 1112.452 4.391l3.328 3.329a.75.75 0 11-1.06 1.06l-3.329-3.328A7 7 0 012 9z" clip-rule="evenodd" />
                    </svg>
                </div>
                <input 
                    type="search" 
                    wire:model.live.debounce.300ms="search" 
                    placeholder="Cari judul atau topik artikel..." 
                    class="w-full pl-9 pr-8 py-2 text-sm bg-white dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-800 rounded-lg text-zinc-900 dark:text-zinc-100 placeholder-zinc-400 focus:outline-none focus:ring-1 focus:ring-zinc-400 dark:focus:ring-zinc-600 transition"
                />
                @if($search)
                    <button 
                        wire:click="$set('search', '')" 
                        class="absolute inset-y-0 right-0 flex items-center pr-3 text-xs font-mono text-zinc-400 hover:text-zinc-600 dark:hover:text-zinc-200"
                        title="Reset pencarian"
                    >
                        esc
                    </button>
                @endif
            </div>
        </div>

        <!-- Grid Artikel -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
            @forelse($posts as $post)
                @php
                    $wordCount = str_word_count(strip_tags($post->content));
                    $readTime = max(1, (int) ceil($wordCount / 200));
                @endphp
                <article class="group relative flex flex-col justify-between p-6 bg-white dark:bg-zinc-900/40 border border-zinc-200 dark:border-zinc-800 hover:border-zinc-400 dark:hover:border-zinc-700 rounded-xl transition duration-150">
                    <div>
                        <!-- Metadata Top -->
                        <div class="flex items-center gap-2 text-xs font-mono text-zinc-500 dark:text-zinc-400 mb-3">
                            <time datetime="{{ $post->created_at->toIso8601String() }}">
                                {{ $post->created_at->format('d M Y') }}
                            </time>
                            <span>&bull;</span>
                            <span>{{ $readTime }} min read</span>
                            <span>&bull;</span>
                            <span>{{ number_format($post->views_count) }} views</span>
                        </div>

                        <!-- Judul Artikel -->
                        <h2 class="text-xl font-semibold tracking-tight text-zinc-900 dark:text-zinc-100 group-hover:text-zinc-600 dark:group-hover:text-zinc-300 transition-colors">
                            <a href="{{ route('posts.show', $post->slug) }}" wire:navigate class="after:absolute after:inset-0 focus:outline-none">
                                {{ $post->title }}
                            </a>
                        </h2>

                        <!-- Cuplikan -->
                        <p class="mt-3 text-sm text-zinc-600 dark:text-zinc-400 line-clamp-3 leading-relaxed">
                            {{ Str::limit(strip_tags($post->content), 140) }}
                        </p>
                    </div>

                    <!-- Footer Kartu -->
                    <div class="mt-6 pt-4 border-t border-zinc-100 dark:border-zinc-800/80 flex items-center justify-between text-xs">
                        <span class="text-zinc-500 dark:text-zinc-400 font-mono">
                            {{ $post->user->name ?? 'Dev' }}
                        </span>
                        <span class="font-medium text-zinc-900 dark:text-zinc-100 flex items-center gap-1 group-hover:translate-x-0.5 transition-transform">
                            Baca &rarr;
                        </span>
                    </div>
                </article>
            @empty
                <div class="col-span-full py-16 px-6 text-center border border-dashed border-zinc-200 dark:border-zinc-800 rounded-xl">
                    <p class="font-mono text-sm text-zinc-500 dark:text-zinc-400">
                        @if($search)
                            Tidak ada artikel yang cocok dengan kata kunci "{{ $search }}".
                        @else
                            Belum ada artikel yang dipublikasikan.
                        @endif
                    </p>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        @if($posts->hasPages())
            <div class="mt-10">
                {{ $posts->links() }}
            </div>
        @endif

        <!-- Form Langganan Newsletter -->
        <livewire:subscribe-form />
    </main>

    <footer class="border-t border-zinc-200 dark:border-zinc-800/80 py-8 text-center text-xs font-mono text-zinc-500">
        <div class="max-w-5xl mx-auto px-4 flex flex-col sm:flex-row items-center justify-between gap-4">
            <span>&copy; {{ date('Y') }} DevBlog. All rights reserved.</span>
            <span>Minimal editorial &bull; Livewire 4</span>
        </div>
    </footer>
</div>
