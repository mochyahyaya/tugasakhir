<?php

namespace App\Http\Livewire\Admin;

use App\Models\Breeding;
use App\Models\Cage;
use App\Models\Groom;
use App\Models\Pet;
use App\Models\User;
use App\Models\Hotel;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Asantibanez\LivewireCharts\Models\ColumnChartModel;
use Illuminate\Support\Facades\Gate;

class Dashboard extends Component
{
    public $message = 'Hello World!';
    public $notif, $notificationId;

    public function users() 
    {
        $users = User::where('role_id', 3)->count();
        return $users;
    }

    public function pets()
    {
        $pets = Pet::where('user_id', 1)->count();
        return $pets;
    }

    public function cages()
    {
        $cages = Cage::all()->count();
        return $cages;
    }

    public function grooms()
    {
        $groomcat = Groom::where('type', 'Kucing')->count();
        $groomdog = Groom::where('type', 'Anjing')->count();
        $columnChartModelgroom = 
        (new ColumnChartModel())
        ->setTitle('Grooming')
        ->addColumn('Kucing', $groomcat, '#349eeb')
        ->addColumn('Anjing', $groomdog, '#fc8181')
        ->withOnColumnClickEventName('onColumnClick');

        return $columnChartModelgroom;
    }

    public function hotels()
    {
        $hotelscat = Hotel::query()
                     ->leftJoin('pets', 'pets.id', '=', 'hotels.pet_id')
                     ->where('type_id', 1)
                     ->count();

        $hotelsdog = Hotel::query()
                     ->leftJoin('pets', 'pets.id', '=', 'hotels.pet_id')
                     ->where('type_id', 2)
                     ->count();

        $columnChartModelhotel = 
        (new ColumnChartModel())
        ->setTitle('Boarding')
        ->addColumn('Kucing', $hotelscat, '#349eeb')
        ->addColumn('Anjing', $hotelsdog, '#fc8181')
        ->withOnColumnClickEventName('onColumnClick');

        return $columnChartModelhotel;
    }

    public function breeds()
    {
        $breedscat = Breeding::query()
                     ->leftJoin('pets', 'pets.id', '=', 'breedings.pet_id_1')
                     ->where('type_id', 1)
                     ->count();
        
        $breeddog = Breeding::query()
                    ->leftJoin('pets', 'pets.id', '=', 'breedings.pet_id_1')
                    ->where('type_id', 2)
                    ->count();
        
        $columnChartModelbreed = 
        (new ColumnChartModel())
        ->setTitle('Breeding')
        ->addColumn('Kucing', $breedscat, '#349eeb')
        ->addColumn('Anjing', $breeddog, '#fc8181')
        ->withOnColumnClickEventName('onColumnClick');

        return $columnChartModelbreed;
    }

    public function markNotificationGroom($notificatiId)
    {
        $this->notificationId = $notificatiId;
         auth()->user()
            ->unreadNotifications
            ->when($this->notificationId, function ($query){
             return $query->where('id', $this->notificationId);
            })
            ->markAsRead();
        return redirect()->to('/admin/groom'); 
    }

    public function markNotificationHotel(Request $request)
    {
         auth()->user()
            ->unreadNotifications
            ->when($request->input('id'), function ($query) use ($request) {
             return $query->where('id', $request->input('id'));
            })
            ->markAsRead();

            return redirect()->to('/admin/hotels'); 
    }

    public function markNotificationBreeding(Request $request)
    {
         auth()->user()
            ->unreadNotifications
            ->when($request->input('id'), function ($query) use ($request) {
             return $query->where('id', $request->input('id'));
            })
            ->markAsRead();

        return redirect()->to('/admin/breeding'); 
    }

    public function markAll()
    {
        auth()->user()->unreadNotifications;
    }

    public function render()
    {
        $notifications  = auth()->user()->unreadNotifications; 
        if(Gate::denies('manage-admins')){
            abort(403);
        }
        
        return view('livewire.admin.dashboard')
        ->with([
            'columnChartModelgroom' => $this->grooms(),
            'columnChartModelbreed' => $this->breeds(),
            'columnChartModelboard' => $this->hotels(),
            'users'                 => $this->users(),
            'pets'                  => $this->pets(),
            'cages'                 => $this->cages(),
            'notifications'         => $notifications
        ]);
    }
}
