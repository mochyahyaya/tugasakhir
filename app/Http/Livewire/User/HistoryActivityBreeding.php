<?php

namespace App\Http\Livewire\User;

use Livewire\Component;
use App\Models\Breeding;
use Illuminate\Support\Facades\Auth;

class HistoryActivityBreeding extends Component
{
    public function historyBreedings()
    {
        $breeds = Breeding::join('pets', 'pets.id', '=', 'breedings.pet_id_1')
        ->where('pets.user_id','=', Auth::user()->id)
        ->get();

        return $breeds;
    }

    public function render()
    {
        return view('livewire.user.history-activity-breeding', [
            'historyBreedings' => $this->historyBreedings()
        ])->extends('layouts.user')->section('content');
    }
}
