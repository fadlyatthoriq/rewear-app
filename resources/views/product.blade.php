@extends('layouts.master')

@section('title', $product->name)

@section('main')
<section class="min-h-screen py-12 bg-gradient-to-b from-gray-50 to-white dark:from-gray-900 dark:to-gray-800 antialiased">
    <div class="max-w-screen-xl px-4 mx-auto 2xl:px-0">
        <!-- Breadcrumb -->
        <nav class="mb-8 flex" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li class="inline-flex items-center">
                    <a href="{{ route('home') }}" class="text-sm font-medium text-gray-700 hover:text-primary dark:text-gray-400 dark:hover:text-white">
                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path>
                        </svg>
                        Home
                    </a>
                </li>
                <li>
                    <div class="flex items-center">
                        <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        <a href="{{ route('shop') }}" class="ml-1 text-sm font-medium text-gray-700 hover:text-primary md:ml-2 dark:text-gray-400 dark:hover:text-white">Shop</a>
                    </div>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2 dark:text-gray-400">{{ $product->name }}</span>
                    </div>
                </li>
            </ol>
        </nav>

        <div class="lg:grid lg:grid-cols-2 lg:gap-12 xl:gap-16 bg-white dark:bg-gray-800 p-6 sm:p-8 rounded-xl shadow-lg">
            <!-- Product Image Section -->
            <div class="shrink-0 max-w-md lg:max-w-lg mx-auto">
                <div class="aspect-square overflow-hidden rounded-xl bg-gray-100 cursor-pointer transition-all duration-300 hover:scale-105 hover:shadow-lg" id="product-image-container">
                    @if($product->image)
                        <img class="w-full h-full object-cover transform transition-transform duration-300 hover:scale-105" 
                             src="{{ $product->image }}" 
                             alt="{{ $product->name }}" />
                    @else
                        <img class="w-full h-full object-cover dark:hidden transform transition-transform duration-300 hover:scale-105" 
                             src="https://flowbite.s3.amazonaws.com/blocks/e-commerce/imac-front.svg" 
                             alt="Product Image Placeholder" />
                        <img class="w-full h-full object-cover hidden dark:block transform transition-transform duration-300 hover:scale-105" 
                             src="https://flowbite.s3.amazonaws.com/blocks/e-commerce/imac-front-dark.svg" 
                             alt="Product Image Placeholder" />
                    @endif
                </div>
            </div>

            <!-- Product Info Section -->
            <div class="mt-6 lg:mt-0 flex flex-col justify-between">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900 sm:text-3xl dark:text-white mb-4">
                        {{ $product->name }}
                    </h1>
                    <div class="mt-4 sm:items-center sm:gap-4 sm:flex">
                        <p class="text-3xl font-extrabold text-primary sm:text-4xl dark:text-primary">
                            Rp. {{ number_format($product->price) }}
                        </p>
                        <div class="mt-3 flex items-center gap-2">
                            @if($product->stock > 0)
                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200 shadow-sm">
                                    <svg class="w-3.5 h-3.5 mr-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                    </svg>
                                    In Stock
                                </span>
                                <span class="text-sm text-gray-600 dark:text-gray-400">
                                    {{ $product->stock }} items available
                                </span>
                            @else
                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-sm font-medium bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200 shadow-sm">
                                    <svg class="w-3.5 h-3.5 mr-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                    </svg>
                                    Out of Stock
                                </span>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="mt-6 sm:mt-8 flex flex-wrap items-center gap-3">
                    <div class="flex-1 w-full sm:w-auto">
                        <form action="{{ route('wishlist.add', $product->id) }}" method="POST" class="w-full">
                            @csrf
                            <button type="submit" title="Add to favorites" 
                               class="flex items-center justify-center w-full py-2.5 px-5 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-50 hover:text-primary focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700 transition-all duration-200 shadow-sm hover:shadow-md">
                                <svg class="w-5 h-5 -ms-2 me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12.01 6.001C6.5 1 1 8 5.782 13.001L12.011 20l6.23-7C23 8 17.5 1 12.01 6.002Z"/>
                                </svg>
                                Add to favorites
                            </button>
                        </form>
                    </div>

                    @if($product->stock > 0)
                    <form action="{{ route('cart.add', $product->id) }}" method="POST" class="flex-1 w-full sm:w-auto">
                        @csrf
                        <button type="submit" title="Add to cart" 
                            class="text-white w-full flex items-center justify-center bg-primary hover:bg-[#1e7a9c] focus:ring-4 focus:ring-primary/50 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-primary dark:hover:bg-[#1e7a9c] focus:outline-none dark:focus:ring-primary/50 transition-all duration-200 shadow-sm hover:shadow-md">
                            <svg class="w-5 h-5 -ms-2 me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4h1.5L8 16m0 0h8m-8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm.75-3H7.5M11 7H6.312M17 4v6m-3-3h6"/>
                            </svg>
                            Add to cart
                        </button>
                    </form>
                    @else
                    <button disabled 
                        class="text-white mt-4 sm:mt-0 flex items-center justify-center flex-1 bg-gray-400 cursor-not-allowed font-medium rounded-lg text-sm px-5 py-2.5 transition-all duration-200">
                        <svg class="w-5 h-5 -ms-2 me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                        Out of Stock
                    </button>
                    @endif
                </div>

                <hr class="my-6 md:my-8 border-gray-200 dark:border-gray-700" />

                <!-- Product Description -->
                <div class="bg-gray-50 dark:bg-gray-700/50 p-5 rounded-lg">
                    <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-3 flex items-center gap-2">
                        <svg class="w-5 h-5 text-primary" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5.586a1 1 0 0 1 .707.293l5.414 5.414a1 1 0 0 1 .293.707V19a2 2 0 0 1-2 2Z"/>
                        </svg>
                        Product Description
                    </h2>
                    <p class="text-gray-600 dark:text-gray-300 leading-relaxed">
                        {{ $product->description ?? 'No description available.' }}
                    </p>
                </div>

                <!-- Seller Information -->
                <div class="mt-6 border-t pt-6">
                    <h3 class="text-lg font-semibold mb-4 flex items-center gap-2">
                        <svg class="w-5 h-5 text-primary" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 21a9 9 0 1 0 0-18 9 9 0 0 0 0 18Zm0 0a8.949 8.949 0 0 0 4.951-1.488A3.987 3.987 0 0 0 13 16h-2a3.987 3.987 0 0 0-3.951 3.512A8.948 8.948 0 0 0 12 21Zm3-11a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
                        </svg>
                        Seller Information
                    </h3>
                    <div class="flex items-center space-x-4 p-4 bg-gray-50 dark:bg-gray-700/50 rounded-lg">
                        <img src="{{ $product->seller->profile_picture ? $product->seller->profile_picture : asset('images/default-avatar.png') }}" 
                             alt="{{ $product->seller->name }}" 
                             class="w-12 h-12 rounded-full object-cover border-2 border-primary/20">
                        <div class="flex-1">
                            <h4 class="font-medium text-gray-900 dark:text-white">{{ $product->seller->store_name ?? $product->seller->name }}</h4>
                            <p class="text-sm text-gray-600 dark:text-gray-400">Member since {{ $product->seller->created_at->format('M Y') }}</p>
                            @if($product->seller->phone)
                                <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">
                                    <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                    </svg>
                                    {{ $product->seller->phone }}
                                </p>
                            @endif
                        </div>
                        @if($product->seller->phone)
                            <div class="flex-shrink-0">
                                <a href="{{ \App\Helpers\WhatsAppHelper::generateWhatsAppUrl($product->seller->phone, 'Halo, saya tertarik dengan produk ' . $product->name . '. Apakah masih tersedia?') }}" 
                                   target="_blank" 
                                   rel="noopener noreferrer"
                                   class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-green-600 hover:bg-green-700 focus:ring-4 focus:ring-green-300 rounded-lg transition-all duration-200 shadow-sm hover:shadow-md">
                                    <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893A11.821 11.821 0 0020.885 3.488"/>
                                    </svg>
                                    Chat WhatsApp
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Image Modal -->
<div id="image-modal" class="fixed inset-0 bg-black/80 backdrop-blur-sm flex items-center justify-center z-50 hidden opacity-0 transition-opacity duration-300">
    <div class="relative w-auto max-w-2xl mx-4 p-4 bg-white/5 rounded-2xl shadow-2xl flex flex-col items-center">
        <!-- Close button -->
        <button id="close-modal" class="absolute -top-10 right-0 text-white hover:text-gray-300 transition-colors p-2 rounded-full hover:bg-white/10">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
        <!-- Product Title -->
        <div class="mb-4 text-center w-full">
            <span class="text-lg font-semibold text-white drop-shadow-lg">{{ $product->name }}</span>
        </div>
        <!-- Loading spinner -->
        <div id="modal-loading" class="absolute inset-0 flex items-center justify-center bg-black/40 rounded-2xl">
            <div class="animate-spin rounded-full h-12 w-12 border-4 border-white border-t-transparent"></div>
        </div>
        <!-- Image container -->
        <div class="relative overflow-hidden rounded-xl shadow-xl bg-gray-900 flex items-center justify-center">
            <img src="" alt="Enlarged Product Image" id="enlarged-image" 
                 class="max-h-[70vh] max-w-[80vw] w-auto h-auto object-contain rounded-xl transition-transform duration-300 cursor-zoom-in border-4 border-white/20 shadow-2xl">
        </div>
        <!-- Zoom controls -->
        <div class="mt-4 flex gap-2">
            <button id="zoom-in" class="bg-white/10 hover:bg-white/20 text-white p-2 rounded-full transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                </svg>
            </button>
            <button id="zoom-out" class="bg-white/10 hover:bg-white/20 text-white p-2 rounded-full transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4" />
                </svg>
            </button>
            <button id="reset-zoom" class="bg-white/10 hover:bg-white/20 text-white p-2 rounded-full transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                </svg>
            </button>
        </div>
    </div>
