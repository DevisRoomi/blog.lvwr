<?php

namespace App\Notifications;

use App\Models\Post;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewPostPublishedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(public Post $post)
    {
    }

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Artikel Baru Telah Diterbitkan: ' . $this->post->title)
            ->greeting('Halo Sobat DevBlog!')
            ->line('Ada postingan artikel terbaru yang baru saja diterbitkan di platform kami:')
            ->line('"' . $this->post->title . '"')
            ->action('Baca Artikel Sekarang', route('posts.show', $this->post->slug))
            ->line('Jika Anda tidak ingin menerima email notifikasi ini lagi, Anda dapat berhenti berlangganan kapan saja.')
            ->action('Berhenti Berlangganan', route('unsubscribe', $notifiable->token ?? ''));
    }
}