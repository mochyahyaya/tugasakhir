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
  
                  <div class="collapse navbar-collapse hidden lg:block duration-300 shadow absolute top-100 left-0 mt-full bg-white z-20 px-5 py-3 w-full lg:static lg:bg-transparent lg:shadow-none" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto justify-center items-center lg:flex">
                      <li class="nav-item">
                        <a class="page-scroll" href=""></a>
                      </li>
                      <li class="nav-item">
                        <a class="page-scroll" href=""></a>
                      </li>
                      <li class="nav-item">
                        <a class="page-scroll" href=""></a>
                      </li>
                      <li class="nav-item">
                        <a class="page-scroll " href="{{route('user/dashboard')}}">Home</a>
                      </li>
                      <li class="nav-item">
                        <a class="page-scroll" href="{{route('user/groomings')}}">Grooming</a>
                      </li>
                      <li class="nav-item">
                        <a class="page-scroll" href="{{route('user/hotels')}}">Boarding</a>
                      </li>
                      <li class="nav-item">
                        <a class="page-scroll active" href="{{route('user/breedings')}}">Breeding</a>
                      </li>
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
    <div class="h-screen bg-blue-100 flex justify-center items-center">
      <div class="lg:w-2/5 md:w-1/2 w-2/3">
        <div>
          @if (session()->has('success'))
              <div class="bg-green-100 border-t border-b border-green-500 text-green-700 px-4 py-3" role="alert">
                <p class="font-bold">Berhasil</p>
                <p class="text-sm">{{ session('success') }}</p>
              </div>
          @endif
        </div>
        <form class="bg-white p-10 rounded-lg shadow-lg min-w-full mt-4" wire:submit.prevent="store">
          <h1 class="text-center text-2xl mb-6 text-gray-600 font-bold font-sans">Pendaftaran Breeding</h1>
                <div wire:model="pet1">
                  <label class="text-gray-800 font-semibold block my-3 text-md" for="username">Nama Hewan Peliharaan</label>
                  <select class="w-full bg-gray-100 px-4 py-2 rounded-lg focus:outline-none">
                    <option selected>Pilih Pet Betina</option>
                    @foreach ($pet as $item)
                        <option value="{{$item->id}}"> {{$item->name}} </option>
                    @endforeach
                  </select>
                </div>
                <div wire:model="pet2">
                <label class="text-gray-800 font-semibold block my-3 text-md" for="pet2">Nama Hewan Peliharaan</label>
                  <select class="w-full bg-gray-100 px-4 py-2 rounded-lg focus:outline-none">
                      <option selected>Pilih Pet Jantan</option>
                      @foreach ($pets2 as $items)
                          <option value="{{$items->name}}"> {{$items->name}} </option>
                      @endforeach
                  </select>
                </div>
                <div class="mt-4">
                    <x-jet-label for="start_date" value="{{ __('Tanggal Mulai') }}" />
                    <x-datetime-picker wire:model="start_date" class="w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" />
                </div>
                <div>
                    <button type="submit" class="mt-6 bg-blue-600 rounded-lg px-4 py-2 text-lg text-white tracking-wide font-semibold font-sans">Book</button>
                </div>
        </form>
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