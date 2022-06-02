<div class="bg-gray-100">
<x-slot name="header">
  <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      Rekam Medis
  </h2>
</x-slot>
    <!-- End of Navbar -->

    <div class="container mx-auto my-5 p-5">
        <div class="md:flex no-wrap md:-mx-2 ">
            <!-- Left Side -->
            <div class="w-full md:w-3/12 md:mx-2">
                <!-- Profile Card -->
                <div class="bg-white p-3 border-t-4 border-blue-400">
                    @foreach ($pet as $items)
                    <div class="image overflow-hidden">
                        <img class="h-auto w-full mx-auto"
                            src="{{ url('storage/featured_image/'.$items->featured_image)}}"
                            alt="{{$items->image}}">
                    </div>
                    <h1 class="text-gray-900 font-bold text-xl leading-8 my-1">Pemilik</h1>
                    <h3 class="text-gray-900 font-lg text-semibold leading-6">{{$items->users->name}}</h3>
                    <ul
                        class="bg-gray-100 text-gray-600 hover:text-gray-700 hover:shadow py-2 px-3 mt-3 divide-y rounded shadow-sm">
                        <li class="flex items-center py-3">
                            <span>Status</span>
                                <span class="ml-auto">
                                    @if ($status == 'sehat')
                                        <span class="bg-green-500 py-1 px-2 rounded text-white text-sm"  
                                        wire:click="$toggle('status')"
                                        style="cursor: pointer">{{$status ? 'Sehat' : 'Sakit'}}
                                        </span>
                                    @else
                                        <span class="bg-yellow-500 py-1 px-2 rounded text-white text-sm"  
                                        wire:click="$toggle('status')"
                                        style="cursor: pointer">{{$status ? 'Sehat' : 'Sakit'}}
                                        </span>
                                    @endif
                                   
                            </span>
                        </li>
                        <li class="flex items-center py-3">
                            <span>Member since</span>
                            <span class="ml-auto">{{ \Carbon\Carbon::parse($items->created_at)->translatedFormat('d F Y')}}</span>
                        </li>
                    </ul>
                   @endforeach
                </div>
                <!-- End of profile card -->
                <div class="my-4"></div>
                <!-- Friends card -->
                <div class="bg-white p-3 hover:shadow">
                    <div class="flex items-center space-x-3 font-semibold text-gray-900 text-xl leading-8">
                        <span class="text-green-500">
                            <svg class="h-5 fill-current" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                        </span>
                        <span>Pet lain yang dimiliki</span>
                    </div>
                    <div class="grid grid-cols-3">
                        @foreach ($otherpets as $items)
                        <a href="{{ route('veterinarian/medicaldetails', ['id'=>$items->id]) }}">
                            <div class="text-center my-2">
                                <img class="h-16 w-16 rounded-full object-cover"
                                src="{{ url('storage/featured_image/'.$items->featured_image)}}"
                                alt="">
                            </div>
                            <span class="text-main-color">{{$items->name}}</span>
                        </a>
                        @endforeach
                    </div>
                </div>
                <!-- End of friends card -->
            </div>
            <!-- Right Side -->
            <div class="w-full md:w-9/12 mx-2 h-64">
                <!-- Profile tab -->
                <!-- About Section -->
                <div class="bg-white p-3 shadow-sm rounded-sm">
                    <div class="flex items-center space-x-2 font-semibold text-gray-900 leading-8">
                        <span clas="text-green-500">
                            <svg class="h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </span>
                        <span class="tracking-wide">About</span>
                    </div>
                    <div class="text-gray-700">
                        <div class="grid md:grid-cols-2 text-sm">
                            @foreach ($pet as $items)
                            <div class="grid grid-cols-2">
                                <div class="px-4 py-2 font-semibold">Nama</div>
                                <div class="px-4 py-2">{{$items->name}}</div>
                            </div>
                            <div class="grid grid-cols-2">
                                <div class="px-4 py-2 font-semibold">Gender</div>
                                <div class="px-4 py-2">{{$items->name}}</div>
                            </div>
                            <div class="grid grid-cols-2">
                                <div class="px-4 py-2 font-semibold">Ras</div>
                                <div class="px-4 py-2">{{$items->race}}</div>
                            </div>
                            <div class="grid grid-cols-2">
                                <div class="px-4 py-2 font-semibold">Berat</div>
                                <div class="px-4 py-2">{{$items->weight}} KG</div>
                            </div>
                            <div class="grid grid-cols-2">
                                <div class="px-4 py-2 font-semibold">Warna</div>
                                <div class="px-4 py-2">{{$items->colour}}</div>
                            </div>
                            <div class="grid grid-cols-2">
                                <div class="px-4 py-2 font-semibold">BirthDay</div>
                                <div class="px-4 py-2">{{ \Carbon\Carbon::parse($items->start_date)->translatedFormat('d F Y')}}</div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <!-- End of about section -->

                <div class="my-4"></div>

                <!-- Experience and education -->
                <div class="bg-white p-3 shadow-sm rounded-sm">

                    <div class="">
                        <div>
                            <div class="flex items-center space-x-2 font-semibold text-gray-900 leading-8 mb-3">
                                <span clas="text-green-500">
                                    <svg class="h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                </span>
                                <span class="tracking-wide">Medical Records</span>
                            </div>
                            <div class="overflow-x-auto">
                            <table class="table-auto w-full">
                                <thead class="text-xs font-semibold uppercase text-black bg-gray-200">
                                    <tr>
                                        <th class="p-2 whitespace-nowrap">
                                            <div class="font-semibold text-left">Gejala</div>
                                        </th>
                                        <th class="p-2 whitespace-nowrap">
                                            <div class="font-semibold text-left">Pengobatan</div>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="text-sm divide-y divide-gray-100">
                                    @foreach ($medicals as $item)
                                    <tr>
                                        <td class="p-2 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="font-medium text-gray-800">{{$item->indication}}</div>
                                            </div>
                                        </td>
                                        <td class="p-2 whitespace-nowrap">
                                            <div class="text-left">{{$item->medication}}</div>
                                        </td>
                                    </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    <div>
                </div>
                    </div>
                    <!-- End of Experience and education grid -->
                </div>
                <!-- End of profile tab -->

                <div class="my-4"></div>

                <form wire:submit="store">
                   <div class="bg-white p-3 shadow-sm rounded-sm">
                        <div class="mt-4">
                            <x-jet-label for="indication" value="{{ __('Gejala / Keluhan') }}" />
                            <x-jet-input id="indication" class="block mt-1 w-full" type="text" wire:model.debounce.800ms="indication" />
                            @error('indication') <span class="error">{{ $message }}</span> @enderror
                        </div>
                        <div class="mt-4">
                            <x-jet-label for="medication" value="{{ __('Pengobatan') }}" />
                            <x-jet-input id="medication" class="block mt-1 w-full" type="text" wire:model.debounce.800ms="medication" />
                            @error('medication') <span class="error">{{ $message }}</span> @enderror
                        </div>
                        {{-- <div class="mt-4">
                            <select wire:model="vaccinee" id="vaccinee" class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm block mt-1 w-full">
                                <option selected>Kosongkan jika tidak dibutuhkan</option>
                                    @foreach ($vaccinees as $item)
                                     <option value="{{$item->id}}">{{$item->name}}</option>
                                    @endforeach
                                    @error('vaccinee') <span class="error">{{ $message }}</span> @enderror
                            </select>
                        </div> --}}
                        <button type="submit" class="mt-2 inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition">
                            Tambah
                        </button>
                    </div>
                </form>
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