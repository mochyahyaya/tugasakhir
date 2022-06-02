<?php

namespace App\Http\Livewire\Veterinarian;

use Illuminate\Support\Facades\Gate;
use Livewire\Component;

class DashboardD extends Component
{
    public function render()
    {
        if(Gate::denies('manage-veterinarian')){
            abort(403);
        }
        return view('livewire.veterinarian.dashboard');
    }
}
