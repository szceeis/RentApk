<section>
    <header>
        <h2 class="text-xl font-bold text-white border-l-4 border-[#6600FF] pl-3">
            {{ __('Update Password') }}
        </h2>

        <p class="mt-2 text-sm text-gray-400">
            {{ __('Ensure your account is using a long, random password to stay secure.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        <div>
            <label for="update_password_current_password" class="block font-medium text-sm text-gray-300">Current Password</label>
            <input id="update_password_current_password" name="current_password" type="password" class="mt-1 block w-full bg-[#0B0F19] border border-[#2A2B3D] text-white focus:border-[#6600FF] focus:ring-[#6600FF] rounded-md shadow-sm" autocomplete="current-password" />
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2 text-red-400" />
        </div>

        <div>
            <label for="update_password_password" class="block font-medium text-sm text-gray-300">New Password</label>
            <input id="update_password_password" name="password" type="password" class="mt-1 block w-full bg-[#0B0F19] border border-[#2A2B3D] text-white focus:border-[#6600FF] focus:ring-[#6600FF] rounded-md shadow-sm" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2 text-red-400" />
        </div>

        <div>
            <label for="update_password_password_confirmation" class="block font-medium text-sm text-gray-300">Confirm Password</label>
            <input id="update_password_password_confirmation" name="password_confirmation" type="password" class="mt-1 block w-full bg-[#0B0F19] border border-[#2A2B3D] text-white focus:border-[#6600FF] focus:ring-[#6600FF] rounded-md shadow-sm" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2 text-red-400" />
        </div>

        <div class="flex items-center gap-4 pt-4 border-t border-[#2A2B3D]">
            <button type="submit" class="bg-[#6600FF] text-white font-bold py-2 px-6 rounded-md hover:bg-[#5500DD] transition shadow-[0_0_15px_rgba(102,0,255,0.4)]">
                {{ __('Save') }}
            </button>

            @if (session('status') === 'password-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm font-bold text-[#00FF66]"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
