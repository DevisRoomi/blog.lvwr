<?php

namespace App\Livewire;

use App\Models\Subscriber;
use Illuminate\Support\Str;
use Livewire\Attributes\Rule;
use Livewire\Component;

class SubscribeForm extends Component
{
    #[Rule('required|email|unique:subscribers,email')]
    public string $email = '';

    public bool $subscribed = false;

    public function subscribe(): void
    {
        $this->validate();

        Subscriber::create([
            'email' => $this->email,
            'token' => Str::random(32),
            'is_verified' => true, // Auto-verified untuk kemudahan tutorial
        ]);

        $this->reset('email');
        $this->subscribed = true;
    }

    public function render()
    {
        return view('livewire.subscribe-form');
    }
}