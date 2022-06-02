<div>
    <style>
        .hover-trigger .hover-target {
            display: none;
        }
        
        .hover-trigger:hover .hover-target {
            display: block;
        }
        .dropdown:hover .dropdown-menu {
        display: block;
        }
    </style>

    <header id="header-wrap" class="relative">
        <!-- Navbar Start -->      
        <div class="navigation fixed top-0 left-0 w-full z-30 duration-300">
            <div class="container">
                <nav class="navbar py-2 navbar-expand-lg flex justify-between items-center relative duration-300">
                    <a class="navbar-brand" href="{{ route('user/dashboard')}}">
                      <img src="../shine/assets/img/Logo.png" alt="Logo" style="width: 90px; height:45px">
                    </a>
                    <a  href="{{ route('user/dashboard')}}"><span class="inline font-mono font-semibold text-blue-500">Garden Petshop</span></a>
                    <button class="navbar-toggler focus:outline-none block lg:hidden" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="toggler-icon"></span>
                        <span class="toggler-icon"></span>
                        <span class="toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse hidden lg:block duration-300 shadow absolute top-100 left-10 mt-full bg-white z-20 px-10 py-3 w-full lg:static lg:bg-transparent lg:shadow-none" id="navbarSupportedContent">
                        <ul class="navbar-nav mr-auto justify-center items-center lg:flex">
                            {{-- <li class="nav-item">
                              <a class="page-scroll active" href="{{route('user/dashboard')}}">Home</a>
                            </li>
                            <li class="nav-item">
                              <a class="page-scroll" href="{{route('user/groomings')}}">Grooming</a>
                            </li>
                            <li class="nav-item">
                              <a class="page-scroll" href="{{route('user/hotels')}}">Boarding</a>
                            </li>
                            <li class="nav-item">
                              <a class="page-scroll" href="{{route('user/breedings')}}">Breeding</a>
                            </li>
                            <li class="nav-item">
                              <a class="page-scroll" href="">Vaksinasi</a>
                            </li> --}}
                        </ul>
                    </div>
                    @if (auth()->user()->role_id == 3)
                    <div class="">
                      <div class="dropdown inline-block relative">
                        <button class="">
                          <img class="h-12 w-12 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                        </button>
                        <ul class="dropdown-menu absolute hidden w-56 pt-1">
                          <li class=""><p class="rounded-t text-black font-bold bg-white py-2 px-4 block whitespace-no-wrap">{{Auth::user()->name}}<p></li>
                           <li class=""><p class="rounded-t text-black ont-bold text-sm bg-white px-4 block whitespace-no-wrap">{{Auth::user()->email}}</p></li>
                          <div class="border-t border-gray-200"></div>
                          <li class=""><a class="rounded-t bg-white hover:bg-blue-200 py-2 px-4 block whitespace-no-wrap" href="{{route('user/profil')}}">Profile</a></li>
                          <li class=""><a class="rounded-t bg-white hover:bg-blue-200 py-2 px-4 block whitespace-no-wrap" href="{{route('user/pet')}}">Pet</a></li>
                          <li class=""><a class="rounded-t bg-white hover:bg-blue-200 py-2 px-4 block whitespace-no-wrap" href="{{route('user/monitoringuser')}}">Monitoring Pet</a></li>
                          <li class=""><a class="rounded-t bg-white hover:bg-blue-200 py-2 px-4 block whitespace-no-wrap" href="{{route('user/historyactivity')}}">Riwayat Aktivitas</a></li>
                          <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <a class= "rounded-t bg-white hover:bg-blue-200 py-2 px-4 block whitespace-no-wrap" href="{{ route('logout') }}" onclick="event.preventDefault();
                            this.closest('form').submit();"> Logout</a>
                          </form>
                        </ul>
                      </div>
                    </div>
                    @else
                      <div class="header-btn hidden sm:block sm:absolute sm:right-0 sm:mr-16 lg:static lg:mr-0">
                        <a class="text-blue-600 border border-blue-600 px-10 py-3 rounded-full duration-300 hover:bg-blue-600 hover:text-white" href="{{route('user/logins')}}">Masuk</a>
                      </div>
                    @endif
                </nav>
            </div>
        </div>
        <!-- Navbar End -->
    </header>

    <div class="text-gray-600 body-font">
        <div class="container h-screen px-5 py-24 mx-auto">
            <div class="bg-white shadow overflow-hidden border-b border-gray-200 sm:rounded-lg p-12">
                <div class="flex flex-col text-center w-full mb-20">
                    <h1 class="sm:text-3xl text-2xl font-medium title-font mb-4 text-gray-900">GALLERY</h1>
                    <p class="lg:w-2/3 mx-auto leading-relaxed text-base">Hewan Peliharaan {{Auth::user()->name}}</p>
                </div>
                <button class="flex mt-16 mb-16 text-white bg-blue-300 border-0 py-2 px-8 focus:outline-none hover:bg-blue-600 rounded text-lg" wire:click="createShowModal">Tambah Pet</button>
                <div class="flex flex-wrap -m-4">
                    @foreach ($data as $item)
                    <div class="lg:w-1/4 sm:w-1/2 p-2">
                        <div class="flex relative">
                            <img alt="gallery" class="absolute inset-0 w-full h-full object-fill object-center" src="{{ url('storage/featured_image/'.$item->featured_image )}}">
                            <div class="px-8 py-10 relative z-10 w-full border-4 border-gray-200 bg-white opacity-0 hover:opacity-100">
                                <h2 class="tracking-widest text-sm title-font font-medium text-indigo-500 mb-1">{{$item->name}}</h2>
                                <h1 class="title-font text-lg font-medium text-gray-900 mb-3">{{$item->race}}</h1>
                                <p class="leading-relaxed">{{ \Carbon\Carbon::parse($item->birthday)->locale('id')->format('d M Y')}}</p>
                                <a href= "#" wire:click="updateShowModal({{$item->id}})" class="text-indigo-600 hover:text-indigo-900 mr-3">Edit</a>
                                <a href= "#" wire:click="deleteShowModal({{$item->id}})" class="text-indigo-600 hover:text-indigo-900 mr-3">Hapus</a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <x-jet-dialog-modal wire:model="modalFormVisible">
        @if ($modelId)
        <x-slot name="title">
            {{ __('Ubah Data Pet') }}
        </x-slot>
        @else
        <x-slot name="title">
            {{ __('Tambah Pet') }}
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
                {{$colour}}
                @error('colour') <span class="error">{{ $message }}</span> @enderror
            </div>
            <div class="mt-4">
                <x-jet-label for="gender" value="{{ __('Gender') }}" />
                <x-jet-input id="gender" class="block mt-1 w-full" type="text" wire:model.debounce.800ms="gender" />
                @error('gender') <span class="error">{{ $message }}</span> @enderror
            </div>
            <div class="mt-4">
                <x-jet-label for="birthday" value="{{ __('Ulang Tahun') }}" />
                <x-datetime-picker wire:model="birthday" class="w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" />
                @error('birthday') <span class="error">{{ $message }}</span> @enderror
            </div>
            <div class="mt-4">
                <x-jet-label for="feature_image" value="{{ __('Foto') }}" />
                <x-jet-input id="feature_image" class="block mt-1 w-full" type="file" wire:model.debounce.800ms="feature_image" enctype="multipart/form-data" />
                @error('feature_image') <span class="error">{{ $message }}</span> @enderror
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