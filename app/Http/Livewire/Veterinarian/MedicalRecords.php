<?php

namespace App\Http\Livewire\Veterinarian;

use App\Models\Pet;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Livewire\Component;

class MedicalRecords extends Component
{   
    public $user_id;
    public function users()
    {
        return User::where('role_id', 3)->get();
    }

    public function pets()
    {
        return Pet::where('user_id', '=', $this->user_id);
    }
    public function render()
    { 
        if(Gate::denies('manage-veterinarian')){
            abort(403);
        }
        return view('livewire.veterinarian.medicalRecords', [
            'users' => $this->users(),
            'pets'  => $this->pets(),
        ]);
    }
}
