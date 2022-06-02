<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
    </h2>
  </x-slot>
    
<div class="py-12">
  <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
      <div class="p-6">
       <div class="flex px-4 py-3 sm:px-6">
          <div class="flex-1 float-left">   
            <div class="row mb-4">
              <div class="col form-inline">
                Per Page: &nbsp;
                <select wire:model="perPage" class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                <option>5</option>
                <option>10</option>
                <option>25</option>
                <option>50</option>
                </select>
              </div>
            </div>
          </div>
        <div class="flex-2 float-right">
            <x-jet-input id="name" type="text" wire:model.debounce.500ms="" placeholder="Search..." />
        </div>
      </div>  
        {{-- Data Tables --}}
        <!-- This example requires Tailwind CSS v2.0+ -->
      <div class="flex flex-col">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
          <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
            <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
              <section class="text-gray-600 body-font">
                <div class="container px-5 py-19 mx-auto">
                  <div class="flex flex-col text-center w-full mb-10">
                    <h1 class="sm:text-3xl text-2xl font-medium title-font mb-4 text-gray-900">Gallery Photo</h1>
                    <h3 class="sm:text-2xl text-1xl font-medium title-font mb-4 text-gray-900">{{$name}}</h3>
                  </div>
                  <div class="flex flex-wrap -m-4">
                    @foreach ($pet as $item)
                        <div class="lg:w-1/4 sm:w-1/2 p-2">
                            <div class="flex relative mb-6">
                                <img alt="gallery" class="absolute inset-0 w-full h-full object-fill object-center" src="{{ url('storage/galery/'.$item->filename )}}">
                                <div class="px-8 py-10 relative z-10 w-full border-4 border-gray-200 bg-white opacity-0 hover:opacity-100">
                                    <h2 class="tracking-widest text-sm title-font font-medium text-indigo-500 mb-1">{{$item->pets->name}}</h2>
                                    <h1 class="title-font text-lg font-medium text-gray-900 mb-3">{{$item->pets->race}}</h1>
                                    <p class="leading-relaxed">{{ \Carbon\Carbon::parse($item->pets->birthday)->locale('id')->format('d M Y')}}</p>
                                    <a href= "#" wire:click="deleteShowModal({{$item->id}})" class="text-indigo-600 hover:text-indigo-900 mr-3">Hapus</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                  </a>
                </div>
              </section>
            </div>
          </div>
        </div>
          <div>
            {{-- Showing {{$item -> firstItem()}} to {{$item -> lastItem()}} out of {{$item->total()}} items --}}
          </div>
          <div class="mt-5">
            {{-- {{$item ->links()}} --}}
          </div>
        </div>
      </div>
    </div>
  </div>

    <x-jet-dialog-modal wire:model="modalDeleteVisible">
      <x-slot name="title">
          {{ __('Hapus Data') }}
      </x-slot>

      <x-slot name="content">
          {{ __('Apakah Anda yakin untuk menghapus data ini? ') }}
      </x-slot>

      <x-slot name="footer">
          <x-jet-secondary-button wire:click="$toggle('modalDeleteVisible')" wire:loading.attr="disabled">
              {{ __('Batalkan') }}
          </x-jet-secondary-button>

          <x-jet-danger-button class="ml-2" wire:click="delete" wire:loading.attr="disabled">
              {{ __('Hapus Data') }}
          </x-jet-danger-button>
      </x-slot>
    </x-jet-dialog-modal>
</div>