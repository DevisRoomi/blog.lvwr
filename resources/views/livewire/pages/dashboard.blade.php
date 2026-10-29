<div class="py-8">
    <!-- CDN Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
        <!-- Header Dashboard -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h1 class="text-3xl font-extrabold text-zinc-900 dark:text-zinc-100">
                    Analitik & Ringkasan Blog
                </h1>
                <p class="text-sm text-zinc-500 dark:text-zinc-400 mt-1">
                    Pantau pertumbuhan pembaca, tren penayangan, dan performa artikel Anda.
                </p>
            </div>
            <div>
                <a href="{{ route('posts.create') }}" wire:navigate class="inline-flex items-center gap-2 px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg text-sm font-medium transition shadow-sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    Tulis Artikel Baru
                </a>
            </div>
        </div>

      <!-- 1. Grid Kartu Statistik -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Kartu Total Postingan -->
            <div class="bg-white dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-800 rounded-xl p-6 shadow-sm">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-wider text-zinc-500 dark:text-zinc-400">Total Postingan</p>
                        <h3 class="text-3xl font-bold text-zinc-900 dark:text-zinc-100 mt-2">{{ number_format($totalPosts) }}</h3>
                    </div>
                    <div class="p-3 bg-indigo-50 dark:bg-indigo-950/50 text-indigo-600 dark:text-indigo-400 rounded-lg">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Kartu Total Tayangan (Views) -->
            <div class="bg-white dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-800 rounded-xl p-6 shadow-sm">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-wider text-zinc-500 dark:text-zinc-400">Total Pembaca (Views)</p>
                        <h3 class="text-3xl font-bold text-emerald-600 dark:text-emerald-400 mt-2">{{ number_format($totalViews) }}</h3>
                    </div>
                    <div class="p-3 bg-emerald-50 dark:bg-emerald-950/50 text-emerald-600 dark:text-emerald-400 rounded-lg">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Kartu Total Pengguna Terdaftar -->
            <div class="bg-white dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-800 rounded-xl p-6 shadow-sm sm:col-span-2 lg:col-span-1">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-wider text-zinc-500 dark:text-zinc-400">Total Pengguna</p>
                        <h3 class="text-3xl font-bold text-zinc-900 dark:text-zinc-100 mt-2">{{ number_format($totalUsers) }}</h3>
                    </div>
                    <div class="p-3 bg-blue-50 dark:bg-blue-950/50 text-blue-600 dark:text-blue-400 rounded-lg">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- 2. Grid Grafik Tren & Daftar Artikel Populer -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Grafik Tren Penayangan (Chart.js) -->
            <div class="lg:col-span-2 bg-white dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-800 rounded-xl p-6 shadow-sm">
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <h2 class="text-lg font-bold text-zinc-900 dark:text-zinc-100">Tren Penayangan 7 Hari Terakhir</h2>
                        <p class="text-xs text-zinc-500">Visualisasi kunjungan pembaca setiap hari</p>
                    </div>
                </div>
                
                <div class="relative w-full h-72">
                    <canvas id="viewsChart"></canvas>
                </div>
            </div>

            <!-- Daftar Artikel Paling Banyak Dilihat (Top 5) -->
            <div class="bg-white dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-800 rounded-xl p-6 shadow-sm">
                <h2 class="text-lg font-bold text-zinc-900 dark:text-zinc-100 mb-4">Artikel Terpopuler</h2>
                <div class="divide-y divide-zinc-100 dark:divide-zinc-800">
                    @forelse($mostViewedPosts as $popularPost)
                        <div class="py-3.5 first:pt-0 last:pb-0 flex items-center justify-between gap-3">
                            <div class="min-w-0 flex-1">
                                <a href="{{ route('posts.show', $popularPost->slug) }}" wire:navigate class="text-sm font-semibold text-zinc-800 dark:text-zinc-200 hover:text-indigo-600 dark:hover:text-indigo-400 truncate block">
                                    {{ $popularPost->title }}
                                </a>
                                <p class="text-xs text-zinc-400 mt-0.5">
                                    {{ $popularPost->created_at->format('d M Y') }}
                                </p>
                            </div>
                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-zinc-100 dark:bg-zinc-800 text-zinc-700 dark:text-zinc-300 whitespace-nowrap">
                                {{ number_format($popularPost->views_count) }} views
                            </span>
                        </div>
                    @empty
                        <p class="text-sm text-zinc-400 py-6 text-center">Belum ada data penayangan artikel.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    <!-- Data Bridge & Script Inisialisasi Chart.js -->
    <div id="viewsChartData" 
         data-labels="{{ json_encode($chartLabels) }}" 
         data-values="{{ json_encode($chartData) }}" 
         style="display: none;">
    </div>

    <script>
        document.addEventListener('livewire:navigated', function () {
            initViewsChart();
        });

        // Jalankan juga saat pemuatan halaman pertama kali
        document.addEventListener('DOMContentLoaded', function () {
            initViewsChart();
        });

        function initViewsChart() {
            const chartCanvas = document.getElementById('viewsChart');
            if (!chartCanvas) return;

            // Hancurkan chart sebelumnya jika ada (mencegah error tumpang-tindih saat navigasi SPA)
            const existingChart = Chart.getChart(chartCanvas);
            if (existingChart) {
                existingChart.destroy();
            }

            const dataContainer = document.getElementById('viewsChartData');
            if (!dataContainer) return;

            const labels = JSON.parse(dataContainer.dataset.labels || '[]');
            const values = JSON.parse(dataContainer.dataset.values || '[]');

            const ctx = chartCanvas.getContext('2d');
            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Penayangan (Views)',
                        data: values,
                        borderColor: '#6366f1',
                        backgroundColor: 'rgba(99, 102, 241, 0.1)',
                        fill: true,
                        tension: 0.35,
                        pointBackgroundColor: '#4f46e5',
                        pointBorderColor: '#fff',
                        pointHoverRadius: 6,
                        borderWidth: 2
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { display: false }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: { precision: 0 }
                        }
                    }
                }
            });
        }
    </script>
</div>