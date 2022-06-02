<?php

namespace App\Http\Livewire\Admin;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Asantibanez\LivewireCharts\Models\ColumnChartModel;

class Home extends Component
{
    public function mount()
    {
        $user = Auth::user();
        if ($user->role_id == 1)
        {
            redirect()->to('/admin/dashboard');
        } else if ($user->role_id == 2)
        {
            redirect()->to('/veterinarian/dashboard');
        }
        else if ($user->role_id == 3)
        {
            return redirect()->to('/user/dashboard');
        }
    }
    public function render()
    {
        $view = $this->getView();

    }
    private function getView()
    {
        /** @var User $user */
        $user = Auth::user();
        if ($user->role_id == 1)
        {
            return 'livewire.admin.dashboard';
        } else if ($user->role_id == 2)
        {
            return 'livewire.veterinarian.dashboard';
        }
        else if ($user->role_id == 3)
        {
            return 'livewire.user.dashboard';
        }
    }
}
