<?php

namespace App\Http\Livewire\User;

use Livewire\Component;
use Livewire\WithPagination;

use App\Models\Pet;
use App\Models\Gallery;

class UserBreedingGalery extends Component
{
    use WithPagination;
    public $pet_id, $name, $modelId;
    public $modalDeleteVisible = false;

    public function mount($id)
    {
        $this->pet_id = $id;
        $data = Pet::find($this->pet_id);
        $this->name = $data->name;

        $this->modalDeleteVisible = false;
    }

    public function pets()
    {
        return Gallery::where('pet_id', $this->pet_id)->get();
        
    }
    public function render()
    {
        return view('livewire.user.user-breeding-galery', [
            'pets' => $this->pets()
        ])->extends('layouts.user')->section('content');
    }
}
