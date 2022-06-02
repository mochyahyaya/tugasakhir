<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Breeding;
use App\Models\MonitoringBreeding;

class PetMonitoringBreedings extends Component
{
    public $breeds_id, $pet_name;
    public $sortDirection = 'asc';
    public $sortBy = 'food';

    public function mount($id)
    {
        $this->breeds_id = $id;
        $data = Breeding::find($this->breeds_id);
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
        $monitoring = MonitoringBreeding::where('breeds_id', $this->breeds_id)
        ->get();
        return $monitoring;
    }

    public function render()
    {
        return view('livewire.admin.pet-monitoring-breedings', [
            'data' => $this->read()
        ]);
    }
}
