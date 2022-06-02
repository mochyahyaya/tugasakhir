<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        List Data Breeding
    </h2>
  </x-slot>
  <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6">
                    <div class="flex px-4 py-3 sm:px-6">
                     <div class="flex-1 float-left">   
                         <x-jet-button wire:click="createShowModal">
                             {{ __('Tambah') }}
                         </x-jet-button>
                         <a href="{{ route('admin/showmonitoringbreedings') }}"> 
                          <button class="inline-flex items-center px-4 py-2 bg-white border border-transparent rounded-md font-semibold text-xs text-black uppercase tracking-widest hover:bg-gray-500 active:bg-white focus:outline-none focus:border-white focus:ring focus:ring-white disabled:opacity-25 transition">
                            {{ __('Monitoring') }}
                          </a>
                        </div>
                     <div class="flex-2 float-right">
                         <x-jet-input id="name" type="text" wire:model.debounce.500ms="search" placeholder="Search..." />
                     </div>
                    </div>  
                 
                     {{-- Data Tables --}}
                     <!-- This example requires Tailwind CSS v2.0+ -->
                 <div class="flex flex-col">
                     <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                       <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                         <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
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
                           <table class="min-w-full divide-y divide-gray-200">
                             <thead class="bg-gray-50">
                               <tr>
                                 <th wire:click="sortBy('pet_id_2')" scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider" style="cursor: pointer">
                                   Nama Betina
                                   @include('partials._sort-icon', ['field' => 'pet_id_2'])
                                 </th>
                                 <th wire:click="sortBy('pet_id_1')" scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider" style="cursor: pointer">
                                   Nama Jantan
                                   @include('partials._sort-icon', ['field' => 'pet_id_1'])
                                 </th>
                                 <th wire:click="sortBy('start_date')" scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider" style="cursor: pointer">
                                   Tanggal Mulai
                                   @include('partials._sort-icon', ['field' => 'start_date'])
                                 </th>
                                 <th wire:click="sortBy('cage')"scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider" style="cursor: pointer">
                                   Kandang
                                   @include('partials._sort-icon', ['field' => 'cage'])
                                 </th>
                                 <th wire:click="sortBy('status')" scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider" style="cursor: pointer">
                                   Status
                                   @include('partials._sort-icon', ['field' => 'status'])
                                 </th>
                                 <th scope="col" class="relative px-6 py-3">
                                   <span class="sr-only">Lihat</span>
                                   <span class="sr-only">Ubah</span>
                                   <span class="sr-only">Hapus</span>
                                 </th>
                               </tr>
                             </thead>
                             <tbody class="bg-white divide-y divide-gray-200">
                                 @if ($data->count())
                                     @foreach ($data as $items)    
                               <tr>
                                 <td class="px-6 py-4 whitespace-nowrap">
                                     {{$items->pets->name}}
                                 </td>
                                 <td class="px-6 py-4 whitespace-nowrap">
                                     {{$items->pet_id_2}}
                                 </td>
                                 <td class="px-6 py-4 whitespace-nowrap">
                                  {{ \Carbon\Carbon::parse($items->start_date)->translatedFormat('d F Y')}}
                                 </td>
                                 <td class="px-6 py-4 whitespace-nowrap">
                                     {{$items->cages->typecages->alias ?? ''}} - {{$items->cages->number ?? ''}} 
                                 </td>
                                 <td class="px-6 py-4 whitespace-nowrap">
                                  @if($items->status == 'belum diproses')
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-200 text-green-800">
                                      {{$items->status}}
                                    </span>
                                  @elseif ( $items->status == 'diproses' ) 
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-200 text-green-800">
                                      {{$items->status}}
                                    </span>          
                                  @else
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-200 text-green-800">
                                      {{$items->status}}
                                    </span>
                                  @endif
                                 </td>
                                 <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                   <a href= "#" wire:click="detailShowModal({{$items->id}})" class="text-indigo-600 hover:text-indigo-900 mr-3">Lihat</a>
                                   <a href= "#" wire:click="updateShowModal({{$items->id}})" class="text-indigo-600 hover:text-indigo-900 mr-3">Edit</a>
                                   <a href= "#" wire:click="deleteShowModal({{$items->id}})" class="text-indigo-600 hover:text-indigo-900 mr-3">Hapus</a>
                                 </td>
                               </tr>
                               @endforeach
                               @endif
                             </tbody>
                           </table>
                         </div>
                       </div>
                     </div>
                   </div>
                     <div>
                       Showing {{$data -> firstItem()}} to {{$data -> lastItem()}} out of {{$data->total()}} items
                     </div>
                     <div class="mt-5">
                         {{$data ->links()}}
                     </div>
                   
                     {{-- Modal Form --}}
                 
                     <x-jet-dialog-modal wire:model="modalFormVisible">
                         @if ($modelId)
                         <x-slot name="title">
                             {{ __('Ubah Data Breeding') }}
                         </x-slot>
                         @else
                         <x-slot name="title">
                             {{ __('Tambah Data Breeding') }}
                         </x-slot>
                         @endif
                         
                         <x-slot name="content">
                            <div class="mt-4">
                              <x-jet-label for="pet1" value="{{ __('Nama Jantan') }}" />
                              <select wire:model.debounce.800ms="pet_id_1" class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 block w-full">
                                   <option selected>--Nama Jantan-- </option>
                               @foreach ($pet1 as $item)
                                    <option value="{{$item->name}}"> {{$item->name}}</option>
                                @endforeach
                              </select>
                              @error('pet_id_1') <span class="error">{{ $message }}</span> @enderror
                            </div>
                            <div class="mt-4" wire:ignore>
                              <x-jet-label for="user_id" value="{{ __('Nama Pemilik') }}" />
                              <select class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 block w-full" wire:model="selectedUser" id="selectpicker" style="width: 100%">
                                    <option value="">--Pilih Nama Pemilik--</option>
                                  @foreach ($users as $item)
                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                  @endforeach
                                </select>
                              @error('selectedUser') <span class="error">{{ $message }}</span> @enderror
                            </div>
                            @if(!is_null($pet))
                            <div class="mt-4">
                              <x-jet-label for="selectedPet" value="{{ __('Nama Pet') }}" />
                              <select class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 block w-full" wire:model="selectedPet"> 
                                    <option>--Nama hewan--</option>
                                  @foreach ($pet as $item)
                                    <option value= "{{$item->id}}">{{$item->name}}</option>
                                  @endforeach
                                </select>
                              @error('selectedPet') <span class="error">{{ $message }}</span> @enderror
                            </div>  
                            @endif
                            <div class="mt-4">
                               <x-jet-label for="service" value="{{ __('Jenis Hewan') }}" />
                               <select class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 block w-full" wire:model.debounce.800ms="type" >
                                    <option selected>--Jenis Hewan--</option>   
                                    <option value="kucing">Kucing</option>
                                    <option value="anjing">Anjing</option>
                                 </select>
                               @error('type') <span class="error">{{ $message }}</span> @enderror
                            </div>
                            <div class="mt-4">
                              <x-jet-label for="start_date" value="{{ __('Tanggal Mulai') }}" />
                              <x-datetime-picker wire:model="start_date" class="w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" />
                            </div>
                            <div class="mt-4">
                              <x-jet-label for="cages" value="{{ __('Kandang') }}" />
                              <select class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 block w-full" wire:model="cage_id" >
                                <option selected>--Pilih Kandang--</option>
                                @foreach($cages as $cages)
                                <option value="{{ $cages->id }}">{{ $cages->typecages->alias}} - {{$cages->number}}</option>
                                @endforeach
                                </select>
                              @error('cage_id') <span class="error">{{ $message }}</span> @enderror
                            </div>
                         </x-slot>
                     
                         <x-slot name="footer">
                             <x-jet-secondary-button wire:click="$toggle('modalFormVisible')" wire:loading.attr="disabled">
                                 {{ __('Batalkan') }}
                             
                             @if ($modelId)
                             <x-jet-button class="ml-2" wire:click="update" wire:loading.attr="disabled">
                                 {{ __('Ubah') }}
                             </x-jet-danger-button>
                             @else
                             <x-jet-button class="ml-2" wire:click="create" wire:loading.attr="disabled">
                                 {{ __('Simpan') }}
                             </x-jet-danger-button>
                             @endif
                         </x-jet-secondary-button>
                         </x-slot>
                     </x-jet-dialog-modal>

                     {{-- Modal Update --}}

                     {{-- <x-jet-dialog-modal wire:model="modalUpdateVisible">
                      
                      @if ($modelId)
                      <x-slot name="title">
                          {{ __('Ubah Data Breeding') }}
                      </x-slot>
                      @else
                      <x-slot name="title">
                          {{ __('Tambah Data Breeding') }}
                      </x-slot>
                      @endif
                      
                      <x-slot name="content">
                         <div class="mt-4">
                           <x-jet-label for="pet1" value="{{ __('Nama Jantan') }}" />
                           <select wire:model.debounce.800ms="pet_id_1" class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 block w-full">
                            @foreach ($pet1 as $item)
                                 <option value="{{$item->name}}"> {{$item->name}}</option>
                             @endforeach
                           </select>
                           @error('pet_id_1') <span class="error">{{ $message }}</span> @enderror
                         </div>
                         <div class="mt-4" wire:ignore>
                           <x-jet-label for="user_id" value="{{ __('Nama Pemilik') }}" />
                           <select class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 block w-full" wire:model="selectedUser" id="selectpicker" style="width: 100%">
                               @foreach ($users as $item)
                                 <option value="{{$item->id}}">{{$item->name}}</option>
                               @endforeach
                             </select>
                           @error('selectedUser') <span class="error">{{ $message }}</span> @enderror
                         </div>
                         @if(!is_null($pet))
                         <div class="mt-4">
                           <x-jet-label for="selectedPet" value="{{ __('Nama Pet') }}" />
                           <select class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 block w-full" wire:model="selectedPet"> 
                               @foreach ($pet as $item)
                                 <option value= "{{$item->id}}">{{$item->name}}</option>
                               @endforeach
                             </select>
                           @error('selectedPet') <span class="error">{{ $message }}</span> @enderror
                         </div>  
                         @endif
                         <div class="mt-4">
                            <x-jet-label for="service" value="{{ __('Jenis Hewan') }}" />
                            <select class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 block w-full" wire:model.debounce.800ms="type" >
                                 <option value="kucing">Kucing</option>
                                 <option value="anjing">Anjing</option>
                              </select>
                            @error('type') <span class="error">{{ $message }}</span> @enderror
                         </div>
                         <div class="mt-4">
                           <x-jet-label for="start_date" value="{{ __('Tanggal Mulai') }}" />
                           <x-datetime-picker wire:model="start_date" class="w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" />
                         </div>
                         <div class="mt-4">
                           <x-jet-label for="cages" value="{{ __('Kandang') }}" />
                           <select class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 block w-full" wire:model="cage_id" >
                             @foreach($cages as $cages)
                             <option value="{{ $cages->id}}">{{ $cages->typecages->alias ?? '' }} - {{$cages->number ?? ''}}</option>
                             @endforeach
                             </select>
                           @error('cage_id') <span class="error">{{ $message }}</span> @enderror
                         </div>
                      </x-slot>
                  
                      <x-slot name="footer">
                          <x-jet-secondary-button wire:click="$toggle('modalUpdateVisible')" wire:loading.attr="disabled">
                              {{ __('Batalkan') }}
                          <x-jet-button class="ml-2" wire:click="update" wire:loading.attr="disabled">
                              {{ __('Ubah') }}
                          </x-jet-danger-button>
                      </x-jet-secondary-button>
                      </x-slot>
                  </x-jet-dialog-modal> --}}
                 
                     {{-- Delete modal --}}
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
                 
                     {{-- Detail Modal --}}
                     <x-jet-dialog-modal wire:model="modalDetailVisible">
                         <x-slot name="title">
                             {{ __('Detail Breeding') }}
                         </x-slot>
                 
                         <x-slot name="content">
                         
                             <div class="flex flex-col py-8 overflow-hidden bg-white">
                                 <span class="flex items-center gap-4 px-6 py-3 w-full">
                                   <div class="flex items-center justify-center h-8 w-8 p-4 bg-red-500 rounded-full">
                                     <i class="fas fa-clipboard-list text-white"></i>
                                   </div>
                                   <div class="flex-grow">
                                     <h5 class="leading-tight text-sm text-gray-700 font-semibold">Nama Pemilik</h5>
                                     <span class="text-xs text-gray-500">{{$selectedUser}}</span>
                                   </div>
                                 </span>
                                 <span class="flex items-center gap-4 px-6 py-3 w-full">
                                   <div class="flex items-center justify-center h-8 w-8 p-4 bg-green-500 rounded-full">
                                     <i class="fas fa-stream text-white"></i>
                                   </div>
                                   <div class="flex-grow">
                                     <h5 class="leading-tight text-sm text-gray-700 font-semibold">Nama Pet Betina</h5>
                                     <span class="text-xs text-gray-500">{{$selectedPet}}</span>
                                   </div>
                                 </span >
                                 <span class="flex items-center gap-4 px-6 py-3 w-full">
                                  <div class="flex items-center justify-center h-8 w-8 p-4 bg-green-500 rounded-full">
                                    <i class="fas fa-stream text-white"></i>
                                  </div>
                                  <div class="flex-grow">
                                    <h5 class="leading-tight text-sm text-gray-700 font-semibold">Nama Pet Jantan</h5>
                                    <span class="text-xs text-gray-500">{{$pet_id_1}}</span>
                                  </div>
                                </span >
                                 <span  class="flex items-center gap-4 px-6 py-3 w-full">
                                   <div class="flex items-center justify-center h-8 w-8 p-4 bg-yellow-500 rounded-full">
                                     <i class="fas fa-address-book text-white"></i>
                                   </div>
                                   <div class="flex-grow">
                                     <h5 class="leading-tight text-sm text-gray-700 font-semibold">Jenis Pet</h5>
                                     <span class="text-xs text-gray-500">{{$type_id}}</span>
                                   </div>
                                 </span>
                                 <span class="flex items-center gap-4 px-6 py-3 w-full">
                                   <div class="flex items-center justify-center h-8 w-8 p-4 bg-green-500 rounded-full">
                                     <i class="fas fa-stream text-white"></i>
                                   </div>
                                   <div class="flex-grow">
                                     <h5 class="leading-tight text-sm text-gray-700 font-semibold">Status</h5>
                                     <span class="text-xs text-gray-500">{{$status}}</span>
                                   </div>
                                 </span>
                               </div>
                                @if ($status == 'belum diproses')
                                  <button wire:click="proceed(id)" class="inline-flex items-center px-4 py-2 bg-blue-400 border border-white-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:ring focus:ring-blue-200 active:text-gray-800 active:bg-gray-50 disabled:opacity-25 transition">
                                    Proses
                                  </button>
                                @elseif($status == 'proses')
                                  <button wire:click="finish(id)" class="inline-flex items-center px-4 py-2 bg-green-400 border border-white-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:ring focus:ring-blue-200 active:text-gray-800 active:bg-gray-50 disabled:opacity-25 transition">
                                    Selesai
                                  </button>
                                @elseif ($status == 'selesai')
                                  <div></div>
                                @endif
                         </x-slot>
                 
                         <x-slot name="footer">
                             <x-jet-secondary-button wire:click="finish" wire:loading.attr="disabled">
                                 {{ __('Tutup') }}
                             </x-jet-secondary-button>
                         </x-slot>
                     </x-jet-dialog-modal>
                 </div>
  <div>

    @section('scripts')
    <script>
      $(document).ready(function() {
              $('#selectpicker').select2();
              $('#selectpicker').on('change', function(e) {
                  var data = $('#selectpicker').select2("val");
                  @this.set('selectedUser', data);
              });
      });
    </script>
    <script>
      window.addEventListener('swal:modal', event=>
      {
        Swal.fire({
          icon: event.detail.icon,
          iconcolor: event.detail.iconcolor,
          title: event.detail.title,
          text: event.detail.text,
          showConfirmButton: false,
          timer: 1500,
        });
      });
    </script>
  @endsection