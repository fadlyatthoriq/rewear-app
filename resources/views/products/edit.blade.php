@extends('layouts.master')

@section('title', 'Edit Product')

@section('main')
<section class="min-h-screen bg-gray-50 py-8 antialiased dark:bg-gray-900 md:py-12">
    <div class="mx-auto max-w-screen-xl px-4 2xl:px-0">
        <div class="mb-8">
            <h2 class="text-2xl font-bold text-gray-900 dark:text-white sm:text-3xl">Edit Product</h2>
            <p class="mt-2 text-base text-gray-500 dark:text-gray-400">Update your product information</p>
        </div>

        <div class="p-6 bg-white border border-gray-200 rounded-xl shadow-sm dark:border-gray-700 sm:p-8 dark:bg-gray-800">
            <form action="{{ route('products.update', $product) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Product Name -->
                    <div class="col-span-2">
                        <label for="name" class="block mb-2 text-sm font-semibold text-gray-900 dark:text-white">Product Name</label>
                        <input type="text" name="name" id="name" value="{{ old('name', $product->name) }}" required
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
                                <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
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
                            <option value="new" {{ old('condition', $product->condition) == 'new' ? 'selected' : '' }}>New</option>
                            <option value="like_new" {{ old('condition', $product->condition) == 'like_new' ? 'selected' : '' }}>Like New</option>
                            <option value="good" {{ old('condition', $product->condition) == 'good' ? 'selected' : '' }}>Good</option>
                            <option value="fair" {{ old('condition', $product->condition) == 'fair' ? 'selected' : '' }}>Fair</option>
                        </select>
                        @error('condition')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Price -->
                    <div>
                        <label for="price" class="block mb-2 text-sm font-semibold text-gray-900 dark:text-white">Price (Rp)</label>
                        <div class="relative">
                            <input type="number" name="price" id="price" value="{{ old('price', $product->price) }}" required min="0"
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
                        <input type="number" name="stock" id="stock" value="{{ old('stock', $product->stock) }}" required min="0"
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
                            <option value="active" {{ old('status', $product->status) == 'active' ? 'selected' : '' }}>Active</option>
                            <option value="inactive" {{ old('status', $product->status) == 'inactive' ? 'selected' : '' }}>Inactive</option>
                        </select>
                        @error('status')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Product Image -->
                    <div class="col-span-2">
                        <label for="image-upload-edit" class="block mb-2 text-sm font-semibold text-gray-900 dark:text-white">Product Image</label>
                        <div class="relative w-full border-2 border-gray-300 border-dashed rounded-lg bg-gray-50 dark:bg-gray-700 p-4 min-h-[200px] flex items-center justify-center overflow-hidden transition-all duration-200" id="image-upload-area-combined-edit">
                            <!-- Existing Image Display (visible if product->image exists and no new file selected) -->
                            <div class="absolute inset-0 flex items-center justify-center group {{ $product->image && !old('image') ? '' : 'hidden' }}" id="current-image-display-edit">
                                <div class="relative w-48 h-48">
                                    <img src="{{ $product->image }}" alt="{{ $product->name }}" class="w-full h-full object-cover rounded-lg shadow-md transition-transform duration-200 group-hover:scale-105">
                                    <button type="button" id="remove-current-image-edit" class="absolute top-2 right-2 bg-red-500 text-white rounded-full p-1.5 hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition-all duration-200 z-10">
                                        <i class="fas fa-times w-4 h-4"></i>
                                    </button>
                                </div>
                            </div>

                            <!-- New Image Preview (visible after new file selected) -->
                            <div class="absolute inset-0 flex items-center justify-center group hidden" id="new-image-preview-edit">
                                <div class="relative w-48 h-48">
                                    <img src="" alt="New image preview" class="w-full h-48 object-cover rounded-lg shadow-md transition-transform duration-200 group-hover:scale-105">
                                    <button type="button" id="remove-new-image-edit" class="absolute top-2 right-2 bg-red-500 text-white rounded-full p-1.5 hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition-all duration-200 z-10">
                                        <i class="fas fa-times w-4 h-4"></i>
                                    </button>
                                </div>
                            </div>

                            <!-- Upload Placeholder (visible initially if no image, or if image removed/cleared) -->
                            <label for="image-upload-edit" class="absolute inset-0 flex flex-col items-center justify-center cursor-pointer hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors duration-200 {{ $product->image ? 'hidden' : '' }} z-0" id="upload-text-area-edit-label">
                                <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                    <i class="fas fa-cloud-upload-alt text-4xl text-gray-500 dark:text-gray-400 mb-4"></i>
                                    <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold">Click to upload</span> or drag and drop</p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">PNG, JPG or JPEG (MAX. 2MB)</p>
                                </div>
                            </label>
                            <input type="file" name="image" id="image-upload-edit" accept="image/*" class="hidden" />

                            <!-- Loading Spinner (positioned over everything) -->
                            <div id="loading-spinner-edit" class="absolute inset-0 flex items-center justify-center hidden bg-gray-50 dark:bg-gray-700 bg-opacity-75 dark:bg-opacity-75 z-20">
                                <div class="flex items-center justify-center space-x-2">
                                    <svg class="animate-spin h-6 w-6 text-primary" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                    </svg>
                                    <span class="text-sm text-gray-600 dark:text-gray-400 font-medium">Uploading image...</span>
                                </div>
                            </div>
                        </div>
                        <!-- File Name and Upload Status below the main area -->
                        <div id="file-name-edit" class="mt-2 text-sm text-gray-600 dark:text-gray-300 font-medium hidden"></div>
                        <div id="upload-status-edit" class="mt-2 text-sm text-green-600 dark:text-green-400 hidden flex items-center">
                            <i class="fas fa-check-circle inline w-5 h-5 mr-1.5"></i>
                            Image uploaded successfully
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
                            placeholder="Enter product description">{{ old('description', $product->description) }}</textarea>
                        @error('description')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="flex flex-col sm:flex-row justify-end space-y-3 sm:space-y-0 sm:space-x-4 mt-8">
                    <a href="{{ route('account') }}" 
                        class="inline-flex justify-center items-center px-5 py-3 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-4 focus:outline-none focus:ring-gray-200 focus:text:primary-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700 dark:focus:ring-gray-700 transition-colors duration-200">
                        Cancel
                    </a>
                    <button type="submit" 
                        class="inline-flex justify-center items-center px-5 py-3 text-sm font-medium text-white !bg-primary-600 hover:!bg-primary-600 focus:ring-4 focus:!ring-primary-300 rounded-lg dark:!bg-primary-600 dark:hover:!bg-primary-700 focus:outline-none dark:focus:!ring-primary-800 transition-colors duration-200">
                        Update Product
                    </button>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const fileInput = document.getElementById('image-upload-edit');
        const fileNameDisplay = document.getElementById('file-name-edit');
        const newImagePreview = document.getElementById('new-image-preview-edit');
        const newImagePreviewImg = newImagePreview ? newImagePreview.querySelector('img') : null;
        const uploadTextAreaLabel = document.getElementById('upload-text-area-edit-label');
        const uploadStatus = document.getElementById('upload-status-edit');
        const loadingSpinner = document.getElementById('loading-spinner-edit');
        const currentImageDisplay = document.getElementById('current-image-display-edit');
        const removeCurrentBtn = document.getElementById('remove-current-image-edit');
        const removeNewBtn = document.getElementById('remove-new-image-edit');
        const form = document.querySelector('form');

        // Function to reset display to initial state (either current image or upload area)
        function resetImageDisplay() {
            // Always hide new image preview and related statuses
            newImagePreview.classList.add('hidden');
            if (newImagePreviewImg) newImagePreviewImg.src = ''; 
            uploadStatus.classList.add('hidden');
            loadingSpinner.classList.add('hidden');
            fileNameDisplay.classList.add('hidden');
            fileNameDisplay.textContent = '';
            fileInput.value = ''; // Crucial: clear the file input

            // Determine whether to show existing image or upload area
            const hasCurrentImage = currentImageDisplay && currentImageDisplay.querySelector('img').src && currentImageDisplay.querySelector('img').src !== '{{ url('') }}';
            if (hasCurrentImage) {
                currentImageDisplay.classList.remove('hidden'); // Show existing image
                uploadTextAreaLabel.classList.add('hidden');    // Hide upload area
            } else {
                currentImageDisplay.classList.add('hidden');    // Hide existing image (if no image or already hidden)
                uploadTextAreaLabel.classList.remove('hidden'); // Show upload area
            }
        }

        // Initial state check for edit form
        resetImageDisplay();

        if (fileInput) {
            fileInput.addEventListener('change', function(event) {
                if (fileInput.files && fileInput.files[0]) {
                    const file = fileInput.files[0];
                    
                    // Validate file size (2MB max)
                    if (file.size > 2 * 1024 * 1024) {
                        alert('File size must be less than 2MB');
                        resetImageDisplay();
                        return;
                    }

                    // Validate file type
                    if (!file.type.startsWith('image/')) {
                        alert('Please select an image file');
                        resetImageDisplay();
                        return;
                    }

                    fileNameDisplay.textContent = `Selected file: ${file.name}`;
                    fileNameDisplay.classList.remove('hidden');
                    
                    // Show loading spinner
                    loadingSpinner.classList.remove('hidden');
                    uploadTextAreaLabel.classList.add('hidden');
                    currentImageDisplay.classList.add('hidden'); // Hide current image when new one is being uploaded
                    newImagePreview.classList.add('hidden');
                    uploadStatus.classList.add('hidden');

                    // Create FormData for upload
                    const formData = new FormData();
                    formData.append('image', file);
                    formData.append('_token', '{{ csrf_token() }}');

                    // Upload image via AJAX
                    fetch(window.location.origin + '{{ route('products.upload-image') }}', {
                        method: 'POST',
                        body: formData
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            // Show success message
                            uploadStatus.classList.remove('hidden');
                            
                            // Show image preview
                            if (newImagePreviewImg) {
                                newImagePreviewImg.src = data.url;
                                newImagePreview.classList.remove('hidden');
                            }
                        } else {
                            throw new Error(data.message || 'Upload failed');
                        }
                    })
                    .catch(error => {
                        alert(error.message || 'Failed to upload image. Please try again.');
                        resetImageDisplay();
                    })
                    .finally(() => {
                        loadingSpinner.classList.add('hidden');
                    });
                } else {
                    resetImageDisplay();
                }
            });
        }

        if (removeCurrentBtn) {
            removeCurrentBtn.addEventListener('click', function() {
                currentImageDisplay.classList.add('hidden');
                uploadTextAreaLabel.classList.remove('hidden');
                fileInput.value = ''; // Clear the file input
            });
        }

        if (removeNewBtn) {
            removeNewBtn.addEventListener('click', function() {
                resetImageDisplay();
            });
        }
    });
</script>
@endpush 