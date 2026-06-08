<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Product') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form action="{{ route('admin.products.update', $product) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-4">
                        <label class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2" for="title">Title</label>
                        <input type="text" name="title" id="title" value="{{ $product->title }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 dark:text-gray-300 dark:bg-gray-900 leading-tight focus:outline-none focus:shadow-outline" required>
                    </div>
                    
                    <div class="mb-4">
                        <label class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2" for="type">Type</label>
                        <select name="type" id="type" class="shadow border rounded w-full py-2 px-3 text-gray-700 dark:text-gray-300 dark:bg-gray-900 leading-tight focus:outline-none focus:shadow-outline" required>
                            <option value="android" {{ $product->type == 'android' ? 'selected' : '' }}>Android App (Github)</option>
                            <option value="gdevelop" {{ $product->type == 'gdevelop' ? 'selected' : '' }}>GDevelop Game (Itch.io)</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2" for="price">Price (Rp)</label>
                        <input type="number" name="price" id="price" value="{{ $product->price }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 dark:text-gray-300 dark:bg-gray-900 leading-tight focus:outline-none focus:shadow-outline" required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2" for="access_link">Access Link (URL)</label>
                        <input type="url" name="access_link" id="access_link" value="{{ $product->access_link }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 dark:text-gray-300 dark:bg-gray-900 leading-tight focus:outline-none focus:shadow-outline" required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2" for="description">Description</label>
                        <textarea name="description" id="description" rows="4" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 dark:text-gray-300 dark:bg-gray-900 leading-tight focus:outline-none focus:shadow-outline">{{ $product->description }}</textarea>
                    </div>

                    <div class="flex items-center justify-between">
                        <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                            Update Product
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
