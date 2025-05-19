@extends('layouts.master')

@section('title', 'Wishlist')

@section('main')
<section class="bg-gradient-to-b from-gray-50 to-white py-8 antialiased dark:from-gray-900 dark:to-gray-800 md:py-12">
  <div class="mx-auto max-w-screen-xl px-4 2xl:px-0">
    <!-- Header Section -->
    <div class="mb-6 text-center">
      <h1 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white md:text-3xl">My Wishlist</h1>
      <p class="text-sm text-gray-600 dark:text-gray-400 md:text-base">Save your favorite items for later</p>
    </div>

    <!-- Filter and Sort Section -->
    <div class="mb-6 flex flex-wrap items-center justify-between gap-3 bg-white dark:bg-gray-800 p-3 rounded-lg shadow-sm">
      <div class="flex items-center gap-3">
        <select id="sortSelect" class="rounded-lg border border-gray-200 bg-white px-3 py-1.5 text-xs font-medium text-gray-900 dark:border-gray-600 dark:bg-gray-800 dark:text-white focus:ring-2 focus:ring-[#2596be] focus:border-[#2596be] md:text-sm">
          <option value="newest" selected>Sort by: Newest</option>
          <option value="price_asc">Price: Low to High</option>
          <option value="price_desc">Price: High to Low</option>
        </select>
      </div>
      <div class="flex items-center gap-2">
        <span class="text-xs text-gray-600 dark:text-gray-400 md:text-sm">{{ $wishlistItems->count() }} items</span>
      </div>
    </div>

    <!-- Products Grid -->
    <div class="mb-6 grid gap-4 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
      @forelse($wishlistItems as $item)
        <div class="group relative rounded-lg border border-gray-200 bg-white p-4 shadow-sm transition-all duration-300 hover:shadow-lg dark:border-gray-700 dark:bg-gray-800">
          <!-- Product Image -->
          <div class="relative h-48 w-full overflow-hidden rounded-lg">
            <a href="{{ route('product.show', $item->product->id) }}" class="block h-full w-full">
              <img class="h-full w-full transform object-cover transition-transform duration-300 group-hover:scale-110" 
                   src="{{ secure_asset('storage/' . $item->product->image_url) }}" 
                   alt="{{ $item->product->name }}" />
            </a>
            <!-- Quick Actions -->
            <div class="absolute right-2 top-2 flex flex-col gap-2">
              <a href="{{ route('product.show', $item->product->id) }}" 
                 class="rounded-full bg-white/80 p-1.5 text-gray-500 backdrop-blur-sm transition-colors hover:bg-white hover:text-[#2596be] dark:bg-gray-800/80 dark:text-gray-400 dark:hover:bg-gray-800 dark:hover:text-white">
                <svg class="h-4 w-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                  <path stroke="currentColor" stroke-width="2" d="M21 12c0 1.2-4.03 6-9 6s-9-4.8-9-6c0-1.2 4.03-6 9-6s9 4.8 9 6Z"/>
                  <path stroke="currentColor" stroke-width="2" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
                </svg>
              </a>
              <form action="{{ route('wishlist.remove', $item->product->id) }}" method="POST" class="inline">
                @csrf
                <button type="submit" class="rounded-full bg-white p-1.5 text-red-700 backdrop-blur-sm transition-colors hover:bg-white hover:text-gray-600 dark:bg-gray-800/80 dark:text-gray-400 dark:hover:bg-gray-800 dark:hover:text-red-500">
                  <svg class="h-4 w-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6C6.5 1 1 8 5.8 13l6.2 7 6.2-7C23 8 17.5 1 12 6Z"/>
                  </svg>
                </button>
              </form>
            </div>
          </div>

          <!-- Product Info -->
          <div class="pt-4">
            <a href="{{ route('product.show', $item->product->id) }}" class="text-sm font-semibold leading-tight text-gray-900 transition-colors hover:text-[#2596be] dark:text-white dark:hover:text-[#2596be] md:text-base">
              {{ $item->product->name }}
            </a>

            <!-- Price and Add to Cart -->
            <div class="mt-3 flex items-center justify-between gap-3">
              <div>
                <p class="text-lg font-extrabold leading-tight text-gray-900 dark:text-white md:text-xl">Rp {{ number_format($item->product->price, 0, ',', '.') }}</p>
              </div>
              <form action="{{ route('cart.add', $item->product->id) }}" method="POST" class="inline">
                @csrf
                <button type="submit" class="inline-flex items-center rounded-lg bg-[#2596be] px-3 py-1.5 text-xs font-medium text-white transition-colors hover:bg-[#1e7a9c] focus:outline-none focus:ring-4 focus:ring-[#2596be]/50 dark:bg-[#2596be] dark:hover:bg-[#1e7a9c] dark:focus:ring-[#2596be]/50 md:px-4 md:py-2 md:text-sm">
                  <svg class="-ms-1 me-1 h-4 w-4 md:-ms-2 md:me-2 md:h-5 md:w-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4h1.5L8 16m0 0h8m-8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm.75-3H7.5M11 7H6.312M17 4v6m-3-3h6"/>
                  </svg>
                  Add to cart
                </button>
              </form>
            </div>
          </div>
        </div>
      @empty
      <div class="col-span-full text-center py-8">
        <div class="bg-white dark:bg-gray-800 rounded-lg p-6 shadow-sm">
          <svg class="mx-auto h-10 w-10 text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6C6.5 1 1 8 5.8 13l6.2 7 6.2-7C23 8 17.5 1 12 6Z"/>
          </svg>
          <h3 class="mt-2 text-sm font-semibold text-gray-900 dark:text-white">No items in wishlist</h3>
          <p class="mt-1 text-xs text-gray-500 dark:text-gray-400 md:text-sm">Get started by adding some products to your wishlist.</p>
          <div class="mt-4">
            <a href="{{ route('shop') }}" class="inline-flex items-center rounded-lg bg-[#2596be] px-4 py-2 text-xs font-medium text-white transition-colors hover:bg-[#1e7a9c] focus:outline-none focus:ring-4 focus:ring-[#2596be]/50 dark:bg-[#2596be] dark:hover:bg-[#1e7a9c] dark:focus:ring-[#2596be]/50 md:text-sm">
              <svg class="-ms-1 me-1 h-4 w-4 md:-ms-2 md:me-2 md:h-5 md:w-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 12H5m7-7 7 7-7 7"/>
              </svg>
              Browse products
            </a>
          </div>
        </div>
      </div>
      @endforelse
    </div>
  </div>
