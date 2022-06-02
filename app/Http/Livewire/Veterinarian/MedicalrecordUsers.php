<?php

namespace App\Http\Livewire\Veterinarian;

use App\Models\Pet;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Livewire\Component;

class MedicalrecordUsers extends Component
{
    public $user_id, $name;
    public function mount($id)
    {
        $this->user_id = $id;
        $data = User::find($this->user_id);
        $this->name = $data->name;

    }

    public function petusers()
    {
        return Pet::where('user_id', $this->user_id)->get();
    }
    public function render()
    {
        if(Gate::denies('manage-veterinarian')){
            abort(403);
        }
        return view('livewire.veterinarian.medicalrecord-users', [
            'pet' => $this->petusers()
        ]);
    }
}
