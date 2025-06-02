@extends('layouts.master')

@section('title', 'Wishlist')

@section('main')
<section class="min-h-screen bg-gradient-to-b from-gray-50 to-white py-8 antialiased dark:from-gray-900 dark:to-gray-800 md:py-12">
  <div class="mx-auto max-w-screen-xl px-4 2xl:px-0">
    <!-- Header Section -->
    <div class="mb-8 text-center">
      <h1 class="mb-3 text-2xl font-bold tracking-tight text-gray-900 dark:text-white md:text-3xl">My Wishlist</h1>
      <p class="text-sm text-gray-600 dark:text-gray-400 md:text-base">Save your favorite items for later</p>
    </div>

    <!-- Filter and Sort Section -->
    <div class="mb-8 flex flex-wrap items-center justify-between gap-4 rounded-lg border border-gray-200 bg-white p-4 shadow-sm dark:border-gray-700 dark:bg-gray-800">
      <div class="flex flex-wrap items-center gap-4">
        <div class="flex items-center gap-2">
          <label for="sortSelect" class="text-sm font-medium text-gray-700 dark:text-gray-300">Sort by:</label>
          <select id="sortSelect" class="rounded-lg border border-gray-200 bg-white px-3 py-2 text-sm font-medium text-gray-900 transition-colors focus:border-[#2596be] focus:ring-2 focus:ring-[#2596be] dark:border-gray-600 dark:bg-gray-800 dark:text-white dark:focus:border-[#2596be] dark:focus:ring-[#2596be]">
            <option value="newest" selected>Newest</option>
            <option value="price_asc">Price: Low to High</option>
            <option value="price_desc">Price: High to Low</option>
          </select>
        </div>
      </div>
      <div class="flex items-center gap-2">
        <span class="rounded-full bg-gray-100 px-3 py-1 text-sm font-medium text-gray-600 dark:bg-gray-700 dark:text-gray-300">
          {{ $wishlistItems->count() }} items
        </span>
      </div>
    </div>

    <!-- Products Grid -->
    <div class="mb-8 grid gap-6 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
      @forelse($wishlistItems as $item)
        <div class="group relative flex flex-col overflow-hidden rounded-lg border border-gray-200 bg-white shadow-sm transition-all duration-300 hover:shadow-lg dark:border-gray-700 dark:bg-gray-800">
          <!-- Product Image -->
          <div class="relative aspect-square w-full overflow-hidden">
            <a href="{{ route('product.show', $item->product->id) }}" class="block h-full w-full">
              <img src="{{ $item->product->image }}" 
                   alt="{{ $item->product->name }}" 
                   class="h-full w-full object-cover object-center transition-transform duration-300 group-hover:scale-105">
            </a>
            <!-- Quick Actions -->
            <div class="absolute right-3 top-3 flex flex-col gap-2">
              <a href="{{ route('product.show', $item->product->id) }}" 
                 class="rounded-full bg-white/90 p-2 text-gray-500 backdrop-blur-sm transition-colors hover:bg-white hover:text-[#2596be] dark:bg-gray-800/90 dark:text-gray-400 dark:hover:bg-gray-800 dark:hover:text-white">
                <svg class="h-4 w-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                  <path stroke="currentColor" stroke-width="2" d="M21 12c0 1.2-4.03 6-9 6s-9-4.8-9-6c0-1.2 4.03-6 9-6s9 4.8 9 6Z"/>
                  <path stroke="currentColor" stroke-width="2" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
                </svg>
              </a>
              <form action="{{ route('wishlist.remove', $item->product->id) }}" method="POST" class="inline">
                @csrf
                <button type="submit" 
                        class="rounded-full bg-white/90 p-2 text-red-600 backdrop-blur-sm transition-colors hover:bg-white hover:text-red-700 dark:bg-gray-800/90 dark:text-red-500 dark:hover:bg-gray-800 dark:hover:text-red-400">
                  <svg class="h-4 w-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6C6.5 1 1 8 5.8 13l6.2 7 6.2-7C23 8 17.5 1 12 6Z"/>
                  </svg>
                </button>
              </form>
            </div>
          </div>

          <!-- Product Info -->
          <div class="flex flex-1 flex-col p-4">
            <a href="{{ route('product.show', $item->product->id) }}" 
               class="mb-2 text-sm font-semibold leading-tight text-gray-900 transition-colors hover:text-[#2596be] dark:text-white dark:hover:text-[#2596be] md:text-base">
              {{ $item->product->name }}
            </a>

            <!-- Price and Add to Cart -->
            <div class="mt-auto flex items-center justify-between gap-3">
              <div>
                <p class="text-lg font-bold leading-tight text-gray-900 dark:text-white md:text-xl">
                  Rp {{ number_format($item->product->price, 0, ',', '.') }}
                </p>
              </div>
              <form action="{{ route('cart.add', $item->product->id) }}" method="POST" class="inline">
                @csrf
                <button type="submit" 
                        class="inline-flex items-center rounded-lg bg-primary px-3 py-2 text-sm font-medium text-white transition-colors hover:bg-[#1e7a9c] focus:outline-none focus:ring-4 focus:ring-[#2596be]/50 dark:bg-[#2596be] dark:hover:bg-[#1e7a9c] dark:focus:ring-[#2596be]/50">
                  <svg class="mr-2 h-4 w-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4h1.5L8 16m0 0h8m-8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm.75-3H7.5M11 7H6.312M17 4v6m-3-3h6"/>
                  </svg>
                  Add to cart
                </button>
              </form>
            </div>
          </div>
        </div>
      @empty
        <div class="col-span-full">
          <div class="mx-auto max-w-md rounded-lg border border-gray-200 bg-white p-8 text-center shadow-sm dark:border-gray-700 dark:bg-gray-800">
            <svg class="mx-auto h-12 w-12 text-gray-400 dark:text-gray-600" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6C6.5 1 1 8 5.8 13l6.2 7 6.2-7C23 8 17.5 1 12 6Z"/>
            </svg>
            <h3 class="mt-4 text-lg font-semibold text-gray-900 dark:text-white">Your wishlist is empty</h3>
            <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">Get started by adding some products to your wishlist.</p>
            <div class="mt-6">
              <a href="{{ route('shop') }}" 
                 class="inline-flex items-center rounded-lg bg-[#2596be] px-4 py-2.5 text-sm font-medium text-white transition-colors hover:bg-[#1e7a9c] focus:outline-none focus:ring-4 focus:ring-[#2596be]/50 dark:bg-[#2596be] dark:hover:bg-[#1e7a9c] dark:focus:ring-[#2596be]/50">
                <svg class="mr-2 h-4 w-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
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
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
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
              'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
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
            const itemCountElement = document.querySelector('.text-sm.font-medium.text-gray-600');
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
