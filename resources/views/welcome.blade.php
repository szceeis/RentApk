<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>RentalApp - Sewa Game & Aplikasi</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body { background-color: #0D0D12; }
    </style>
</head>
<body class="antialiased text-gray-200 font-sans">
    
    <!-- Navbar -->
    <nav class="bg-[#1A1B26] shadow-lg border-b border-[#2A2B3D] sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex">
                    <div class="shrink-0 flex items-center">
                        <a href="{{ route('home') }}" class="text-2xl font-extrabold text-[#00FF66] tracking-wider drop-shadow-[0_0_8px_rgba(0,255,102,0.5)]">RENTAL<span class="text-[#6600FF]">APP</span></a>
                    </div>
                </div>
                <div class="flex items-center space-x-6">
                    @auth
                        @if(auth()->user()->is_admin)
                            <a href="{{ route('admin.dashboard') }}" class="text-gray-300 hover:text-white font-medium transition">Admin Dashboard</a>
                        @else
                            <a href="{{ route('cart.index') }}" class="text-gray-300 hover:text-[#00FF66] font-medium transition">Keranjang</a>
                            <a href="{{ route('rentals.index') }}" class="text-gray-300 hover:text-[#00FF66] font-medium transition">Sewa Saya</a>
                        @endif
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="text-red-400 hover:text-red-300 font-medium transition">Logout</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="text-gray-300 hover:text-white font-medium transition">Log in</a>
                        <a href="{{ route('register') }}" class="bg-[#6600FF] hover:bg-[#5500DD] text-white px-5 py-2 rounded-md font-bold transition shadow-[0_0_15px_rgba(102,0,255,0.4)]">Register</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="relative overflow-hidden bg-[#0B0F19] border-b border-[#2A2B3D]">
        <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] opacity-10"></div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24 text-center relative z-10">
            <h1 class="text-4xl tracking-tight font-extrabold text-white sm:text-5xl md:text-6xl drop-shadow-lg">
                Sewa <span class="text-[#00FF66]">Game</span> & <span class="text-[#6600FF]">Aplikasi</span> Kapan Saja
            </h1>
            <p class="mt-4 max-w-2xl mx-auto text-base text-gray-400 sm:text-lg md:text-xl">Platform teknologi modern penyewaan aplikasi Android & game GDevelop secara eksklusif. Nikmati performa tanpa batas.</p>
            
            <form action="{{ route('home') }}" method="GET" class="mt-8 max-w-xl mx-auto flex shadow-2xl">
                <input type="text" name="search" value="{{ $search ?? '' }}" placeholder="Cari aplikasi/game..." class="w-full bg-[#1A1B26] text-white border border-[#2A2B3D] rounded-l-md px-6 py-4 focus:outline-none focus:border-[#6600FF] focus:ring-1 focus:ring-[#6600FF]">
                <button type="submit" class="bg-[#6600FF] text-white px-8 py-4 rounded-r-md font-bold hover:bg-[#5500DD] transition flex items-center justify-center">
                    Cari
                </button>
            </form>
        </div>
    </div>

    <!-- Alert / Messages -->
    @if(session('success'))
        <div class="max-w-7xl mx-auto px-4 mt-8">
            <div class="bg-[#00FF66]/10 border border-[#00FF66]/50 text-[#00FF66] px-4 py-3 rounded-lg relative shadow-[0_0_15px_rgba(0,255,102,0.1)]" role="alert">
                <span class="block sm:inline font-medium">{{ session('success') }}</span>
            </div>
        </div>
    @endif
    @if(session('error'))
        <div class="max-w-7xl mx-auto px-4 mt-8">
            <div class="bg-red-500/10 border border-red-500/50 text-red-400 px-4 py-3 rounded-lg relative shadow-[0_0_15px_rgba(239,68,68,0.1)]" role="alert">
                <span class="block sm:inline font-medium">{{ session('error') }}</span>
            </div>
        </div>
    @endif

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="mb-10 flex justify-between items-center border-b border-[#2A2B3D] pb-4">
            <h2 class="text-3xl font-bold text-white flex items-center">
                <span class="bg-[#6600FF] w-2 h-8 mr-3 rounded"></span> Katalog Produk
            </h2>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($products as $product)
                <div class="bg-[#1A1B26] border border-[#2A2B3D] rounded-xl overflow-hidden hover:shadow-[0_0_20px_rgba(102,0,255,0.2)] hover:border-[#6600FF]/50 transition-all duration-300 group">
                    <div class="h-48 bg-gradient-to-br from-[#0B0F19] to-[#1E1B3A] flex items-center justify-center relative overflow-hidden">
                        <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/carbon-fibre.png')] opacity-20"></div>
                        <span class="text-7xl group-hover:scale-110 transition-transform duration-500 relative z-10">{{ $product->type == 'android' ? '📱' : '🎮' }}</span>
                    </div>
                    <div class="p-6 relative">
                        <div class="flex justify-between items-start mb-3">
                            <h3 class="text-xl font-bold text-white truncate pr-2">{{ $product->title }}</h3>
                            <span class="shrink-0 inline-flex items-center px-3 py-1 rounded-full text-xs font-bold {{ $product->type == 'android' ? 'bg-[#00FF66]/20 text-[#00FF66] border border-[#00FF66]/30' : 'bg-[#6600FF]/20 text-[#a366ff] border border-[#6600FF]/30' }} uppercase tracking-wider">
                                {{ $product->type }}
                            </span>
                        </div>
                        <div class="flex items-center mb-4">
                            <span class="text-yellow-400 text-sm">★★★★☆</span>
                            <span class="text-gray-500 text-xs ml-2">(4.8)</span>
                        </div>
                        <p class="text-gray-400 text-sm mb-6 h-10 overflow-hidden line-clamp-2">{{ $product->description ?? 'Deskripsi tidak tersedia.' }}</p>
                        <div class="flex justify-between items-center pt-4 border-t border-[#2A2B3D]">
                            <div>
                                <span class="text-2xl font-extrabold text-[#00FF66]">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                                <span class="text-gray-500 text-xs">/minggu</span>
                            </div>
                            @auth
                                @if(!auth()->user()->is_admin)
                                <form action="{{ route('cart.store', $product) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="bg-[#00FF66] hover:bg-[#00CC52] text-[#0D0D12] p-3 rounded-lg font-bold shadow-[0_0_15px_rgba(0,255,102,0.3)] transition-transform transform hover:scale-105" title="Tambah ke Keranjang">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                                    </button>
                                </form>
                                @endif
                            @else
                                <a href="{{ route('login') }}" class="bg-[#2A2B3D] text-gray-300 px-4 py-2 text-sm rounded-lg hover:bg-[#3F4059] transition-colors border border-[#3F4059]">Login</a>
                            @endauth
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-16 bg-[#1A1B26] border border-[#2A2B3D] rounded-xl">
                    <div class="text-5xl mb-4 opacity-50">🛒</div>
                    <p class="text-gray-400 text-xl font-medium">Belum ada produk yang tersedia.</p>
                </div>
            @endforelse
        </div>
    </main>
</body>
</html>
