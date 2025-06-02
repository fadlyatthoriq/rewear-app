@extends('layouts.master')

@section('title', 'Add New Product')

@section('main')
<section class="min-h-screen bg-gray-50 py-8 antialiased dark:bg-gray-900 md:py-12">
    <div class="mx-auto max-w-screen-xl px-4 2xl:px-0">
        <div class="mb-8">
            <h2 class="text-2xl font-bold text-gray-900 dark:text-white sm:text-3xl">Add New Product</h2>
            <p class="mt-2 text-base text-gray-500 dark:text-gray-400">Create a new product listing for your store</p>
        </div>

        <div class="p-6 bg-white border border-gray-200 rounded-xl shadow-sm dark:border-gray-700 sm:p-8 dark:bg-gray-800">
            <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Product Name -->
                    <div class="col-span-2">
                        <label for="name" class="block mb-2 text-sm font-semibold text-gray-900 dark:text-white">Product Name</label>
                        <input type="text" name="name" id="name" value="{{ old('name') }}" required
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-3 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 transition-colors duration-200"
                            placeholder="Enter product name">
                        @error('name')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Category -->
                    <div>
                        <label for="category_id" class="block mb-2 text-sm font-semibold text-gray-900 dark:text-white">Category</label>
                        <select name="category_id" id="category_id" required
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-3 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 transition-colors duration-200">
                            <option value="">Select a category</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Condition -->
                    <div>
                        <label for="condition" class="block mb-2 text-sm font-semibold text-gray-900 dark:text-white">Condition</label>
                        <select name="condition" id="condition" required
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-3 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 transition-colors duration-200">
                            <option value="">Select condition</option>
                            <option value="new" {{ old('condition') == 'new' ? 'selected' : '' }}>New</option>
                            <option value="like_new" {{ old('condition') == 'like_new' ? 'selected' : '' }}>Like New</option>
                            <option value="good" {{ old('condition') == 'good' ? 'selected' : '' }}>Good</option>
                            <option value="fair" {{ old('condition') == 'fair' ? 'selected' : '' }}>Fair</option>
                        </select>
                        @error('condition')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Price -->
                    <div>
                        <label for="price" class="block mb-2 text-sm font-semibold text-gray-900 dark:text-white">Price (Rp)</label>
                        <div class="relative">
                            <input type="number" name="price" id="price" value="{{ old('price') }}" required min="0"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full pl-10 p-3 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 transition-colors duration-200"
                                placeholder="Enter price">
                        </div>
                        @error('price')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Stock -->
                    <div>
                        <label for="stock" class="block mb-2 text-sm font-semibold text-gray-900 dark:text-white">Stock</label>
                        <input type="number" name="stock" id="stock" value="{{ old('stock') }}" required min="0"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-3 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 transition-colors duration-200"
                            placeholder="Enter stock quantity">
                        @error('stock')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Status -->
                    <div>
                        <label for="status" class="block mb-2 text-sm font-semibold text-gray-900 dark:text-white">Status</label>
                        <select name="status" id="status" required
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-3 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 transition-colors duration-200">
                            <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                            <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                        </select>
                        @error('status')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Product Image -->
                    <div class="col-span-2">
                        <label for="image-upload" class="block mb-2 text-sm font-semibold text-gray-900 dark:text-white">Product Image</label>
                        <div class="flex items-center justify-center w-full">
                            <label for="image-upload" class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-gray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
                                <div class="flex flex-col items-center justify-center pt-5 pb-6" id="upload-text-area">
                                    <svg class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2"/>
                                    </svg>
                                    <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold">Click to upload</span> or drag and drop</p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">PNG, JPG or JPEG (MAX. 2MB)</p>
                                </div>
                                <input type="file" name="image" id="image-upload" required accept="image/*" class="hidden" />
                            </label>
                        </div>
                        <div id="file-name" class="mt-2 text-sm text-gray-600 dark:text-gray-300"></div>
                        <div id="image-preview" class="mt-4 hidden">
                            <img src="" alt="Image preview" class="w-32 h-32 object-cover rounded-lg shadow-md">
                        </div>
                        @error('image')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Description -->
                    <div class="col-span-2">
                        <label for="description" class="block mb-2 text-sm font-semibold text-gray-900 dark:text-white">Description</label>
                        <textarea name="description" id="description" rows="6" required
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-3 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 transition-colors duration-200"
                            placeholder="Enter product description">{{ old('description') }}</textarea>
                        @error('description')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="flex flex-col sm:flex-row justify-end space-y-3 sm:space-y-0 sm:space-x-4 mt-8">
                    <a href="{{ route('account') }}" 
                        class="inline-flex justify-center items-center px-5 py-3 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-4 focus:outline-none focus:ring-gray-200 focus:text-primary-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700 dark:focus:ring-gray-700 transition-colors duration-200">
                        Cancel
                    </a>
                    <button type="submit" 
                        class="inline-flex justify-center items-center px-5 py-3 text-sm font-medium text-white bg-primary hover:bg-primary-600 focus:ring-4 focus:ring-primary-300 rounded-lg dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800 transition-colors duration-200">
                        Create Product
                    </button>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection

<script>
    document.getElementById('image-upload').addEventListener('change', function(event) {
        const fileInput = event.target;
        const fileNameDisplay = document.getElementById('file-name');
        const imagePreview = document.getElementById('image-preview');
        const imagePreviewImg = imagePreview.querySelector('img');
        const uploadTextArea = document.getElementById('upload-text-area');

        if (fileInput.files && fileInput.files[0]) {
            const file = fileInput.files[0];
            fileNameDisplay.textContent = `Selected file: ${file.name}`;
            
            if (file.type.startsWith('image/')) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    imagePreviewImg.src = e.target.result;
                    imagePreview.classList.remove('hidden');
                     uploadTextArea.classList.add('hidden'); // Hide upload text
                }
                reader.readAsDataURL(file);
            } else {
                imagePreview.classList.add('hidden');
                uploadTextArea.classList.remove('hidden'); // Show upload text for non-images (though input accepts only images)
            }
        } else {
            fileNameDisplay.textContent = '';
            imagePreview.classList.add('hidden');
            imagePreviewImg.src = '';
            uploadTextArea.classList.remove('hidden'); // Show upload text when no file selected
        }
    });
</script>