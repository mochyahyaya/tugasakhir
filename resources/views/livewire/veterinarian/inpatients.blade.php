<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        List Data Rawat Inap
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
                 </div>
                 <div class="flex-2 float-right">
                     <x-jet-input id="name" type="text" wire:model.debounce.500ms="searchTerm" placeholder="Search..." />
                 </div>
                </div>  
             
                 {{-- Data Tables --}}
                 <!-- This example requires Tailwind CSS v2.0+ -->
             <div class="flex flex-col">
                 <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                   <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                     <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                       <table class="min-w-full divide-y divide-gray-200">
                         <thead class="bg-gray-50">
                           <tr>
                             <th wire:click="sortBy('petname')" scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                               Hewan Peliharaan
                               @include('partials._sort-icon', ['field' => 'petname'])
                             </th>
                             <th wire:click="sortBy('type')" scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                               Jenis
                               @include('partials._sort-icon', ['field' => 'type'])
                             </th>
                             <th wire:click="sortBy('start_date')" scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                               Tanggal Mulai
                               @include('partials._sort-icon', ['field' => 'start_date'])
                             </th>
                             <th wire:click="sortBy('end_date')" scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                               Tanggal Berakhir
                               @include('partials._sort-icon', ['field' => 'end_date'])
                             </th>
                             <th wire:click="sortBy('total_day')" scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                               Total Hari
                               @include('partials._sort-icon', ['field' => 'todal_day'])
                             </th>
                             <th wire:click="sortBy('cage')" scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                               Kandang
                               @include('partials._sort-icon', ['field' => 'cage'])
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
                                 {{$items->pets->typepet->name}}
                             </td>
                             <td class="px-6 py-4 whitespace-nowrap">
                              {{ \Carbon\Carbon::parse($items->start_date)->locale('id')->format('d M Y')}}
                             </td>
                             <td class="px-6 py-4 whitespace-nowrap">
                              {{ \Carbon\Carbon::parse($items->end_date)->locale('id')->format('d M Y')}}
                             </td>
                             <td class="px-6 py-4 whitespace-nowrap">
                                 {{$items->total_day}}
                             </td>
                             <td class="px-6 py-4 whitespace-nowrap">
                                 {{$items->cages->typecages->alias}} - {{$items->cages->number}} 
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
                 <div class="mt-5">
                     {{$data ->links()}}
                 </div>
               
                 {{-- Modal Form --}}
             
                 <x-jet-dialog-modal wire:model="modalFormVisible" >
                     @if ($modelId)
                     <x-slot name="title">
                         {{ __('Ubah Data Hotel') }}
                     </x-slot>
                     @else
                     <x-slot name="title">
                         {{ __('Tambah Data Hotel') }}
                     </x-slot>
                     @endif
  
                     <x-slot name="content" >
                      <div x-data="{type: 0}">
                        @if (!$modelId)
                        <div class="mt-4">
                          <x-jet-label for="user_id" value="{{ __('Nama Pemilik') }}" />
                          <select class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 block w-full" wire:model="selectedUser">
                                <option value="" selected>  Pilih Nama Pemilik </option>
                              @foreach ($users as $item)
                                <option value="{{$item->id}}">{{$item->name}}</option>
                              @endforeach
                            </select>
                          @error('selectedUser') <span class="error">{{ $message }}</span> @enderror
                       </div>
                       @endif

                       @if(!is_null($pet))
                       <div class="mt-4">
                        <x-jet-label for="user_id" value="{{ __('Nama Pet') }}" />
                        <select class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 block w-full" wire:model="selectedPet">
                              <option value="" selected>  Pilih Pet </option>
                            @foreach ($pet as $item)
                              <option value="{{$item->id}}">{{$item->name}} </option>
                            @endforeach
                          </select>
                        @error('selectedUser') <span class="error">{{ $message }}</span> @enderror
                     </div>
                     @endif                  
                         <div class="mt-4">
                           <x-jet-label for="type" value="{{ __('Jenis Hewan') }}" />
                           <select name="type" x-model="type" class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 block w-full">
                               <option selected>-- Jenis Hewan --</option>
                               <option value =1>Kucing</option>
                               <option value =2>Anjing</option>
                             </select>
                           @error('type') <span class="error">{{ $message }}</span> @enderror
                       </div>
                         {{-- <div class="mt-4">
                             <x-jet-label for="size" value="{{ __('Ukuran') }}" />
                             <x-jet-input id="size" class="block mt-1 w-full" type="text" wire:model.debounce.800ms="size" />
                             @error('size') <span class="error">{{ $message }}</span> @enderror
                         </div> --}}
                         <div class="mt-4">
                            <x-jet-label for="start_date" value="{{ __('Tanggal Mulai') }}" />
                            <x-datetime-picker wire:model="start_date" class="w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" />
                         </div>
                         <div class="mt-4">
                            <x-jet-label for="end_date" value="{{ __('Tanggal Berakhir') }}" />
                            <x-datetime-picker wire:model="end_date" class="w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" />
                        </div>
                        {{-- <div class="mt-4">
                          <x-jet-label for="total_day" value="{{ __('Total Hari') }}" />
                          <x-jet-input id="total_day" class="block mt-1 w-full" type="text" wire:model.debounce.800ms="total_day" />
                          @error('total_day') <span class="error">{{ $message }}</span> @enderror
                        </div> --}}
                            <div class="mt-4" x-show="type == 1">
                              <x-jet-label for="cage_id" value="{{ __('Kandang') }}" />
                              <select class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 block w-full" wire:model="cage_id" >
                                <option selected> -- Pilih Kandang -- </option>
                                @foreach($cats as $cat)
                                <option value="{{ $cat->id }}">{{ $cat->typecages->alias}} - {{$cat->number}}</option>
                                @endforeach
                                </select>
                              @error('cage_id') <span class="error">{{ $message }}</span> @enderror
                            </div> 
                            <div class="mt-4" x-show="type == 2">
                              <x-jet-label for="cage" value="{{ __('Kandang') }}" />
                              <select class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 block w-full" wire:model="cage_id" >
                                <option selected> -- Pilih Kandang --</option>
                                @foreach($dogs as $dog)
                                <option value="{{ $dog->id }}">{{ $dog->typecages->alias}} - {{$dog->number}}</option>
                                @endforeach
                                </select>
                              @error('cage_id') <span class="error">{{ $message }}</span> @enderror
                            </div>
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
                         {{ __('Detail Grooming') }}
                     </x-slot>
             
                     <x-slot name="content">
                     
                         <div class="flex flex-col py-8 overflow-hidden bg-white">
                             <span class="flex items-center gap-4 px-6 py-3 w-full">
                               <div class="flex items-center justify-center h-8 w-8 p-4 bg-red-500 rounded-full">
                                 <i class="fas fa-clipboard-list text-white"></i>
                               </div>
                               <div class="flex-grow">
                                 <h5 class="leading-tight text-sm text-gray-700 font-semibold">Nama Pemilik</h5>
                                 <span class="text-xs text-gray-500">{{$user_id}}</span>
                               </div>
                             </span>
                             <span class="flex items-center gap-4 px-6 py-3 w-full">
                               <div class="flex items-center justify-center h-8 w-8 p-4 bg-green-500 rounded-full">
                                 <i class="fas fa-stream text-white"></i>
                               </div>
                               <div class="flex-grow">
                                 <h5 class="leading-tight text-sm text-gray-700 font-semibold">Nama Hewan Peliharaan</h5>
                                 <span class="text-xs text-gray-500">{{$pet_id}}</span>
                               </div>
                             </span >
                             <span  class="flex items-center gap-4 px-6 py-3 w-full">
                               <div class="flex items-center justify-center h-8 w-8 p-4 bg-yellow-500 rounded-full">
                                 <i class="fas fa-address-book text-white"></i>
                               </div>
                               <div class="flex-grow">
                                 <h5 class="leading-tight text-sm text-gray-700 font-semibold">Jenis Hewan Peliharaan</h5>
                                 <span class="text-xs text-gray-500">{{$type_id}}</span>
                               </div>
                             </span>
                             <span class="flex items-center gap-4 px-6 py-3 w-full">
                               <div class="flex items-center justify-center h-8 w-8 p-4 bg-green-500 rounded-full">
                                 <i class="fas fa-stream text-white"></i>
                               </div>
                               <div class="flex-grow">
                                 <h5 class="leading-tight text-sm text-gray-700 font-semibold">Ukuran</h5>
                                 <span class="text-sm text-gray-500">{{$size}}<span class="text-xs text-gray-500">(60-70 cm)</span></span>
                               </div>
                             </span >
                             <span class="flex items-center gap-4 px-6 py-3 w-full">
                               <div class="flex items-center justify-center h-8 w-8 p-4 bg-yellow-500 rounded-full">
                                 <i class="fas fa-address-book text-white"></i>
                               </div>
                               <div class="flex-grow">
                                 <h5 class="leading-tight text-sm text-gray-700 font-semibold">Tanggal Mulai</h5>
                                 <span class="text-xs text-gray-500">{{$start_date}}</span>
                               </div>
                             </span>
                             <span class="flex items-center gap-4 px-6 py-3 w-full">
                               <div class="flex items-center justify-center h-8 w-8 p-4 bg-green-500 rounded-full">
                                 <i class="fas fa-stream text-white"></i>
                               </div>
                               <div class="flex-grow">
                                 <h5 class="leading-tight text-sm text-gray-700 font-semibold">Tanggal Berakhir</h5>
                                 <span class="text-xs text-gray-500">{{$end_date}}</span>
                               </div>
                             </span >
                             <span class="flex items-center gap-4 px-6 py-3 w-full">
                               <div class="flex items-center justify-center h-8 w-8 p-4 bg-yellow-500 rounded-full">
                                 <i class="fas fa-address-book text-white"></i>
                               </div>
                               <div class="flex-grow">
                                 <h5 class="leading-tight text-sm text-gray-700 font-semibold">Total Hari</h5>
                                 <span class="text-xs text-gray-500">{{$total_day}}</span>
                               </div>
                             </span>
                             <span class="flex items-center gap-4 px-6 py-3 w-full">
                               <div class="flex items-center justify-center h-8 w-8 p-4 bg-yellow-500 rounded-full">
                                 <i class="fas fa-address-book text-white"></i>
                               </div>
                               <div class="flex-grow">
                                 <h5 class="leading-tight text-sm text-gray-700 font-semibold">Kandang</h5>
                                 <span class="text-xs text-gray-500">{{$cage_id}} - {{$cage_number}}</span>
                               </div>
                             </span>
                           </div>
                             <button wire:click="accept" class="inline-flex items-center px-4 py-2 bg-blue-400 border border-white-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:ring focus:ring-blue-200 active:text-gray-800 active:bg-gray-50 disabled:opacity-25 transition">
                               Terima
                             </button>
                             <button wire:click="reject" class="inline-flex items-center px-4 py-2 bg-green-400 border border-white-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:ring focus:ring-blue-200 active:text-gray-800 active:bg-gray-50 disabled:opacity-25 transition">
                               Tolak
                             </button>
                     </x-slot>
             
                     <x-slot name="footer">
                         <x-jet-secondary-button wire:click="$toggle('modalDetailVisible')" wire:loading.attr="disabled">
                             {{ __('Tutup') }}
                         </x-jet-secondary-button>
                     </x-slot>
                 </x-jet-dialog-modal>   
             </div>
        </div>
    </div>
  </div>
  
  <script>
    $('.js-example-basic-single').select2({
      placeholder: 'Nama Pemilik', 
      width: '100%'
    });
  </script>

@section('scripts')
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
  