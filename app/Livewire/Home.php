<?php

namespace App\Livewire;

use App\Models\Post;
use Livewire\Component;
use Livewire\WithPagination;

class Home extends Component
{
    use WithPagination;

    public function render()
    {
        $posts = Post::with('user')
            ->where('is_published', true)
            ->latest()
            ->paginate(6);

        return view('livewire.home', [
            'posts' => $posts,
        ]);
    }
}