<div class="max-w-xl">
    <div class="flex items-center gap-2 mb-2">
        <span class="text-xs font-mono text-zinc-500 dark:text-zinc-400">~/newsletter</span>
    </div>
    <p class="text-xs text-zinc-600 dark:text-zinc-400 font-sans">
        Dapatkan ringkasan catatan dan rilis artikel baru langsung ke email Anda. Tanpa spam.
    </p>

    @if($subscribed)
        <div class="mt-3 p-2 bg-zinc-100 dark:bg-zinc-800 text-zinc-800 dark:text-zinc-200 text-xs font-mono rounded">
            ✓ Berhasil berlangganan. Terima kasih telah terhubung!
        </div>
    @else
        <form wire:submit="subscribe" class="mt-3 flex gap-2">
            <div class="flex-1">
                <input 
                    type="email" 
                    wire:model="email" 
                    placeholder="email@domain.com" 
                    class="w-full px-3 py-1.5 rounded-md border border-zinc-200 dark:border-zinc-800 bg-zinc-50 dark:bg-zinc-900/60 text-zinc-900 dark:text-zinc-100 text-xs font-mono focus:outline-none focus:border-zinc-400 dark:focus:border-zinc-600"
                >
                @error('email') 
                    <span class="text-[11px] text-rose-500 mt-1 block font-mono">{{ $message }}</span> 
                @enderror
            </div>
            <button 
                type="submit" 
                class="px-3 py-1.5 bg-zinc-900 hover:bg-zinc-800 text-white dark:bg-zinc-100 dark:hover:bg-zinc-200 dark:text-zinc-900 text-xs font-mono font-medium rounded-md transition cursor-pointer shrink-0"
            >
                Ikuti
            </button>
        </form>
    @endif
</div>