</div>

@push('scripts')
<script>
    const productImageContainer = document.getElementById('product-image-container');
    const imageModal = document.getElementById('image-modal');
    const enlargedImage = document.getElementById('enlarged-image');
    const closeModal = document.getElementById('close-modal');
    const modalLoading = document.getElementById('modal-loading');
    const zoomIn = document.getElementById('zoom-in');
    const zoomOut = document.getElementById('zoom-out');
    const resetZoom = document.getElementById('reset-zoom');

    let currentScale = 1;
    const ZOOM_STEP = 0.25;
    const MAX_ZOOM = 3;
    const MIN_ZOOM = 1;

    if (productImageContainer && imageModal && enlargedImage && closeModal) {
        // Open modal
        productImageContainer.addEventListener('click', () => {
            const imageUrl = productImageContainer.querySelector('img').src;
            modalLoading.classList.remove('hidden');
            imageModal.classList.remove('hidden');
            
            // Load image
            const img = new Image();
            img.onload = () => {
                enlargedImage.src = imageUrl;
                modalLoading.classList.add('hidden');
                // Show modal with animation
                setTimeout(() => {
                    imageModal.classList.remove('opacity-0');
                    imageModal.querySelector('.relative').classList.remove('scale-95');
                }, 50);
            };
            img.src = imageUrl;
        });

        // Close modal
        const closeModalHandler = () => {
            imageModal.classList.add('opacity-0');
            imageModal.querySelector('.relative').classList.add('scale-95');
            setTimeout(() => {
                imageModal.classList.add('hidden');
                enlargedImage.src = '';
                currentScale = 1;
                enlargedImage.style.transform = `scale(${currentScale})`;
            }, 300);
        };

        closeModal.addEventListener('click', closeModalHandler);
        imageModal.addEventListener('click', (event) => {
            if (event.target === imageModal) {
                closeModalHandler();
            }
        });

        // Zoom controls
        zoomIn.addEventListener('click', () => {
            if (currentScale < MAX_ZOOM) {
                currentScale += ZOOM_STEP;
                enlargedImage.style.transform = `scale(${currentScale})`;
            }
        });

        zoomOut.addEventListener('click', () => {
            if (currentScale > MIN_ZOOM) {
                currentScale -= ZOOM_STEP;
                enlargedImage.style.transform = `scale(${currentScale})`;
            }
        });

        resetZoom.addEventListener('click', () => {
            currentScale = 1;
            enlargedImage.style.transform = `scale(${currentScale})`;
        });

        // Double click to zoom
        enlargedImage.addEventListener('dblclick', () => {
            if (currentScale === 1) {
                currentScale = 2;
            } else {
                currentScale = 1;
            }
            enlargedImage.style.transform = `scale(${currentScale})`;
        });

        // Keyboard controls
        document.addEventListener('keydown', (event) => {
            if (!imageModal.classList.contains('hidden')) {
                if (event.key === 'Escape') {
                    closeModalHandler();
                } else if (event.key === '+') {
                    zoomIn.click();
                } else if (event.key === '-') {
                    zoomOut.click();
                } else if (event.key === '0') {
                    resetZoom.click();
                }
            }
        });
    }

    // Handle add to cart form submission
    document.querySelector('form[action*="cart/add"]').addEventListener('submit', function(e) {
        e.preventDefault();
        
        fetch(window.location.origin + this.action, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Accept': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            },
            body: new FormData(this)
        })
        .then(response => {
            if (response.status === 401) {
                Swal.fire({
                    toast: true,
                    position: 'top-end',
                    icon: 'warning',
                    title: 'Please login first to add items to cart',
                    showConfirmButton: false,
                    timer: 3000
                });
                return Promise.reject('Unauthorized');
            }

            if (!response.ok) {
                return response.json().then(data => {
                    Swal.fire({
                        toast: true,
                        position: 'top-end',
                        icon: 'error',
                        title: data.message || 'Something went wrong! Please try again.',
                        showConfirmButton: false,
                        timer: 3000
                    });
                    throw new Error(data.message || 'Something went wrong!');
                }).catch(() => {
                    throw new Error('Network response was not ok');
                });
            }
            return response.json();
        })
        .then(data => {
            if (data.status === 'success') {
                const cartCountElement = document.querySelector('.cart-count');
                if (data.cartCount > 0) {
                    if (cartCountElement) {
                        cartCountElement.textContent = data.cartCount;
                    } else {
                        const cartLink = document.querySelector('a[href="/cart"]');
                        const countSpan = document.createElement('span');
                        countSpan.className = 'absolute -top-2 -right-2 bg-primary text-white text-xs rounded-full w-5 h-5 flex items-center justify-center shadow cart-count';
                        countSpan.textContent = data.cartCount;
                        cartLink.appendChild(countSpan);
                    }
                }

                Swal.fire({
                    toast: true,
                    position: 'top-end',
                    icon: 'success',
                    title: data.message,
                    showConfirmButton: false,
                    timer: 3000
                });
            }
        })
        .catch(error => {
            console.error('Error:', error);
            if (error !== 'Unauthorized') {
                Swal.fire({
                    toast: true,
                    position: 'top-end',
                    icon: 'error',
                    title: 'Something went wrong! Please try again.',
                    showConfirmButton: false,
                    timer: 3000
                });
            }
        });
    });

    // Handle add to wishlist form submission
    document.querySelector('form[action*="wishlist/add"]').addEventListener('submit', function(e) {
        e.preventDefault();
        
        fetch(window.location.origin + this.action, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Accept': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            },
            body: new FormData(this)
        })
        .then(response => {
            if (response.status === 401) {
                Swal.fire({
                    toast: true,
                    position: 'top-end',
                    icon: 'warning',
                    title: 'Please login first to add items to wishlist',
                    showConfirmButton: false,
                    timer: 3000
                });
                return Promise.reject('Unauthorized');
            }

            if (!response.ok) {
                return response.json().then(data => {
                    Swal.fire({
                        toast: true,
                        position: 'top-end',
                        icon: 'error',
                        title: data.message || 'Something went wrong! Please try again.',
                        showConfirmButton: false,
                        timer: 3000
                    });
                    throw new Error(data.message || 'Something went wrong!');
                }).catch(() => {
                    throw new Error('Network response was not ok');
                });
            }
            return response.json();
        })
        .then(data => {
            const wishlistCountElement = document.querySelector('a[href*="wishlist"] span');
            if (data.wishlistCount > 0) {
                if (wishlistCountElement) {
                    wishlistCountElement.textContent = data.wishlistCount;
                } else {
                    const wishlistLink = document.querySelector('a[href*="wishlist"]');
                    const countSpan = document.createElement('span');
                    countSpan.className = 'absolute -top-2 -right-2 bg-primary text-white text-xs rounded-full w-5 h-5 flex items-center justify-center shadow';
                    countSpan.textContent = data.wishlistCount;
                    wishlistLink.appendChild(countSpan);
                }
            }

            Swal.fire({
                toast: true,
                position: 'top-end',
                icon: 'success',
                title: data.message,
                showConfirmButton: false,
                timer: 3000
            });
        })
        .catch(error => {
            console.error('Error:', error);
            if (error !== 'Unauthorized') {
                Swal.fire({
                    toast: true,
                    position: 'top-end',
                    icon: 'error',
                    title: 'Something went wrong! Please try again.',
                    showConfirmButton: false,
                    timer: 3000
                });
            }
        });
    });
</script>
@endpush
@endsection