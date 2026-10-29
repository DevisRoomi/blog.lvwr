<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Subscriber extends Model
{
    use Notifiable;

    protected $fillable = [
        'email',
        'token',
        'is_verified',
    ];

    public function routeNotificationForMail(): string
    {
        return $this->email;
    }
}