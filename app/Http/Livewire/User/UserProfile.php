<?php

namespace App\Http\Livewire\USer;

use Livewire\Component;

class UserProfile extends Component
{
    public function render()
    {
        return view('livewire.user.user-profile')
        ->extends('layouts.user')->section('content');
    }
}
