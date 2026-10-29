<div class="min-h-screen">
    <!-- Navbar Minimalis -->
    <header class="border-b border-zinc-200/80 dark:border-zinc-800/60 bg-white/70 dark:bg-zinc-950/70 backdrop-blur sticky top-0 z-40">
        <div class="max-w-2xl mx-auto px-5 h-14 flex items-center justify-between">
            <a href="{{ route('home') }}" wire:navigate class="flex items-center gap-2 group">
                <span class="inline-block size-2 rounded-full bg-emerald-500 ring-2 ring-emerald-500/20"></span>
                <span class="font-mono text-xs font-medium text-zinc-900 dark:text-zinc-100 tracking-tight">devisroomi</span>
            </a>

            <div class="flex items-center gap-4">
                <button 
                    x-data 
                    x-on:click="$flux.appearance = $flux.dark ? 'light' : 'dark'" 
                    type="button" 
                    class="p-1 rounded text-zinc-400 hover:text-zinc-700 dark:hover:text-zinc-200 transition" 
                    aria-label="Toggle dark mode"
                    title="Ganti tema"
                >
                    <svg x-show="$flux.dark" class="size-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                    <svg x-show="!$flux.dark" class="size-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="display: none;">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                    </svg>
                </button>

                @auth
                    <a href="{{ route('dashboard') }}" wire:navigate class="font-mono text-xs text-zinc-500 hover:text-zinc-900 dark:hover:text-zinc-100 transition">
                        admin &rarr;
                    </a>
                @else
                    <a href="{{ route('login') }}" class="font-mono text-xs text-zinc-400 hover:text-zinc-700 dark:hover:text-zinc-200 transition">
                        masuk
                    </a>
                @endauth
            </div>
        </div>
    </header>

    <main class="max-w-2xl mx-auto px-5 py-14">
        <!-- Author Masthead -->
        <header class="mb-12">
            <h1 class="text-2xl sm:text-3xl font-bold tracking-tight text-zinc-950 dark:text-zinc-50">
                Catatan & Rekayasa
            </h1>
            <p class="mt-2.5 text-sm sm:text-base text-zinc-600 dark:text-zinc-400 leading-relaxed font-sans">
                Dokumentasi sistem, arsitektur backend, Laravel, Livewire, dan eksplorasi teknis harian.
            </p>

            <!-- Minimal Search Field -->
            <div class="mt-6 relative">
                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                    <span class="text-zinc-400 font-mono text-xs">$</span>
                </div>
                <input 
                    type="search" 
                    wire:model.live.debounce.250ms="search" 
                    placeholder="filter catatan..." 
                    class="w-full pl-7 pr-8 py-1.5 text-xs font-mono bg-zinc-50 dark:bg-zinc-900/60 border border-zinc-200 dark:border-zinc-800 rounded-md text-zinc-900 dark:text-zinc-100 placeholder-zinc-400 dark:placeholder-zinc-600 focus:outline-none focus:border-zinc-400 dark:focus:border-zinc-600 focus:bg-white dark:focus:bg-zinc-900 transition"
                />
                @if($search)
                    <button 
                        wire:click="$set('search', '')" 
                        class="absolute inset-y-0 right-0 flex items-center pr-2.5 text-[10px] font-mono text-zinc-400 hover:text-zinc-600 dark:hover:text-zinc-200 cursor-pointer"
                        title="Hapus filter"
                    >
                        esc
                    </button>
                @endif
            </div>
        </header>

        <!-- Chronological Timeline Stream -->
        <section aria-label="Daftar Tulisan" class="space-y-1">
            <div class="text-[11px] font-mono uppercase tracking-wider text-zinc-400 dark:text-zinc-500 pb-3 border-b border-zinc-200/80 dark:border-zinc-800/80 mb-2 flex items-center justify-between">
                <span>Semua Tulisan ({{ $posts->total() }})</span>
                <span>Views / Tanggal</span>
            </div>

            @forelse($posts as $post)
                @php
                    $cleanSnippet = trim(preg_replace('/\s+/', ' ', strip_tags($post->content)));
                @endphp
                <article class="group">
                    <a href="{{ route('posts.show', $post->slug) }}" wire:navigate class="-mx-3 px-3 py-3 rounded-lg flex flex-col sm:flex-row sm:items-baseline justify-between gap-1 sm:gap-4 hover:bg-zinc-100/80 dark:hover:bg-zinc-900/60 transition-colors">
                        <div class="min-w-0 flex-1">
                            <h2 class="text-sm sm:text-base font-medium text-zinc-900 dark:text-zinc-100 group-hover:text-black dark:group-hover:text-white transition-colors">
                                {{ $post->title }}
                            </h2>
                            @if(strlen($cleanSnippet) > 0)
                                <p class="mt-1 text-xs text-zinc-500 dark:text-zinc-400 line-clamp-1 leading-normal font-sans">
                                    {{ Str::limit($cleanSnippet, 100) }}
                                </p>
                            @endif
                        </div>

                        <div class="flex items-center gap-2.5 shrink-0 text-xs font-mono text-zinc-400 dark:text-zinc-500 mt-1 sm:mt-0">
                            <span>{{ number_format($post->views_count) }} views</span>
                            <span>&bull;</span>
                            <time datetime="{{ $post->created_at->toIso8601String() }}">
                                {{ $post->created_at->format('d M Y') }}
                            </time>
                        </div>
                    </a>
                </article>
            @empty
                <div class="py-12 text-center">
                    <p class="font-mono text-xs text-zinc-500 dark:text-zinc-400">
                        @if($search)
                            Tidak ada catatan yang cocok dengan "<span class="text-zinc-800 dark:text-zinc-200">{{ $search }}</span>".
                            <button wire:click="$set('search', '')" class="underline underline-offset-2 ml-1 text-zinc-700 dark:text-zinc-300 cursor-pointer">
                                Reset
                            </button>
                        @else
                            Belum ada catatan yang dipublikasikan.
                        @endif
                    </p>
                </div>
            @endforelse
        </section>

        <!-- Pagination -->
        @if($posts->hasPages())
            <div class="mt-10 pt-6 border-t border-zinc-200/80 dark:border-zinc-800/80">
                {{ $posts->links() }}
            </div>
        @endif

        <!-- Minimal Footnote Newsletter -->
        <div class="mt-16 pt-10 border-t border-zinc-200/80 dark:border-zinc-800/80">
            <livewire:subscribe-form />
        </div>
    </main>

    <footer class="py-8 text-center text-xs font-mono text-zinc-400 dark:text-zinc-600">
        <div class="max-w-2xl mx-auto px-5 flex items-center justify-between">
            <span>&copy; {{ date('Y') }} Devis Roomi</span>
            <span>Estetika Editorial &bull; Livewire</span>
        </div>
    </footer>
</div>
