<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-white tracking-wide border-l-4 border-[#00FF66] pl-3">
            {{ __('Add Product') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-[#1A1B26] overflow-hidden shadow-lg sm:rounded-xl border border-[#2A2B3D] p-6">
                <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-4">
                        <label class="block text-gray-300 text-sm font-bold mb-2" for="title">Title</label>
                        <input type="text" name="title" id="title" class="shadow appearance-none border border-[#3F4059] rounded w-full py-2 px-3 text-white bg-[#0B0F19] leading-tight focus:outline-none focus:border-[#6600FF] focus:ring-1 focus:ring-[#6600FF]" required>
                    </div>
                    
                    <div class="mb-4">
                        <label class="block text-gray-300 text-sm font-bold mb-2" for="type">Type</label>
                        <select name="type" id="type" class="shadow border border-[#3F4059] rounded w-full py-2 px-3 text-white bg-[#0B0F19] leading-tight focus:outline-none focus:border-[#6600FF] focus:ring-1 focus:ring-[#6600FF]" required>
                            <option value="android">Android App (Github)</option>
                            <option value="gdevelop">GDevelop Game (Itch.io)</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-300 text-sm font-bold mb-2" for="price">Price (Rp)</label>
                        <input type="number" name="price" id="price" class="shadow appearance-none border border-[#3F4059] rounded w-full py-2 px-3 text-white bg-[#0B0F19] leading-tight focus:outline-none focus:border-[#6600FF] focus:ring-1 focus:ring-[#6600FF]" required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-300 text-sm font-bold mb-2" for="image">Product Image (Optional)</label>
                        <input type="file" name="image" id="image" accept="image/*" class="w-full text-sm text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-bold file:bg-[#6600FF] file:text-white hover:file:bg-[#5500DD] cursor-pointer bg-[#0B0F19] border border-[#3F4059] rounded p-2">
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-300 text-sm font-bold mb-2" for="access_link">Access Link (URL)</label>
                        <input type="url" name="access_link" id="access_link" class="shadow appearance-none border border-[#3F4059] rounded w-full py-2 px-3 text-white bg-[#0B0F19] leading-tight focus:outline-none focus:border-[#6600FF] focus:ring-1 focus:ring-[#6600FF]" required>
                    </div>

                    <div class="mb-6">
                        <label class="block text-gray-300 text-sm font-bold mb-2" for="description">Description</label>
                        <textarea name="description" id="description" rows="4" class="shadow appearance-none border border-[#3F4059] rounded w-full py-2 px-3 text-white bg-[#0B0F19] leading-tight focus:outline-none focus:border-[#6600FF] focus:ring-1 focus:ring-[#6600FF]"></textarea>
                    </div>

                    <div class="flex items-center justify-between">
                        <button type="submit" class="bg-[#00FF66] hover:bg-[#00CC52] text-[#0D0D12] font-bold py-2 px-6 rounded focus:outline-none focus:shadow-outline transition">
                            Save Product
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
