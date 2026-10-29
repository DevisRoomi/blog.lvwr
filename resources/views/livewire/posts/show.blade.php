<div class="min-h-screen">
    <!-- Navbar Minimalis -->
    <header class="border-b border-zinc-200 dark:border-zinc-800/80 bg-white/80 dark:bg-zinc-950/80 backdrop-blur sticky top-0 z-40">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 h-14 flex items-center justify-between">
            <a href="{{ route('home') }}" wire:navigate class="font-mono text-xs text-zinc-600 dark:text-zinc-400 hover:text-zinc-900 dark:hover:text-white transition flex items-center gap-1.5">
                <span aria-hidden="true">&larr;</span>
                <span>Semua Catatan</span>
            </a>
            <a href="{{ route('home') }}" wire:navigate class="font-mono text-xs px-2 py-0.5 rounded bg-zinc-100 dark:bg-zinc-800 text-zinc-800 dark:text-zinc-200 border border-zinc-300 dark:border-zinc-700">
                ~/devblog
            </a>
        </div>
    </header>

    @php
        $wordCount = str_word_count(strip_tags($post->content));
        $readTime = max(1, (int) ceil($wordCount / 200));
    @endphp

    <!-- Konten Artikel Lengkap -->
    <main class="max-w-3xl mx-auto px-4 sm:px-6 py-12">
        <article>
            <header class="mb-10 pb-8 border-b border-zinc-200 dark:border-zinc-800/80">
                <div class="flex flex-wrap items-center gap-2 text-xs font-mono text-zinc-500 dark:text-zinc-400 mb-4">
                    <time datetime="{{ $post->created_at->toIso8601String() }}">
                        {{ $post->created_at->format('d M Y') }}
                    </time>
                    <span>&bull;</span>
                    <span>{{ $readTime }} min read</span>
                    <span>&bull;</span>
                    <span>{{ number_format($post->views_count) }} views</span>
                    <span>&bull;</span>
                    <span>Ditulis oleh {{ $post->user->name ?? 'Dev' }}</span>
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