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
                    <a class="page-scroll" href="{{route('user/monitoringuser')}}">Monitoring Boarding</a>
                    </li>
                    <li class="nav-item">
                    <a class="page-scroll active" href="{{route('user/monitoringbreedinguser')}}">Monitoring Breeding</a>
                    </li>
                </ul>
                <div class="border-t border-gray-200"></div>
                <div class="text-gray-600 body-font">
                    <div class="container h-screen px-5 py-12 mx-auto">
                        <div class="bg-white shadow overflow-hidden border-b border-gray-200 sm:rounded-lg p-12">
                            <div class="flex flex-col text-center w-full mb-20">
                                <h1 class="sm:text-3xl text-2xl font-medium title-font mb-4 text-gray-900">Monitoring Breeding</h1>
                                <p class="lg:w-2/3 mx-auto leading-relaxed text-base">Hewan Peliharaan {{Auth::user()->name}}</p>
                            </div>
                            <div class="flex flex-wrap -m-4">
                                @foreach ($pets as $item)
                                <div class="lg:w-1/4 sm:w-1/2 p-2 border-4 border-gray-200">
                                    <div class="flex relative">
                                        <img alt="gallery" class="absolute inset-0 w-full h-full object-fill object-center" src="{{ url('storage/featured_image/'.$item->featured_image )}}">
                                        <div class="px-8 py-10 relative z-10 w-full border-4 border-gray-200 bg-white opacity-0 hover:opacity-100">
                                            <h2 class="tracking-widest text-sm title-font font-medium text-indigo-500 mb-1">{{$item->name}}</h2>
                                            <h1 class="title-font text-lg font-medium text-gray-900 mb-3">{{$item->race}}</h1>
                                            <a href= "{{route('user/monitoringbreedingpets', ['id'=>$item->id])}}" class="text-indigo-600 hover:text-indigo-900 mr-3">Lihat Monitoring</a>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </div>
</div>