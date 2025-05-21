@extends('layouts.master')

@section('title', 'Order Summary')

@section('main')
<div class="container mx-auto px-2 sm:px-4 py-4 sm:py-8">
    <div class="max-w-4xl mx-auto">
        <!-- Breadcrumb -->
        <div class="flex flex-wrap items-center space-x-2 mb-4 sm:mb-8">
            <div class="flex items-center">
                <svg class="w-4 h-4 sm:w-5 sm:h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                </svg>
                <span class="ml-1 sm:ml-2 text-sm sm:text-base text-gray-500">Cart</span>
            </div>
            <svg class="w-4 h-4 sm:w-5 sm:h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
            <div class="flex items-center">
                <svg class="w-4 h-4 sm:w-5 sm:h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                </svg>
                <span class="ml-1 sm:ml-2 text-sm sm:text-base text-gray-500">Checkout</span>
            </div>
            <svg class="w-4 h-4 sm:w-5 sm:h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
            <div class="flex items-center">
                <svg class="w-4 h-4 sm:w-5 sm:h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <span class="ml-1 sm:ml-2 text-sm sm:text-base text-blue-600">Order Summary</span>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 sm:gap-8">
            <!-- Left Column -->
            <div class="space-y-4 sm:space-y-8">
                <!-- Billing Information -->
                <div class="bg-white rounded-lg shadow-md p-4 sm:p-6">
                    <h2 class="text-lg sm:text-xl font-semibold mb-3 sm:mb-4">Billing Information</h2>
                    <div class="space-y-3 sm:space-y-4">
                        <div>
                            <span class="text-xs sm:text-sm font-medium text-gray-500">Name</span>
                            <p class="mt-1 text-sm sm:text-base">{{ $checkout['name'] }}</p>
                        </div>
                        <div>
                            <span class="text-xs sm:text-sm font-medium text-gray-500">Email</span>
                            <p class="mt-1 text-sm sm:text-base">{{ $checkout['email'] }}</p>
                        </div>
                        <div>
                            <span class="text-xs sm:text-sm font-medium text-gray-500">Phone</span>
                            <p class="mt-1 text-sm sm:text-base">{{ $checkout['phone'] }}</p>
                        </div>
                        <div>
                            <span class="text-xs sm:text-sm font-medium text-gray-500">Address</span>
                            <p class="mt-1 text-sm sm:text-base">{{ $checkout['address'] }}</p>
                        </div>
                    </div>
                </div>

                <!-- Payment & Delivery -->
                <div class="bg-white rounded-lg shadow-md p-4 sm:p-6">
                    <h2 class="text-lg sm:text-xl font-semibold mb-3 sm:mb-4">Payment & Delivery</h2>
                    <div class="space-y-3 sm:space-y-4">
                        <div>
                            <span class="text-xs sm:text-sm font-medium text-gray-500">Payment Method</span>
                            <p class="mt-1 text-sm sm:text-base capitalize">{{ str_replace('_', ' ', $checkout['payment_method']) }}</p>
                        </div>
                        <div>
                            <span class="text-xs sm:text-sm font-medium text-gray-500">Delivery Method</span>
                            <p class="mt-1 text-sm sm:text-base capitalize">{{ str_replace('_', ' ', $checkout['delivery_method']) }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column -->
            <div class="space-y-4 sm:space-y-8">
                <!-- Order Items -->
                <div class="bg-white rounded-lg shadow-md p-4 sm:p-6">
                    <h2 class="text-lg sm:text-xl font-semibold mb-3 sm:mb-4">Order Items</h2>
                    <div class="space-y-3 sm:space-y-4">
                        @foreach($items as $item)
                        <div class="flex items-center space-x-3 sm:space-x-4">
                            <img src="{{ asset('storage/' . $item->product->image_url) }}" alt="{{ $item->product->name }}" class="w-12 h-12 sm:w-16 sm:h-16 object-cover rounded">
                            <div class="flex-1 min-w-0">
                                <h3 class="text-xs sm:text-sm font-medium text-gray-900 truncate">{{ $item->product->name }}</h3>
                                <p class="text-xs sm:text-sm text-gray-500">Quantity: {{ $item->quantity }}</p>
                            </div>
                            <div class="text-xs sm:text-sm font-medium text-gray-900 whitespace-nowrap">
                                Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                <!-- Order Summary -->
                <div class="bg-white rounded-lg shadow-md p-4 sm:p-6">
                    <h2 class="text-lg sm:text-xl font-semibold mb-3 sm:mb-4">Order Summary</h2>
                    <div class="space-y-3 sm:space-y-4">
                        <div class="flex justify-between">
                            <span class="text-sm sm:text-base text-gray-600">Subtotal</span>
                            <span class="text-sm sm:text-base text-gray-900">Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-sm sm:text-base text-gray-600">Tax (10%)</span>
                            <span class="text-sm sm:text-base text-gray-900">Rp {{ number_format($tax, 0, ',', '.') }}</span>
                        </div>
                        <div class="border-t pt-3 sm:pt-4">
                            <div class="flex justify-between font-semibold text-base sm:text-lg">
                                <span>Total</span>
                                <span>Rp {{ number_format($total, 0, ',', '.') }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex flex-col sm:flex-row justify-between gap-3 sm:gap-4 mt-4 sm:mt-6">
                    <a href="{{ route('checkout') }}" class="w-full sm:w-auto text-center bg-gray-200 text-gray-800 px-4 sm:px-6 py-2 sm:py-3 rounded-lg hover:bg-gray-300 transition-colors text-sm sm:text-base">
                        Back to Checkout
                    </a>
                    <form action="{{ route('order.create-transaction') }}" method="POST" class="w-full sm:w-auto">
                        @csrf
                        <input type="hidden" name="total" value="{{ $total }}">
                        <input type="hidden" name="payment_method" value="{{ $checkout['payment_method'] }}">
                        <input type="hidden" name="delivery_method" value="{{ $checkout['delivery_method'] }}">
                        <button type="submit" class="w-full bg-primary text-white px-6 sm:px-8 py-2 sm:py-3 rounded-lg hover:bg-[#1f7a9c] transition-colors font-semibold shadow-md hover:shadow-lg text-sm sm:text-base">
                            Place Order
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
