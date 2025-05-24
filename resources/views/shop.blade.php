@extends('layouts.master')

@section('title', 'Shop')

@section('main')
<div class="container pb-16">
    <!-- Search and Filter Section -->
    <div class="bg-white rounded-lg p-4 mb-6 border border-gray-100">
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-base font-semibold text-[#2596be] tracking-wide flex items-center gap-2">
                <i class="fa-solid fa-filter text-[#2596be] text-base"></i>
                Search & Filter Products
            </h2>
            <div class="flex items-center gap-1 text-xs text-[#2596be] font-medium" title="Total products shown" style="background: none; box-shadow: none; padding: 0;">
                <i class="fa-solid fa-boxes-stacked text-sm"></i>
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
        <form action="{{ route('shop') }}" method="GET" class="space-y-4">
            <!-- Search Bar -->
            <div class="w-full">
                <div class="relative group">
                    <input type="text" 
                        id="search"
                        name="search" 
                        value="{{ request('search') }}" 
                        class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:ring-1 focus:ring-[#2596be] focus:border-[#2596be] pl-10 text-gray-700 bg-white transition-all duration-200 group-hover:border-[#2596be] text-sm"
                        placeholder="Search products...">
                </div>
            </div>

            <!-- Filters Grid -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
                <!-- Category Filter -->
                <div class="relative">
                    <select id="category" 
                        name="category" 
                        class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:ring-1 focus:ring-[#2596be] focus:border-[#2596be] appearance-none bg-white transition-all duration-200 pr-8 text-sm">
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
                    <select id="sort" 
                        name="sort" 
                        class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:ring-1 focus:ring-[#2596be] focus:border-[#2596be] appearance-none bg-white transition-all duration-200 pr-8 text-sm">
                        <option value="created_at" {{ request('sort') == 'created_at' ? 'selected' : '' }}>Latest</option>
                        <option value="price" {{ request('sort') == 'price' ? 'selected' : '' }}>Price</option>
                        <option value="name" {{ request('sort') == 'name' ? 'selected' : '' }}>Name</option>
                    </select>
                </div>

                <!-- Sort Direction -->
                <div class="relative">
                    <select id="direction" 
                        name="direction" 
                        class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:ring-1 focus:ring-[#2596be] focus:border-[#2596be] appearance-none bg-white transition-all duration-200 pr-8 text-sm">
                        <option value="desc" {{ request('direction') == 'desc' ? 'selected' : '' }}>Descending</option>
                        <option value="asc" {{ request('direction') == 'asc' ? 'selected' : '' }}>Ascending</option>
                    </select>
                </div>
            </div>

            <!-- Filter Button -->
            <div class="flex justify-end gap-3">
                <a href="{{ route('shop') }}" 
                    class="px-8 py-2 bg-gray-100 text-gray-700 rounded hover:bg-gray-200 transition flex items-center gap-2 shadow font-semibold text-sm">
                    <i class="fa-solid fa-rotate"></i>
                    Reset Filters
                </a>
                <button type="submit" 
                    class="px-8 py-2 bg-primary text-white rounded hover:bg-[#1f7a9c] transition flex items-center gap-2 shadow font-semibold text-sm">
                    <i class="fa-solid fa-filter"></i>
                    Apply Filters
                </button>
            </div>
        </form>
    </div>

    <!-- Products Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
        @forelse($products as $product)
            <div class="bg-white rounded-2xl shadow-md hover:shadow-xl border border-transparent hover:border-[#2596be] transition-all duration-300 group h-full flex flex-col p-4">
                <div class="relative">
                    <img src="{{ asset('storage/' . $product->image_url) }}" alt="{{ $product->name }}" class="w-full h-64 aspect-square object-cover rounded-xl transition-transform duration-300 group-hover:scale-105">
                    <div class="absolute inset-0 flex items-center justify-center gap-3 opacity-0 group-hover:opacity-100 transition-all duration-300">
                        <a href="{{ route('product.show', $product->id) }}"
                            class="bg-white text-[#2596be] shadow w-10 h-10 flex items-center justify-center rounded-full hover:bg-[#2596be] hover:text-white transition"
                            title="view product">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </a>
                        <form action="{{ route('wishlist.add', $product->id) }}" method="POST" class="wishlist-form">
                            @csrf
                            <button type="submit"
                                class="bg-white text-[#2596be] shadow w-10 h-10 flex items-center justify-center rounded-full hover:bg-[#2596be] hover:text-white transition"
                                title="add to wishlist">
                                <i class="fa-solid fa-heart"></i>
                            </button>
                        </form>
                    </div>
                </div>
                <div class="flex-1 flex flex-col pt-4 pb-2">
                    <a href="{{ route('product.show', $product->id) }}">
                        <h4 class="uppercase font-bold text-lg mb-2 text-gray-800 hover:text-[#2596be] transition">{{ $product->name }}</h4>
                    </a>
                    <div class="flex items-baseline mb-1 space-x-2">
                        <p class="text-2xl text-[#2596be] font-extrabold">Rp. {{ number_format($product->price) }}</p>
                    </div>
                    <div class="flex items-center">
                        <div class="text-sm text-gray-600">
                            Stock: <span class="font-semibold">{{ $product->stock }}</span>
                        </div>
                    </div>
                </div>
                <form action="{{ route('cart.add', $product->id) }}" method="POST" class="mt-auto add-to-cart-form">
                    @csrf
                    <button type="submit" class="w-full py-2 text-center text-white bg-primary font-bold rounded shadow hover:bg-white hover:text-primary hover:border-primary hover:shadow-xl hover:scale-105 border-2 border-primary transition-all duration-300">
                        Add to cart
                    </button>
                </form>
            </div>
        @empty
            <div class="col-span-full text-center py-8">
                <p class="text-gray-500 text-lg">No products found matching your criteria.</p>
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    <div class="mt-4">
        <div class="flex items-center justify-center">
            {{ $products->links('pagination::tailwind') }}
        </div>
    </div>
</div>

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
        @apply px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-200 rounded-lg hover:bg-[#2596be] hover:text-white hover:border-[#2596be] transition-all duration-200;
    }

    .pagination span {
        @apply px-4 py-2 text-sm font-medium text-white bg-[#2596be] border border-[#2596be] rounded-lg;
    }

    .pagination .disabled {
        @apply px-4 py-2 text-sm font-medium text-gray-400 bg-gray-100 border border-gray-200 rounded-lg cursor-not-allowed;
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