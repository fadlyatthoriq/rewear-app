@extends('layouts.master')

@section('title', 'Order Details')

@section('main')
<section class="bg-white py-8 antialiased dark:bg-gray-900 md:py-16">
    <div class="mx-auto max-w-screen-xl px-4 2xl:px-0">
        <div class="mx-auto max-w-5xl">
            <div class="mb-6 flex items-center justify-between">
                <h2 class="text-xl font-semibold text-gray-900 dark:text-white sm:text-2xl">Order Details</h2>
                <a href="{{ route('my-orders') }}" class="inline-flex items-center rounded-lg border border-gray-200 bg-white px-3 py-2 text-sm font-medium text-gray-900 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:outline-none focus:ring-4 focus:ring-gray-100 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white dark:focus:ring-gray-700">
                    <svg class="me-2 h-4 w-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m15 19-7-7 7-7" />
                    </svg>
                    Back to orders
                </a>
            </div>

            <div class="mb-6 rounded-lg border border-gray-200 bg-white p-6 dark:border-gray-700 dark:bg-gray-800">
                <div class="mb-4 grid grid-cols-1 gap-4 sm:grid-cols-2">
                    <div>
                        <h3 class="mb-2 text-sm font-medium text-gray-900 dark:text-white">Order Information</h3>
                        <dl class="space-y-2">
                            <div>
                                <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Order ID</dt>
                                <dd class="text-sm font-semibold text-gray-900 dark:text-white">#{{ $transaction->id }}</dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Date</dt>
                                <dd class="text-sm font-semibold text-gray-900 dark:text-white">{{ $transaction->created_at->format('d.m.Y H:i') }}</dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Status</dt>
                                <dd class="inline-flex items-center rounded px-2.5 py-0.5 text-xs font-medium
                                    @if($transaction->status === 'pending') bg-primary-100 text-primary-800 dark:bg-primary-900 dark:text-primary-300
                                    @elseif($transaction->status === 'processing') bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-300
                                    @elseif($transaction->status === 'completed') bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300
                                    @else bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-300 @endif">
                                    {{ ucfirst($transaction->status) }}
                                </dd>
                            </div>
                        </dl>
                    </div>
                    <div>
                        <h3 class="mb-2 text-sm font-medium text-gray-900 dark:text-white">Payment Information</h3>
                        <dl class="space-y-2">
                            <div>
                                <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Payment Method</dt>
                                <dd class="text-sm font-semibold text-gray-900 dark:text-white">{{ ucfirst($transaction->payment_method) }}</dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Payment Status</dt>
                                <dd class="inline-flex items-center rounded px-2.5 py-0.5 text-xs font-medium
                                    @if($transaction->payment_status === 'pending') bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-300
                                    @elseif($transaction->payment_status === 'paid') bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300
                                    @else bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-300 @endif">
                                    {{ ucfirst($transaction->payment_status) }}
                                </dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Delivery Method</dt>
                                <dd class="text-sm font-semibold text-gray-900 dark:text-white">{{ ucfirst($transaction->delivery_method) }}</dd>
                            </div>
                        </dl>
                    </div>
                </div>
            </div>

            <div class="mb-6 rounded-lg border border-gray-200 bg-white dark:border-gray-700 dark:bg-gray-800">
                <div class="p-6">
                    <h3 class="mb-4 text-lg font-medium text-gray-900 dark:text-white">Order Items</h3>
                    <div class="flow-root">
                        <ul role="list" class="divide-y divide-gray-200 dark:divide-gray-700">
                            @foreach($transaction->items as $item)
                            <li class="py-4">
                                <div class="flex items-center space-x-4">
                                    <div class="h-24 w-24 flex-shrink-0 overflow-hidden rounded-md border border-gray-200 dark:border-gray-700">
                                        @if($item->product->image_url)
                                            <img src="{{ asset('storage/' . $item->product->image_url) }}" 
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
                                    <div class="flex flex-1 flex-col">
                                        <div>
                                            <div class="flex justify-between text-base font-medium text-gray-900 dark:text-white">
                                                <h4>{{ $item->product->name }}</h4>
                                                <p class="ml-4">${{ number_format($item->price * $item->quantity, 2) }}</p>
                                            </div>
                                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Quantity: {{ $item->quantity }}</p>
                                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Price per item: ${{ number_format($item->price, 2) }}</p>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="border-t border-gray-200 bg-gray-50 px-6 py-4 dark:border-gray-700 dark:bg-gray-800">
                    <div class="flex justify-between text-base font-medium text-gray-900 dark:text-white">
                        <p>Total</p>
                        <p>${{ number_format($transaction->total_amount, 2) }}</p>
                    </div>
                </div>
            </div>

            @if($transaction->status === 'pending')
            <div class="flex justify-end">
                <form action="{{ route('my-orders.cancel', $transaction) }}" method="POST">
                    @csrf
                    <button type="submit" class="rounded-lg border border-red-700 px-5 py-2.5 text-center text-sm font-medium text-red-700 hover:bg-red-700 hover:text-white focus:outline-none focus:ring-4 focus:ring-red-300 dark:border-red-500 dark:text-red-500 dark:hover:bg-red-600 dark:hover:text-white dark:focus:ring-red-900">Cancel Order</button>
                </form>
            </div>
            @elseif($transaction->status === 'shipped')
            <div class="flex justify-end">
                <form action="{{ route('my-orders.complete', $transaction) }}" method="POST">
                    @csrf
                    <button type="submit" class="rounded-lg bg-green-600 px-5 py-2.5 text-center text-sm font-medium text-white hover:bg-green-700 focus:outline-none focus:ring-4 focus:ring-green-300 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Complete Order</button>
                </form>
            </div>
            @else
            <div class="flex justify-end">
                <form action="{{ route('my-orders.reorder', $transaction) }}" method="POST">
                    @csrf
                    <button type="submit" class="rounded-lg bg-primary px-5 py-2.5 text-center text-sm font-medium text-white hover:bg-primary-800 focus:outline-none focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Order again</button>
                </form>
            </div>
            @endif
        </div>
    </div>
</section>
@endsection 