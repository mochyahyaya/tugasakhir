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
        <div class="navigation fixed top-0 left-0 bot-10 w-full z-40 duration-300">
            <div class="container">
                <nav class="navbar py-1 navbar-expand-lg flex justify-between items-center relative duration-300">
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

    <div class="py-12 mt-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <ul class="navbar-nav mr-auto justify-center items-center lg:flex">
                    <li class="nav-item">
                    <a class="page-scroll" href="{{route('user/historyactivity')}}">Grooming</a>
                    </li>
                    <li class="nav-item">
                    <a class="page-scroll" href="{{route('user/historyactivityhotels')}}">Boarding</a>
                    </li>
                    <li class="nav-item">
                    <a class="page-scroll active" href="{{route('user/historyactivitybreeds')}}">Breeding</a>
                    </li>
                </ul>
                <div class="border-t border-gray-200"></div>
                <section class="text-gray-600 body-font overflow-hidden">
                    <div class="container px-5 py-12 mx-auto">
                      <div class="-my-8 divide-y-2 divide-gray-100">
                          @foreach ($historyBreedings as $item)
                          <div class="py-8 flex flex-wrap md:flex-nowrap">
                            <div class="md:w-64 md:mb-0 mb-6 flex-shrink-0 flex flex-col">
                              <span class="font-semibold title-font text-gray-700">Breeding</span>
                              <span class="mt-1 text-gray-500 text-sm">{{$item->status}}</span>
                            </div>
                            <div class="md:flex-grow">
                              <h2 class="text-2xl font-medium text-gray-900 title-font mb-2">{{$item->pets->name}}</h2>
                              <p class="leading-relaxed">{{$item->service}}</p>
                              <div class="py-4 flex flex-wrap md:flex-nowrap">
                                <span class="mt-1 text-gray-500 text-sm">Jantan:{{$item->pet_id_2}}</span>
                              </div>
                              <div class="py-4 flex flex-wrap md:flex-nowrap">
                                <span class="mt-1 text-gray-500 text-sm">Betina:{{$item->pets->name}}</span>
                              </div>
                              <a class="text-yellow-500 inline-flex items-center mt-4">Lebih detail
                                <svg class="w-4 h-4 ml-2" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                  <path d="M5 12h14"></path>
                                  <path d="M12 5l7 7-7 7"></path>
                                </svg>
                              </a>
                            </div>
                          </div>
                          @endforeach
                      </div>
                    </div>
                  </section>
            </div>
        </div>
    </div>
</div>