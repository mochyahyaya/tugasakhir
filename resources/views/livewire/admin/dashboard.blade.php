<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Dashboard') }} 
    </h2>
</x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="main-content flex-1 bg-gray-100 mt-12 md:mt-2 pb-24 md:pb-5">
                    <div class="flex flex-wrap">
                        <div class="w-full md:w-1/2 xl:w-1/3 p-6">
                            <!--Metric Card-->
                            <a href="{{route('admin/users')}}">
                                <div class="bg-gradient-to-b from-green-200 to-green-100 border-b-4 border-green-600 rounded-lg shadow-xl p-5">
                                    <div class="flex flex-row items-center">
                                        <div class="flex-shrink pr-4">
                                            <div class="rounded-full p-5 bg-green-600"><i class="fas fa-users fa-2x fa-inverse"></i></div>
                                        </div>
                                        <div class="flex-1 text-right md:text-center">
                                            <h5 class="font-bold uppercase text-gray-600">Total Member</h5>
                                            <h3 class="font-bold text-3xl">{{$users}} <span class="text-green-500"><i class="fas fa-user"></i></span></h3>
                                        </div>
                                    </div>
                                </div>
                            </a>
                            <!--/Metric Card-->
                        </div>
                        <div class="w-full md:w-1/2 xl:w-1/3 p-6">
                            <!--Metric Card-->
                            <a href="{{route('admin/pets')}}">
                                <div class="bg-gradient-to-b from-pink-200 to-pink-100 border-b-4 border-pink-500 rounded-lg shadow-xl p-5">
                                    <div class="flex flex-row items-center">
                                        <div class="flex-shrink pr-4">
                                            <div class="rounded-full p-5 bg-pink-600"><i class="fas fa-cat fa-2x fa-inverse"></i></div>
                                        </div>
                                        <div class="flex-1 text-right md:text-center">
                                            <h5 class="font-bold uppercase text-gray-600">Total Pet</h5>
                                            <h3 class="font-bold text-3xl">{{$pets}} <span class="text-pink-500"><i class="fas fa-dog"></i></span></h3>
                                        </div>
                                    </div>
                                </div>
                            </a>
                            <!--/Metric Card-->
                        </div>
                        <div class="w-full md:w-1/2 xl:w-1/3 p-6">
                            <!--Metric Card-->
                            <a href="{{route('admin/cages')}}">
                                <div class="bg-gradient-to-b from-yellow-200 to-yellow-100 border-b-4 border-yellow-600 rounded-lg shadow-xl p-5">
                                    <div class="flex flex-row items-center">
                                        <div class="flex-shrink pr-4">
                                            <div class="rounded-full p-5 bg-yellow-600"><i class="fas fa-home fa-2x fa-inverse"></i></div>
                                        </div>
                                        <div class="flex-1 text-right md:text-center">
                                            <h5 class="font-bold uppercase text-gray-600">Total Kandang</h5>
                                            <h3 class="font-bold text-3xl">{{$cages}} <span class="text-yellow-600"><i class="fab fa-simplybuilt"></i></span></h3>
                                        </div>
                                    </div>
                                </div>
                            </a>
                            <!--/Metric Card-->
                        </div>
                    </div>
        
        
                    <div class="flex flex-row flex-wrap flex-grow mt-2">
                        <div class="w-full md:w-1/2 xl:w-1/3 p-6">
                            <!--Graph Card-->
                            <div class="bg-white border-transparent rounded-lg shadow-xl">
                                <div class="bg-gradient-to-b from-gray-300 to-gray-100 uppercase text-gray-800 border-b-2 border-gray-300 rounded-tl-lg rounded-tr-lg p-2">
                                    <h5 class="font-bold uppercase text-gray-600">Grooming</h5>
                                </div>
                                <div class="p-5" style="height: 280px !important">
                                    <livewire:livewire-column-chart
                                    key="{{ $columnChartModelgroom->reactiveKey() }}"
                                    :column-chart-model="$columnChartModelgroom "
                                />  
                                </div>
                            </div>
                            <!--/Graph Card-->
                        </div>
        
                        <div class="w-full md:w-1/2 xl:w-1/3 p-6">
                            <!--Graph Card-->
                            <div class="bg-white border-transparent rounded-lg shadow-xl">
                                <div class="bg-gradient-to-b from-gray-300 to-gray-100 uppercase text-gray-800 border-b-2 border-gray-300 rounded-tl-lg rounded-tr-lg p-2">
                                    <h5 class="font-bold uppercase text-gray-600">Boarding</h5>
                                </div>
                                <div class="p-5">
                                    <div class="p-5" style="height: 240px !important">
                                        <livewire:livewire-column-chart
                                        key="{{ $columnChartModelboard->reactiveKey() }}"
                                        :column-chart-model="$columnChartModelboard"
                                    />  
                                    </div>
                                </div>
                            </div>
                            <!--/Graph Card-->
                        </div>
        
                        <div class="w-full md:w-1/2 xl:w-1/3 p-6">
                            <!--Graph Card-->
                            <div class="bg-white border-transparent rounded-lg shadow-xl">
                                <div class="bg-gradient-to-b from-gray-300 to-gray-100 uppercase text-gray-800 border-b-2 border-gray-300 rounded-tl-lg rounded-tr-lg p-2">
                                    <h5 class="font-bold uppercase text-gray-600">Breeding</h5>
                                </div>
                                    <div class="p-5" style="height: 280px !important">
                                        <livewire:livewire-column-chart
                                        key="{{ $columnChartModelbreed->reactiveKey() }}"
                                        :column-chart-model="$columnChartModelbreed"
                                    />  
                                    </div>
                                </div>
                            </div>
                            <!--/Graph Card-->
                        </div>
        
                        <div class="w-full p-6">
                            @if(auth()->user()->role_id == 1)
                            <!--Graph Card-->
                            <div class="bg-white border-transparent rounded-lg shadow-xl m-3">
                                <div class="bg-gradient-to-b from-gray-300 to-gray-100 uppercase text-gray-800 border-b-2 border-gray-300 rounded-tl-lg rounded-tr-lg p-2">
                                    <h5 class="font-bold uppercase text-gray-600">Notifikasi</h5>
                                </div>
                                @forelse( json_decode($notifications) as $notification)
        
                                @if ($notification->type == 'App\Notifications\GroomsNotification') 
                                <div x-ref="">
                                    <div class="alert border border-red-400 text-black px-2 py-2 m-3 rounded-full relative" role="alert">
                                        <span class="font-semibold mr-2 text-left flex-auto">{{ \Carbon\Carbon::parse($notification->created_at)->locale('id')->format('d M Y')}} {{($notification->data->name)}} telah melakukan reservasi grooming atas nama pet {{($notification->data->pet)}}.</span>
                                        <a href="#" wire:click="markNotificationGroom('{{ ($notification->id) }}')" class="float-right mark-as-read">
                                            Mark as read
                                        </a>
                                    </div>
                                </div>
                                @endif

                                @if ($notification->type == 'App\Notifications\BoardsNotification') 
                                <div x-ref="notif">
                                    <div class="alert border border-blue-400 text-black px-2 py-2 m-3 rounded-full relative" role="alert">
                                        <span class="font-semibold mr-2 text-left flex-auto">{{ \Carbon\Carbon::parse($notification->created_at)->locale('id')->format('d M Y')}} {{($notification->data->name)}} telah melakukan reservasi boarding atas nama pet {{($notification->data->pet)}}.</span>
                                        <a href="#" wire:click="markNotificationGroom('{{ ($notification->id) }}')" class="float-right mark-as-read">
                                            Mark as read
                                        </a>
                                    </div>
                                </div>
                                @endif

                                @if ($notification->type == 'App\Notifications\BreedsNotification') 
                                <div x-ref="">
                                    <div class="alert border border-yellow-400 text-black px-2 py-2 m-3 rounded-full relative" role="alert">
                                        <span class="font-semibold mr-2 text-left flex-auto">{{ \Carbon\Carbon::parse($notification->created_at)->locale('id')->format('d M Y')}} {{($notification->data->name)}} telah melakukan reservasi breeding atas nama pet {{($notification->data->pet)}}.</span>
                                        <a href="#" wire:click="markNotificationGroom('{{ ($notification->id) }}')" class="float-right mark-as-read">
                                            Mark as read
                                        </a>
                                    </div>
                                </div>
                                @endif
            
                                @if($loop->last)
                                    {{-- <button @click="$refs.notif.remove()">
                                        Mark all as read
                                    </button> --}}
                                @endif
                                @empty
                                <h6 class="m-1 font-weight-bold text-dark">Tidak ada notifikasi baru</h6> 
                                @endforelse 
                            </div>
                            <!--/Graph Card-->
                            @endif
                        </div>
                    </div>
                </div>
        </div>
    </div>
    <livewire:scripts />
    @if(auth()->user()->role_id == 1)
    <script>
    </script>
@endif
    @livewireChartsScripts
