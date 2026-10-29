<?php

use App\Livewire\Home;
use App\Livewire\Pages\Dashboard as AnalyticsDashboard;
use App\Livewire\Posts\Create as PostCreate;
use App\Livewire\Posts\Edit as PostEdit;
use App\Livewire\Posts\Index as PostIndex;
use App\Livewire\Posts\Show as PostShow;
use App\Models\Subscriber;
use Illuminate\Support\Facades\Route;

// Rute Publik
Route::get('/', Home::class)->name('home');
Route::get('/posts/{slug}', PostShow::class)->name('posts.show');

Route::get('/unsubscribe/{token}', function (string $token) {
    $subscriber = Subscriber::where('token', $token)->firstOrFail();
    $subscriber->delete();

    return view('unsubscribed');
})->name('unsubscribe');

// Rute Dashboard Admin
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', AnalyticsDashboard::class)->name('dashboard');
    Route::get('/dashboard/posts', PostIndex::class)->name('posts.index');
    Route::get('/dashboard/posts/create', PostCreate::class)->name('posts.create');
    Route::get('/dashboard/posts/{post}/edit', PostEdit::class)->name('posts.edit');
});

require __DIR__.'/settings.php';