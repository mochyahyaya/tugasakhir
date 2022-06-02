<?php

namespace App\Http\Livewire\Admin;

use Illuminate\Support\Facades\Gate;
use Livewire\WithPagination;
use Livewire\Component;
use App\Models\User;
use App\Models\Breeding;
use App\Models\Cage;
use App\Models\Pet;

class Breedings extends Component
{

    use WithPagination;
    
    public $modalFormVisible = false;
    public $modalUpdateVisible = false;
    public $modalDeleteVisible = false;
    public $modalDetailVisible = false;
    public $pet_id_1, $cage_id, $query, $user_id, $type_id, $cage_number;
    public $hotel_status = 'hotel';
    public $status = 'proses';
    public $modelId;
    public $sortColumn = 'created_at';
    public $sortDirection = 'asc';
    public $sortBy = 'pet_id_1';       
    public $start_date = null;
    public $end_date = null;
    public $search, $perPage;
    public $type= 1; 
    public $pet = null;
    public $selectedUser = null;
    public $selectedPet = null;
    /**
     * function for validation
     *
     * @return void
     */
    public function rules()
    {
        return [
            'selectedPet' => 'required',
            'pet_id_1' => 'required',
            'start_date' => 'required',
            'status' => 'required',
            'cage_id' => 'required',
            
        ];
    }

    public function mount($selectedPet=null)
    {
        $this->resetPage();
        $this->resetVars();

        $this->users = User::all();
        $this->pets = collect();
        $this->selectedPet = $selectedPet;

        if (!is_null($selectedPet)) {
            $pet = Pet::with('users')->find($selectedPet);
            if ($pet) {
                $this->pets = Pet::where('user_id', $pet->user_id)->get();
                $this->selectedUser = $pet->user_id;
            }
        }
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
        $this->resetValidation();
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

        $data = Breeding::find($this->modelId);
        $this->selectedUser     = $data->pets->users->name;
        $this->selectedPet      = $data->pets->name;
        $this->pet_id_1         = $data->pet_id_2;
        $this->type_id          = $data->pets->typepet->name;
        $this->start_date       = $data->start_date;
        $this->status           = $data->status;
        $this->cage_id          = $data->cages->typecages->alias ?? '';
        $this->cage_number      = $data->cages->number ?? '';

    }

    public function loadModel()
    {
            $data                       = Breeding::find($this->modelId);
            $this->pet_id_1             = $data->pet_id_2;
            $this->selectedPet          = $data->pet_id_1;
            $this->start_date           = $data->start_date;
            $this->status               = $data->end_date;
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
        $breeding = Breeding::create($this->modelData());
        $breeding->save();
        $cage = Cage::find($breeding->cage_id);
        $cage->counter = $cage->counter + 2;
        $cage->save();
        $this->dispatchBrowserEvent('swal:modal', [
            'title'     => 'Sukses',
            'icon'      => 'success',
            'text'      => 'Data Breeding Berhasil Ditambahkan',
            'iconcolor' => 'green'
        ]);
        $this->modalFormVisible = false;
        $this->resetVars();
    }
    
    public function update()
    {
        $this->validate();
        Breeding::find($this->modelId)->update($this->modelData());
        $this->dispatchBrowserEvent('swal:modal', [
            'title'     => 'Sukses',
            'icon'      => 'success',
            'text'      => 'Data Breeding Berhasil Diubah',
            'iconcolor' => 'green'
        ]);
        $this->modalFormVisible = false;
    }

    public function delete()
    {
        Breeding::destroy($this->modelId);
        $this->modalDeleteVisible = false;
        $this->resetPage();
    }

    public function show()
    {
        $this->modalDetailVisible = false;
    }

    public function proceed($id)
    {
        $breed  = Breeding::findorFail($this->modelId);
        $breed->status = 'proses';
        $breed->save();
        $breed->cages->counter = $breed->cages->counter + 2;
        $breed->cages->save();
        $this->modalDetailVisible = false;
    }

    public function finish($id)
    {
        $breed  = Breeding::findorFail($this->modelId);
        $breed->status = 'selesai';
        $breed->save();
        $breed->cages->counter = $breed->cages->counter - 2;
        $breed->cages->save();
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
            'pet_id_1'          => $this->selectedPet,
            'pet_id_2'          => $this->pet_id_1,
            'start_date'        => $this->start_date,
            'status'            => $this->status,
            'cage_id'           => $this->cage_id,
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
             $this->pet_id_1 = null;
             $this->selectedPet = null;
             $this->start_date = null;
             $this->cage_id = null;
    }

    public function read()
    {
        return Breeding::query()
        ->search($this->search)
        ->orderBy($this->sortBy, $this->sortDirection)
        ->paginate($this->perPage);
    }

    public function pets()
    {
        return Pet::where('user_id', 1)
        ->where('gender', 'Betina')
        ->get();
    }
    public function users()
    {
        return User::where('role_id', 3)->get();
    }

    public function monitorings()
    {
        return view('livewire.admin.monitorings');
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

    public function cages()
    {
        return Cage::where('type_cage_id', '3')
        ->where('count', '>', 'counter')
        ->get();
    }

    public function pet1()
    {
        return Pet::where('user_id', '1')->get();
    }

    public function updatedSelectedUser($user)
    {
        $this->pet = Pet::where('user_id', $user)
        ->where('gender', 'Betina')
        // ->leftjoin('breedings', 'breedings.pet_id_1', '=', 'pets.id')
        // ->whereNull('breedings.pet_id_1')
        ->doesntHave('breeds')
        ->get();
        $this->selectedPet = NULL;
    }
    public function render()
    {
        if(Gate::denies('manage-admins')){
            abort(403);
        }
        return view('livewire.admin.breedings', 
        [
            'data' => $this->read(),
            'pet1' => $this->pet1(),
            'cages' => $this->cages(),
            'pets' => $this->pets(),
            'users' => $this->users(),
        ]);
    }
}
