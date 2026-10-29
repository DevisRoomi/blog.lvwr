<?php

namespace App\Livewire\Posts;

use App\Models\Post;
use Illuminate\Support\Str;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Rule;
use Livewire\Component;

#[Layout('layouts.app')]
class Create extends Component
{
    #[Rule('required|min:3|max:255')]
    public string $title = '';

    #[Rule('required|min:3|unique:posts,slug')]
    public string $slug = '';

    #[Rule('required|min:10')]
    public string $content = '';

    public bool $is_published = false;

    // Otomatis membuat format URL slug saat judul diketik
    public function updatedTitle($value): void
    {
        $this->slug = Str::slug($value);
    }

    // Menyimpan postingan ke basis data
    public function save()
    {
        $this->validate();

        auth()->user()->posts()->create([
            'title' => $this->title,
            'slug' => $this->slug,
            'content' => $this->content,
            'is_published' => $this->is_published,
        ]);

        session()->flash('status', 'Artikel berhasil diterbitkan!');

        return $this->redirectRoute('dashboard', navigate: true);
    }

    public function render()
    {
        return view('livewire.posts.create');
    }
}
