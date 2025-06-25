@extends('layouts.master')

@section('title', 'Checkout')

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
                <li aria-current="page">
                    <div class="flex items-center">
                        <svg class="rtl:rotate-180 w-4 h-4 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                        </svg>
                        <span class="ms-1 text-sm font-medium text-gray-500 md:ms-2 dark:text-gray-400">Checkout</span>
                    </div>
                </li>
                 <li>
                    <div class="flex items-center">
                        <svg class="rtl:rotate-180 w-4 h-4 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                        </svg>
                        <span class="ms-1 text-sm font-medium text-gray-500 md:ms-2 dark:text-gray-400">Order Summary</span>
                    </div>
                </li>
            </ol>
        </nav>

        <form action="{{ route('checkout.process') }}" method="POST">
            @csrf
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 lg:gap-8">
                <!-- Left Column (Delivery Details, Payment, Delivery Method) -->
                <div class="lg:col-span-2 space-y-6">
                    <!-- Delivery Details -->
                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-6">
                        <h2 class="text-xl font-semibold text-gray-900 dark:text-white mb-5">Delivery Details</h2>
                        <div class="space-y-4">
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Name</label>
                                <input type="text" name="name" id="name" value="{{ old('name', auth()->user()->name) }}" 
                                       class="block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:border-primary-500 dark:focus:ring-primary-500">
                                @error('name')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Email</label>
                                <input type="email" name="email" id="email" value="{{ old('email', auth()->user()->email) }}" 
                                       class="block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:border-primary-500 dark:focus:ring-primary-500">
                                @error('email')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="phone" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Phone Number</label>
                                <input type="tel" name="phone" id="phone" value="{{ old('phone', auth()->user()->phone) }}" 
                                       class="block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:border-primary-500 dark:focus:ring-primary-500">
                                @error('phone')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="address" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Address</label>
                                <textarea name="address" id="address" rows="3" 
                                          class="block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:border-primary-500 dark:focus:ring-primary-500">{{ old('address', auth()->user()->address) }}</textarea>
                                @error('address')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Payment Method -->
                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-6">
                        <h2 class="text-xl font-semibold text-gray-900 dark:text-white mb-5">Payment Method</h2>
                        <div class="space-y-4">
                            @php
                                $paymentMethods = [
                                    'gopay' => 'GoPay / GoPay Later',
                                    'va' => 'Virtual Account Bank',
                                    'credit_card' => 'Credit / Debit Card',
                                    'google_play' => 'Google Play',
                                    'shopeepay' => 'ShopeePay / SPayLater',
                                    'dana' => 'Dana',
                                    'qris' => 'QRIS',
                                    'alfa' => 'Alfa Group',
                                    'indomaret' => 'Indomaret',
                                    'akulaku' => 'Akulaku Paylater',
                                    'kredivo' => 'Kredivo',
                                ];
                            @endphp
                            @foreach($paymentMethods as $value => $label)
                                <div class="flex items-center">
                                    <input id="payment_{{ $value }}" name="payment_method" type="radio" value="{{ $value }}" 
                                           class="h-4 w-4 text-primary-600 border-gray-300 focus:ring-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:ring-offset-gray-800 dark:focus:ring-primary-600" 
                                           {{ old('payment_method') == $value ? 'checked' : '' }}>
                                    <label for="payment_{{ $value }}" class="ml-3 block text-sm font-medium text-gray-700 dark:text-gray-300">{{ $label }}</label>
                                </div>
                            @endforeach
                             @error('payment_method')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Delivery Method -->
                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-6">
                        <h2 class="text-xl font-semibold text-gray-900 dark:text-white mb-5">Delivery Method</h2>
                        <div class="space-y-4">
                            @php
                                $deliveryMethods = [
                                    'regular' => 'Regular Delivery (3-5 days)',
                                    'express' => 'Express Delivery (1-2 days)',
                                    'pickup' => 'Store Pickup',
                                ];
                            @endphp
                            @foreach($deliveryMethods as $value => $label)
                                <div class="flex items-center">
                                    <input id="delivery_{{ $value }}" name="delivery_method" type="radio" value="{{ $value }}" 
                                           class="h-4 w-4 text-primary-600 border-gray-300 focus:ring-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:ring-offset-gray-800 dark:focus:ring-primary-600" 
                                           {{ old('delivery_method') == $value ? 'checked' : '' }}>
                                    <label for="delivery_{{ $value }}" class="ml-3 block text-sm font-medium text-gray-700 dark:text-gray-300">{{ $label }}</label>
                                </div>
                            @endforeach
                             @error('delivery_method')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Right Column (Order Summary and Buttons) -->
                <div class="lg:col-span-1 space-y-6">
                    <!-- Order Summary -->
                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-6 sticky top-8">
                        <h2 class="text-xl font-semibold text-gray-900 dark:text-white mb-5">Order Summary</h2>
                        <div class="space-y-4">
                            @foreach($items as $item)
                            <div class="flex justify-between text-sm text-gray-600 dark:text-gray-300">
                                <span class="flex-1 pr-2">{{ $item->product->name }} x {{ $item->quantity }}</span>
                                <span class="text-gray-900 dark:text-white font-medium">Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}</span>
                            </div>
                            @endforeach
                            <div class="border-t border-gray-200 dark:border-gray-700 pt-4 space-y-3">
                                <div class="flex justify-between text-gray-600 dark:text-gray-300">
                                    <span class="text-base font-medium">Subtotal</span>
                                    <span class="text-gray-900 dark:text-white text-base font-semibold">Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                                </div>
                                <div class="flex justify-between text-gray-600 dark:text-gray-300">
                                    <span class="text-base font-medium">Tax (10%)</span>
                                    <span class="text-gray-900 dark:text-white text-base font-semibold">Rp {{ number_format($tax, 0, ',', '.') }}</span>
                                </div>
                                {{-- You can add a section for Savings/Discount here if applicable --}}
                                {{-- 
                                <div class="flex justify-between text-green-600 dark:text-green-400">
                                    <span class="text-base font-medium">Savings</span>
                                    <span class="text-base font-semibold">- Rp. {{ number_format($savings ?? 0, 0, ',', '.') }}</span>
                                </div>
                                --}}
                                <div class="flex justify-between font-bold text-lg text-gray-900 dark:text-white pt-2 border-t border-gray-200 dark:border-gray-700">
                                    <span>Total</span>
                                    <span>Rp {{ number_format($total, 0, ',', '.') }}</span>
                                </div>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex flex-col space-y-4 mt-6">
                            <button type="submit" class="w-full !bg-primary text-white py-3 px-6 rounded-lg font-semibold hover:!bg-primary-700 transition-colors duration-200 shadow-md">
                                Proceed to Order Summary
                            </button>
                            <a href="{{ route('cart.index') }}" class="w-full bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-gray-200 py-3 px-6 rounded-lg font-semibold hover:bg-gray-300 dark:hover:bg-gray-600 transition-colors duration-200 text-center shadow-sm">
                                Back to Cart
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>
@endsection
