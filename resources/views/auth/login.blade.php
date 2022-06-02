<x-guest-layout>
    <div class="min-h-screen bg-blue-400 flex justify-center items-center">
        <form method="POST" action="{{ route('login') }}">
            @csrf
                <div class="absolute w-60 h-60 rounded-xl bg-blue-300 -top-5 -left-16 z-0 transform rotate-45 hidden md:block">
                </div>
                <div class="absolute w-48 h-48 rounded-xl bg-blue-300 -bottom-6 -right-10 transform rotate-12 hidden md:block">
                </div>
                <div class="py-12 px-12 bg-white rounded-2xl shadow-xl z-25">
                    <div>
                        <h1 class="text-3xl font-bold text-center mb-4 cursor-pointer">Login</h1>
                        <p class="w-80 text-center text-sm mb-8 font-semibold text-gray-700 tracking-wide cursor-pointer">Silahkan
                            login untuk dapat melakukan melakukan berbagai fitur pada Garden Petshop & Clinic!</p>
                    </div>
                    <div class="space-y-4">
                        <div>
                            <x-jet-label for="name" value="{{ __('Email') }}" />
                            <input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus class="block text-sm py-3 px-4 rounded-lg w-full border outline-none" />
                        </div>
                        <div>
                            <x-jet-label for="name" value="{{ __('Email') }}" />
                            <input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" class="block text-sm py-3 px-4 rounded-lg w-full border outline-none" />
                        </div>
                    </div>
                        <div class="text-center mt-6">
                            <button type="submit" class="py-3 w-64 text-xl text-white bg-blue-400 rounded-2xl">Login</button>
                            @if (Route::has('register'))
                            <p class="mt-4 text-sm">Already Have An Account? <a href="{{ route('register') }}" class="text-sm text-gray-700 underline">Register</a>
                            </p>
                            @endif
                        </div>
                        @if ($errors->any())
                            <div class="font-medium text-red-600">{{ __('Whoops! Something went wrong.') }}</div>
                                <ul class="mt-3 list-disc list-inside text-sm text-red-600">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                </div>
                    <div class="w-40 h-40 absolute bg-blue-300 rounded-full top-0 right-12 hidden md:block"></div>
                    <div
                        class="w-20 h-40 absolute bg-blue-300 rounded-full bottom-20 left-10 transform rotate-45 hidden md:block">
                    </div>
       </form>
    </div>
</x-guest-layout>
