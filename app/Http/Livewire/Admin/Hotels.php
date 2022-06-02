<?php

namespace App\Http\Livewire\Admin;

use App\Models\Cage;
use App\Models\Hotel;
use App\Models\Pet;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Livewire\Component;
use Livewire\WithPagination;

class Hotels extends Component
{
    use WithPagination;
    
    public $modalFormVisible = false;
    public $modalDeleteVisible = false;
    public $modalDetailVisible = false;
    public $pet_id, $cage_id, $query, $user_id, $type_id, $cage_number, $days;
    public $hotel_status = 'hotel';
    public $status = 'dalam kandang';
    public $modelId;
    public $sortColumn = 'created_at';
    public $sortDirection = 'asc';
    public $sortBy = 'pet_id';       
    public $start_date = null;
    public $end_date = null;
    public $search;
    public $type; 
    public $petUpdate;
    public $perPage = 10;

    public $selectedUser = null;
    public $selectedPet = null;
    public $pet = null;

    
    /**
     * function for validation
     *
     * @return void
     */
    public function rules()
    {
        return [
            'selectedPet' => 'required',
            // 'size' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            // 'cage_id' => 'required',
            
        ];
    }

    public function mount($selectedPet=null)
    {  
        $this->resetPage();
        $this->resetVars();
    }

    /**
     * Show the form modal
     * of create function
     * @return void
     */
    public function createShowModal()
    {
        $this->resetValidation();
        $this->resetVars();
        $this->modalFormVisible = true;
    }

    public function updateShowModal($id)
    {
        // $this->resetValidation();
        $this->modelId = $id;
        $this->modalFormVisible = true;
        $this->loadModel();
    }

    public function deleteShowModal($id)
    {
        $this->modelId = $id;
        $this->modalDeleteVisible = true;
    }

    public function detailShowModal($id)
    {
        $this->modelId = $id;
        $this->modalDetailVisible = true;

        $data               = Hotel::find($this->modelId);
        $this->selectedUser = $data->pets->users->name;
        $this->selectedPet  = $data->pets->name;
        $this->type_id      = $data->pets->typepet->name;
        // $this->size         = $data->size;
        $this->start_date   = $data->start_date;
        $this->end_date     = $data->end_date;
        // $this->total_day    = $data->total_day;
        $this->cage_id      = $data->cages->typecages->alias ?? '';
        $this->cage_number  = $data->cages->number ?? '';
        $this->status       = $data->status;

    }

    public function loadModel()
    {
        $data                       = Hotel::find($this->modelId);
        $this->selectedPet          = $data->pet_id;
        $this->start_date           = $data->start_date;
        $this->end_date             = $data->end_date;
        $this->status               = $data->status;
        $this->cage_id              = $data->cage_id;
    }
        
    /**
     * create function
     *
     * @return void
     */
    public function create()
    {   
        $this->validate();
        $hotel = Hotel::create($this->modelData());
        $hotel->save();
        $cage = Cage::find($hotel->cage_id);
        $cage->counter = $cage->counter +1 ;
        $cage->save();
        $this->dispatchBrowserEvent('swal:modal', [
            'title'     => 'Sukses',
            'icon'      => 'success',
            'text'      => 'Data Boarding Berhasil Ditambahkan',
            'iconcolor' => 'green'
        ]);
        $this->modalFormVisible = false;
        $this->resetVars();
    }
    
    public function update()
    {
        $this->validate();
        Hotel::find($this->modelId)->update($this->modelData());
        $this->dispatchBrowserEvent('swal:modal', [
            'title'     => 'Sukses',
            'icon'      => 'success',
            'text'      => 'Data Boarding Berhasil Diubah',
            'iconcolor' => 'green'
        ]);
        $this->modalFormVisible = false;
    }

    public function delete()
    {
        Hotel::destroy($this->modelId);
        $this->modalDeleteVisible = false;
        $this->resetPage();
    }

    public function show()
    {
        $this->modalDetailVisible = false;
    }

    public function proceed()
    {
        $hotel = Hotel::findorFail($this->modelId);
        $hotel->status = 'dalam kandang';
        $hotel->save();
        $hotel->cages->counter = $hotel->cages->counter + 1 ;
        $hotel->cages->save();
        $this->modalDetailVisible = false;
    }

    public function finish()
    {
        $hotel  = Hotel::findorFail($this->modelId);
        $hotel->status = 'selesai';
        $hotel->save();
        $hotel->cages->counter = $hotel->cages->counter - 1 ;
        $hotel->cages->save();
        $this->modalDetailVisible = false;
    }
    
    /**
     * Fill model to create data
     *
     * @return void
     */
    public function modelData()
    {
        return [

            'pet_id'        => $this->selectedPet,
            // 'size'          => $this->size,
            'start_date'    => $this->start_date,
            'end_date'      => $this->end_date,
            // 'total_day'     => $this->total_day,
            'cage_id'       => $this->cage_id,
            'hotel_status'  => $this->hotel_status, 
            'status'        => $this->status 
        ];
    }
    
    /**
     * function for reset
     *
     * @return void
     */
    public function resetVars()
    {        
             $this->modelId        = null;   
             $this->selectedUser   = null;
             $this->selectedPet    = null;
             $this->type           = null;
             $this->start_date     = null;
             $this->end_date       = null;
            //  $this->size           = null;
            //  $this->total_day      = null;
             $this->cage_id        = null;
    }

    
    public function sortBy($field)
    {
        if($this->sortDirection =='asc'){
            $this->sortDirection ='desc';
        } 
        else {
            $this->sortDirection = 'asc';
        }
        
        return $this->sortBy = $field;
    }
    
    public function pets()
    {
        return Pet::where('user_id', )->get(); 
    }
    public function users()
    {
        return User::where('role_id', '>', 2)->get();
    }
    
    public function monitorings()
    {
        return view('livewire.admin.monitorings');
    }
    
    public function cats()
    {
        $cats = Cage::where('type_cage_id', '1')
        ->where('count', '>', 'counter' )
        ->get();

        return $cats;
    }
    
    public function dogs()
    {
        $dogs = Cage::where('type_cage_id', '2')
        ->where('count', '>', 'counter' )
        ->get();

        return $dogs;
    }
    
    public function updatedSelectedUser($user)
    {
        $this->pet = Pet::where('user_id', $user)
        // ->leftjoin('hotels', 'hotels.pet_id', '=', 'pets.id')
        // ->whereNull('hotels.pet_id')
        ->doesntHave('hotels')
        ->get();
        $this->selectedPet = NULL;
    }
    
    public function read()
    {
        return Hotel::query()
        ->search($this->search)
        ->orderBy($this->sortBy, $this->sortDirection)
        ->paginate($this->perPage);
    }

    public function render()
    {
        if(Gate::denies('manage-admins')){
            abort(403);
        }
        return view('livewire.admin.hotels', [
            'data'  => $this->read(),
            'cats'  => $this->cats(),
            'dogs'  => $this->dogs(),
            'pets'  => $this->pets(),
            'users' => $this->users(),
        ]);
    }
}
