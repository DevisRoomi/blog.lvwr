<?php

namespace App\Livewire\Posts;

use App\Models\Post;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app')]
class Edit extends Component
{
    public Post $post;

    public string $title = '';
    public string $slug = '';
    public string $content = '';
    public bool $is_published = false;

    public function mount(Post $post): void
    {
        $this->post = $post;
        $this->title = $post->title;
        $this->slug = $post->slug;
        $this->content = $post->content;
        $this->is_published = (bool) $post->is_published;
    }

    public function updatedTitle($value): void
    {
        $this->slug = Str::slug($value);
    }

    public function update()
    {
        $this->validate([
            'title' => 'required|min:3|max:255',
            'slug'  => ['required', 'min:3', Rule::unique('posts', 'slug')->ignore($this->post->id)],
            'content' => 'required|min:10',
            'is_published' => 'boolean',
        ]);

        $this->post->update([
            'title' => $this->title,
            'slug' => $this->slug,
            'content' => $this->content,
            'is_published' => $this->is_published,
        ]);

        session()->flash('status', 'Artikel berhasil diperbarui!');

        return $this->redirectRoute('posts.index', navigate: true);
    }

    public function render()
    {
        return view('livewire.posts.edit');
    }
}
