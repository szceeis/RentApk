<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-white tracking-wide border-l-4 border-[#00FF66] pl-3">
            {{ __('Keranjang Belanja') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-[#1A1B26] overflow-hidden shadow-[0_0_20px_rgba(0,0,0,0.5)] sm:rounded-xl border border-[#2A2B3D]">
                <div class="p-8 text-gray-200">
                    
                    @if(session('success'))
                        <div class="bg-[#00FF66]/10 border border-[#00FF66]/50 text-[#00FF66] p-4 rounded-lg mb-6 shadow-[0_0_15px_rgba(0,255,102,0.1)]">{{ session('success') }}</div>
                    @endif
                    @if(session('error'))
                        <div class="bg-red-500/10 border border-red-500/50 text-red-400 p-4 rounded-lg mb-6 shadow-[0_0_15px_rgba(239,68,68,0.1)]">{{ session('error') }}</div>
                    @endif

                    @if($carts->isEmpty())
                        <div class="text-center py-16">
                            <div class="text-6xl mb-4 opacity-50">🛒</div>
                            <p class="text-gray-400 text-xl mb-6">Keranjang Anda masih kosong.</p>
                            <a href="{{ route('home') }}" class="bg-[#6600FF] text-white px-6 py-3 rounded-lg font-bold hover:bg-[#5500DD] transition shadow-[0_0_15px_rgba(102,0,255,0.4)]">Mulai Belanja</a>
                        </div>
                    @else
                        <div class="space-y-6">
                            @foreach($carts as $cart)
                                <div class="flex items-center justify-between border border-[#2A2B3D] bg-[#0B0F19] rounded-lg p-6 hover:border-[#6600FF]/50 transition duration-300">
                                    <div class="flex items-center space-x-6">
                                        <div class="w-20 h-20 bg-gradient-to-br from-[#1A1B26] to-[#2A2B3D] rounded-lg flex items-center justify-center text-4xl shadow-inner border border-[#3F4059] overflow-hidden">
                                            @if($cart->product->image)
                                                <img src="{{ Storage::url($cart->product->image) }}" class="w-full h-full object-cover" alt="{{ $cart->product->title }}">
                                            @else
                                                {{ $cart->product->type == 'android' ? '📱' : '🎮' }}
                                            @endif
                                        </div>
                                        <div>
                                            <h4 class="font-extrabold text-xl text-white">{{ $cart->product->title }}</h4>
                                            <p class="text-sm font-bold mt-1 {{ $cart->product->type == 'android' ? 'text-[#00FF66]' : 'text-[#6600FF]' }} uppercase tracking-widest">{{ $cart->product->type }}</p>
                                        </div>
                                    </div>
                                    <div class="flex items-center space-x-8">
                                        <span class="font-black text-2xl text-[#00FF66]">Rp {{ number_format($cart->product->price, 0, ',', '.') }}</span>
                                        <form action="{{ route('cart.destroy', $cart) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="bg-red-500/10 text-red-500 hover:bg-red-500 hover:text-white p-3 rounded-lg transition-all" title="Hapus">
                                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="mt-10 pt-6 border-t border-[#2A2B3D] flex justify-end">
                            <a href="{{ route('checkout.index') }}" class="bg-[#00FF66] text-[#0D0D12] px-8 py-4 rounded-lg font-extrabold text-lg hover:bg-[#00CC52] transition shadow-[0_0_20px_rgba(0,255,102,0.4)] flex items-center">
                                Lanjut ke Pembayaran 
                                <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
