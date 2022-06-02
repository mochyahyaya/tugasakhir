<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            List Monitoring Pet {{$pet_name}}
        </h2>
      </x-slot>
      <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6">
                    <div class="flex px-4 py-3 sm:px-6">
                      <div class="flex-1 float-left">   
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
                                 <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                   Tanggal Masuk
                                 </th>
                                <th wire:click="sortBy('food')" scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider" style="cursor: pointer">
                                    Kondisi Makan
                                    @include('partials._sort-icon', ['field' => 'food'])
                                  </th>
                                 <th wire:click="sortBy('temperature')" scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider" style="cursor: pointer">
                                   Kondisi Suhu Badan
                                   @include('partials._sort-icon', ['field' => 'temperature'])
                                 </th>
                                 <th wire:click="sortBy('medicine')" scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider" style="cursor: pointer">
                                   Kebutuhan Obat
                                   @include('partials._sort-icon', ['field' => 'medicine'])
                                 </th>
                                 <th wire:click="sortBy('notes')" scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider" style="cursor: pointer">
                                   Keterangan
                                   @include('partials._sort-icon', ['field' => 'notes'])
                                 </th>
                                 <th wire:click="sortBy('photo')" scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Foto
                                    @include('partials._sort-icon', ['field' => 'photo'])
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
                                  {{ \Carbon\Carbon::parse($items->created_at)->translatedFormat('d F Y H:i')}}
                                 </td>
                                <td class="px-4 py-4 whitespace-nowrap">
                                    {{$items->food}}
                                 </td>
                                 <td class="px-4 py-4 whitespace-nowrap">
                                    {{$items->temperature}}
                                 </td>
                                 <td class="px-4 py-4 whitespace-nowrap">
                                    {{$items->medicine}}
                                 </td>
                                 <td class="px-4 py-4 whitespace-nowrap">
                                     {!! $items->notes !!}
                                 </td>
                                 <td class="">
                                  <img src="{{ url('/storage/boardmonitoring/'.$items->photo )}}" alt="" class="h-12 w-12" alt="Image">
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
                       {{-- Showing {{$data -> firstItem()}} to {{$data -> lastItem()}} out of {{$data->total()}} items --}}
                     </div>
                     <div class="mt-5">
                         {{-- {{$data ->links()}} --}}
                     </div>
            </div>
      </div>
</div>
