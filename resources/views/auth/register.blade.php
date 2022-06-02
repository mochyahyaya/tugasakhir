<x-guest-layout>

        <x-jet-validation-errors class="mb-4" />
    <div class="min-h-screen bg-blue-400 flex justify-center items-center">
        <div class="absolute w-60 h-60 rounded-xl bg-blue-300 -top-5 -left-16 z-0 transform rotate-45 hidden md:block">
        </div>
        <div class="absolute w-48 h-48 rounded-xl bg-blue-300 -bottom-6 -right-10 transform rotate-12 hidden md:block">
        </div>
        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="py-16 px-16 bg-white rounded-2xl shadow-xl z-25">
                <div>
                    <h1 class="text-3xl font-bold text-center mb-4 cursor-pointer">Registrasi</h1>
                    <p class="w-80 text-center text-sm mb-8 font-semibold text-gray-700 tracking-wide cursor-pointer">Silahkan
                        daftar untuk dapat melakukan login ke dalam Garden Petshop & Clinic!</p>
                </div>
                <div class="space-y-4">
                    <div>
                        <x-jet-label for="name" value="{{ __('Name') }}" />
                        <input id="name" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" class="block text-sm py-3 px-4 rounded-lg w-full border outline-none" />
                    </div>
                    <div>
                        <x-jet-label for="name" value="{{ __('Email') }}" />
                        <input id="email" type="email" name="email" :value="old('email')" required class="block text-sm py-3 px-4 rounded-lg w-full border outline-none" />
                    </div>
                    <div>
                        <x-jet-label for="name" value="{{ __('Confirm Password') }}" />
                        <input id="password" type="password" name="password" required autocomplete="new-password"  class="block text-sm py-3 px-4 rounded-lg w-full border outline-none" />
                    </div>
                    <div>
                        <x-jet-label for="name" value="{{ __('Password') }}" />
                        <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password" class="block text-sm py-3 px-4 rounded-lg w-full border outline-none" />
                    </div>
                </div>
                    <div class="text-center mt-6">
                        <button type="submit" class="py-3 w-64 text-xl text-white bg-blue-400 rounded-2xl">Create Account</button>
                    </div>
                    <div class="flex items-center justify-end mt-4">
                        <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                            {{ __('Already registered?') }}
                        </a>
                    </div>
                </div>

            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                <div class="mt-4">
                    <x-jet-label for="terms">
                        <div class="flex items-center">
                            <x-jet-checkbox name="terms" id="terms"/>

                            <div class="ml-2">
                                {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                        'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Terms of Service').'</a>',
                                        'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Privacy Policy').'</a>',
                                ]) !!}
                            </div>
                        </div>
                    </x-jet-label>
                </div>
            @endif
        </form>
        <div class="w-40 h-40 absolute bg-blue-300 rounded-full top-0 right-12 hidden md:block"></div>
		<div
			class="w-20 h-40 absolute bg-blue-300 rounded-full bottom-20 left-10 transform rotate-45 hidden md:block">
		</div>
    </div>
</x-guest-layout>
