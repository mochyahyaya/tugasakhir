<?php

namespace App\Http\Livewire\Admin;

use App\Models\Gallery;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Models\Pet;
use App\Models\TypePet;
use Carbon\Carbon;
use Illuminate\Support\Facades\Gate;
use Intervention\Image\Imagemanager;

class Pets extends Component
{
    use WithPagination,WithFileUploads;

    public $modalFormVisible = false;
    public $modalDeleteVisible = false;
    public $modalDetailVisible = false;
    public $name, $type_id, $race, $size, $weight, $colour, $birthday, $feature_image, $user_id, $gender;
    public $modelId;
    public $search='';
    public $sortDirection = 'asc';
    public $sortBy = 'name';    
    public $perPage = 10;
    public $galery;
    /**
     * function for validation
     *
     * @return void
     */
    
    public function rules()
    {
        return [
            'name' => 'required',
            'type_id' => 'required',
            // 'size' => 'required',
            'weight' => 'required',
            'colour' => 'required',
            'birthday' => 'required',
            'feature_image' => 'image',
            'galery.*' => 'image'
            
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
        
        $this->emit('getPetId', $this->modelId);
        $this->modalDetailVisible = true;
        
    }

    public function loadModel()
    {
        
        $data = Pet::find($this->modelId);
        $this->name = $data->name;
        $this->race = $data->race;
        // $this->size = $data->size;
        $this->weight = $data->weight;
        $this->colour = $data->colour;
        $this->feature_image = $data->featured_image;
        $this->galery = $data->galery;
        $this->type_id = $data->type_id;
        $this->gender = $data->gender;
        $this->birthday = $data->birthday;
    }
        
    /**
     * create function
     *
     * @return void
     */
    public function create()
    {   
        if (!empty($this->feature_image)) {
            $this->feature_image->store('public/featured_image');
        }

        $this->validate();
        $pets = Pet::create($this->modelData());
        $petId = $pets->id;

        
        if (!empty($this->galery)) {
            foreach ($this->galery as $photo) {
                $photo->store('public/galery');

                // Save the filename in the additional_photos table
                Gallery::create([
                    'pet_id' => $petId,
                    'filename' => $photo->hashName()
                ]);
            }
        }
        $this->dispatchBrowserEvent('swal:modal', [
            'title'     => 'Sukses',
            'icon'      => 'success',
            'text'      => 'Data Pets Berhasil Ditambahkan',
            'iconcolor' => 'green'
        ]);
        
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

        $this->dispatchBrowserEvent('swal:modal', [
            'title'     => 'Sukses',
            'icon'      => 'success',
            'text'      => 'Data Pets Berhasil Diubah',
            'iconcolor' => 'green'
        ]);
        
        $this->modalFormVisible = false;
    }

    public function delete()
    {
        Pet::destroy($this->modelId);
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
            'name'           => $this->name,
            'race'           => $this->race,
            // 'size'           => $this->size,
            'weight'         => $this->weight,
            'colour'         => $this->colour,
            'type_id'        => $this->type_id,
            'birthday'       => $this->birthday,
            'featured_image' => $this->feature_image->hashName(),
            'user_id'        => Auth::user()->id,
            'gender'         => 'Jantan'
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
             $this->race = null;
            //  $this->size = null;
             $this->weight = null;
             $this->colour = null;
             $this->type_id = null;
             $this->feature_image = null;
             $this->galery = null;
    }

    public function read()
    {
        return Pet::where('user_id', 1)->get();
    }

    public function search()
    {
        return Pet::query()
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

    public function typepets()
    {
        return TypePet::all();
    }

    public function render()
    {
        if(Gate::denies('manage-admins')){
            abort(403);
        }
        return view('livewire.admin.pets',[
            'data' => $this->search(),
            'search' => $this->read(),
            'typepets' => $this->typepets(),
            'galery' => $this->detailShowModal($this->modelId),
        ]);
    }

}
