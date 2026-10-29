<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PostView extends Model
{
    protected $fillable = [
        'post_id',
        'user_id',
        'ip_address',
        'user_agent',
        'viewed_at',
    ];

    protected $casts = [
        'viewed_at' => 'datetime',
    ];

    // Relasi ke postingan
    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    // Relasi ke user (jika sedang login saat membaca)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}