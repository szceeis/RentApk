<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-white tracking-wide border-l-4 border-[#00FF66] pl-3">
            {{ __('Checkout Simulasi') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-[#1A1B26] overflow-hidden shadow-[0_0_20px_rgba(0,0,0,0.5)] sm:rounded-xl border border-[#2A2B3D] p-8 flex flex-col md:flex-row gap-10">
                
                <div class="flex-1">
                    <h3 class="text-2xl font-bold mb-6 text-white border-b border-[#2A2B3D] pb-3">Ringkasan Pesanan</h3>
                    <div class="space-y-4 mb-8">
                        @foreach($carts as $cart)
                            <div class="flex justify-between items-center bg-[#0B0F19] p-4 rounded-lg border border-[#2A2B3D]">
                                <span class="text-gray-200 font-medium">{{ $cart->product->title }}</span>
                                <span class="font-bold text-[#00FF66]">Rp {{ number_format($cart->product->price, 0, ',', '.') }}</span>
                            </div>
                        @endforeach
                    </div>
                    <div class="flex justify-between items-center text-xl font-black bg-[#6600FF]/10 border border-[#6600FF]/30 p-6 rounded-xl">
                        <span class="text-white">Total Pembayaran:</span>
                        <span class="text-[#00FF66] text-3xl drop-shadow-[0_0_8px_rgba(0,255,102,0.4)]">Rp {{ number_format($total, 0, ',', '.') }}</span>
                    </div>
                </div>

                <div class="flex-1 bg-[#0B0F19] p-8 rounded-xl border border-[#2A2B3D] shadow-inner relative overflow-hidden">
                    <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-[#00FF66] to-[#6600FF]"></div>
                    <h3 class="text-xl font-bold mb-4 text-[#6600FF] flex items-center"><span class="text-2xl mr-2">💳</span> Instruksi Pembayaran</h3>
                    <p class="mb-4 text-sm text-gray-400">Transfer tepat sesuai total pembayaran ke rekening berikut:</p>
                    <div class="bg-[#1A1B26] p-6 rounded border border-[#2A2B3D] mb-8 font-mono text-center shadow-sm">
                        <div class="text-gray-500 text-xs mb-1">Bank Dummy Cyber</div>
                        <div class="text-2xl text-white tracking-widest font-bold">1234-5678-9012</div>
                        <div class="text-[#00FF66] text-sm mt-2">a.n RentalApp Official</div>
                    </div>
                    
                    <form action="{{ route('checkout.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                        @csrf
                        <div>
                            <label class="block text-gray-300 text-sm font-bold mb-3">Upload Bukti Transfer</label>
                            <div class="border-2 border-dashed border-[#3F4059] rounded-lg p-6 bg-[#1A1B26] text-center hover:border-[#6600FF] transition cursor-pointer">
                                <input type="file" name="proof_of_payment" required accept="image/*" class="w-full text-sm text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-bold file:bg-[#6600FF] file:text-white hover:file:bg-[#5500DD] cursor-pointer">
                            </div>
                            @error('proof_of_payment')
                                <p class="text-red-400 text-xs mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                        <button type="submit" class="w-full bg-[#00FF66] text-[#0D0D12] font-extrabold py-4 px-4 rounded-lg hover:bg-[#00CC52] transition shadow-[0_0_15px_rgba(0,255,102,0.3)] transform hover:-translate-y-1">Konfirmasi & Selesaikan Pesanan</button>
                    </form>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
