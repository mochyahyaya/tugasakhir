<?php

namespace App\Http\Livewire\User;

use Livewire\Component;
use App\Models\Breeding;
use App\Models\MonitoringBreeding;

class MonitoringBreedingPets extends Component
{
    public $breeds_id, $pet_name;

    public function mount($id)
    {
        $this->breeds_id = $id;
        $data = Breeding::find($this->breeds_id);
        $this->pet_name = $data->pets->name;

    }

    public function read()
    {
        $monitoring = MonitoringBreeding::where('breeds_id', $this->breeds_id)
        ->get();
        return $monitoring;
    }

    public function render()
    {
        return view('livewire.user.monitoring-breeding-pets', [
            'data' => $this->read()
        ])->extends('layouts.user')->section('content');
    }
}
