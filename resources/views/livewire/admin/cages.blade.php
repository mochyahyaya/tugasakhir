<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        List Data Kandang
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
                                <th wire:click="sortBy('type_cage_id')" scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider" style="cursor: pointer">
                                    Kandang
                                    @include('partials._sort-icon', ['field' => 'alias'])
                                  </th>
                                 <th wire:click="sortBy('type_cage_id')" scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider" style="cursor: pointer">
                                   Jenis Kandang
                                   @include('partials._sort-icon', ['field' => 'type_id'])
                                 </th>
                                 <th wire:click="sortBy('number')" scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider" style="cursor: pointer">
                                   Nomor Kandang
                                   @include('partials._sort-icon', ['field' => 'number'])
                                 </th>
                                 <th wire:click="sortBy('count')" scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider" style="cursor: pointer">
                                   Muatan
                                   @include('partials._sort-icon', ['field' => 'count'])
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
                                    {{$items->typecages->alias}} - {{$items->number}}
                                 </td>
                                 <td class="px-6 py-4 whitespace-nowrap">
                                    {{$items->typecages->name}}
                                 </td>
                                 <td class="px-6 py-4 whitespace-nowrap">
                                    {{$items->number}}
                                 </td>
                                 <td class="px-6 py-4 whitespace-nowrap">
                                     {{$items->count}}
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
                             {{ __('Ubah Data Grooming') }}
                         </x-slot>
                         @else
                         <x-slot name="title">
                             {{ __('Tambah Data Grooming') }}
                         </x-slot>
                         @endif     
                         <x-slot name="content">
                            <div class="mt-4">
                                <x-jet-label for="service" value="{{ __('Jenis Kandang') }}" />
                                <select class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 block w-full" wire:model.debounce.800ms="type_cage_id" >
                                        <option selected>-- Jenis Kandang --</option>  
                                  @foreach ($typecages as $type)
                                        <option value="{{$type->id}}">{{$type->alias}}</option>                                       
                                    @endforeach
                                  </select>
                                @error('type') <span class="error">{{ $message }}</span> @enderror
                            </div>  
                             <div class="mt-4">
                                 <x-jet-label for="number" value="{{ __('Nomor Kandang') }}" />
                                 <x-jet-input id="number" class="block mt-1 w-full" type="text" wire:model.debounce.800ms="number" />
                                 @error('number') <span class="error">{{ $message }}</span> @enderror
                             </div>
                             <div class="mt-4">
                                <x-jet-label for="count" value="{{ __('Muatan') }}" />
                                <x-jet-input id="count" class="block mt-1 w-full" type="text" wire:model.debounce.800ms="count" />
                                @error('count') <span class="error">{{ $message }}</span> @enderror
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
                                     <h5 class="leading-tight text-sm text-gray-700 font-semibold">Jenis Kandang</h5>
                                     <span class="text-xs text-gray-500">{{$name}}</span>
                                   </div>
                                 </span>
                                 <span class="flex items-center gap-4 px-6 py-3 w-full">
                                   <div class="flex items-center justify-center h-8 w-8 p-4 bg-green-500 rounded-full">
                                     <i class="fas fa-stream text-white"></i>
                                   </div>
                                   <div class="flex-grow">
                                     <h5 class="leading-tight text-sm text-gray-700 font-semibold">Nomor Kandang</h5>
                                     <span class="text-xs text-gray-500">{{$number}}</span>
                                   </div>
                                 </span >
                                 <span  class="flex items-center gap-4 px-6 py-3 w-full">
                                   <div class="flex items-center justify-center h-8 w-8 p-4 bg-yellow-500 rounded-full">
                                     <i class="fas fa-address-book text-white"></i>
                                   </div>
                                   <div class="flex-grow">
                                     <h5 class="leading-tight text-sm text-gray-700 font-semibold">Muatan</h5>
                                     <span class="text-xs text-gray-500">{{$count}}</span>
                                   </div>
                                 </span>
                               </div>
                         </x-slot>
                 
                         <x-slot name="footer">
                             <x-jet-secondary-button wire:click="finish" wire:loading.attr="disabled">
                                 {{ __('Tutup') }}
                             </x-jet-secondary-button>
                         </x-slot>
                     </x-jet-dialog-modal>
                 </div>
        </div>
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