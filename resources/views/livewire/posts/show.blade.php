<div class="min-h-screen">
    <!-- Reading Progress Bar -->
    <div 
        x-data="{ width: '0%' }" 
        x-init="const updateProgress = () => {
            const h = document.documentElement.scrollHeight - window.innerHeight;
            width = h > 0 ? Math.min(100, Math.max(0, (window.scrollY / h) * 100)) + '%' : '0%';
        };
        window.addEventListener('scroll', updateProgress, { passive: true });
        updateProgress();"
        class="fixed top-0 left-0 h-0.5 bg-zinc-900 dark:bg-zinc-100 z-50 transition-all duration-75"
        :style="{ width: width }"
    ></div>

    <!-- Navbar Minimalis -->
    <header class="border-b border-zinc-200 dark:border-zinc-800/80 bg-white/80 dark:bg-zinc-950/80 backdrop-blur sticky top-0 z-40">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 h-14 flex items-center justify-between">
            <a href="{{ route('home') }}" wire:navigate class="font-mono text-xs text-zinc-600 dark:text-zinc-400 hover:text-zinc-900 dark:hover:text-white transition flex items-center gap-1.5">
                <span aria-hidden="true">&larr;</span>
                <span>Semua Catatan</span>
            </a>

            <div class="flex items-center gap-3">
                <button 
                    x-data 
                    x-on:click="$flux.appearance = $flux.dark ? 'light' : 'dark'" 
                    type="button" 
                    class="p-1.5 rounded-md text-zinc-500 hover:text-zinc-900 dark:text-zinc-400 dark:hover:text-zinc-100 hover:bg-zinc-100 dark:hover:bg-zinc-800 transition" 
                    aria-label="Toggle dark mode"
                >
                    <svg x-show="$flux.dark" class="size-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                    <svg x-show="!$flux.dark" class="size-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="display: none;">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                    </svg>
                </button>

                <a href="{{ route('home') }}" wire:navigate class="font-mono text-xs px-2 py-0.5 rounded bg-zinc-100 dark:bg-zinc-800 text-zinc-800 dark:text-zinc-200 border border-zinc-300 dark:border-zinc-700">
                    ~/devblog
                </a>
            </div>
        </div>
    </header>

    @php
        $wordCount = str_word_count(strip_tags($post->content));
        $readTime = max(1, (int) ceil($wordCount / 200));
    @endphp

    <!-- Konten Artikel Lengkap -->
    <main class="max-w-3xl mx-auto px-4 sm:px-6 py-12">
        <article 
            x-data 
            x-init="
                $nextTick(() => {
                    $el.querySelectorAll('pre').forEach(pre => {
                        if (pre.querySelector('.code-copy-btn')) return;
                        pre.classList.add('relative', 'group');
                        const btn = document.createElement('button');
                        btn.className = 'code-copy-btn absolute top-2.5 right-2.5 px-2 py-1 text-xs font-mono rounded bg-zinc-800/90 text-zinc-300 hover:text-white border border-zinc-700 opacity-0 group-hover:opacity-100 transition cursor-pointer';
                        btn.innerText = 'copy';
                        btn.onclick = () => {
                            navigator.clipboard.writeText(pre.querySelector('code')?.innerText || pre.innerText);
                            btn.innerText = 'copied!';
                            setTimeout(() => btn.innerText = 'copy', 2000);
                        };
                        pre.appendChild(btn);
                    });
                });
            "
        >
            <header class="mb-10 pb-8 border-b border-zinc-200 dark:border-zinc-800/80">
                <div class="flex flex-wrap items-center justify-between gap-3 text-xs font-mono text-zinc-500 dark:text-zinc-400 mb-4">
                    <div class="flex flex-wrap items-center gap-2">
                        <time datetime="{{ $post->created_at->toIso8601String() }}">
                            {{ $post->created_at->format('d M Y') }}
                        </time>
                        <span>&bull;</span>
                        <span>{{ $readTime }} min read</span>
                        <span>&bull;</span>
                        <span>{{ number_format($post->views_count) }} views</span>
                    </div>

                    <div x-data="{ copied: false }">
                        <button 
                            x-on:click="navigator.clipboard.writeText(window.location.href); copied = true; setTimeout(() => copied = false, 2000)" 
                            type="button" 
                            class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded border border-zinc-200 dark:border-zinc-800 hover:border-zinc-400 dark:hover:border-zinc-600 bg-white dark:bg-zinc-900 text-zinc-600 dark:text-zinc-400 hover:text-zinc-900 dark:hover:text-zinc-100 transition cursor-pointer"
                        >
                            <svg class="size-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z" />
                            </svg>
                            <span x-text="copied ? 'Tersalin!' : 'Bagikan'"></span>
                        </button>
                    </div>
                </div>

                <h1 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-zinc-950 dark:text-zinc-50 tracking-tight leading-tight">
                    {{ $post->title }}
                </h1>
            </header>

            <!-- Isi Artikel -->
            <div class="prose prose-zinc dark:prose-invert max-w-none text-zinc-800 dark:text-zinc-200 leading-relaxed text-base sm:text-lg">
                {!! $post->content !!}
            </div>

            <!-- Footer Artikel & Penulis -->
            <div class="mt-16 pt-8 border-t border-zinc-200 dark:border-zinc-800/80">
                <div class="p-6 rounded-xl bg-zinc-100/50 dark:bg-zinc-900/40 border border-zinc-200 dark:border-zinc-800 flex items-center justify-between gap-4">
                    <div>
                        <span class="text-xs font-mono text-zinc-500 uppercase tracking-wider block mb-1">Penulis</span>
                        <p class="font-semibold text-zinc-900 dark:text-zinc-100 text-sm">
                            {{ $post->user->name ?? 'DevBlog Contributor' }}
                        </p>
                        <p class="text-xs text-zinc-500 dark:text-zinc-400 mt-0.5">
                            Software engineer & technical writer.
                        </p>
                    </div>
                    <a href="{{ route('home') }}" wire:navigate class="px-3.5 py-1.5 text-xs font-mono bg-white dark:bg-zinc-800 border border-zinc-300 dark:border-zinc-700 rounded-lg hover:border-zinc-400 dark:hover:border-zinc-600 transition shrink-0">
                        &larr; Indeks
                    </a>
                </div>
            </div>
        </article>

        <!-- Form Langganan Newsletter -->
        <livewire:subscribe-form />
    </main>

    <footer class="border-t border-zinc-200 dark:border-zinc-800/80 py-8 text-center text-xs font-mono text-zinc-500">
        <div class="max-w-3xl mx-auto px-4 flex flex-col sm:flex-row items-center justify-between gap-4">
            <span>&copy; {{ date('Y') }} DevBlog. All rights reserved.</span>
            <span>Minimal editorial &bull; Livewire 4</span>
        </div>
    </footer>
</div>