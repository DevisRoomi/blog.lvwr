<?php

namespace App\Observers;

use App\Models\Post;
use App\Models\Subscriber;
use App\Notifications\NewPostPublishedNotification;
use Illuminate\Support\Facades\Notification;

class PostObserver
{
    /**
     * Handle the Post "updated" event.
     */
    public function updated(Post $post): void
    {
        // Cek jika status artikel diubah menjadi Published (is_published berubah jadi true)
        if ($post->isDirty('is_published') && $post->is_published) {
            $subscribers = Subscriber::where('is_verified', true)->get();

            if ($subscribers->isNotEmpty()) {
                Notification::send($subscribers, new NewPostPublishedNotification($post));
            }
        }
    }
}