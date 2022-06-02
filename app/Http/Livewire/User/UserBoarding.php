<?php

namespace App\Http\Livewire\User;

use App\Models\Hotel;
use App\Models\Pet;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Notifications\BoardsNotification;
use Illuminate\Support\Facades\Notification;
use Livewire\Component;
use Livewire\WithPagination;

class UserBoarding extends Component
{
    public $pet_id;
    public $start_date = null;
    public $end_date = null;

    public function store()
    {
        $this->validate([
            'pet_id'            => 'required',
            // 'size'              => 'required',
            'start_date'        => 'required',
            'end_date'          => 'required',
            // 'total_day'         => 'required',
        ]);

        $hotels = Hotel::create([
            'pet_id'          => $this->pet_id,
            // 'size'            => $this->size,
            'start_date'      => $this->start_date,
            'end_date'        => $this->end_date,
            // 'total_day'       => $this->total_day
        ]); 

        $this->dispatchBrowserEvent('swal:modal', [
            'title'     => 'Sukses',
            'icon'      => 'success',
            'text'      => 'Pendaftaran Boarding Berhasil dilakukan',
            'iconcolor' => 'green'
        ]);

        $admins = User::whereHas('roles', function ($query) {
            $query->where('id', 1);
        })->get();
        Notification::send($admins, new BoardsNotification($hotels));

        // return redirect()->to('/user/dashboard');
    }

    public function pet()
    {
        return Pet::where('user_id', Auth::user()->id)->get();
    }

    public function render()
    {
        if(Gate::denies('manage-users')){
            abort(403);
        }
        return view('livewire.user.user-boarding', [
            'pet'  => $this->pet(),
        ])->extends('layouts.user')->section('content');
    }
}
