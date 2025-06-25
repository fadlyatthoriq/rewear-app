@extends('layouts.master')

@section('title', 'Home')

@section('banner')
    <!-- banner -->
    <div class="relative min-h-[500px] bg-cover bg-no-repeat bg-center py-36 overflow-hidden" style="background-image: url({{ asset('assets/images/banner-bg.jpg') }});">
        <div class="absolute inset-0 bg-gradient-to-r from-black/70 to-black/40 backdrop-blur-sm"></div>
        <div class="container relative z-10">
            <div class="max-w-2xl">
                <h1 class="text-4xl md:text-6xl text-white font-bold mb-6 leading-tight animate-fade-in-up">
                    Sustainable Fashion <br> With Rewear
                </h1>
                <p class="text-white/90 text-lg md:text-xl mb-8 animate-fade-in-up delay-100 leading-relaxed">
                    Discover quality preloved fashion items <br>
                    Give clothes a second life while saving the planet
                </p>
                <div class="mt-12 animate-fade-in-up delay-200">
                    <a href="{{ route('shop') }}" 
                        class="inline-flex items-center px-8 py-4 text-lg font-semibold text-white !bg-primary-600 hover:!bg-primary/90 rounded-lg transition-all duration-300 transform hover:scale-105 hover:shadow-lg">
                        Shop Now
                        <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </div>
<!-- ./banner -->
@endsection

