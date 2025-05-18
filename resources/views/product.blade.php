@extends('layouts.master')

@section('title', $product->name)

@section('main')
<section class="py-12 bg-gray-50 dark:bg-gray-900 antialiased">
    <div class="max-w-screen-xl px-4 mx-auto 2xl:px-0">
      <div class="lg:grid lg:grid-cols-2 lg:gap-12 xl:gap-16 bg-white dark:bg-gray-800 p-6 sm:p-8 rounded-xl shadow-lg">
        <div class="shrink-0 max-w-md lg:max-w-lg mx-auto">
          <div class="aspect-square overflow-hidden rounded-lg bg-gray-100 cursor-pointer transition-transform duration-300 hover:scale-105" id="product-image-container">
            @if($product->image_url)
              <img class="w-full h-full object-cover" 
                   src="{{ asset('storage/' . $product->image_url) }}" 
                   alt="{{ $product->name }}" />
            @else
              <img class="w-full h-full object-cover dark:hidden" src="https://flowbite.s3.amazonaws.com/blocks/e-commerce/imac-front.svg" alt="Product Image Placeholder" />
              <img class="w-full h-full object-cover hidden dark:block" src="https://flowbite.s3.amazonaws.com/blocks/e-commerce/imac-front-dark.svg" alt="Product Image Placeholder" />
            @endif
          </div>
        </div>

        <div class="mt-6 sm:mt-8 lg:mt-0 flex flex-col justify-between">
          <div>
            <h1
              class="text-2xl font-bold text-gray-900 sm:text-3xl dark:text-white mb-4"
            >
              {{ $product->name }}
            </h1>
            <div class="mt-4 sm:items-center sm:gap-4 sm:flex">
              <p
                class="text-3xl font-extrabold text-gray-900 sm:text-4xl dark:text-white"
              >
                Rp. {{ number_format($product->price) }}
              </p>
            </div>
          </div>

          <div class="mt-6 sm:mt-8 flex flex-wrap items-center gap-4">
            <div class="flex-1 w-full sm:w-auto">
              <a href="{{ route('wishlist.add', $product->id) }}" title="Add to favorites" 
                 class="flex items-center justify-center w-full py-2.5 px-5 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700 transition-all duration-200 shadow-sm hover:shadow-md" role="button">
                <svg class="w-5 h-5 -ms-2 me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12.01 6.001C6.5 1 1 8 5.782 13.001L12.011 20l6.23-7C23 8 17.5 1 12.01 6.002Z"/>
                </svg>
                Add to favorites
              </a>
            </div>

            @if($product->stock > 0)
            <form action="{{ route('cart.add', $product->id) }}" method="POST" class="flex-1 w-full sm:w-auto">
                @csrf
                <button type="submit" title="Add to cart" class="text-white w-full flex items-center justify-center bg-primary hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800 transition-all duration-200 shadow-sm hover:shadow-md" role="button">
                  <svg
                    class="w-5 h-5 -ms-2 me-2"
                    aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg"
                    width="24"
                    height="24"
                    fill="none"
                    viewBox="0 0 24 24"
                  >
                    <path
                      stroke="currentColor"
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2"
                      d="M4 4h1.5L8 16m0 0h8m-8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm.75-3H7.5M11 7H6.312M17 4v6m-3-3h6"
                    />
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

          <hr class="my-6 md:my-8 border-gray-200 dark:border-gray-800" />

          <div>
            <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-3">Product Description</h2>
            <p class="text-gray-600 dark:text-gray-400 leading-relaxed">
              {{ $product->description ?? 'No description available.' }}
            </p>
          </div>

        </div>
      </div>
    </div>
  </section>

  <!-- Image Modal -->
  <div id="image-modal" class="fixed inset-0 bg-black bg-opacity-75 flex items-center justify-center z-50 hidden">
    <div class="relative">
      <span class="absolute top-2 right-2 text-white text-3xl cursor-pointer" id="close-modal">&times;</span>
      <img src="" alt="Enlarged Product Image" id="enlarged-image" class="max-w-full max-h-screen">
    </div>
  </div>

  <script>
    const productImageContainer = document.getElementById('product-image-container');
    const imageModal = document.getElementById('image-modal');
    const enlargedImage = document.getElementById('enlarged-image');
    const closeModal = document.getElementById('close-modal');

    if (productImageContainer && imageModal && enlargedImage && closeModal) {
      productImageContainer.addEventListener('click', () => {
        const imageUrl = productImageContainer.querySelector('img').src;
        enlargedImage.src = imageUrl;
        imageModal.classList.remove('hidden');
      });

      closeModal.addEventListener('click', () => {
        imageModal.classList.add('hidden');
        enlargedImage.src = ''; // Clear image src when closing
      });

      // Close modal when clicking outside the image
      imageModal.addEventListener('click', (event) => {
        if (event.target === imageModal) {
          imageModal.classList.add('hidden');
          enlargedImage.src = '';
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
          'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
        },
        body: new FormData(this)
      })
      .then(response => response.json())
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
        Swal.fire({
          toast: true,
          position: 'top-end',
          icon: 'error',
          title: 'Something went wrong!',
          showConfirmButton: false,
          timer: 3000
        });
      });
    });
  </script>
@endsection