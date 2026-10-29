<div class="bg-indigo-50 dark:bg-zinc-900 border border-indigo-100 dark:border-zinc-800 rounded-2xl p-6 sm:p-8 text-center my-12">
    <h3 class="text-xl sm:text-2xl font-bold text-zinc-900 dark:text-zinc-100">
        Berlangganan Artikel Terbaru
    </h3>
    <p class="text-sm text-zinc-600 dark:text-zinc-400 mt-2 max-w-md mx-auto">
        Dapatkan pemberitahuan langsung di kotak masuk email Anda setiap kali artikel baru diterbitkan.
    </p>

    @if($subscribed)
        <div class="mt-4 p-3 bg-emerald-100 dark:bg-emerald-950/50 text-emerald-700 dark:text-emerald-400 text-sm rounded-lg font-medium inline-block">
            Terima kasih! Anda telah berhasil berlangganan.
        </div>
    @else
        <form wire:submit="subscribe" class="mt-6 flex flex-col sm:flex-row gap-2 max-w-md mx-auto">
            <div class="flex-1 text-left">
                <input type="email" wire:model="email" placeholder="Masukkan alamat email Anda..." 
                       class="w-full px-4 py-2.5 rounded-lg border border-zinc-300 dark:border-zinc-700 bg-white dark:bg-zinc-800 text-zinc-900 dark:text-zinc-100 text-sm focus:ring-2 focus:ring-indigo-500 focus:outline-none">
                @error('email') 
                    <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> 
                @enderror
            </div>
            <button type="submit" class="px-5 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-semibold rounded-lg transition whitespace-nowrap">
                Langganan
            </button>
        </form>
    @endif
</div>