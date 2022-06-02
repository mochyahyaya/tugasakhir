<?php

namespace App\Http\Livewire\User;

use App\Models\Groom;
use App\Models\Pet;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Notifications\GroomsNotification;
use Illuminate\Support\Facades\Notification;
use Livewire\Component;

class UserGrooming extends Component
{
    public $pet_id, $size, $service, $address;

    public function rules()
    {
        return
          [
            'pet_id'            => 'required',
            // 'size'              => 'required',
            'service'           => 'required',
            'address'           => 'required',
          ];
    }

    public function store()
    {
        
        $grooms = Groom::create([
            'pet_id'          => $this->pet_id,
            // 'size'            => $this->size,
            'service'         => $this->service,
            'address'         => $this->address,

        ]);

        $this->dispatchBrowserEvent('swal:modal', [
            'title'     => 'Sukses',
            'icon'      => 'success',
            'text'      => 'Pendaftaran Grooming Berhasil dilakukan',
            'iconcolor' => 'green'
        ]);

        $admins = User::whereHas('roles', function ($query) {
            $query->where('id', 1);
        })->get();
        Notification::send($admins, new GroomsNotification($grooms));
        // sleep(2);
        // return redirect()->to('/user/dashboad');
    }

    public function pet()
    {
        return Pet::where('user_id', Auth::user()->id)->get();
    }

    public function resetVars()
    {
        $this->pet_id = null;
        $this->address = null;
        $this->size = null;
        $this->service = null;
    }

    public function render()
    {
        if(Gate::denies('manage-users')){
            abort(403);
        }
        return view('livewire.user.user-grooming', [
            'pet'  => $this->pet(),
        ])->extends('layouts.user')->section('content');
    }
}
