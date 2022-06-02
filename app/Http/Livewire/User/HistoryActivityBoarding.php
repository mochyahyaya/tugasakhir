<?php

namespace App\Http\Livewire\User;

use Livewire\Component;
use App\Models\Hotel;
use Illuminate\Support\Facades\Auth;

class HistoryActivityBoarding extends Component
{
    public function historyBoardings()
    {
        $boards = Hotel::join('pets', 'pets.id', '=', 'hotels.pet_id')
        ->where('pets.user_id','=', Auth::user()->id)
        ->get();

        return $boards;
    }

    public function render()
    {
        return view('livewire.user.history-activity-boarding', [
            'historyBoardings' => $this->historyBoardings()
        ])->extends('layouts.user')->section('content');
    }
}
