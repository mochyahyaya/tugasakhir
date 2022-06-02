<?php

namespace App\Http\Livewire\Admin;

use App\Models\Pet;
use App\Models\User;
use Livewire\Component;

class UserPet extends Component
{
    public $users;
    public $pets;

    public $selectedUser = null;
    public $selectedPet = null;

    public function mount($selectedPet = null)
    {
        $this->users = User::all();
        $this->pets = collect();
        $this->selectedPet = $selectedPet;

        if (!is_null($selectedPet)) {
            $pet = Pet::with('users')->find($selectedPet);
            if ($pet) {
                $this->pets = Pet::where('user_id', $pet->user_id)->get();
                $this->selectedUser = $pet->user_id;
            }
        }
    }

    public function updatedSelectedUser($user)
    {
        $this->pets = Pet::where('user_id', $user)->get();
        $this->selectedPet = NULL;
    }

    public function render()
    {
        return view('livewire.user-pet');
    }
}
