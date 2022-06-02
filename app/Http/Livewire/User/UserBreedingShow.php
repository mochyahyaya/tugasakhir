<?php

namespace App\Http\Livewire\User;

use Livewire\Component;
use App\Models\Pet;

class UserBreedingShow extends Component
{
    public function adminPet()
    {
        return Pet::where('user_id', 1)->get();
    }

    public function render()
    {
        return view('livewire.user.user-breeding-show',[
            'adminPet' => $this->adminPet()
        ])
        ->extends('layouts.user')->section('content');
    }
}
