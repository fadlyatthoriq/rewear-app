@extends('layouts.master')
@section('title', 'Order Items')
@section('main')
<section class="min-h-screen bg-gray-50 py-8 antialiased dark:bg-gray-900 md:py-16">
    <div class="mx-auto max-w-screen-xl px-4 2xl:px-0">
        <div class="mx-auto max-w-5xl">
            <div class="mb-8 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <h2 class="text-2xl font-bold text-gray-900 dark:text-white sm:text-3xl">Order Items</h2>
                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Kelola status & resi produk yang kamu jual</p>
                </div>
            </div>
            <div class="mt-6 overflow-hidden rounded-lg border border-gray-200 bg-white shadow-sm dark:border-gray-700 dark:bg-gray-800">
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm text-gray-500 dark:text-gray-400">
                        <thead class="bg-gray-50 text-xs uppercase text-gray-700 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th class="px-6 py-4">Order ID</th>
                                <th class="px-6 py-4">Product</th>
                                <th class="px-6 py-4">Buyer</th>
                                <th class="px-6 py-4">Status</th>
                                <th class="px-6 py-4">Tracking</th>
                                <th class="px-6 py-4">Action</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                            @forelse($orderItems as $item)
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                                <td class="px-6 py-4 font-medium text-gray-900 dark:text-white">#{{ $item->transaction->id }}</td>
                                <td class="px-6 py-4">{{ $item->product->name }}</td>
                                <td class="px-6 py-4">{{ $item->transaction->user->name }}</td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center gap-1.5 rounded-full px-3 py-1 text-xs font-medium
                                        @if($item->shipping_status === 'pending') bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-300
                                        @elseif($item->shipping_status === 'processing') bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-300
                                        @elseif($item->shipping_status === 'delivered') bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300
                                        @elseif($item->shipping_status === 'shipped') bg-purple-100 text-purple-800 dark:bg-purple-900 dark:text-purple-300
                                        @else bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-300 @endif">
                                        {{ ucfirst($item->shipping_status) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    @if($item->tracking_number)
                                        <span class="inline-flex items-center gap-1.5 rounded-full px-2.5 py-0.5 text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-300">
                                            <svg class="h-3.5 w-3.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2-10V4a1 1 0 0 0-1-1H4a1 1 0 0 0-1 1v16a1 1 0 0 0 1 1h16a1 1 0 0 0 1-1V10a1 1 0 0 0-1-1h-3.393a1 1 0 0 1-.894-.553L14 5h-3c-.53 0-1.04-.2-1.414-.586l-.78-.78a1 1 0 0 0-1.414 0l-.78.78A1 1 0 0 1 7.393 9H4a1 1 0 0 0-1 1v2h18v-2h-3Z"/>
                                            </svg>
                                            {{ $item->tracking_number }}
                                        </span>
                                    @else
                                        <span class="text-gray-400 dark:text-gray-500">-</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    <a href="{{ route('seller.order-items.edit', $item->id) }}"
                                       class="inline-flex items-center rounded-lg bg-[#2596be] px-3 py-1.5 text-xs font-medium text-white hover:bg-[#217ca6] transition-colors duration-300">
                                        <i class="fas fa-edit mr-1"></i> Update
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="px-6 py-8 text-center">
                                    <div class="mx-auto flex max-w-sm flex-col items-center">
                                        <svg class="mb-3 h-10 w-10 text-gray-400 dark:text-gray-600" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2-10V4a1 1 0 0 0-1-1H4a1 1 0 0 0-1 1v16a1 1 0 0 0 1 1h16a1 1 0 0 0 1-1V10a1 1 0 0 0-1-1h-3.393a1 1 0 0 1-.894-.553L14 5h-3c-.53 0-1.04-.2-1.414-.586l-.78-.78a1 1 0 0 0-1.414 0l-.78.78A1 1 0 0 1 7.393 9H4a1 1 0 0 0-1 1v2h18v-2h-3Z"/>
                                        </svg>
                                        <h3 class="mb-1 text-lg font-semibold text-gray-900 dark:text-white">No order items found</h3>
                                        <p class="text-sm text-gray-500 dark:text-gray-400">Belum ada pesanan produk kamu</p>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            <nav class="mt-6 flex items-center justify-center sm:mt-8" aria-label="Page navigation">
                {{ $orderItems->links() }}
            </nav>
        </div>
    </div>
</section>
@endsection 