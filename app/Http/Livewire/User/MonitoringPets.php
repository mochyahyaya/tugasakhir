<?php

namespace App\Http\Livewire\User;

use Livewire\Component;
use App\Models\Hotel;
use App\Models\Monitoring;

class MonitoringPets extends Component
{
    public $hotel_id, $pet_name;

    public function mount($id)
    {
        $this->hotel_id = $id;
        $data = Hotel::find($this->hotel_id);
        $this->pet_name = $data->pets->name;

    }

    public function read()
    {
        $monitoring = Monitoring::where('hotel_id', $this->hotel_id)
        ->get();
        return $monitoring;
    }

    public function render()
    {
        return view('livewire.user.monitoring-pets', [
            'data' => $this->read()
        ])
        ->extends('layouts.user')->section('content');
    }
}
