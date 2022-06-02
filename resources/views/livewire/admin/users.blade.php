<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        List Pengguna
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
                       <table class="center min-w-full divide-y divide-gray-200">
                         <thead class="bg-gray-50">
                           <tr>
                             <th wire:click="sortBy('name')" scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider" sortable direction="desc">
                               Nama
                               @include('partials._sort-icon', ['field' => 'name'])
                             </th>
                             <th wire:click="sortBy('phone_number')" scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                              Nomor Telepon
                              @include('partials._sort-icon', ['field' => 'phone_number'])
                            </th>
                            <th wire:click="sortBy('address')" scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                              Alamat
                              @include('partials._sort-icon', ['field' => 'address'])
                            </th>
                             <th wire:click="sortBy('role_id')" scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                               Role
                               @include('partials._sort-icon', ['field' => 'role_id'])
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
                              <div class="flex items-center">
                                <div class="flex-shrink-0 h-10 w-10">
                                  <img src="{{ $items->profile_photo_url }}" alt="{{ $items->name }}" class="h-10 w-10 rounded-full" alt="Profile">
                                </div>
                                <div class="ml-4">
                                  <div class="text-sm font-medium text-gray-900">
                                    {{$items->name}}
                                  </div>
                                  <div class="text-sm text-gray-500">
                                    {{$items->email}}
                                  </div>
                                </div>
                              </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap"> 
                              {{$items->phone_number}}
                            </td><td class="px-6 py-4 whitespace-nowrap"> 
                              {{$items->address}}
                            </td>
                             <td class="px-6 py-4 whitespace-nowrap"> 
                                {{$items->roles->name}}
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
                              
                <x-jet-dialog-modal wire:model="modalFormVisible">
                  @if ($modelId)
                  <x-slot name="title">
                      {{ __('Ubah Data Pengguna') }}
                  </x-slot>
                  @else
                  <x-slot name="title">
                      {{ __('Tambah Data Pengguna') }}
                  </x-slot>
                  @endif
  

                  <x-slot name="content">
                      <div class="mt-4">
                        <x-jet-label for="name" value="{{ __('Nama') }}" />
                        <x-jet-input id="name" class="block mt-1 w-full" type="text" wire:model.debounce.800ms="name" />
                        @error('name') <span class="error">{{ $message }}</span> @enderror
                      </div>    
                      <div class="mt-4">
                          <x-jet-label for="email" value="{{ __('Email') }}" />
                          <x-jet-input id="email" class="block mt-1 w-full" type="text" wire:model.debounce.800ms="email" />
                          @error('email') <span class="error">{{ $message }}</span> @enderror
                      </div>
                      <div class="mt-4">
                        <x-jet-label for="role_id" value="{{ __('Sebagai') }}" />
                        <select class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 block w-full" wire:model.debounce.800ms="role_id" >
                            <option value="1">Admin</option>
                            <option value="2">Dokter</option>
                            <option value="3">Pengguna</option>
                          </select>
                        @error('role_id') <span class="error">{{ $message }}</span> @enderror
                    </div>
                    <div class="mt-4">
                        <x-jet-label for="address" value="{{ __('Alamat') }}" />
                        <x-jet-input id="address" class="block mt-1 w-full" type="text" wire:model.debounce.800ms="address" />
                        @error('address') <span class="error">{{ $message }}</span> @enderror
                    </div>
                      <div class="mt-4">
                          <x-jet-label for="phone_number" value="{{ __('Nomor Telepon') }}" />
                          <x-jet-input id="phone_number" class="block mt-1 w-full" type="text" wire:model.debounce.800ms="phone_number" />
                          @error('phone_number') <span class="error">{{ $message }}</span> @enderror
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
              {{ __('Detail Pengguna') }}
          </x-slot>

  <x-slot name="content">
  
      <div class="flex flex-col py-8 overflow-hidden bg-white">
          <span class="flex items-center gap-4 px-6 py-3 w-full">
            <div class="flex items-center justify-center h-8 w-8 p-4 bg-red-500 rounded-full">
              <i class="fas fa-clipboard-list text-white"></i>
            </div>
            <div class="flex-grow">
              <h5 class="leading-tight text-sm text-gray-700 font-semibold">Nama Pemilik</h5>
              <span class="text-xs text-gray-500">{{$name}}</span>
            </div>
          </span>
          <span class="flex items-center gap-4 px-6 py-3 w-full">
            <div class="flex items-center justify-center h-8 w-8 p-4 bg-green-500 rounded-full">
              <i class="fas fa-stream text-white"></i>
            </div>
            <div class="flex-grow">
              <h5 class="leading-tight text-sm text-gray-700 font-semibold">Nama Hewan Peliharaan</h5>
              <span class="text-xs text-gray-500">{{$email}}</span>
            </div>
          </span >
          <span  class="flex items-center gap-4 px-6 py-3 w-full">
            <div class="flex items-center justify-center h-8 w-8 p-4 bg-yellow-500 rounded-full">
              <i class="fas fa-address-book text-white"></i>
            </div>
            <div class="flex-grow">
              <h5 class="leading-tight text-sm text-gray-700 font-semibold">Jenis Hewan Peliharaan</h5>
              <span class="text-xs text-gray-500">{{$phone_number}}</span>
            </div>
          </span>
          <span class="flex items-center gap-4 px-6 py-3 w-full">
            <div class="flex items-center justify-center h-8 w-8 p-4 bg-green-500 rounded-full">
              <i class="fas fa-stream text-white"></i>
            </div>
            <div class="flex-grow">
              <h5 class="leading-tight text-sm text-gray-700 font-semibold">Ukuran</h5>
              <span class="text-sm text-gray-500">{{$address}}</span>
            </div>
          </span >
          <span class="flex items-center gap-4 px-6 py-3 w-full">
            <div class="flex items-center justify-center h-8 w-8 p-4 bg-yellow-500 rounded-full">
              <i class="fas fa-address-book text-white"></i>
            </div>
            <div class="flex-grow">
              <h5 class="leading-tight text-sm text-gray-700 font-semibold">Sebagai</h5>
              <span class="text-xs text-gray-500">{{$role_id}}</span>
            </div>
          </span>
  </x-slot>

  <x-slot name="footer">
      <x-jet-secondary-button wire:click="$toggle('modalDetailVisible')" wire:loading.attr="disabled">
          {{ __('Tutup') }}
      </x-jet-secondary-button>
  </x-slot>
</x-jet-dialog-modal>
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