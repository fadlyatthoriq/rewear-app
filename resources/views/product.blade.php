@extends('layouts.master')

@section('title', $product->name)

@section('main')
<section class="py-12 bg-gradient-to-b from-gray-50 to-white dark:from-gray-900 dark:to-gray-800 antialiased">
    <div class="max-w-screen-xl px-4 mx-auto 2xl:px-0">
      <div class="lg:grid lg:grid-cols-2 lg:gap-12 xl:gap-16 bg-white dark:bg-gray-800 p-6 sm:p-8 rounded-xl shadow-lg">
        <div class="shrink-0 max-w-md lg:max-w-lg mx-auto">
          <div class="aspect-square overflow-hidden rounded-xl bg-gray-100 cursor-pointer transition-all duration-300 hover:scale-105 hover:shadow-lg" id="product-image-container">
            @if($product->image_url)
              <img class="w-full h-full object-cover transform transition-transform duration-300 hover:scale-105" 
                   src="{{ asset('storage/' . $product->image_url) }}" 
                   alt="{{ $product->name }}" />
            @else
              <img class="w-full h-full object-cover dark:hidden transform transition-transform duration-300 hover:scale-105" src="https://flowbite.s3.amazonaws.com/blocks/e-commerce/imac-front.svg" alt="Product Image Placeholder" />
              <img class="w-full h-full object-cover hidden dark:block transform transition-transform duration-300 hover:scale-105" src="https://flowbite.s3.amazonaws.com/blocks/e-commerce/imac-front-dark.svg" alt="Product Image Placeholder" />
            @endif
          </div>
        </div>

        <div class="mt-6 lg:mt-0 flex flex-col justify-between">
          <div>
            <h1 class="text-2xl font-bold text-gray-900 sm:text-3xl dark:text-white mb-4">
              {{ $product->name }}
            </h1>
            <div class="mt-4 sm:items-center sm:gap-4 sm:flex">
              <p class="text-3xl font-extrabold text-primary-600 sm:text-4xl dark:text-primary-400">
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

          <div class="mt-6 sm:mt-8 flex flex-wrap items-center gap-3">
            <div class="flex-1 w-full sm:w-auto">
              <form action="{{ route('wishlist.add', $product->id) }}" method="POST" class="w-full">
                @csrf
                <button type="submit" title="Add to favorites" 
                   class="flex items-center justify-center w-full py-2.5 px-5 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-50 hover:text-primary-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700 transition-all duration-200 shadow-sm hover:shadow-md" role="button">
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
                <button type="submit" title="Add to cart" class="text-white w-full flex items-center justify-center bg-primary hover:bg-primary-700 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800 transition-all duration-200 shadow-sm hover:shadow-md" role="button">
                  <svg class="w-5 h-5 -ms-2 me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4h1.5L8 16m0 0h8m-8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm.75-3H7.5M11 7H6.312M17 4v6m-3-3h6"/>
                  </svg>
                  Add to cart
                </button>
            </form>
            @else
            <button disabled class="text-white mt-4 sm:mt-0 flex items-center justify-center flex-1 bg-gray-400 cursor-not-allowed font-medium rounded-lg text-sm px-5 py-2.5">
              Out of Stock
            </button>
            @endif
          </div>

          <hr class="my-6 md:my-8 border-gray-200 dark:border-gray-700" />

          <div class="bg-gray-50 dark:bg-gray-700/50 p-5 rounded-lg">
            <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-3">Product Description</h2>
            <p class="text-gray-600 dark:text-gray-300 leading-relaxed">
              {{ $product->description ?? 'No description available.' }}
            </p>
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
  </script>

  <script>
    // Handle add to cart form submission
    document.querySelector('form[action*="cart/add"]').addEventListener('submit', function(e) {
      e.preventDefault();
      
      fetch(this.action, {
        method: 'POST',
        headers: {
          'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
          'Accept': 'application/json',
          'X-Requested-With': 'XMLHttpRequest'
        },
        body: new FormData(this)
      })
      .then(response => {
        if (!response.ok) {
          throw new Error('Network response was not ok');
        }
        return response.json();
      })
      .then(data => {
        if (data.status === 'success') {
          // Update cart count in navbar
          const cartCountElement = document.querySelector('.cart-count');
          if (data.cartCount > 0) {
            if (cartCountElement) {
              cartCountElement.textContent = data.cartCount;
            } else {
              const cartLink = document.querySelector('a[href="/cart"]');
              const countSpan = document.createElement('span');
              countSpan.className = 'absolute -top-2 -right-2 bg-[#2596be] text-white text-xs rounded-full w-5 h-5 flex items-center justify-center shadow cart-count';
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
        } else {
          Swal.fire({
            toast: true,
            position: 'top-end',
            icon: 'error',
            title: data.message,
            showConfirmButton: false,
            timer: 3000
          });
        }
      })
      .catch(error => {
        console.error('Error:', error);
        // Check if session expired
        if (error.message.includes('<!DOCTYPE')) {
          Swal.fire({
            toast: true,
            position: 'top-end',
            icon: 'error',
            title: 'Your session has expired. Please refresh the page.',
            showConfirmButton: false,
            timer: 3000
          });
        } else {
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
      
      fetch(this.action, {
        method: 'POST',
        headers: {
          'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
          'Accept': 'application/json',
          'X-Requested-With': 'XMLHttpRequest'
        },
        body: new FormData(this)
      })
      .then(response => {
        if (!response.ok) {
          throw new Error('Network response was not ok');
        }
        return response.json();
      })
      .then(data => {
        // Update wishlist count in navbar
        const wishlistCountElement = document.querySelector('a[href*="wishlist"] span');
        if (data.wishlistCount > 0) {
          if (wishlistCountElement) {
            wishlistCountElement.textContent = data.wishlistCount;
          } else {
            const wishlistLink = document.querySelector('a[href*="wishlist"]');
            const countSpan = document.createElement('span');
            countSpan.className = 'absolute -top-2 -right-2 bg-[#2596be] text-white text-xs rounded-full w-5 h-5 flex items-center justify-center shadow';
            countSpan.textContent = data.wishlistCount;
            wishlistLink.appendChild(countSpan);
          }
        }

        // Show success message
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
        // Check if session expired
        if (error.message.includes('<!DOCTYPE')) {
          Swal.fire({
            toast: true,
            position: 'top-end',
            icon: 'error',
            title: 'Your session has expired. Please refresh the page.',
            showConfirmButton: false,
            timer: 3000
          });
        } else {
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
@endsection