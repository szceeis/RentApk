<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-white tracking-wide border-l-4 border-[#6600FF] pl-3">
            {{ __('Manage Products') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if(session('success'))
                <div class="bg-[#00FF66]/10 border border-[#00FF66]/50 text-[#00FF66] p-4 rounded-lg mb-6 shadow-[0_0_15px_rgba(0,255,102,0.1)]">{{ session('success') }}</div>
            @endif

            <div class="mb-6 flex justify-end">
                <a href="{{ route('admin.products.create') }}" class="bg-[#6600FF] hover:bg-[#5500DD] text-white font-bold py-2 px-6 rounded-lg shadow-[0_0_15px_rgba(102,0,255,0.4)] transition">
                    + ADD PRODUCT
                </a>
            </div>

            <div class="bg-[#1A1B26] overflow-hidden shadow-lg sm:rounded-xl border border-[#2A2B3D]">
                <div class="p-6">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="border-b border-[#3F4059] text-gray-400 text-sm tracking-wider uppercase">
                                <th class="py-4 px-6 font-bold">Image</th>
                                <th class="py-4 px-6 font-bold">Title</th>
                                <th class="py-4 px-6 font-bold">Type</th>
                                <th class="py-4 px-6 font-bold">Price</th>
                                <th class="py-4 px-6 font-bold text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-200">
                            @forelse($products as $product)
                            <tr class="border-b border-[#2A2B3D] hover:bg-[#0B0F19] transition duration-200">
                                <td class="py-4 px-6">
                                    @if($product->image)
                                        <img src="{{ Storage::url($product->image) }}" class="h-16 w-24 object-cover rounded border border-[#3F4059]" alt="{{ $product->title }}">
                                    @else
                                        <div class="h-16 w-24 bg-[#0B0F19] rounded border border-[#3F4059] flex items-center justify-center text-2xl">
                                            {{ $product->type == 'android' ? '📱' : '🎮' }}
                                        </div>
                                    @endif
                                </td>
                                <td class="py-4 px-6 font-bold text-white">{{ $product->title }}</td>
                                <td class="py-4 px-6">
                                    <span class="px-3 py-1 rounded-full text-xs font-bold {{ $product->type == 'android' ? 'bg-[#00FF66]/20 text-[#00FF66] border border-[#00FF66]/30' : 'bg-[#6600FF]/20 text-[#a366ff] border border-[#6600FF]/30' }} uppercase tracking-wider">
                                        {{ ucfirst($product->type) }}
                                    </span>
                                </td>
                                <td class="py-4 px-6 font-bold text-[#00FF66]">Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                                <td class="py-4 px-6 text-right">
                                    <a href="{{ route('admin.products.edit', $product) }}" class="text-[#6600FF] hover:text-[#8A2BE2] font-bold mr-4 transition">Edit</a>
                                    <form action="{{ route('admin.products.destroy', $product) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this product?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:text-red-400 font-bold transition">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="py-8 text-center text-gray-500 font-medium">No products available.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
