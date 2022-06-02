<?php

namespace App\Http\Livewire\User;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

use App\Models\Hotel;
use App\Models\Pet;

class MonitoringBreedingUser extends Component
{
    public function pets()
    {
        $pets = Pet::where('user_id', Auth::user()->id)
        ->leftjoin('breedings', 'breedings.pet_id_1', '=', 'pets.id')
        ->whereIn('breedings.status', ['proses'])
        ->get();

        // dd($pets);
        return $pets;
    }

    public function render()
    {
        return view('livewire.user.monitoring-breeding-user',[
            'pets' => $this->pets()
        ])
        ->extends('layouts.user')->section('content');
    }
}
