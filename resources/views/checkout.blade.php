@extends('layouts.master')

@section('title', 'Checkout')

@section('main')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-4xl mx-auto">
        <!-- Breadcrumb -->
        <div class="flex items-center space-x-2 mb-8">
            <div class="flex items-center">
                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                </svg>
                <span class="ml-2 text-gray-500">Cart</span>
            </div>
            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
            <div class="flex items-center">
                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                </svg>
                <span class="ml-2 text-blue-600">Checkout</span>
            </div>
            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
            <div class="flex items-center">
                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <span class="ml-2 text-gray-500">Order Summary</span>
            </div>
        </div>

        <form action="{{ route('checkout.process') }}" method="POST">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Left Column -->
                <div class="space-y-8">
                    <!-- Delivery Details -->
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <h2 class="text-xl font-semibold mb-4">Delivery Details</h2>
                        <div class="space-y-4">
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                                <input type="text" name="name" id="name" value="{{ auth()->user()->name }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            </div>
                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                                <input type="email" name="email" id="email" value="{{ auth()->user()->email }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            </div>
                            <div>
                                <label for="phone" class="block text-sm font-medium text-gray-700">Phone Number</label>
                                <input type="tel" name="phone" id="phone" value="{{ auth()->user()->phone }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            </div>
                            <div>
                                <label for="address" class="block text-sm font-medium text-gray-700">Address</label>
                                <textarea name="address" id="address" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">{{ auth()->user()->address }}</textarea>
                            </div>
                        </div>
                    </div>

                    <!-- Payment Method -->
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <h2 class="text-xl font-semibold mb-4">Payment Method</h2>
                        <div class="space-y-4">
                            <div class="flex items-center">
                                <input type="radio" name="payment_method" id="credit_card" value="credit_card" class="h-4 w-4 text-blue-600 focus:ring-blue-500">
                                <label for="credit_card" class="ml-3 block text-sm font-medium text-gray-700">Credit Card</label>
                            </div>
                            <div class="flex items-center">
                                <input type="radio" name="payment_method" id="bank_transfer" value="bank_transfer" class="h-4 w-4 text-blue-600 focus:ring-blue-500">
                                <label for="bank_transfer" class="ml-3 block text-sm font-medium text-gray-700">Bank Transfer</label>
                            </div>
                            <div class="flex items-center">
                                <input type="radio" name="payment_method" id="e_wallet" value="e_wallet" class="h-4 w-4 text-blue-600 focus:ring-blue-500">
                                <label for="e_wallet" class="ml-3 block text-sm font-medium text-gray-700">E-Wallet</label>
                            </div>
                        </div>
                    </div>

                    <!-- Delivery Method -->
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <h2 class="text-xl font-semibold mb-4">Delivery Method</h2>
                        <div class="space-y-4">
                            <div class="flex items-center">
                                <input type="radio" name="delivery_method" id="regular" value="regular" class="h-4 w-4 text-blue-600 focus:ring-blue-500">
                                <label for="regular" class="ml-3 block text-sm font-medium text-gray-700">Regular Delivery (3-5 days)</label>
                            </div>
                            <div class="flex items-center">
                                <input type="radio" name="delivery_method" id="express" value="express" class="h-4 w-4 text-blue-600 focus:ring-blue-500">
                                <label for="express" class="ml-3 block text-sm font-medium text-gray-700">Express Delivery (1-2 days)</label>
                            </div>
                            <div class="flex items-center">
                                <input type="radio" name="delivery_method" id="pickup" value="pickup" class="h-4 w-4 text-blue-600 focus:ring-blue-500">
                                <label for="pickup" class="ml-3 block text-sm font-medium text-gray-700">Store Pickup</label>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Column -->
                <div class="space-y-8">
                    <!-- Order Summary -->
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <h2 class="text-xl font-semibold mb-4">Order Summary</h2>
                        <div class="space-y-4">
                            @foreach($items as $item)
                            <div class="flex justify-between">
                                <span class="text-gray-600">{{ $item->product->name }} x {{ $item->quantity }}</span>
                                <span class="text-gray-900">Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}</span>
                            </div>
                            @endforeach
                            <div class="border-t pt-4">
                                <div class="flex justify-between mb-2">
                                    <span class="text-gray-600">Subtotal</span>
                                    <span class="text-gray-900">Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                                </div>
                                <div class="flex justify-between mb-2">
                                    <span class="text-gray-600">Tax (10%)</span>
                                    <span class="text-gray-900">Rp {{ number_format($tax, 0, ',', '.') }}</span>
                                </div>
                                <div class="flex justify-between font-semibold text-lg">
                                    <span>Total</span>
                                    <span>Rp {{ number_format($total, 0, ',', '.') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex space-x-4">
                        <button type="submit" class="flex-1 bg-primary text-white py-3 px-6 rounded-lg hover:bg-blue-700 transition duration-200">
                            Proceed to Order Summary
                        </button>
                        <a href="{{ route('cart.index') }}" class="flex-1 bg-gray-200 text-gray-800 py-3 px-6 rounded-lg hover:bg-gray-300 transition duration-200 text-center">
                            Back to Cart
                        </a>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
