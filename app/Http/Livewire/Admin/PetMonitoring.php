<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Hotel;
use App\Models\Monitoring;

class PetMonitoring extends Component
{
    public $hotel_id, $pet_name;
    public $sortDirection = 'asc';
    public $sortBy = 'food';
     

    public function mount($id)
    {
        $this->hotel_id = $id;
        $data = Hotel::find($this->hotel_id);
        $this->pet_name = $data->pets->name;

    }

    public function sortBy($field)
    {
        if($this->sortDirection =='asc'){
            $this->sortDirection ='desc';
        } else {
            $this->sortDirection = 'asc';
        }

        return $this->sortBy = $field;
    }

    public function read()
    {
        $monitoring = Monitoring::where('hotel_id', $this->hotel_id)
        ->get();
        return $monitoring;
    }

    public function render()
    {
        return view('livewire.admin.pet-monitoring', [
            'data' => $this->read()
        ]);
    }
}
