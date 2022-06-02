<?php

namespace App\Http\Livewire\User;

use App\Models\Breeding;
use App\Models\Pet;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Notifications\BreedsNotification;
use Illuminate\Support\Facades\Notification;
use Livewire\Component;

class UserBreeding extends Component
{
    public $pet1, $pet2, $status, $start_date;

    public function rules()
    {
        return [
            'pet1'          => 'required',
            'pet2'          => 'required',
            'status'        => 'required',
            'start_date'    => 'required',
        ];
    }
    public function store()
    {
        $breeds = Breeding::create([ 
            'pet_id_1'          => $this->pet1,
            'pet_id_2'          => $this->pet2,
            'status'            => 'belum diproses',
            'start_date'        => $this->start_date,
        ]);

        $this->dispatchBrowserEvent('swal:modal', [
            'title'     => 'Sukses',
            'icon'      => 'success',
            'text'      => 'Pendaftaran Breeding Berhasil dilakukan',
            'iconcolor' => 'green'
        ]);

        $admins = User::whereHas('roles', function ($query) {
            $query->where('id', 1);
        })->get();
        Notification::send($admins, new BreedsNotification($breeds));

        // return redirect()->to('/user/dashboard');
    }
    public function pet()
    {
        return Pet::where('user_id', Auth::user()->id)->get();
    }
    public function pets2()
    {
        return (Pet::where('user_id', '1')->get());
    }
    public function render()
    {
        if(Gate::denies('manage-users')){
            abort(403);
        }
        return view('livewire.user.user-breeding', [
            'pet'   => $this->pet(),
            'pets2'  => $this->pets2()
        ])->extends('layouts.user')->section('content');
    }
}
