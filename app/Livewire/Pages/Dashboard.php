<?php

namespace App\Livewire\Pages;

use App\Models\Post;
use App\Models\PostView;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app')]
class Dashboard extends Component
{
    public function render()
    {
        // 1. Data Ringkasan Kartu Metrik
        $totalPosts = Post::count();
        $totalViews = Post::sum('views_count');
        $totalUsers = User::count();

        // 2. Artikel yang Paling Banyak Dilihat (Top 5)
        $mostViewedPosts = Post::where('is_published', true)
            ->orderByDesc('views_count')
            ->take(5)
            ->get();

        // 3. Menyiapkan Data Tren Views 7 Hari Terakhir untuk Chart.js
        $rawViewsData = PostView::select(
                DB::raw('DATE(viewed_at) as date'),
                DB::raw('COUNT(*) as count')
            )
            ->where('viewed_at', '>=', now()->subDays(6)->startOfDay())
            ->groupBy('date')
            ->orderBy('date')
            ->get()
            ->keyBy('date');

        $chartLabels = [];
        $chartData = [];

        // Mengisi hari yang kosong agar tren grafik tetap kontinu (nilai 0 jika tidak ada views)
        for ($i = 6; $i >= 0; $i--) {
            $date = now()->subDays($i)->format('Y-m-d');
            $chartLabels[] = now()->subDays($i)->format('d M');
            $chartData[] = isset($rawViewsData[$date]) ? (int) $rawViewsData[$date]->count : 0;
        }

        return view('livewire.pages.dashboard', compact(
            'totalPosts',
            'totalViews',
            'totalUsers',
            'mostViewedPosts',
            'chartLabels',
            'chartData'
        ));
    }
}