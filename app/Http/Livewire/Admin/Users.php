<?php

namespace App\Http\Livewire\Admin;

use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\WithPagination;

class Users extends Component
{
    use WithPagination;
    public $modalFormVisible = false;
    public $modalDeleteVisible = false;
    public $modalDetailVisible = false;
    public $name, $email, $role_id, $photo_profile_url, $phone_number, $address;
    public $modelId;
    public $search='';
    public $sortDirection = 'asc';
    public $sortBy = 'name';    
    public $sortColumn = 'created_at';  
    public $searchTerm;
    public $perPage = 10;

    public function rules()
    {
        return [
            'name' => 'required',
            'email' => 'required',
            'role_id' => 'required',
            'phone_number' => 'required',
            'address' => 'required'
        ];
    }

    public function mount()
    {
        $this->resetPage();
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
        $this->resetVars();
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

        $data = User::find($this->modelId);
        $this->name = $data->name;
        $this->email = $data->email;
        $this->role_id = $data->role_id;
        $this->phone_number = $data->phone_number;
        $this->address = $data->address;
        $this->photo_profile_url = $data->photo_profile_url;
    }

    public function loadModel()
    {
        $data = User::find($this->modelId);
        $this->name = $data->name;
        $this->email = $data->email;
        $this->role_id = $data->role_id;
        $this->phone_number = $data->phone_number;
        $this->address = $data->address;
        $this->photo_profile_url = $data->photo_profile_url;
    }
        
    /**
     * create function
     *
     * @return void
     */
    public function create()
    {   
        $this->validate();
        User::create($this->modelData());
        $this->dispatchBrowserEvent('swal:modal', [
            'title'     => 'Sukses',
            'icon'      => 'success',
            'text'      => 'Data Users Berhasil Ditambahkan',
            'iconcolor' => 'green'
        ]);
        $this->modalFormVisible = false;
        $this->resetVars();
    }
    
    public function update()
    {
        $this->validate();
        User::find($this->modelId)->update($this->modelData());
        $this->dispatchBrowserEvent('swal:modal', [
            'title'     => 'Sukses',
            'icon'      => 'success',
            'text'      => 'Data Users Berhasil Diubah',
            'iconcolor' => 'green'
        ]);
        $this->modalFormVisible = false;
    }

    public function delete()
    {
        User::destroy($this->modelId);
        $this->modalDeleteVisible = false;
        $this->resetPage();
    }

    public function modelData()
    {
        return [
            'name'                  => $this->name,
            'password'              => Hash::make( $this->name),
            'email'                 => $this->email,
            'phone_number'          => $this->phone_number,
            'address'               => $this->address,
            'photo_profile_url'     => $this->photo_profile_url,
            'role_id'               => $this->role_id,
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
             $this->name = null;
             $this->email = null;
             $this->role_id = null;
             $this->address = null;
             $this->phone_number = null;
             $this->photo_profile_url=null;
    }
    
    public function read()
    {
        return User::query()
        ->search($this->search)
        ->orderBy($this->sortBy, $this->sortDirection)
        ->paginate($this->perPage);
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


    public function render()
    {
        if (Gate::denies('manage-admins')) {
            abort(403);
        }
        return view('livewire.admin.users',[
            'data' => $this->read(),
        ]);
    }
}
