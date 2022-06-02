<?php

namespace App\Http\Livewire\User;

use Livewire\Component;
use App\Models\Groom;
use Illuminate\Support\Facades\Auth;

class HistoryActivity extends Component
{
    public function historyGrooms()
    {
        $grooms = Groom::join('pets', 'pets.id', '=', 'grooms.pet_id')
        ->where('pets.user_id','=', Auth::user()->id)
        ->get();

        return $grooms;
    }

    public function render()
    {
        return view('livewire.user.history-activity', [
            'historyGrooms' => $this->historyGrooms()
        ])->extends('layouts.user')->section('content');
    }
}
