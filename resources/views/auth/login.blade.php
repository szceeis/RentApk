<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4 text-[#00FF66]" :status="session('status')" />

    <h2 class="text-2xl font-bold text-white mb-6 text-center">Login to your account</h2>

    <form method="POST" action="{{ route('login') }}" class="space-y-6">
        @csrf

        <!-- Email Address -->
        <div>
            <label for="email" class="block font-medium text-sm text-gray-300">Email</label>
            <input id="email" class="block mt-1 w-full bg-[#0B0F19] border border-[#2A2B3D] text-white focus:border-[#6600FF] focus:ring-[#6600FF] rounded-md shadow-sm" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-400" />
        </div>

        <!-- Password -->
        <div>
            <label for="password" class="block font-medium text-sm text-gray-300">Password</label>
            <input id="password" class="block mt-1 w-full bg-[#0B0F19] border border-[#2A2B3D] text-white focus:border-[#6600FF] focus:ring-[#6600FF] rounded-md shadow-sm" type="password" name="password" required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-400" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded bg-[#0B0F19] border-[#2A2B3D] text-[#6600FF] shadow-sm focus:ring-[#6600FF]" name="remember">
                <span class="ms-2 text-sm text-gray-400">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-between mt-4 border-t border-[#2A2B3D] pt-6">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-400 hover:text-white rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#6600FF]" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <button type="submit" class="bg-[#00FF66] text-[#0D0D12] font-bold py-2 px-6 rounded-md hover:bg-[#00CC52] transition shadow-[0_0_15px_rgba(0,255,102,0.3)]">
                {{ __('Log in') }}
            </button>
        </div>
        
        <div class="text-center mt-6 text-sm text-gray-400 bg-[#0B0F19] p-3 rounded border border-[#2A2B3D]">
            Don't have an account? <a href="{{ route('register') }}" class="text-[#6600FF] font-bold hover:underline">Register</a>
        </div>
    </form>
</x-guest-layout>