</section>

@push('scripts')
<script>
  // Sort functionality
  document.getElementById('sortSelect').addEventListener('change', function() {
    const sortBy = this.value;
    const productsGrid = document.querySelector('.grid');
    const products = Array.from(productsGrid.children).filter(el => el.classList.contains('group'));
    
    // Sort products based on selected option
    products.sort((a, b) => {
      const priceA = parseInt(a.querySelector('p').textContent.replace(/[^0-9]/g, ''));
      const priceB = parseInt(b.querySelector('p').textContent.replace(/[^0-9]/g, ''));
      
      switch(sortBy) {
        case 'price_asc':
          return priceA - priceB;
        case 'price_desc':
          return priceB - priceA;
        case 'newest':
          // Get the order of items in the wishlist
          const idA = a.querySelector('form[action*="wishlist/remove"]').action.split('/').pop();
          const idB = b.querySelector('form[action*="wishlist/remove"]').action.split('/').pop();
          return idB - idA; // Assuming newer items have higher IDs
        default:
          return 0;
      }
    });
    
    // Remove all products from grid
    products.forEach(product => product.remove());
    
    // Add sorted products back to grid
    products.forEach(product => productsGrid.appendChild(product));
  });

  // Handle add to cart form submission
  document.querySelectorAll('form[action*="cart/add"]').forEach(form => {
    form.addEventListener('submit', function(e) {
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
  });

  // Handle remove from wishlist form submission
  document.querySelectorAll('form[action*="wishlist/remove"]').forEach(form => {
    form.addEventListener('submit', function(e) {
      e.preventDefault();
      
      // Show confirmation dialog
      Swal.fire({
        title: 'Remove from Wishlist',
        text: 'Are you sure you want to remove this item from your wishlist?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#ef4444',
        cancelButtonColor: '#6b7280',
        confirmButtonText: 'Yes, remove it!',
        cancelButtonText: 'Cancel'
      }).then((result) => {
        if (result.isConfirmed) {
          // If confirmed, proceed with removal
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
            // Update wishlist count in navbar if it exists
            const wishlistCountElement = document.querySelector('.wishlist-count');
            if (wishlistCountElement) {
              wishlistCountElement.textContent = data.wishlistCount;
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

            // Remove the product card from the DOM
            const productCard = this.closest('.group');
            productCard.remove();

            // Update the item count
            const itemCountElement = document.querySelector('.text-xs.text-gray-600');
            if (itemCountElement) {
              itemCountElement.textContent = `${data.wishlistCount} items`;
            }

            // If no items left, refresh the page to show empty state
            if (data.wishlistCount === 0) {
              window.location.reload();
            }
          })
          .catch(error => {
            console.error('Error:', error);
            Swal.fire({
              toast: true,
              position: 'top-end',
              icon: 'error',
              title: 'Failed to remove item from wishlist. Please try again.',
              showConfirmButton: false,
              timer: 3000
            });
          });
        }
      });
    });
  });
</script>
@endpush
@endsection
