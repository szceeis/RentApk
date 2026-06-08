<x-guest-layout>
    <h2 class="text-2xl font-bold text-white mb-6 text-center">Create an account</h2>
    
    <form method="POST" action="{{ route('register') }}" class="space-y-6">
        @csrf

        <!-- Name -->
        <div>
            <label for="name" class="block font-medium text-sm text-gray-300">Name</label>
            <input id="name" class="block mt-1 w-full bg-[#0B0F19] border border-[#2A2B3D] text-white focus:border-[#6600FF] focus:ring-[#6600FF] rounded-md shadow-sm" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2 text-red-400" />
        </div>

        <!-- Email Address -->
        <div>
            <label for="email" class="block font-medium text-sm text-gray-300">Email</label>
            <input id="email" class="block mt-1 w-full bg-[#0B0F19] border border-[#2A2B3D] text-white focus:border-[#6600FF] focus:ring-[#6600FF] rounded-md shadow-sm" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-400" />
        </div>

        <!-- Password -->
        <div>
            <label for="password" class="block font-medium text-sm text-gray-300">Password</label>
            <input id="password" class="block mt-1 w-full bg-[#0B0F19] border border-[#2A2B3D] text-white focus:border-[#6600FF] focus:ring-[#6600FF] rounded-md shadow-sm" type="password" name="password" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-400" />
        </div>

        <!-- Confirm Password -->
        <div>
            <label for="password_confirmation" class="block font-medium text-sm text-gray-300">Confirm Password</label>
            <input id="password_confirmation" class="block mt-1 w-full bg-[#0B0F19] border border-[#2A2B3D] text-white focus:border-[#6600FF] focus:ring-[#6600FF] rounded-md shadow-sm" type="password" name="password_confirmation" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-red-400" />
        </div>

        <div class="flex items-center justify-between mt-4 border-t border-[#2A2B3D] pt-6">
            <a class="underline text-sm text-gray-400 hover:text-white rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#6600FF]" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <button type="submit" class="bg-[#6600FF] text-white font-bold py-2 px-6 rounded-md hover:bg-[#5500DD] transition shadow-[0_0_15px_rgba(102,0,255,0.4)]">
                {{ __('Register') }}
            </button>
        </div>
    </form>
</x-guest-layout>
