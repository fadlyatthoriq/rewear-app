@extends('layouts.master')

@section('title', 'Order Summary')

@section('main')
<section class="bg-gray-100 dark:bg-gray-900 py-8 md:py-12 antialiased">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-screen-xl">

        <!-- Breadcrumb -->
        <nav class="flex mb-6 md:mb-8" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
                <li class="inline-flex items-center">
                    <a href="{{ route('cart.index') }}" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-primary-600 dark:text-gray-400 dark:hover:text-primary-500 transition-colors duration-200">
                        <svg class="w-4 h-4 me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                            <path fill-rule="evenodd" d="M14 7V4a1 1 0 0 0-1-1H9a1 1 0 0 0-1 1v3H7a3 3 0 0 0-3 3v11a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V10a3 3 0 0 0-3-3h-1Zm-3 2V4h2v5h-2Z" clip-rule="evenodd"/>
                        </svg>
                        Cart
                    </a>
                </li>
                 <li>
                    <div class="flex items-center">
                        <svg class="rtl:rotate-180 w-4 h-4 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                        </svg>
                        <a href="{{ route('checkout') }}" class="ms-1 text-sm font-medium text-gray-700 hover:text-primary-600 md:ms-2 dark:text-gray-400 dark:hover:text-primary-500 transition-colors duration-200">Checkout</a>
                    </div>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <svg class="rtl:rotate-180 w-4 h-4 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                        </svg>
                        <span class="ms-1 text-sm font-medium text-gray-500 md:ms-2 dark:text-gray-400">Order Summary</span>
                    </div>
                </li>
            </ol>
        </nav>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 lg:gap-8">
            <!-- Left Column (Billing, Payment & Delivery) -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Billing Information -->
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-6">
                    <h2 class="text-xl font-semibold text-gray-900 dark:text-white mb-5">Billing Information</h2>
                    <div class="space-y-4">
                        <div>
                            <span class="block text-sm font-medium text-gray-500 dark:text-gray-400">Name</span>
                            <p class="mt-1 text-base text-gray-900 dark:text-white">{{ $checkout['name'] }}</p>
                        </div>
                        <div>
                            <span class="block text-sm font-medium text-gray-500 dark:text-gray-400">Email</span>
                            <p class="mt-1 text-base text-gray-900 dark:text-white">{{ $checkout['email'] }}</p>
                        </div>
                        <div>
                            <span class="block text-sm font-medium text-gray-500 dark:text-gray-400">Phone</span>
                            <p class="mt-1 text-base text-gray-900 dark:text-white">{{ $checkout['phone'] }}</p>
                        </div>
                        <div>
                            <span class="block text-sm font-medium text-gray-500 dark:text-gray-400">Address</span>
                            <p class="mt-1 text-base text-gray-900 dark:text-white">{{ $checkout['address'] }}</p>
                        </div>
                    </div>
                </div>

                <!-- Payment & Delivery -->
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-6">
                    <h2 class="text-xl font-semibold text-gray-900 dark:text-white mb-5">Payment & Delivery</h2>
                    <div class="space-y-4">
                        <div>
                            <span class="block text-sm font-medium text-gray-500 dark:text-gray-400">Payment Method</span>
                            <p class="mt-1 text-base text-gray-900 dark:text-white capitalize">{{ str_replace('_', ' ', $checkout['payment_method']) }}</p>
                        </div>
                        <div>
                            <span class="block text-sm font-medium text-gray-500 dark:text-gray-400">Delivery Method</span>
                            <p class="mt-1 text-base text-gray-900 dark:text-white capitalize">{{ str_replace('_', ' ', $checkout['delivery_method']) }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column (Order Items and Summary) -->
            <div class="lg:col-span-1 space-y-6">
                <!-- Order Items -->
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-6">
                    <h2 class="text-xl font-semibold text-gray-900 dark:text-white mb-5">Order Items</h2>
                    <div class="space-y-4">
                        @foreach($items as $item)
                        <div class="flex items-start gap-4">
                            <img src="{{ $item->product->image }}" alt="{{ $item->product->name }}" class="w-14 h-14 object-cover rounded-md shadow-sm">
                            <div class="flex-1 min-w-0">
                                <h3 class="text-base font-medium text-gray-900 dark:text-white line-clamp-2">{{ $item->product->name }}</h3>
                                <p class="text-sm text-gray-500 dark:text-gray-400">Quantity: {{ $item->quantity }}</p>
                            </div>
                            <div class="text-base font-semibold text-gray-900 dark:text-white whitespace-nowrap">
                                Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                <!-- Order Summary -->
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-6 sticky top-8">
                    <h2 class="text-xl font-semibold text-gray-900 dark:text-white mb-5">Order Summary</h2>
                    <div class="space-y-4">
                        <div class="flex justify-between text-base text-gray-600 dark:text-gray-300">
                            <span>Subtotal</span>
                            <span class="font-medium text-gray-900 dark:text-white">Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between text-base text-gray-600 dark:text-gray-300">
                            <span>Tax (10%)</span>
                            <span class="font-medium text-gray-900 dark:text-white">Rp {{ number_format($tax, 0, ',', '.') }}</span>
                        </div>
                         {{-- You can add a section for Savings/Discount here if applicable --}}
                         {{-- 
                        <div class="flex justify-between text-green-600 dark:text-green-400">
                            <span class="text-base font-medium">Savings</span>
                            <span class="text-base font-semibold">- Rp. {{ number_format($savings ?? 0, 0, ',', '.') }}</span>
                        </div>
                         --}}
                        <div class="border-t border-gray-200 dark:border-gray-700 pt-4">
                            <div class="flex justify-between font-bold text-lg text-gray-900 dark:text-white">
                                <span>Total</span>
                                <span>Rp {{ number_format($total, 0, ',', '.') }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex flex-col sm:flex-row justify-between gap-4 mt-6">
                        <a href="{{ route('checkout') }}" class="w-full sm:w-auto flex-1 text-center bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-gray-200 px-6 py-3 rounded-lg font-semibold hover:bg-gray-300 dark:hover:bg-gray-600 transition-colors duration-200 shadow-sm">
                            Back to Checkout
                        </a>
                        <form action="{{ route('order.create-transaction') }}" method="POST" class="w-full sm:w-auto flex-1">
                            @csrf
                             {{-- Assuming total, payment_method, and delivery_method are available and passed correctly --}}
                            <input type="hidden" name="total" value="{{ $total }}">
                            <input type="hidden" name="payment_method" value="{{ $checkout['payment_method'] ?? '' }}">
                            <input type="hidden" name="delivery_method" value="{{ $checkout['delivery_method'] ?? '' }}">
                            <button type="submit" class="w-full !bg-primary text-white px-6 py-3 rounded-lg font-semibold hover:!bg-primary-700 transition-colors duration-200 shadow-md">
                                Place Order
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
