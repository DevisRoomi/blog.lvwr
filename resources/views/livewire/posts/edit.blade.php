<div class="py-12">
    <!-- CDN Trix Rich Text Editor -->
    <link rel="stylesheet" type="text/css" href="https://unpkg.com/trix@2.0.8/dist/trix.css">
    <script type="text/javascript" src="https://unpkg.com/trix@2.0.8/dist/trix.umd.min.js"></script>

    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-zinc-900 shadow-sm sm:rounded-lg p-6">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-2xl font-bold text-zinc-900 dark:text-zinc-100">Edit Artikel</h2>
                <a href="{{ route('posts.index') }}" wire:navigate class="text-sm text-zinc-500 hover:text-zinc-700 dark:text-zinc-400">
                    &larr; Kembali ke Daftar
                </a>
            </div>

            <form wire:submit="update" class="space-y-6">
                <!-- Judul Artikel -->
                <div>
                    <label for="title" class="block text-sm font-medium text-zinc-700 dark:text-zinc-300">Judul Artikel</label>
                    <input type="text" id="title" wire:model.live.debounce.300ms="title"
                           class="mt-1 block w-full rounded-md border-zinc-300 dark:border-zinc-700 bg-white dark:bg-zinc-800 text-zinc-900 dark:text-zinc-100 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm p-2.5">
                    @error('title') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                </div>

                <!-- Slug URL Otomatis -->
                <div>
                    <label for="slug" class="block text-sm font-medium text-zinc-700 dark:text-zinc-300">Slug URL (Otomatis)</label>
                    <input type="text" id="slug" wire:model="slug" readonly
                           class="mt-1 block w-full rounded-md border-zinc-300 dark:border-zinc-700 bg-zinc-100 dark:bg-zinc-800/50 text-zinc-500 shadow-sm sm:text-sm p-2.5 cursor-not-allowed">
                    @error('slug') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                </div>

                <!-- Konten dengan Trix Editor -->
                <div>
                    <label class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-2">Konten Artikel</label>
                    <div wire:ignore x-data @trix-change="$wire.set('content', $event.target.value)">
                        <input id="content" type="hidden" value="{{ $content }}">
                        <trix-editor input="content" class="trix-content min-h-[250px] rounded-md border-zinc-300 dark:border-zinc-700 bg-white dark:bg-zinc-800 text-zinc-900 dark:text-zinc-100 p-3"></trix-editor>
                    </div>
                    @error('content') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                </div>

                <!-- Status Publikasi -->
                <div class="flex items-center">
                    <input type="checkbox" id="is_published" wire:model="is_published"
                           class="h-4 w-4 rounded border-zinc-300 text-indigo-600 focus:ring-indigo-500 dark:border-zinc-700 dark:bg-zinc-800">
                    <label for="is_published" class="ml-2 block text-sm text-zinc-700 dark:text-zinc-300">Publikasikan artikel ini</label>
                </div>

                <!-- Tombol Aksi -->
                <div class="flex justify-end gap-3">
                    <a href="{{ route('posts.index') }}" wire:navigate class="px-4 py-2 border rounded-md text-sm text-zinc-700 dark:text-zinc-300 hover:bg-zinc-50 dark:hover:bg-zinc-800">Batal</a>
                    <button type="submit" class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-md text-sm font-medium transition shadow-sm">
                        Perbarui Postingan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
