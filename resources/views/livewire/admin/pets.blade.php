
<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        List Data Hewan
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
                       <table class="min-w-full divide-y divide-gray-200">
                         <thead class="bg-gray-50">
                           <tr>
                             <th wire:click="sortBy('name')" scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                               Hewan Peliharaan
                               @include('partials._sort-icon', ['field' => 'name'])
                             </th>
                             <th wire:click="sortBy('type_id')" scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                               Jenis
                               @include('partials._sort-icon', ['field' => 'type_id'])
                             </th>
                             <th wire:click="sortBy('race')" scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                              Ras
                              @include('partials._sort-icon', ['field' => 'race'])
                            </th>
                             <th wire:click="sortBy('weight')" scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Berat
                                @include('partials._sort-icon', ['field' => 'weight'])
                              </th>
                             <th wire:click="sortBy('colour')" scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                               Warna
                               @include('partials._sort-icon', ['field' => 'colour'])
                             </th>
                             <th wire:click="sortBy('birthday')" scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                               Ulang Tahun
                               @include('partials._sort-icon', ['field' => 'birthday'])
                             </th>
                             <th wire:click="sortBy('birthday')" scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                               Foto
                               @include('partials._sort-icon', ['field' => 'feature_image'])
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
                                 {{$items->name}}
                             </td>
                             <td class="px-6 py-4 whitespace-nowrap">
                                 {{$items->typepet->name}}
                             </td>
                             <td class="px-6 py-4 whitespace-nowrap">
                                 {{$items->race}}
                             </td>
                             <td class="px-6 py-4 whitespace-nowrap">
                                 {{$items->weight}} (kg)
                             </td>
                             <td class="px-6 py-4 whitespace-nowrap">
                                 {{$items->colour}}
                             </td>
                             <td class="px-6 py-4 whitespace-nowrap">
                              {{ \Carbon\Carbon::parse($items->birthday)->translatedFormat('d F Y')}}
                             </td>
                             <td class="px-6 py-4 whitespace-nowrap">
                                <img src="{{ url('storage/featured_image/'.$items->featured_image )}}" alt="{{ $items->name }}" class="h-10 w-10 rounded-full" alt="Image">
                             </td>
                             <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                               <a href="{{ route('admin/gallery', ['id'=>$items->id]) }}" class="text-indigo-600 hover:text-indigo-900 mr-3">Lihat</a>
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
             
                 <x-jet-dialog-modal wire:model="modalFormVisible">
                     @if ($modelId)
                     <x-slot name="title">
                         {{ __('Ubah Data Pet') }}
                     </x-slot>
                     @else
                     <x-slot name="title">
                         {{ __('Tambah Data Pet') }}
                     </x-slot>
                     @endif
  
                     <x-slot name="content">
                         <div class="mt-4">
                           <x-jet-label for="name" value="{{ __('Nama Hewan') }}" />
                           <x-jet-input id="name" class="block mt-1 w-full" type="text" wire:model.debounce.800ms="name" />
                           @error('name') <span class="error">{{ $message }}</span> @enderror
                         </div>    
                         <div class="mt-4">
                             <x-jet-label for="type" value="{{ __('Jenis') }}" />
                             <select class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 block w-full" wire:model="type_id" >
                              <option selected>-- Jenis Hewan --</option> 
                                @foreach($typepets as $type)
                                 <option value="{{ $type->id }}">{{ $type->name}}</option>
                                 @endforeach
                                </select>
                                @error('type_id') <span class="error">{{ $message }}</span> @enderror
                            </div> 
                            <div class="mt-4">
                             <x-jet-label for="size" value="{{ __('Ukuran') }}" />
                             <x-jet-input id="size" class="block mt-1 w-full" type="text" wire:model.debounce.800ms="size" />
                             @error('size') <span class="error">{{ $message }}</span> @enderror
                         </div>
                         <div class="mt-4">
                          <x-jet-label for="rac" value="{{ __('Ras') }}" />
                          <x-jet-input id="race" class="block mt-1 w-full" type="text" wire:model.debounce.800ms="race" />
                          @error('race') <span class="error">{{ $message }}</span> @enderror
                      </div>
                         <div class="mt-4">
                            <x-jet-label for="weight" value="{{ __('Berat') }}" />
                            <x-jet-input id="weight" class="block mt-1 w-full" type="text" wire:model.debounce.800ms="weight" />
                            @error('weight') <span class="error">{{ $message }}</span> @enderror
                        </div>
                         <div class="mt-4">
                           <x-jet-label for="colour" value="{{ __('Warna') }}" />
                           <x-jet-input id="colour" class="block mt-1 w-full" type="text" wire:model.debounce.800ms="colour" />
                           @error('colour') <span class="error">{{ $message }}</span> @enderror
                       </div>
                         <div class="mt-4">
                            <x-jet-label for="birthday" value="{{ __('Ulang Tahun') }}" />
                            <x-datetime-picker-allday wire:model="birthday" class="w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" />
                            @error('birthday') <span class="error">{{ $message }}</span> @enderror
                        </div>
                      <div class="mt-4">
                        <x-jet-label for="feature_image" value="{{ __('Foto') }}" />
                        <x-jet-input id="feature_image" class="block mt-1 w-full" type="file" wire:model.debounce.800ms="feature_image" enctype="multipart/form-data" />
                        @error('feature_image') <span class="error">{{ $message }}</span> @enderror
                    </div>
                    <div class="mt-4">
                      <x-jet-label for="gallery" value="{{ __('Galeri') }}" />
                      <x-jet-input id="galery" class="block mt-1 w-full" type="file" multiple wire:model.debounce.800ms="galery" enctype="multipart/form-data" />
                      @error('galery.*') <span class="error">{{ $message }}</span> @enderror
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
             </div>
        </div>
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