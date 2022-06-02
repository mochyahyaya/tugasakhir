<?php

namespace App\Http\Livewire\User;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

use App\Models\Hotel;
use App\Models\Pet;

class MonitoringUser extends Component
{
    public function pets()
    {
        $pets = Pet::where('user_id', Auth::user()->id)
        ->leftjoin('hotels', 'hotels.pet_id', '=', 'pets.id')
        ->whereIn('hotels.status', ['dalam kandang'])
        ->get();

        // dd($pets);
        return $pets;
    }
    
    public function render()
    {
        return view('livewire.user.monitoring-user',[
            'pets' => $this->pets()
        ])->extends('layouts.user')->section('content');
    }
}
