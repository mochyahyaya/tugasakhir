<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Cage;
use App\Models\TypeCage;
use Illuminate\Support\Facades\Gate;

class Cages extends Component
{
    use WithPagination;
    public $modalFormVisible = false;
    public $modalDeleteVisible = false;
    public $modalDetailVisible = false;
    public $number, $type_cage_id, $count, $name;
    public $modelId;
    public $search='';
    public $sortDirection = 'asc';
    public $sortBy = 'type_cage_id';    
    public $perPage = 10;

    public function rules()
    {
        return [
            'number'        => 'required',
            'type_cage_id'  => 'required',
            'count'         => 'required',
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

        $data = Cage::find($this->modelId);
        $this->number = $data->number;
        $this->type_cage_id = $data->type_cage_id;
        $this->name = $data->typecages->name;
        $this->count = $data->count;
    }

    public function loadModel()
    {
        $data = Cage::find($this->modelId);
        $this->number = $data->number;
        $this->type_cage_id = $data->type_cage_id;
        $this->count = $data->count;
    }
    /**
     * create function
     *
     * @return void
     */
    public function create()
    {   
        $this->validate();
        Cage::create($this->modelData());
        $this->dispatchBrowserEvent('swal:modal', [
            'title'     => 'Sukses',
            'icon'      => 'success',
            'text'      => 'Data Kandang Berhasil Ditambahkan',
            'iconcolor' => 'green'
        ]);
        $this->modalFormVisible = false;
        $this->resetVars();
    }
    
    public function update()
    {
        $this->validate();
        Cage::find($this->modelId)->update($this->modelData());
        $this->dispatchBrowserEvent('swal:modal', [
            'title'     => 'Sukses',
            'icon'      => 'success',
            'text'      => 'Data Kandang Berhasil Diubah',
            'iconcolor' => 'green'
        ]);
        $this->modalFormVisible = false;
    }

    public function delete()
    {
        Cage::destroy($this->modelId);
        $this->modalDeleteVisible = false;
        $this->resetPage();
    }

    public function show()
    {
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
            'number'        => $this->number,
            'type_cage_id'  => $this->type_cage_id,
            'count'         => $this->count,
            'counter'       => 0
        ];
    }
    
    /**
     * function for reset
     *
     * @return void
     */
    public function resetVars()
    {        
             $this->number  = null;   
             $this->type_cage_id = null;
             $this->count   = null;
    }
    
    public function read()
    {
        return Cage::query()
        ->search($this->search)
        ->orderBy($this->sortBy, $this->sortDirection)
        ->paginate($this->perPage);
    }

    public function typecages()
    {
        return TypeCage::all();
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
        if(Gate::denies('manage-admins'))
        {
            abort(403);
        }
        return view('livewire.admin.cages', [
            'data' => $this->read(), 
            'typecages' => $this->typecages()
        ]);
    }
}
