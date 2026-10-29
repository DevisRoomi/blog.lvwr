<?php

namespace App\Livewire\Posts;

use App\Models\Post;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('layouts.app')]
class Index extends Component
{
    use WithPagination;

    // Method untuk menghapus postingan
    public function delete($id): void
    {
        $post = Post::findOrFail($id);

        // Menghapus data dari database
        $post->delete();

        // Notifikasi flash message
        session()->flash('status', 'Postingan berhasil dihapus!');
    }

    public function render()
    {
        $posts = Post::with('user')->latest()->paginate(10);

        return view('livewire.posts.index', [
            'posts' => $posts,
        ]);
    }
}
