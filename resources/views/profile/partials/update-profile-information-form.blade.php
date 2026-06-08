<section>
    <header>
        <h2 class="text-xl font-bold text-white border-l-4 border-[#00FF66] pl-3">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-2 text-sm text-gray-400">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <label for="name" class="block font-medium text-sm text-gray-300">Name</label>
            <input id="name" name="name" type="text" class="mt-1 block w-full bg-[#0B0F19] border border-[#2A2B3D] text-white focus:border-[#00FF66] focus:ring-[#00FF66] rounded-md shadow-sm" value="{{ old('name', $user->name) }}" required autofocus autocomplete="name" />
            <x-input-error class="mt-2 text-red-400" :messages="$errors->get('name')" />
        </div>

        <div>
            <label for="email" class="block font-medium text-sm text-gray-300">Email</label>
            <input id="email" name="email" type="email" class="mt-1 block w-full bg-[#0B0F19] border border-[#2A2B3D] text-white focus:border-[#00FF66] focus:ring-[#00FF66] rounded-md shadow-sm" value="{{ old('email', $user->email) }}" required autocomplete="username" />
            <x-input-error class="mt-2 text-red-400" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-400">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification" class="underline text-sm text-[#00FF66] hover:text-[#00CC52] rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#00FF66]">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-[#00FF66]">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex items-center gap-4 pt-4 border-t border-[#2A2B3D]">
            <button type="submit" class="bg-[#00FF66] text-[#0D0D12] font-bold py-2 px-6 rounded-md hover:bg-[#00CC52] transition shadow-[0_0_15px_rgba(0,255,102,0.3)]">
                {{ __('Save') }}
            </button>

            @if (session('status') === 'profile-updated')
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
