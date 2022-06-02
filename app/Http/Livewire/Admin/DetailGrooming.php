<?php

namespace App\Http\Livewire\Admin;

use App\Models\Groom;
use Livewire\Component;

class DetailGrooming extends Component
{
    public function read()
    {
        return Groom::paginate(5);
    }
    public function render(Groom $groom)
    {
        return view('livewire.detail-grooming', [
            'groom' => $groom
    ]);
    }
}
