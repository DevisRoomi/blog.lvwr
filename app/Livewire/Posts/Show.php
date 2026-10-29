<?php

namespace App\Livewire\Posts;

use App\Models\Post;
use App\Models\PostView;
use Livewire\Component;

class Show extends Component
{
    public Post $post;

    public function mount(string $slug): void
    {
        $this->post = Post::with('user')
            ->where('slug', $slug)
            ->where('is_published', true)
            ->firstOrFail();

        // 1. Tambah counter views cepat di tabel posts
        $this->post->increment('views_count');

        // 2. Rekam analitik rincian view
        $this->post->views()->create([
            'user_id' => auth()->id(),
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
            'viewed_at' => now(),
        ]);
    }

    public function render()
    {
        return view('livewire.posts.show');
    }
}