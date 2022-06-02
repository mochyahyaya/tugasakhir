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
use Intervention\Image\Imagemanager;

class PetForm extends Component
{
    use WithPagination,WithFileUploads;

    public $modalFormVisible = false;
    public $modalDeleteVisible = false;
    public $modalDetailVisible = false;
    public $name, $type_id, $race, $size, $weight, $colour, $birthday, $featuredImage, $user_id;
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
    
    protected $listeners = [
        'getModelId',
        'forcedCloseModal'
    ];

    public function getModelId($modelId)
    {
        $this->modelId = $modelId;

        $data = Pet::find($this->modelId);
        
        $this->name = $data->name;
        $this->race = $data->race;
        $this->size = $data->size;
        $this->weight = $data->weight;
        $this->colour = $data->colour;
        // $this->feature_image = $data->featured_image;
        // $this->galery = $data->galery;
        $this->type_id = $data->type_id;
    }

    public function forcedCloseModal()
    {
        // This is to reset our public variables
        $this->cleanVars();

        // These will reset our error bags
        $this->resetErrorBag();
        $this->resetValidation();
    }

    private function cleanVars()
    {
        $this->modelId = null;
        $this->title = null;
        $this->content = null;
        $this->featuredImage = null;
        $this->additionalPhotos = null;
    }

    public function save()
    {   
        // Data validation
        $validateData = [
            'name' => 'required',
            'type_id' => 'required',
            'size' => 'required',
            'weight' => 'required',
            'colour' => 'required',
            'birthday' => 'required',
        ];

        // Default data
        $data = [
            'name'           => $this->name,
            'race'           => $this->race,
            'size'           => $this->size,
            'weight'         => $this->weight,
            'colour'         => $this->colour,
            'type_id'        => $this->type_id,
            'birthday'       => $this->birthday,
            'user_id'        => Auth::user()->id
        ];

        if (!empty($this->featuredImage)) {
            $imageHashName = $this->featuredImage->hashName();

            // Append to the validation if image is not empty
            $validateData = array_merge($validateData, [
                'featuredImage' => 'image'
            ]);
            
            // This is to save the filename of the image in the database
            $data = array_merge($data, [
                'featured_image' => $imageHashName
            ]);
            
            // Upload the main image
            $this->featuredImage->store('public/images');

            // Create a thumbnail of the image using Intervention Image Library
            $manager = new ImageManager();
            $image = $manager->make('storage/images/'.$imageHashName)->resize(300, 200);
            $image->save('storage/photos_thumb/'.$imageHashName);
        }

        // Validation for the additional photos
        if (!empty($this->additionalPhotos)) {
            $validateData = array_merge($validateData, [
                'galery.*' => 'image'
            ]);
        }

        $this->validate($validateData);

        if ($this->modelId) {
            Pet::find($this->modelId)->update($data);
            $petInstanceId = $this->modelId;
        } else {            
            $petInstance = Pet::create($data);
            $petInstanceId = $petInstance->id;
        }

        // Uploads the images
        if (!empty($this->galery)) {
            foreach ($this->galery as $photo) {
                $photo->store('public/galery');

                // Save the filename in the additional_photos table
                Gallery::create([
                    'pet_id' => $petInstanceId,
                    'filename' => $photo->hashName()
                ]);
            }
        }

        $this->emit('refreshParent');
        $this->dispatchBrowserEvent('closeModal');
        $this->cleanVars();
    }

    public function typepets()
    {
        return TypePet::all();
    }

    public function render()
    {
        return view('livewire.pet-form',[
            'typepets' => $this->typepets()
        ]);
    }
}
