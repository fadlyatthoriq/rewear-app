@extends('layouts.master')

@section('title', 'Order Details')

@section('main')
<section class="min-h-screen bg-gray-50 py-8 antialiased dark:bg-gray-900 md:py-16">
    <div class="mx-auto max-w-screen-xl px-4 2xl:px-0">
        <div class="mx-auto max-w-5xl">
            <!-- Header Section -->
            <div class="mb-8 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <h2 class="text-2xl font-bold text-gray-900 dark:text-white sm:text-3xl">Order Details</h2>
                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">View and manage your order information</p>
                </div>
                <a href="{{ route('my-orders') }}" 
                   class="inline-flex items-center rounded-lg border border-gray-200 bg-white px-4 py-2.5 text-sm font-medium text-gray-900 transition-colors hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:outline-none focus:ring-4 focus:ring-gray-100 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white dark:focus:ring-gray-700">
                    <svg class="mr-2 h-4 w-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m15 19-7-7 7-7" />
                    </svg>
                    Back to orders
                </a>
            </div>

            <!-- Order Information Card -->
            <div class="mb-6 overflow-hidden rounded-lg border border-gray-200 bg-white shadow-sm dark:border-gray-700 dark:bg-gray-800">
                <div class="p-6">
                    <div class="mb-4 grid grid-cols-1 gap-6 sm:grid-cols-2">
                        <!-- Order Information -->
                        <div class="space-y-4">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Order Information</h3>
                            <dl class="space-y-3">
                                <div class="flex flex-col">
                                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Order ID</dt>
                                    <dd class="mt-1 text-base font-semibold text-gray-900 dark:text-white">#{{ $transaction->id }}</dd>
                                </div>
                                <div class="flex flex-col">
                                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Date</dt>
                                    <dd class="mt-1 text-base font-semibold text-gray-900 dark:text-white">{{ $transaction->created_at->format('d.m.Y H:i') }}</dd>
                                </div>
                                <div class="flex flex-col">
                                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Status</dt>
                                    <dd class="mt-1">
                                        <span class="inline-flex items-center gap-1.5 rounded-full px-3 py-1 text-xs font-medium
                                            @if($transaction->status === 'pending') bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-300
                                            @elseif($transaction->status === 'processing') bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-300
                                            @elseif($transaction->status === 'completed' || $transaction->status === 'success') bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300
                                            @elseif($transaction->status === 'shipped') bg-purple-100 text-purple-800 dark:bg-purple-900 dark:text-purple-300
                                            @else bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-300 @endif">
                                            @if($transaction->status === 'pending')
                                                <svg class="h-3.5 w-3.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.5 4h-13m13 16h-13M8 20v-3.333a2 2 0 0 1 .4-1.2L10 12.6a1 1 0 0 0 0-1.2L8.4 8.533a2 2 0 0 1-.4-1.2V4h8v3.333a2 2 0 0 1-.4 1.2L13.957 11.4a1 1 0 0 0 0 1.2l1.643 2.867a2 2 0 0 1 .4 1.2V20H8Z" />
                                                </svg>
                                            @elseif($transaction->status === 'processing')
                                                <svg class="h-3.5 w-3.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h6l2 4m-8-4v8m0-8V6a1 1 0 0 0-1-1H4a1 1 0 0 0-1 1v9h2m8 0H9m4 0h2m4 0h2v-4m0 0h-5m3.5 5.5a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0Zm-10 0a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0Z" />
                                                </svg>
                                            @elseif($transaction->status === 'completed' || $transaction->status === 'success')
                                                <svg class="h-3.5 w-3.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 11.917 9.724 16.5 19 7.5" />
                                                </svg>
                                            @elseif($transaction->status === 'shipped')
                                                <svg class="h-3.5 w-3.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2-10V4a1 1 0 0 0-1-1H4a1 1 0 0 0-1 1v16a1 1 0 0 0 1 1h16a1 1 0 0 0 1-1V10a1 1 0 0 0-1-1h-3.393a1 1 0 0 1-.894-.553L14 5h-3c-.53 0-1.04-.2-1.414-.586l-.78-.78a1 1 0 0 0-1.414 0l-.78.78A1 1 0 0 1 7.393 9H4a1 1 0 0 0-1 1v2h18v-2h-3Z"/>
                                                </svg>
                                            @else
                                                <svg class="h-3.5 w-3.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18 17.94 6M18 18 6.06 6" />
                                                </svg>
                                            @endif
                                            {{ ucfirst($transaction->status) }}
                                        </span>
                                    </dd>
                                </div>
                                @if($transaction->tracking_number)
                                <div class="flex flex-col">
                                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Tracking Number</dt>
                                    <dd class="mt-1 text-base font-semibold text-gray-900 dark:text-white">{{ $transaction->tracking_number }}</dd>
                                </div>
                                @endif
                            </dl>
                        </div>

                        <!-- Payment Information -->
                        <div class="space-y-4">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Payment Information</h3>
                            <dl class="space-y-3">
                                <div class="flex flex-col">
                                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Payment Method</dt>
                                    <dd class="mt-1 text-base font-semibold text-gray-900 dark:text-white">{{ ucfirst($transaction->payment_method) }}</dd>
                                </div>
                                <div class="flex flex-col">
                                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Payment Status</dt>
                                    <dd class="mt-1">
                                        <span class="inline-flex items-center gap-1.5 rounded-full px-3 py-1 text-xs font-medium
                                            @if($transaction->payment_status === 'pending') bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-300
                                            @elseif($transaction->payment_status === 'paid') bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300
                                            @else bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-300 @endif">
                                            @if($transaction->payment_status === 'pending')
                                                <svg class="h-3.5 w-3.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                                                </svg>
                                            @elseif($transaction->payment_status === 'paid')
                                                <svg class="h-3.5 w-3.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 11.917 9.724 16.5 19 7.5"/>
                                                </svg>
                                            @else
                                                <svg class="h-3.5 w-3.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18 17.94 6M18 18 6.06 6"/>
                                                </svg>
                                            @endif
                                            {{ ucfirst($transaction->payment_status) }}
                                        </span>
                                    </dd>
                                </div>
                                <div class="flex flex-col">
                                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Delivery Method</dt>
                                    <dd class="mt-1 text-base font-semibold text-gray-900 dark:text-white">{{ ucfirst($transaction->delivery_method) }}</dd>
                                </div>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Order Items Card -->
            <div class="mb-6 overflow-hidden rounded-lg border border-gray-200 bg-white shadow-sm dark:border-gray-700 dark:bg-gray-800">
                <div class="p-6">
                    <h3 class="mb-6 text-lg font-semibold text-gray-900 dark:text-white">Order Items</h3>
                    <div class="flow-root">
                        <ul role="list" class="divide-y divide-gray-200 dark:divide-gray-700">
                            @foreach($transaction->items as $item)
                            <li class="py-6">
                                <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:gap-6">
                                    <div class="h-32 w-32 flex-shrink-0 overflow-hidden rounded-lg border border-gray-200 dark:border-gray-700">
                                        @if($item->product->image)
                                            <img src="{{ $item->product->image }}" 
                                                 alt="{{ $item->product->name }}" 
                                                 class="h-full w-full object-cover object-center">
                                        @else
                                            <div class="flex h-full w-full items-center justify-center bg-gray-100 dark:bg-gray-800">
                                                <svg class="h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                </svg>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="flex flex-1 flex-col gap-2">
                                        <div class="flex flex-col justify-between gap-2 sm:flex-row sm:items-center">
                                            <h4 class="text-base font-semibold text-gray-900 dark:text-white">{{ $item->product->name }}</h4>
                                            <p class="text-base font-semibold text-gray-900 dark:text-white">Rp. {{ number_format($item->price * $item->quantity, 2) }}</p>
                                        </div>
                                        <div class="flex flex-col gap-1 text-sm text-gray-500 dark:text-gray-400">
                                            <p>Quantity: {{ $item->quantity }}</p>
                                            <p>Price per item: Rp. {{ number_format($item->price, 2) }}</p>
                                            <p>Status: 
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                                    @if($item->shipping_status === 'delivered') bg-green-100 text-green-800
                                                    @elseif($item->shipping_status === 'shipped') bg-blue-100 text-blue-800
                                                    @elseif($item->shipping_status === 'processing') bg-yellow-100 text-yellow-800
                                                    @elseif($item->shipping_status === 'failed') bg-red-100 text-red-800
                                                    @else bg-gray-100 text-gray-800 @endif">
                                                    {{ ucfirst($item->shipping_status) }}
                                                </span>
                                            </p>
                                            <p>Tracking Number: 
                                                @if($item->tracking_number)
                                                    <span class="inline-flex items-center gap-1.5 rounded-full px-2.5 py-0.5 text-xs font-medium bg-blue-100 text-blue-800">
                                                        <svg class="h-3.5 w-3.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2-10V4a1 1 0 0 0-1-1H4a1 1 0 0 0-1 1v16a1 1 0 0 0 1 1h16a1 1 0 0 0 1-1V10a1 1 0 0 0-1-1h-3.393a1 1 0 0 1-.894-.553L14 5h-3c-.53 0-1.04-.2-1.414-.586l-.78-.78a1 1 0 0 0-1.414 0l-.78.78A1 1 0 0 1 7.393 9H4a1 1 0 0 0-1 1v2h18v-2h-3Z"/>
                                                        </svg>
                                                        {{ $item->tracking_number }}
                                                    </span>
                                                @else
                                                    <span class="text-gray-400">-</span>
                                                @endif
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="border-t border-gray-200 bg-gray-50 px-6 py-4 dark:border-gray-700 dark:bg-gray-800">
                    <div class="flex justify-between text-lg font-semibold text-gray-900 dark:text-white">
                        <p>Total</p>
                        <p>Rp. {{ number_format($transaction->total_amount, 2) }}</p>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex justify-end gap-4">
                @if($transaction->status === 'pending')
                    <form action="{{ route('my-orders.cancel', $transaction) }}" method="POST">
                        @csrf
                        <button type="submit" 
                                class="inline-flex items-center rounded-lg border border-red-700 px-5 py-2.5 text-center text-sm font-medium text-red-700 transition-colors hover:bg-red-700 hover:text-white focus:outline-none focus:ring-4 focus:ring-red-300 dark:border-red-500 dark:text-red-500 dark:hover:bg-red-600 dark:hover:text-white dark:focus:ring-red-900">
                            <svg class="mr-2 h-4 w-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18 17.94 6M18 18 6.06 6"/>
                            </svg>
                            Cancel Order
                        </button>
                    </form>
                @elseif($transaction->status === 'shipped')
                    <form action="{{ route('my-orders.complete', $transaction) }}" method="POST">
                        @csrf
                        <button type="submit" 
                                class="inline-flex items-center rounded-lg bg-green-600 px-5 py-2.5 text-center text-sm font-medium text-white transition-colors hover:bg-green-700 focus:outline-none focus:ring-4 focus:ring-green-300 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                            <svg class="mr-2 h-4 w-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 11.917 9.724 16.5 19 7.5"/>
                            </svg>
                            Complete Order
                        </button>
                    </form>
                @else
                    <form action="{{ route('my-orders.reorder', $transaction) }}" method="POST">
                        @csrf
                        <button type="submit" 
                                class="inline-flex items-center rounded-lg bg-primary-600 px-5 py-2.5 text-center text-sm font-medium text-white transition-colors hover:bg-primary-700 focus:outline-none focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                            <svg class="mr-2 h-4 w-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0 3.181 3.183a8.25 8.25 0 0 0 13.803-3.7M4.031 9.865a8.25 8.25 0 0 1 13.803-3.7l3.181 3.182m0-4.991v4.99"/>
                            </svg>
                            Order Again
                        </button>
                    </form>
                @endif
            </div>
        </div>
    </div>
</section>
@endsection 