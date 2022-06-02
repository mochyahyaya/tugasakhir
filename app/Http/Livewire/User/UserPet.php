<?php

namespace App\Http\Livewire\User;

use Illuminate\Support\Facades\Auth;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Livewire\Component;

use App\Models\Pet;
use App\Models\TypePet;

class UserPet extends Component
{
    use WithPagination,WithFileUploads;

    public $modalFormVisible = false;
    public $modalDetailVisible = false;
    public $modalDeleteVisible = false;
    public $modelId;
    public $name, $type_id, $race, $size, $weight, $colour, $birthday, $feature_image, $user_id, $gender;

    public function mount()
    {
        $this->resetPage();
    }

    public function rules()
    {
        return [
            'name'          => 'required',
            'type_id'       => 'required',
            'size'          => 'required',
            'weight'        => 'required',
            'colour'        => 'required',
            'birthday'      => 'required',
            'gender'        => 'required',
            'feature_image' => 'image',
            
        ];
    }

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
    
    public function loadModel()
    {
        
        $data = Pet::find($this->modelId);
        $this->name = $data->name;
        $this->race = $data->race;
        $this->size = $data->size;
        $this->weight = $data->weight;
        $this->colour = $data->colour;
        $this->feature_image = $data->featured_image;
        $this->galery = $data->galery;
        $this->type_id = $data->type_id;
        $this->gender = $data->gender;
        $this->birthday = $data->birthday;
    }

    public function create()
    {   
        if (!empty($this->feature_image)) {
            $this->feature_image->store('public/featured_image');
            }
        $this->validate();
        Pet::create($this->modelData());
        $this->modalFormVisible = false;
        $this->resetVars();
    }

    public function update()
    {
        if (!empty($this->feature_image)) {
            $this->feature_image->store('public/featured_image');
            }
        $this->validate();
        Pet::find($this->modelId)->update($this->modelData());
        $this->modalFormVisible = false;
    }

    public function delete()
    {
        Pet::destroy($this->modelId);
        $this->modalDeleteVisible = false;
        $this->resetPage();
    }

    public function modelData()
    { 

        return [
            'name'           => $this->name,
            'race'           => $this->race,
            'size'           => $this->size,
            'weight'         => $this->weight,
            'colour'         => $this->colour,
            'type_id'        => $this->type_id,
            'birthday'       => $this->birthday,
            'featured_image' => $this->feature_image->hashName(),
            'user_id'        => Auth::user()->id,
            'gender'         => $this->gender,
        ];
    }
    
    public function resetVars()
    {        
             $this->modelId = null;   
             $this->name = null;
             $this->race = null;
             $this->size = null;
             $this->weight = null;
             $this->colour = null;
             $this->type_id = null;
             $this->gender = null;
             $this->feature_image = null;
             $this->galery = null;
    }

    public function typepets()
    {
        return TypePet::all();
    }

    public function read()
    {
        return Pet::where('user_id', Auth::id())->get();
    }

    public function render()
    {
        return view('livewire.user.user-pet', [
            'data' => $this->read(),
            'typepets' => $this->typepets()
        ])->extends('layouts.user')->section('content');
    }
}
