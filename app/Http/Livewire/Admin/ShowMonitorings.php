<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Hotel;
use App\Models\Monitoring;
use Livewire\WithPagination;

class ShowMonitorings extends Component
{
    use WithPagination;
    
    public $monitoringsModal = false;
    public $food, $medicine, $temperature;
    public $modelId;


    public function rules()
    {
        return [
            'food' => 'required',
            'medicine' => 'required',
            'temperature' => 'required',
        ];
    }

    public function mount()
    {
        $this->resetPage();
    }


    public function create($id)
    {   
        $this->validate();
        Monitoring::create($this->modelData());
        $this->modelId = $id;
        $this->modalFormVisible = false;
        $this->resetVars();
    }

    public function modelData()
    {
        return [
            'food'              => $this->food,
            'medicine'          => $this->medicine,
            'temperature'       => $this->temperature,
        ];
    }

    public function resetVars()
    {        
             $this->food = null;   
             $this->medicine = null;
             $this->temperature = null;
    }

    public function read()
    {
        return Hotel::where('cage_id', '>', 0)
        ->where('status', '=', 'dalam kandang')
        ->get();
    }

    public function render()
    {
        return view('livewire.admin.show-monitorings',  [
            'data' => $this->read(),
        ]);
    }
}
