<?php

namespace App\Http\Livewire\Admin;

use App\Models\Groom;
use App\Models\Pet;
use App\Models\User;
use App\Models\Hotel;
use App\Notifications\GroomsNotification;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Gate;
use Livewire\Component;
use Livewire\WithPagination;

class Grooms extends Component
{
    use WithPagination;
    public $modalFormVisible = false;
    public $modalDeleteVisible = false;
    public $modalDetailVisible = false;
    public $modalUpdateVisible = false;
    public $pet_id, $user_id, $type_id, $service, $address;
    public $modelId;
    public $status = 'belum diproses';
    public $search='';
    public $sortDirection = 'asc';
    public $sortBy = 'pet_id';    
    public $perPage = 10;
    public $selectedUser = null;
    public $selectedPet = null;
    public $pet;
    /**
     * function for validation
     *
     * @return void
     */
    public function rules()
    {
        return [
            'selectedPet' => 'required',
            'service' => 'required',
            'address' => 'required',
            
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
        $this->resetVars();
        $this->resetValidation();
        $this->modalFormVisible = true;
    }

    public function updateShowModal($id)
    {
        $this->resetValidation();
        $this->modelId = $id;
        $this->modalUpdateVisible = true;
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

        $data               = Groom::find($this->modelId);
        $this->selectedUser = $data->pets->users->name;
        $this->selectedPet  = $data->pets->name;
        $this->type_id      = $data->pets->typepet->name;
        // $this->size         = $data->size;
        $this->address      = $data->address;
        $this->status       = $data->status;
        $this->service      = $data->service;

    }

    public function loadModel()
    {
        $data               = Groom::find($this->modelId);
        $this->selectedUser = $data->pets->users->name;
        $this->selectedPet  = $data->pets->name;
        $this->type_id      = $data->type_id;
        // $this->size         = $data->size;
        $this->service      = $data->service;
        $this->status       = $data->status;
        $this->address      = $data->address;
    }
        
    /**
     * create function
     *
     * @return void
     */
    public function create()
    {   
        $this->validate();
        $grooms = Groom::create($this->modelData());
        $this->dispatchBrowserEvent('swal:modal', [
            'title'     => 'Sukses',
            'icon'      => 'success',
            'text'      => 'Data Grooming Berhasil Ditambahkan',
            'iconcolor' => 'green'
        ]);
        $this->modalFormVisible = false;
        $this->resetVars();
    }
    
    public function update()
    {
        $this->validate();
        Groom::find($this->modelId)->update($this->modelData());
        $this->dispatchBrowserEvent('swal:modal', [
            'title'     => 'Sukses',
            'icon'      => 'success',
            'text'      => 'Data Grooming Berhasil Diubah',
            'iconcolor' => 'green'
        ]);
        $this->modalUpdateVisible = false;
        $this->resetVars();
    }

    public function delete()
    {
        Groom::destroy($this->modelId);
        $this->modalDeleteVisible = false;
        $this->resetPage();
    }

    public function show()
    {
        $this->modalDetailVisible = false;
    }

    public function proceed()
    {
        $groom  = Groom::findorFail($this->modelId);
        $groom->status = 'diproses';
        $groom->save();
        $this->modalDetailVisible = false;
    }

    public function finish()
    {
        $groom = Groom::findorFail($this->modelId);
        $groom->status = 'selesai';
        $groom->save();
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
            'pet_id'    => $this->selectedPet,
            'service'   => $this->service,
            'status'    => 'diproses',
            'address'   => $this->address,
        ];
    }
    
    /**
     * function for reset
     *
     * @return void
     */
    public function resetVars()
    {        
             $this->modelId = null;   
             $this->selectedUser = null;
             $this->selectedPet = null;
            //  $this->size = null;
             $this->service = null;
             $this->address = null;
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

    public function pets()
    {
        $pet= Pet::where('user_id', $this->selectedUser)
        ->leftjoin('grooms', 'grooms.pet_id', '=', 'pets.id')
        ->whereNull('grooms.pet_id')
        ->get();
        return $pet;
    }

    public function users()
    {
        return User::where('role_id', 3)->get();
    }

    public function updatedSelectedUser($user)
    {
        $this->pet = Pet::where('user_id', $user)
        // ->leftjoin('grooms', 'grooms.pet_id', '=', 'pets.id')
        ->doesntHave('grooms')
        ->get();
        // $this->selectedPet = NULL;
    }
    
    public function read()
    {
        return Groom::query()
        ->search($this->search)
        ->orderBy($this->sortBy, $this->sortDirection)
        ->paginate($this->perPage);
    }

    public function render()
    {
        if(Gate::denies('manage-admins')){
            abort(403);
        }
        return view('livewire.admin.grooms', [
            'data' => $this->read(),
            'pets' => $this->pets(),
            'users' => $this->users(),
        ]);
    }
}
