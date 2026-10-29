<div class="border border-zinc-200 dark:border-zinc-800 bg-white dark:bg-zinc-900/40 rounded-xl p-8 my-16 text-center max-w-2xl mx-auto">
    <div class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md text-xs font-mono font-medium bg-zinc-100 dark:bg-zinc-800 text-zinc-600 dark:text-zinc-400 mb-4">
        <span>newsletter</span>
        <span>•</span>
        <span>no spam, unsubscribe anytime</span>
    </div>

    <h3 class="text-xl sm:text-2xl font-semibold tracking-tight text-zinc-900 dark:text-zinc-100">
        Tetap terhubung dengan tulisan terbaru
    </h3>
    <p class="text-sm text-zinc-500 dark:text-zinc-400 mt-2 max-w-md mx-auto">
        Kirim update langsung ke inbox setiap kali ada tutorial, arsitektur, dan catatan teknis baru.
    </p>

    @if($subscribed)
        <div class="mt-6 p-3 bg-zinc-100 dark:bg-zinc-800/80 border border-zinc-200 dark:border-zinc-700 text-zinc-800 dark:text-zinc-200 text-xs font-mono rounded-lg inline-block">
            ✓ Berhasil berlangganan. Cek inbox Anda untuk konfirmasi.
        </div>
    @else
        <form wire:submit="subscribe" class="mt-6 flex flex-col sm:flex-row gap-2 max-w-md mx-auto">
            <div class="flex-1 text-left">
                <input type="email" wire:model="email" placeholder="nama@email.com" 
                       class="w-full px-3.5 py-2.5 rounded-lg border border-zinc-300 dark:border-zinc-700 bg-zinc-50/50 dark:bg-zinc-900 text-zinc-900 dark:text-zinc-100 text-sm font-sans focus:outline-none focus:ring-1 focus:ring-zinc-400 dark:focus:ring-zinc-600">
                @error('email') 
                    <span class="text-xs text-rose-500 mt-1 block font-mono">{{ $message }}</span> 
                @enderror
            </div>
            <button type="submit" class="px-4 py-2.5 bg-zinc-900 hover:bg-zinc-800 text-white dark:bg-zinc-100 dark:hover:bg-zinc-200 dark:text-zinc-900 text-sm font-medium rounded-lg transition whitespace-nowrap cursor-pointer">
                Berlangganan
            </button>
        </form>
    @endif
</div>