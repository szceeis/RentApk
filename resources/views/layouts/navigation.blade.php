<nav x-data="{ open: false }" class="bg-[#1A1B26] border-b border-[#2A2B3D]">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('home') }}" class="text-2xl font-extrabold text-[#00FF66] tracking-wider drop-shadow-[0_0_8px_rgba(0,255,102,0.5)]">
                        RENTAL<span class="text-[#6600FF]">APP</span>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('home')" :active="request()->routeIs('home')" class="text-gray-300 hover:text-white">
                        {{ __('Katalog') }}
                    </x-nav-link>
                    
                    @if(Auth::check() && !Auth::user()->is_admin)
                        <x-nav-link :href="route('cart.index')" :active="request()->routeIs('cart.*')" class="text-gray-300 hover:text-white">
                            {{ __('Keranjang') }}
                        </x-nav-link>
                        <x-nav-link :href="route('rentals.index')" :active="request()->routeIs('rentals.*')" class="text-gray-300 hover:text-white">
                            {{ __('Riwayat Sewa') }}
                        </x-nav-link>
                    @endif

                    @if(Auth::check() && Auth::user()->is_admin)
                        <x-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')" class="text-[#00FF66] font-bold">
                            {{ __('Admin Dashboard') }}
                        </x-nav-link>
                        <x-nav-link :href="route('admin.products.index')" :active="request()->routeIs('admin.products.*')" class="text-[#00FF66] font-bold">
                            {{ __('Manage Products') }}
                        </x-nav-link>
                        <x-nav-link :href="route('admin.transactions.index')" :active="request()->routeIs('admin.transactions.*')" class="text-[#00FF66] font-bold">
                            {{ __('Manage Transactions') }}
                        </x-nav-link>
                    @endif
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                @auth
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-bold rounded-md text-gray-300 bg-[#0B0F19] hover:text-white hover:bg-[#2A2B3D] focus:outline-none transition ease-in-out duration-150">
                                <div>{{ Auth::user()->name }}</div>

                                <div class="ms-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile.edit')">
                                {{ __('Profile') }}
                            </x-dropdown-link>

                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')"
                                        onclick="event.preventDefault();
                                                    this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                @else
                    <a href="{{ route('login') }}" class="text-sm text-gray-300 hover:text-white font-bold mr-4">Log in</a>
                    <a href="{{ route('register') }}" class="text-sm bg-[#6600FF] text-white px-4 py-2 rounded font-bold hover:bg-[#5500DD]">Register</a>
                @endauth
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-white hover:bg-[#2A2B3D] focus:outline-none focus:bg-[#2A2B3D] focus:text-white transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden bg-[#1A1B26]">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('home')" :active="request()->routeIs('home')" class="text-gray-300">
                {{ __('Katalog') }}
            </x-responsive-nav-link>
            
            @if(Auth::check() && !Auth::user()->is_admin)
                <x-responsive-nav-link :href="route('cart.index')" :active="request()->routeIs('cart.*')" class="text-gray-300">
                    {{ __('Keranjang') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('rentals.index')" :active="request()->routeIs('rentals.*')" class="text-gray-300">
                    {{ __('Riwayat Sewa') }}
                </x-responsive-nav-link>
            @endif

            @if(Auth::check() && Auth::user()->is_admin)
                <x-responsive-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')" class="text-[#00FF66]">
                    {{ __('Admin Dashboard') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('admin.products.index')" :active="request()->routeIs('admin.products.*')" class="text-[#00FF66]">
                    {{ __('Manage Products') }}
                </x-responsive-nav-link>
            @endif
        </div>

        @auth
            <!-- Responsive Settings Options -->
            <div class="pt-4 pb-1 border-t border-[#2A2B3D]">
                <div class="px-4">
                    <div class="font-bold text-base text-white">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-gray-400">{{ Auth::user()->email }}</div>
                </div>

                <div class="mt-3 space-y-1">
                    <x-responsive-nav-link :href="route('profile.edit')" class="text-gray-300">
                        {{ __('Profile') }}
                    </x-responsive-nav-link>

                    <!-- Authentication -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-responsive-nav-link :href="route('logout')" class="text-gray-300"
                                onclick="event.preventDefault();
                                            this.closest('form').submit();">
                            {{ __('Log Out') }}
                        </x-responsive-nav-link>
                    </form>
                </div>
            </div>
        @endauth
    </div>
</nav>
