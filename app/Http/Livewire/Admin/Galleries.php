<?php

namespace App\Http\Livewire\Admin;

use App\Models\Pet;
use App\Models\Gallery;
use Livewire\Component;
use Livewire\WithPagination;

class Galleries extends Component
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

    public function deleteShowModal($id)
    {
        $this->modelId = $id;
        $this->modalDeleteVisible = true;
    }

    public function delete()
    {
        Gallery::destroy($this->modelId);
        $this->modalDeleteVisible = false;
        $this->resetPage();
    }

    public function render()
    {
        return view('livewire.admin.gallery', [
            'pet' => $this->pets()
        ]);
    }
}
