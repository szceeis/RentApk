<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-white tracking-wide border-l-4 border-[#6600FF] pl-3">
            {{ __('Penyewaan Saya') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if(session('success'))
                <div class="bg-[#00FF66]/10 border border-[#00FF66]/50 text-[#00FF66] p-4 rounded-lg mb-6 shadow-[0_0_15px_rgba(0,255,102,0.1)]">{{ session('success') }}</div>
            @endif

            <div class="bg-[#1A1B26] overflow-hidden shadow-[0_0_20px_rgba(0,0,0,0.5)] sm:rounded-xl border border-[#2A2B3D]">
                <div class="p-8 text-gray-200">
                    <h3 class="text-2xl font-bold mb-8 text-white flex items-center"><span class="bg-[#6600FF] w-2 h-6 mr-3 rounded"></span> Riwayat Sewa</h3>
                    
                    <div class="space-y-6">
                        @forelse($transactions as $trx)
                            <div class="border {{ $trx->status == 'expired' ? 'border-[#2A2B3D] opacity-60' : 'border-[#3F4059] shadow-lg' }} bg-[#0B0F19] rounded-xl p-6 relative transition-all duration-300">
                                <div class="flex justify-between items-start mb-6">
                                    <div class="flex items-center space-x-4">
                                        <div class="w-16 h-16 bg-[#1A1B26] rounded-lg border border-[#3F4059] flex items-center justify-center overflow-hidden">
                                            @if($trx->product && $trx->product->image)
                                                <img src="{{ Storage::url($trx->product->image) }}" class="w-full h-full object-cover">
                                            @elseif($trx->product)
                                                <span class="text-3xl">{{ $trx->product->type == 'android' ? '📱' : '🎮' }}</span>
                                            @else
                                                <span class="text-3xl">🗑️</span>
                                            @endif
                                        </div>
                                        <div>
                                            <h4 class="font-extrabold text-xl text-white">{{ $trx->product->title ?? 'Product Deleted' }}</h4>
                                            <p class="text-sm text-gray-500 mt-1">Tgl Transaksi: {{ $trx->created_at->format('d M Y') }}</p>
                                        </div>
                                    </div>
                                    <div>
                                        @if($trx->status == 'pending')
                                            <span class="px-4 py-1.5 bg-yellow-500/20 text-yellow-400 border border-yellow-500/50 rounded-full text-xs font-bold uppercase tracking-wider shadow-[0_0_10px_rgba(234,179,8,0.2)]">Menunggu Konfirmasi</span>
                                        @elseif($trx->status == 'active')
                                            <span class="px-4 py-1.5 bg-[#00FF66]/20 text-[#00FF66] border border-[#00FF66]/50 rounded-full text-xs font-bold uppercase tracking-wider shadow-[0_0_10px_rgba(0,255,102,0.2)]">Aktif</span>
                                        @else
                                            <span class="px-4 py-1.5 bg-red-500/20 text-red-400 border border-red-500/50 rounded-full text-xs font-bold uppercase tracking-wider shadow-[0_0_10px_rgba(239,68,68,0.2)]">Kedaluwarsa</span>
                                        @endif
                                    </div>
                                </div>
                                
                                <div class="bg-[#1A1B26] rounded-lg p-5 border border-[#2A2B3D]">
                                    <div class="flex justify-between items-center mb-3">
                                        <span class="text-gray-400 text-sm">Durasi Sewa:</span>
                                        <span class="font-bold text-gray-200">1 Minggu</span>
                                    </div>
                                    @if($trx->status == 'active')
                                        <div class="flex justify-between items-center mb-4">
                                            <span class="text-gray-400 text-sm">Batas Waktu:</span>
                                            <div class="font-mono bg-[#0B0F19] text-[#00FF66] px-3 py-1 rounded border border-[#00FF66]/30 shadow-inner tracking-widest font-bold">
                                                {{ $trx->rent_end->format('d M Y - H:i') }}
                                            </div>
                                        </div>
                                        <div class="mt-5 pt-5 border-t border-[#3F4059]">
                                            <p class="text-sm text-gray-400 mb-3">Link Akses Produk ({{ ucfirst($trx->product->type) }}):</p>
                                            <a href="{{ $trx->product->access_link }}" target="_blank" class="inline-block w-full text-center bg-gradient-to-r from-[#6600FF] to-[#8A2BE2] text-white px-6 py-3 rounded-lg font-bold hover:shadow-[0_0_20px_rgba(102,0,255,0.6)] hover:scale-[1.02] transition-all">
                                                AKSES SEKARANG
                                            </a>
                                        </div>
                                    @elseif($trx->status == 'pending')
                                        <p class="text-sm text-yellow-500/80 text-center italic mt-4 bg-yellow-500/10 p-3 rounded">⏳ Link akses akan muncul setelah pembayaran dikonfirmasi oleh Admin.</p>
                                    @else
                                        <p class="text-sm text-[#4B5563] text-center font-bold mt-4 bg-[#0B0F19] border border-[#2A2B3D] p-3 rounded uppercase tracking-widest">🚫 Waktu sewa telah habis. Link ditutup.</p>
                                    @endif
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-16">
                                <div class="text-5xl mb-4 opacity-50">🕹️</div>
                                <p class="text-gray-400 text-xl mb-6">Anda belum memiliki riwayat penyewaan.</p>
                                <a href="{{ route('home') }}" class="bg-[#6600FF] text-white px-6 py-3 rounded-lg font-bold hover:bg-[#5500DD] transition shadow-[0_0_15px_rgba(102,0,255,0.4)]">Lihat Katalog Produk</a>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