@section('main')
    <!-- features -->
    <div class="container py-16">
        <div class="w-10/12 grid grid-cols-1 md:grid-cols-3 gap-8 mx-auto justify-center">
            @foreach ([
                ['icon' => 'delivery-van.svg', 'title' => 'Free Shipping', 'description' => 'Order over Rp 500.000'],
                ['icon' => 'money-back.svg', 'title' => 'Easy Returns', 'description' => '7 days return policy'],
                ['icon' => 'service-hours.svg', 'title' => 'Quality Check', 'description' => 'All items verified']
            ] as $feature)
                <div class="group bg-white dark:bg-gray-800 rounded-xl p-6 shadow-sm hover:shadow-xl border border-gray-100 dark:border-gray-700 transition-all duration-300 transform hover:-translate-y-1">
                    <div class="flex items-center gap-5">
                        <div class="p-3 bg-primary/10 rounded-lg group-hover:bg-primary/20 transition-colors duration-300">
                            <img src="{{ asset('assets/images/icons/' . $feature['icon']) }}" alt="{{ $feature['title'] }}" class="w-10 h-10 object-contain">
                        </div>
                        <div>
                            <h4 class="font-semibold text-lg text-gray-900 dark:text-white mb-1">{{ $feature['title'] }}</h4>
                            <p class="text-gray-600 dark:text-gray-400 text-sm">{{ $feature['description'] }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <!-- ./features -->

    <!-- categories -->
    <div class="container py-16">
        <h2 class="text-2xl md:text-3xl font-bold text-gray-900 dark:text-white mb-8 text-center">Shop by Category</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach($categories as $category)
                <div class="relative rounded-xl overflow-hidden group h-64 shadow-lg hover:shadow-2xl transition-all duration-300">
                    @if($category->image_url)
                        <img src="{{ $category->image_url }}" alt="{{ $category->name }}" 
                            class="w-full h-full object-cover transform transition-transform duration-500 group-hover:scale-110">
                    @else
                        <div class="w-full h-full bg-gray-200 dark:bg-gray-700 flex items-center justify-center">
                            <span class="text-gray-400 dark:text-gray-500">No Image</span>
                        </div>
                    @endif
                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/40 to-transparent opacity-80 group-hover:opacity-90 transition-opacity duration-300"></div>
                    <a href="{{ route('shop', ['category' => $category->id]) }}"
                        class="absolute inset-0 flex items-end p-6 text-white group-hover:items-center transition-all duration-300">
                        <div class="text-center w-full transform group-hover:-translate-y-2 transition-transform duration-300">
                            <h3 class="text-2xl font-bold mb-2">{{ $category->name }}</h3>
                            @if($category->description)
                                <p class="text-sm opacity-0 group-hover:opacity-100 transition-opacity duration-300 line-clamp-2">
                                    {{ $category->description }}
                                </p>
                            @endif
                            <span class="inline-block mt-4 px-4 py-2 bg-white/20 rounded-full text-sm font-medium backdrop-blur-sm group-hover:bg-white/30 transition-colors duration-300">
                                Explore Collection
                            </span>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
    <!-- ./categories -->

    <!-- new arrival -->
    <div class="container pb-16">
        <div class="flex items-center justify-between mb-8">
            <h2 class="text-2xl md:text-3xl font-bold text-gray-900 dark:text-white">New Arrivals</h2>
            <a href="{{ route('shop') }}" class="text-primary hover:text-primary/80 font-medium flex items-center gap-2 transition-colors duration-300">
                View All
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                </svg>
            </a>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4 md:gap-6">
            @foreach($newArrivals as $product)
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm hover:shadow-xl border border-gray-100 dark:border-gray-700 transition-all duration-300 group h-full flex flex-col">
                    <div class="relative overflow-hidden rounded-t-xl">
                        <img src="{{ $product->image }}" alt="{{ $product->name }}" 
                            class="w-full h-44 md:h-52 aspect-square object-cover transform transition-transform duration-500 group-hover:scale-110">
                        <span class="absolute top-3 left-3 bg-primary text-white px-3 py-1 text-xs rounded-full shadow-lg font-semibold tracking-wide">
                            New
                        </span>
                        <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center gap-3">
                            <a href="{{ route('product.show', $product->id) }}"
                                class="bg-white text-primary shadow w-10 h-10 flex items-center justify-center rounded-full hover:bg-primary hover:text-primary transition-colors duration-300"
                                title="view product">
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </a>
                            <form action="{{ route('wishlist.add', $product->id) }}" method="POST" class="wishlist-form">
                                @csrf
                                <button type="submit"
                                    class="bg-white text-primary shadow w-10 h-10 flex items-center justify-center rounded-full hover:bg-primary hover:text-primary transition-colors duration-300"
                                    title="add to wishlist">
                                    <i class="fa-solid fa-heart"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                    <div class="flex-1 flex flex-col p-3 md:p-4">
                        <a href="{{ route('product.show', $product->id) }}" class="block">
                            <h4 class="font-semibold text-base md:text-lg text-gray-900 dark:text-white mb-2 line-clamp-2 hover:text-primary transition-colors duration-300">
                                {{ $product->name }}
                            </h4>
                        </a>
                        <div class="mt-auto">
                            <div class="flex items-baseline mb-2">
                                <p class="text-xl md:text-2xl font-bold text-primary">Rp. {{ number_format($product->price) }}</p>
                            </div>
                            <div class="flex items-center justify-between">
                                <div class="text-sm text-gray-600 dark:text-gray-400">
                                    Stock: <span class="font-semibold">{{ $product->stock }}</span>
                                </div>
                                <form action="{{ route('cart.add', $product->id) }}" method="POST" class="add-to-cart-form">
                                    @csrf
                                    <button type="submit" 
                                        class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-primary hover:bg-primary/90 rounded-lg transition-colors duration-300">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                                        </svg>
                                        Add to cart
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <!-- ./new arrival -->

    <!-- ads -->
    <div class="container pb-16">
        <a href="{{ route('shop') }}" class="block group">
            <div class="relative overflow-hidden rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300">
                <img src="{{ asset('assets/images/Rewear-banner.png') }}" alt="ads" 
                    class="w-full max-w-2xl mx-auto h-auto object-contain transform transition-transform duration-500 group-hover:scale-105">
            </div>
        </a>
    </div>
    <!-- ./ads -->

    <!-- trending products -->
    <div class="container pb-16">
        <div class="flex items-center justify-between mb-8">
            <h2 class="text-2xl md:text-3xl font-bold text-gray-900 dark:text-white">Trending Now</h2>
            <a href="{{ route('shop') }}" class="text-primary hover:text-primary/80 font-medium flex items-center gap-2 transition-colors duration-300">
                View All
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                </svg>
            </a>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4 md:gap-6">
            @foreach($trendingProducts as $product)
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm hover:shadow-xl border border-gray-100 dark:border-gray-700 transition-all duration-300 group h-full flex flex-col">
                    <div class="relative overflow-hidden rounded-t-xl">
                        <img src="{{ $product->image }}" alt="{{ $product->name }}" 
                            class="w-full h-44 md:h-52 aspect-square object-cover transform transition-transform duration-500 group-hover:scale-110">
                        <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center gap-3">
                            <a href="{{ route('product.show', $product->id) }}"
                                class="bg-white text-primary shadow w-10 h-10 flex items-center justify-center rounded-full hover:bg-primary hover:text-primary transition-colors duration-300"
                                title="view product">
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </a>
                            <form action="{{ route('wishlist.add', $product->id) }}" method="POST" class="wishlist-form">
                                @csrf
                                <button type="submit"
                                    class="bg-white text-primary shadow w-10 h-10 flex items-center justify-center rounded-full hover:bg-primary hover:text-primary transition-colors duration-300"
                                    title="add to wishlist">
                                    <i class="fa-solid fa-heart"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                    <div class="flex-1 flex flex-col p-3 md:p-4">
                        <a href="{{ route('product.show', $product->id) }}" class="block">
                            <h4 class="font-semibold text-base md:text-lg text-gray-900 dark:text-white mb-2 line-clamp-2 hover:text-primary transition-colors duration-300">
                                {{ $product->name }}
                            </h4>
                        </a>
                        <div class="mt-auto">
                            <div class="flex items-baseline mb-2">
                                <p class="text-xl md:text-2xl font-bold text-primary">Rp. {{ number_format($product->price) }}</p>
                            </div>
                            <div class="flex items-center justify-between">
                                <div class="text-sm text-gray-600 dark:text-gray-400">
                                    Stock: <span class="font-semibold">{{ $product->stock }}</span>
                                </div>
                                <form action="{{ route('cart.add', $product->id) }}" method="POST" class="add-to-cart-form">
                                    @csrf
                                    <button type="submit" 
                                        class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-primary hover:bg-primary/90 rounded-lg transition-colors duration-300">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                                        </svg>
                                        Add to cart
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <!-- ./trending products -->
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Handle add to cart forms
    document.querySelectorAll('.add-to-cart-form').forEach(form => {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Show loading state
            const button = this.querySelector('button');
            const originalContent = button.innerHTML;
            button.innerHTML = `
                <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                Adding...
            `;
            button.disabled = true;
            
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
            })
            .finally(() => {
                // Reset button state
                button.innerHTML = originalContent;
                button.disabled = false;
            });
        });
    });

    // Handle wishlist forms
    document.querySelectorAll('.wishlist-form').forEach(form => {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Show loading state
            const button = this.querySelector('button');
            const originalContent = button.innerHTML;
            button.innerHTML = `
                <svg class="animate-spin h-5 w-5 text-primary" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
            `;
            button.disabled = true;
            
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
            })
            .finally(() => {
                // Reset button state
                button.innerHTML = originalContent;
                button.disabled = false;
            });
        });
    });
});
</script>
@endpush