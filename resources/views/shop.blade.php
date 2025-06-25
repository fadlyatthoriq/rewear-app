@extends('layouts.master')

@section('title', 'Shop')

@section('main')
<section class="min-h-screen bg-gradient-to-b from-gray-50 to-white py-8 antialiased dark:from-gray-900 dark:to-gray-800 md:py-12">
    <div class="mx-auto max-w-screen-xl px-4 2xl:px-0">
        <!-- Header Section -->
        <div class="mb-8 text-center">
            <h1 class="mb-3 text-2xl font-bold tracking-tight text-gray-900 dark:text-white md:text-3xl">Our Products</h1>
            <p class="text-sm text-gray-600 dark:text-gray-400 md:text-base">Discover our collection of high-quality products</p>
        </div>

        <!-- Search and Filter Section -->
        <div class="mb-8 overflow-hidden rounded-lg border border-gray-200 bg-white shadow-sm dark:border-gray-700 dark:bg-gray-800">
            <div class="p-6">
                <div class="mb-6 flex flex-wrap items-center justify-between gap-4">
                    <h2 class="flex items-center gap-2 text-lg font-semibold text-gray-900 dark:text-white">
                        <svg class="h-5 w-5 text-primary" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4h1.5L8 16m0 0h8m-8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm.75-3H7.5M11 7H6.312M17 4v6m-3-3h6"/>
                        </svg>
                        Search & Filter Products
                    </h2>
                    <div class="flex items-center gap-2 rounded-full bg-gray-100 px-3 py-1 text-sm font-medium text-gray-600 dark:bg-gray-700 dark:text-gray-300">
                        <svg class="h-4 w-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4h16M4 12h16M4 20h16"/>
                        </svg>
                        <span>
                            @if(request()->hasAny(['search','category']) && $products->total() > 0)
                                Showing <span class="font-bold">{{ $products->count() }}</span> of <span class="font-bold">{{ $products->total() }}</span> products
                            @elseif($products->total() > 0)
                                Total <span class="font-bold">{{ $products->total() }}</span> products available
                            @else
                                No products found
                            @endif
                        </span>
                    </div>
                </div>

                <form action="{{ route('shop') }}" method="GET" class="space-y-6">
                    <!-- Search Bar -->
                    <div class="relative">
                        <input type="text" 
                            id="search"
                            name="search" 
                            value="{{ request('search') }}" 
                            class="block w-full rounded-lg border border-gray-200 bg-white p-2.5 pl-10 text-sm text-gray-900 transition-colors focus:border-primary focus:ring-2 focus:ring-primary dark:border-gray-600 dark:bg-gray-800 dark:text-white dark:placeholder-gray-400 dark:focus:border-primary dark:focus:ring-primary"
                            placeholder="Search products...">
                    </div>

                    <!-- Filters Grid -->
                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3">
                        <!-- Category Filter -->
                        <div class="relative">
                            <label for="category" class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">Category</label>
                            <select id="category" 
                                name="category" 
                                class="block w-full rounded-lg border border-gray-200 bg-white p-2.5 text-sm text-gray-900 transition-colors focus:border-primary focus:ring-2 focus:ring-primary dark:border-gray-600 dark:bg-gray-800 dark:text-white dark:focus:border-primary dark:focus:ring-primary">
                                <option value="" disabled {{ !request('category') ? 'selected' : '' }}>All Categories</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Sort By -->
                        <div class="relative">
                            <label for="sort" class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">Sort By</label>
                            <select id="sort" 
                                name="sort" 
                                class="block w-full rounded-lg border border-gray-200 bg-white p-2.5 text-sm text-gray-900 transition-colors focus:border-primary focus:ring-2 focus:ring-primary dark:border-gray-600 dark:bg-gray-800 dark:text-white dark:focus:border-primary dark:focus:ring-primary">
                                <option value="created_at" {{ request('sort') == 'created_at' ? 'selected' : '' }}>Latest</option>
                                <option value="price" {{ request('sort') == 'price' ? 'selected' : '' }}>Price</option>
                                <option value="name" {{ request('sort') == 'name' ? 'selected' : '' }}>Name</option>
                            </select>
                        </div>

                        <!-- Sort Direction -->
                        <div class="relative">
                            <label for="direction" class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">Sort Direction</label>
                            <select id="direction" 
                                name="direction" 
                                class="block w-full rounded-lg border border-gray-200 bg-white p-2.5 text-sm text-gray-900 transition-colors focus:border-primary focus:ring-2 focus:ring-primary dark:border-gray-600 dark:bg-gray-800 dark:text-white dark:focus:border-primary dark:focus:ring-primary">
                                <option value="desc" {{ request('direction') == 'desc' ? 'selected' : '' }}>Descending</option>
                                <option value="asc" {{ request('direction') == 'asc' ? 'selected' : '' }}>Ascending</option>
                            </select>
                        </div>
                    </div>

                    <!-- Filter Buttons -->
                    <div class="flex flex-wrap justify-end gap-4">
                        <a href="{{ route('shop') }}" 
                            class="inline-flex items-center rounded-lg border border-gray-200 bg-white px-5 py-2.5 text-sm font-medium text-gray-900 transition-colors hover:bg-gray-100 hover:text-primary focus:outline-none focus:ring-4 focus:ring-gray-100 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white dark:focus:ring-gray-700">
                            <svg class="mr-2 h-4 w-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0 3.181 3.183a8.25 8.25 0 0 0 13.803-3.7M4.031 9.865a8.25 8.25 0 0 1 13.803-3.7l3.181 3.182m0-4.991v4.99"/>
                            </svg>
                            Reset Filters
                        </a>
                        <button type="submit" 
                            class="inline-flex items-center rounded-lg bg-primary px-5 py-2.5 text-sm font-medium text-white transition-colors hover:bg-[#1e7a9c] focus:outline-none focus:ring-4 focus:ring-primary/50 dark:bg-primary dark:hover:bg-[#1e7a9c] dark:focus:ring-primary/50">
                            <svg class="mr-2 h-4 w-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4h13M3 8h9m-9 4h6m4 0 4-4m0 0 4 4m-4-4v12"/>
                            </svg>
                            Apply Filters
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Products Grid -->
        <div class="mb-8 grid gap-6 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
            @forelse($products as $product)
                <div class="group relative flex flex-col overflow-hidden rounded-lg border border-gray-200 bg-white shadow-sm transition-all duration-300 hover:shadow-lg dark:border-gray-700 dark:bg-gray-800">
                    <!-- Product Image -->
                    <div class="relative aspect-square w-full overflow-hidden">
                        <img src="{{ $product->image }}" 
                             alt="{{ $product->name }}" 
                             class="h-full w-full object-cover object-center transition-transform duration-300 group-hover:scale-105">
                        <div class="absolute inset-0 flex items-center justify-center gap-3 opacity-0 group-hover:opacity-100 transition-all duration-300">
                            <a href="{{ route('product.show', $product->id) }}"
                                class="rounded-full bg-white/90 p-2 text-gray-500 backdrop-blur-sm transition-colors hover:bg-white hover:text-primary dark:bg-gray-800/90 dark:text-gray-400 dark:hover:bg-gray-800 dark:hover:text-white"
                                title="View product">
                                <svg class="h-5 w-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-width="2" d="M21 12c0 1.2-4.03 6-9 6s-9-4.8-9-6c0-1.2 4.03-6 9-6s9 4.8 9 6Z"/>
                                    <path stroke="currentColor" stroke-width="2" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
                                </svg>
                            </a>
                            <form action="{{ route('wishlist.add', $product->id) }}" method="POST" class="wishlist-form">
                                @csrf
                                <button type="submit"
                                    class="rounded-full bg-white/90 p-2 text-primary backdrop-blur-sm transition-colors hover:bg-white hover:text-red-600 dark:bg-gray-800/90 dark:text-primary dark:hover:bg-gray-800 dark:hover:text-red-500"
                                    title="Add to wishlist">
                                    <svg class="h-5 w-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6C6.5 1 1 8 5.8 13l6.2 7 6.2-7C23 8 17.5 1 12 6Z"/>
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </div>

                    <!-- Product Info -->
                    <div class="flex flex-1 flex-col p-4">
                        <a href="{{ route('product.show', $product->id) }}" 
                           class="mb-2 text-sm font-semibold leading-tight text-gray-900 transition-colors hover:text-primary dark:text-white dark:hover:text-primary md:text-base">
                            {{ $product->name }}
                        </a>
                        <div class="mt-auto space-y-2">
                            <div class="flex items-baseline gap-2">
                                <p class="text-xl font-bold text-primary dark:text-primary">
                                    Rp {{ number_format($product->price, 0, ',', '.') }}
                                </p>
                            </div>
                            <div class="flex items-center text-sm text-gray-600 dark:text-gray-400">
                                <svg class="mr-1.5 h-4 w-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 7h14M5 12h14M5 17h14"/>
                                </svg>
                                Stock: <span class="ml-1 font-semibold">{{ $product->stock }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Add to Cart Button -->
                    <form action="{{ route('cart.add', $product->id) }}" method="POST" class="add-to-cart-form p-4 pt-0">
                        @csrf
                        <button type="submit" 
                                class="inline-flex w-full items-center justify-center rounded-lg bg-primary px-4 py-2.5 text-sm font-medium text-white transition-colors hover:bg-[#1e7a9c] focus:outline-none focus:ring-4 focus:ring-primary/50 dark:bg-primary dark:hover:bg-[#1e7a9c] dark:focus:ring-primary/50">
                            <svg class="mr-2 h-4 w-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4h1.5L8 16m0 0h8m-8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm.75-3H7.5M11 7H6.312M17 4v6m-3-3h6"/>
                            </svg>
                            Add to cart
                        </button>
                    </form>
                </div>
            @empty
                <div class="col-span-full">
                    <div class="mx-auto max-w-md rounded-lg border border-gray-200 bg-white p-8 text-center shadow-sm dark:border-gray-700 dark:bg-gray-800">
                        <svg class="mx-auto h-12 w-12 text-gray-400 dark:text-gray-600" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4h1.5L8 16m0 0h8m-8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm.75-3H7.5M11 7H6.312M17 4v6m-3-3h6"/>
                        </svg>
                        <h3 class="mt-4 text-lg font-semibold text-gray-900 dark:text-white">No products found</h3>
                        <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">Try adjusting your search or filter criteria.</p>
                    </div>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        <div class="mt-8">
            <div class="flex items-center justify-center">
                {{ $products->links('pagination::tailwind') }}
            </div>
        </div>
    </div>
</section>

@push('styles')
<style>
    /* Pagination Styling */
    .pagination {
        @apply flex items-center gap-2;
    }
    
    .pagination > * {
        @apply flex items-center justify-center;
    }

    .pagination a {
        @apply rounded-lg border border-gray-200 bg-white px-4 py-2 text-sm font-medium text-gray-700 transition-colors hover:bg-primary hover:text-white hover:border-primary dark:border-gray-600 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-primary dark:hover:text-white;
    }

    .pagination span {
        @apply rounded-lg border border-primary bg-primary px-4 py-2 text-sm font-medium text-white dark:border-primary dark:bg-primary;
    }

    .pagination .disabled {
        @apply cursor-not-allowed rounded-lg border border-gray-200 bg-gray-100 px-4 py-2 text-sm font-medium text-gray-400 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-500;
    }
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Handle add to cart forms
    document.querySelectorAll('.add-to-cart-form').forEach(form => {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            
            let url = this.action;
            if (!/^https?:\/\//i.test(url)) {
                url = window.location.origin + url;
            }
            fetch(url, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
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
                // Check if session expired or user is not authenticated
                if (error.message.includes('<!DOCTYPE')) {
                    Swal.fire({
                        toast: true,
                        position: 'top-end',
                        icon: 'warning',
                        title: 'Please login first to add items to cart',
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

    // Handle wishlist forms
    document.querySelectorAll('.wishlist-form').forEach(form => {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            
            let url = this.action;
            if (!/^https?:\/\//i.test(url)) {
                url = window.location.origin + url;
            }
            fetch(url, {
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
                // Update wishlist count in navbar
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
                // Check if session expired or user is not authenticated
                if (error.message.includes('<!DOCTYPE')) {
                    Swal.fire({
                        toast: true,
                        position: 'top-end',
                        icon: 'warning',
                        title: 'Please login first to add items to wishlist',
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
});
</script>
@endpush
@endsection