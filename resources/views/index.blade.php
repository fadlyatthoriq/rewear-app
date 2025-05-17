@extends('layouts.master')

@section('title', 'Home')

@section('banner')
    <!-- banner -->
    <div class="bg-cover bg-no-repeat bg-center py-36 relative" style="background-image: url({{ asset('assets/images/banner-bg.jpg') }});">
        <div class="absolute inset-0 bg-black bg-opacity-40"></div>
        <div class="container relative z-10">
            <h1 class="text-6xl text-white font-medium mb-4 capitalize animate-fade-in-up">
                Discover Your Style <br> With Rewear
            </h1>
            <p class="text-white text-lg mb-8 animate-fade-in-up delay-100">Explore our latest collection of trendy fashion items <br>
                From casual to formal, we've got your style covered</p>
            <div class="mt-12 animate-fade-in-up delay-200">
                <a href="{{ route('shop') }}" class="bg-[#2596be] border border-[#2596be] text-white px-8 py-3 font-medium 
                    rounded-md hover:bg-transparent hover:text-white transition-all duration-300 transform hover:scale-105">Shop Now</a>
            </div>
        </div>
    </div>
<!-- ./banner -->
@endsection

@section('main')
    <!-- features -->
    <div class="container py-16">
        <div class="w-10/12 grid grid-cols-1 md:grid-cols-3 gap-6 mx-auto justify-center">
            @foreach ([
                ['icon' => 'delivery-van.svg', 'title' => 'Free Shipping', 'description' => 'Order over $100'],
                ['icon' => 'money-back.svg', 'title' => 'Easy Returns', 'description' => '14 days return policy'],
                ['icon' => 'service-hours.svg', 'title' => '24/7 Support', 'description' => 'Customer support']
            ] as $feature)
                <div class="border border-[#2596be] rounded-sm px-3 py-6 flex justify-center items-center gap-5">
                    <img src="{{ asset('assets/images/icons/' . $feature['icon']) }}" alt="{{ $feature['title'] }}" class="w-12 h-12 object-contain">
                    <div>
                        <h4 class="font-medium capitalize text-lg">{{ $feature['title'] }}</h4>
                        <p class="text-gray-500 text-sm">{{ $feature['description'] }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <!-- ./features -->

    <!-- categories -->
    <div class="container py-16">
        <h2 class="text-2xl font-medium text-gray-800 uppercase mb-6">shop by category</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach($categories as $category)
                <div class="relative rounded-lg overflow-hidden group h-64">
                    @if($category->image_url)
                        <img src="{{ asset($category->image_url) }}" alt="{{ $category->name }}" class="w-full h-full object-cover">
                    @else
                        <div class="w-full h-full bg-gray-200 flex items-center justify-center">
                            <span class="text-gray-400">No Image</span>
                        </div>
                    @endif
                    <a href="{{ route('shop', ['category' => $category->id]) }}"
                        class="absolute inset-0 bg-black bg-opacity-40 flex items-center justify-center text-xl text-white font-roboto font-medium group-hover:bg-opacity-60 transition">
                        <div class="text-center">
                            <h3 class="text-2xl font-bold mb-2">{{ $category->name }}</h3>
                            @if($category->description)
                                <p class="text-sm opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                    {{ Str::limit($category->description, 100) }}
                                </p>
                            @endif
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
    <!-- ./categories -->

    <!-- new arrival -->
    <div class="container pb-16">
        <h2 class="text-2xl font-medium text-gray-800 uppercase mb-6">new arrivals</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
            @foreach($newArrivals as $product)
                <div class="bg-white rounded-2xl shadow-md hover:shadow-xl border border-transparent hover:border-[#2596be] transition-all duration-300 group h-full flex flex-col p-4">
                    <div class="relative">
                        <img src="{{ asset('storage/' . $product->image_url) }}" alt="{{ $product->name }}" class="w-full h-64 aspect-square object-cover rounded-xl transition-transform duration-300 group-hover:scale-105">
                        <span class="absolute top-3 left-3 bg-[#2596be] text-white px-3 py-1 text-xs rounded-full shadow-lg font-semibold tracking-wide">New</span>
                        <div class="absolute inset-0 flex items-center justify-center gap-3 opacity-0 group-hover:opacity-100 transition-all duration-300">
                            <a href="{{ route('product.show', $product->id) }}"
                                class="bg-white text-[#2596be] shadow w-10 h-10 flex items-center justify-center rounded-full hover:bg-[#2596be] hover:text-white transition"
                                title="view product">
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </a>
                            <a href="{{ route('wishlist.add', $product->id) }}"
                                class="bg-white text-[#2596be] shadow w-10 h-10 flex items-center justify-center rounded-full hover:bg-[#2596be] hover:text-white transition"
                                title="add to wishlist">
                                <i class="fa-solid fa-heart"></i>
                            </a>
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
                            <div class="flex gap-1 text-sm text-yellow-400">
                                @for ($i = 0; $i < 5; $i++)
                                    <span><i class="fa-solid fa-star"></i></span>
                                @endfor
                            </div>
                            <div class="text-xs text-gray-500 ml-3">({{ $product->transactionItems->count() }})</div>
                        </div>
                    </div>
                    <a href="{{ route('cart.add', $product->id) }}"
                        class="block w-full py-2 mt-auto text-center text-white bg-[#2596be] font-bold rounded-xl shadow hover:bg-white hover:text-white hover:border-[#2596be] hover:shadow-xl hover:scale-105 border-2 border-[#2596be] transition-all duration-300">Add to cart</a>
                </div>
            @endforeach
        </div>
    </div>
    <!-- ./new arrival -->

    <!-- ads -->
    <div class="container pb-16">
        <a href="{{ route('shop') }}">
            <img src="{{ asset('assets/images/Rewear-banner.png') }}" alt="ads" class="w-full max-w-2xl mx-auto h-auto object-contain">
        </a>
    </div>
    <!-- ./ads -->

    <!-- product -->
    <div class="container pb-16">
        <h2 class="text-2xl font-medium text-gray-800 uppercase mb-6">trending now</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
            @foreach($trendingProducts as $product)
                <div class="bg-white rounded-2xl shadow-md hover:shadow-xl border border-transparent hover:border-[#2596be] transition-all duration-300 group h-full flex flex-col p-4">
                    <div class="relative">
                        <img src="{{ asset('storage/' . $product->image_url) }}" alt="{{ $product->name }}" class="w-full h-64 aspect-square object-cover rounded-xl transition-transform duration-300 group-hover:scale-105">
                        <div class="absolute inset-0 flex items-center justify-center gap-3 opacity-0 group-hover:opacity-100 transition-all duration-300">
                            <a href="{{ route('product.show', $product->id) }}"
                                class="bg-white text-[#2596be] shadow w-10 h-10 flex items-center justify-center rounded-full hover:bg-[#2596be] hover:text-white transition"
                                title="view product">
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </a>
                            <a href="{{ route('wishlist.add', $product->id) }}"
                                class="bg-white text-[#2596be] shadow w-10 h-10 flex items-center justify-center rounded-full hover:bg-[#2596be] hover:text-white transition"
                                title="add to wishlist">
                                <i class="fa-solid fa-heart"></i>
                            </a>
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
                            <div class="flex gap-1 text-sm text-yellow-400">
                                @for ($i = 0; $i < 5; $i++)
                                    <span><i class="fa-solid fa-star"></i></span>
                                @endfor
                            </div>
                            <div class="text-xs text-gray-500 ml-3">({{ $product->transactionItems->count() }})</div>
                        </div>
                    </div>
                    <a href="{{ route('cart.add', $product->id) }}"
                        class="block w-full py-2 mt-auto text-center text-white bg-[#2596be] font-bold rounded-xl shadow hover:bg-white hover:text-white hover:border-[#2596be] hover:shadow-xl hover:scale-105 border-2 border-[#2596be] transition-all duration-300">Add to cart</a>
                </div>
            @endforeach
        </div>
    </div>
    <!-- ./product -->
@endsection