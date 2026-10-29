<?php

namespace App\Livewire;

use App\Models\Post;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('layouts.public')]
#[Title('Catatan & Jurnal Teknis')]
class Home extends Component
{
    use WithPagination;

    #[Url(except: '')]
    public string $search = '';

    public function updatedSearch(): void
    {
        $this->resetPage();
    }

    public function render()
    {
        $posts = Post::with('user')
            ->where('is_published', true)
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->where('title', 'like', '%'.$this->search.'%')
                        ->orWhere('content', 'like', '%'.$this->search.'%');
                });
            })
            ->latest()
            ->paginate(9);

        return view('livewire.home', [
            'posts' => $posts,
        ]);
    }
}