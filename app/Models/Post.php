<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'user_id',
        'title',
        'slug',
        'content',
        'is_published',
        'views_count', // Tambahkan ini
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke seluruh riwayat analitik views
    public function views()
    {
        return $this->hasMany(PostView::class);
    }
}