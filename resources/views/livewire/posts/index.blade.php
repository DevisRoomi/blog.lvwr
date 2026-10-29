<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

        <!-- Header Halaman & Tombol Tambah -->
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-2xl font-bold text-zinc-900 dark:text-zinc-100">Daftar Postingan</h2>
                <p class="text-sm text-zinc-500 dark:text-zinc-400 mt-1">Kelola seluruh artikel, status publikasi, dan
                    aksi pengeditan.</p>
            </div>
            <a href="{{ route('posts.create') }}" wire:navigate
                class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-md text-sm font-medium transition shadow-sm">
                + Buat Artikel Baru
            </a>
            <!-- Flash Message Notifikasi -->
            @if (session()->has('status'))
                <div
                    class="p-4 text-sm text-emerald-800 rounded-lg bg-emerald-50 dark:bg-zinc-800 dark:text-emerald-400 border border-emerald-200 dark:border-emerald-800">
                    {{ session('status') }}
                </div>
            @endif
        </div>

        <!-- Tabel Data Postingan -->
        <div
            class="bg-white dark:bg-zinc-900 shadow-sm sm:rounded-lg overflow-hidden border border-zinc-200 dark:border-zinc-800">
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm text-zinc-600 dark:text-zinc-300">
                    <thead
                        class="bg-zinc-50 dark:bg-zinc-800/60 text-xs uppercase text-zinc-500 dark:text-zinc-400 border-b border-zinc-200 dark:border-zinc-800">
                        <tr>
                            <th scope="col" class="px-6 py-3.5 font-semibold">Judul</th>
                            <th scope="col" class="px-6 py-3.5 font-semibold">Penulis</th>
                            <th scope="col" class="px-6 py-3.5 font-semibold">Status</th>
                            <th scope="col" class="px-6 py-3.5 font-semibold">Tanggal Dibuat</th>
                            <th scope="col" class="px-6 py-3.5 font-semibold text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-zinc-200 dark:divide-zinc-800">
                        @forelse($posts as $post)
                            <tr class="hover:bg-zinc-50/50 dark:hover:bg-zinc-800/40 transition">
                                <td class="px-6 py-4 font-medium text-zinc-900 dark:text-zinc-100">
                                    {{ $post->title }}
                                    <div class="text-xs text-zinc-400 mt-0.5 font-mono">{{ $post->slug }}</div>
                                </td>
                                <td class="px-6 py-4">
                                    {{ $post->user->name ?? 'Anonim' }}
                                </td>
                                <td class="px-6 py-4">
                                    @if ($post->is_published)
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-emerald-100 text-emerald-800 dark:bg-emerald-950 dark:text-emerald-300">
                                            Published
                                        </span>
                                    @else
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-amber-100 text-amber-800 dark:bg-amber-950 dark:text-amber-300">
                                            Draft
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-xs text-zinc-500">
                                    {{ $post->created_at->format('d M Y') }}
                                </td>
                                <td class="px-6 py-4 text-right space-x-3 whitespace-nowrap">
                                    <!-- Tombol Edit -->
                                    <a href="{{ route('posts.edit', $post) }}" wire:navigate
                                        class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-300 font-medium text-xs">
                                        Edit
                                    </a>

                                    <!-- Tombol Hapus dengan Konfirmasi -->
                                    <button wire:click="delete({{ $post->id }})"
                                        wire:confirm="Apakah kamu yakin ingin menghapus postingan ini?"
                                        class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-300 font-medium text-xs">
                                        Hapus
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-8 text-center text-zinc-400">
                                    Belum ada postingan artikel yang dibuat.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Navigasi Pagination -->
            @if ($posts->hasPages())
                <div class="p-4 border-t border-zinc-200 dark:border-zinc-800">
                    {{ $posts->links() }}
                </div>
            @endif
        </div>

    </div>
</div>
