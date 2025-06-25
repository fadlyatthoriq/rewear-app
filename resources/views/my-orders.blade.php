@extends('layouts.master')

@section('title', 'My Orders')

@section('main')
<section class="min-h-screen bg-gray-50 py-8 antialiased dark:bg-gray-900 md:py-16">
    <div class="mx-auto max-w-screen-xl px-4 2xl:px-0">
        <div class="mx-auto max-w-5xl">
            <!-- Header Section -->
            <div class="mb-8 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <h2 class="text-2xl font-bold text-gray-900 dark:text-white sm:text-3xl">My Orders</h2>
                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Track and manage your orders</p>
                </div>
            </div>

            <!-- Orders Table Section -->
            <div class="mt-6 overflow-hidden rounded-lg border border-gray-200 bg-white shadow-sm dark:border-gray-700 dark:bg-gray-800">
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm text-gray-500 dark:text-gray-400">
                        <thead class="bg-gray-50 text-xs uppercase text-gray-700 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="whitespace-nowrap px-6 py-4">
                                    <a href="{{ request()->fullUrlWithQuery(['sort' => 'created_at', 'direction' => $sortField === 'created_at' && $sortDirection === 'asc' ? 'desc' : 'asc']) }}" 
                                       class="group inline-flex items-center gap-1 font-semibold hover:text-primary-600 dark:hover:text-primary-500">
                                        {{ $allowedSortFields['created_at'] }}
                                        @if($sortField === 'created_at')
                                            <svg class="h-3 w-3 transition-transform {{ $sortDirection === 'asc' ? 'rotate-180' : '' }}" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M8.574 11.024h6.852a2.075 2.075 0 0 0 1.847-1.086 1.9 1.9 0 0 0-.11-1.986L13.736 2.9a2.122 2.122 0 0 0-3.472 0L6.837 7.952a1.9 1.9 0 0 0-.11 1.986 2.074 2.074 0 0 0 1.847 1.086Zm6.852 1.952H8.574a2.072 2.072 0 0 0-1.847 1.087 1.9 1.9 0 0 0 .11 1.985l3.426 5.05a2.123 2.123 0 0 0 3.472 0l3.427-5.05a1.9 1.9 0 0 0 .11-1.985 2.074 2.074 0 0 0-1.846-1.087Z"/>
                                            </svg>
                                        @endif
                                    </a>
                                </th>
                                <th scope="col" class="whitespace-nowrap px-6 py-4">Order ID</th>
                                <th scope="col" class="whitespace-nowrap px-6 py-4">
                                    <a href="{{ request()->fullUrlWithQuery(['sort' => 'total_amount', 'direction' => $sortField === 'total_amount' && $sortDirection === 'asc' ? 'desc' : 'asc']) }}" 
                                       class="group inline-flex items-center gap-1 font-semibold hover:text-primary-600 dark:hover:text-primary-500">
                                        {{ $allowedSortFields['total_amount'] }}
                                        @if($sortField === 'total_amount')
                                            <svg class="h-3 w-3 transition-transform {{ $sortDirection === 'asc' ? 'rotate-180' : '' }}" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M8.574 11.024h6.852a2.075 2.075 0 0 0 1.847-1.086 1.9 1.9 0 0 0-.11-1.986L13.736 2.9a2.122 2.122 0 0 0-3.472 0L6.837 7.952a1.9 1.9 0 0 0-.11 1.986 2.074 2.074 0 0 0 1.847 1.086Zm6.852 1.952H8.574a2.072 2.072 0 0 0-1.847 1.087 1.9 1.9 0 0 0 .11 1.985l3.426 5.05a2.123 2.123 0 0 0 3.472 0l3.427-5.05a1.9 1.9 0 0 0 .11-1.985 2.074 2.074 0 0 0-1.846-1.087Z"/>
                                            </svg>
                                        @endif
                                    </a>
                                </th>
                                <th scope="col" class="whitespace-nowrap px-6 py-4">
                                    <a href="{{ request()->fullUrlWithQuery(['sort' => 'status', 'direction' => $sortField === 'status' && $sortDirection === 'asc' ? 'desc' : 'asc']) }}" 
                                       class="group inline-flex items-center gap-1 font-semibold hover:text-primary-600 dark:hover:text-primary-500">
                                        {{ $allowedSortFields['status'] }}
                                        @if($sortField === 'status')
                                            <svg class="h-3 w-3 transition-transform {{ $sortDirection === 'asc' ? 'rotate-180' : '' }}" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M8.574 11.024h6.852a2.075 2.075 0 0 0 1.847-1.086 1.9 1.9 0 0 0-.11-1.986L13.736 2.9a2.122 2.122 0 0 0-3.472 0L6.837 7.952a1.9 1.9 0 0 0-.11 1.986 2.074 2.074 0 0 0 1.847 1.086Zm6.852 1.952H8.574a2.072 2.072 0 0 0-1.847 1.087 1.9 1.9 0 0 0 .11 1.985l3.426 5.05a2.123 2.123 0 0 0 3.472 0l3.427-5.05a1.9 1.9 0 0 0 .11-1.985 2.074 2.074 0 0 0-1.846-1.087Z"/>
                                            </svg>
                                        @endif
                                    </a>
                                </th>
                                <th scope="col" class="whitespace-nowrap px-6 py-4">Tracking</th>
                                <th scope="col" class="whitespace-nowrap px-6 py-4">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                            @forelse($transactions as $transaction)
                                @php $status = $transaction->aggregated_status; @endphp
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                                    <td class="whitespace-nowrap px-6 py-4">{{ $transaction->created_at->format('d.m.Y H:i') }}</td>
                                    <td class="whitespace-nowrap px-6 py-4">
                                        <a href="{{ route('my-orders.show', $transaction) }}" 
                                           class="font-medium text-primary-600 hover:underline dark:text-primary-500">
                                            #{{ $transaction->id }}
                                        </a>
                                    </td>
                                    <td class="whitespace-nowrap px-6 py-4 font-medium">Rp. {{ number_format($transaction->total_amount, 2) }}</td>
                                    <td class="whitespace-nowrap px-6 py-4">
                                        <span class="inline-flex items-center gap-1.5 rounded-full px-3 py-1 text-xs font-medium
                                            @if($status === 'pending') bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-300
                                            @elseif($status === 'processing') bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-300
                                            @elseif($status === 'delivered') bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300
                                            @elseif($status === 'shipped') bg-purple-100 text-purple-800 dark:bg-purple-900 dark:text-purple-300
                                            @elseif($status === 'partial_delivered') bg-pink-100 text-pink-800 dark:bg-pink-900 dark:text-pink-300
                                            @else bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-300 @endif">
                                            @if($status === 'pending')
                                                <svg class="h-3.5 w-3.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.5 4h-13m13 16h-13M8 20v-3.333a2 2 0 0 1 .4-1.2L10 12.6a1 1 0 0 0 0-1.2L8.4 8.533a2 2 0 0 1-.4-1.2V4h8v3.333a2 2 0 0 1-.4 1.2L13.957 11.4a1 1 0 0 0 0 1.2l1.643 2.867a2 2 0 0 1 .4 1.2V20H8Z" />
                                                </svg>
                                            @elseif($status === 'processing')
                                                <svg class="h-3.5 w-3.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h6l2 4m-8-4v8m0-8V6a1 1 0 0 0-1-1H4a1 1 0 0 0-1 1v9h2m8 0H9m4 0h2m4 0h2v-4m0 0h-5m3.5 5.5a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0Zm-10 0a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0Z" />
                                                </svg>
                                            @elseif($status === 'delivered')
                                                <svg class="h-3.5 w-3.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 11.917 9.724 16.5 19 7.5" />
                                                </svg>
                                            @elseif($status === 'shipped')
                                                <svg class="h-3.5 w-3.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2-10V4a1 1 0 0 0-1-1H4a1 1 0 0 0-1 1v16a1 1 0 0 0 1 1h16a1 1 0 0 0 1-1V10a1 1 0 0 0-1-1h-3.393a1 1 0 0 1-.894-.553L14 5h-3c-.53 0-1.04-.2-1.414-.586l-.78-.78a1 1 0 0 0-1.414 0l-.78.78A1 1 0 0 1 7.393 9H4a1 1 0 0 0-1 1v2h18v-2h-3Z"/>
                                                </svg>
                                            @elseif($status === 'partial_delivered')
                                                <svg class="h-3.5 w-3.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h6l2 4m-8-4v8m0-8V6a1 1 0 0 0-1-1H4a1 1 0 0 0-1 1v16a1 1 0 0 0 1 1h16a1 1 0 0 0 1-1V10a1 1 0 0 0-1-1h-3.393a1 1 0 0 1-.894-.553L14 5h-3c-.53 0-1.04-.2-1.414-.586l-.78-.78a1 1 0 0 0-1.414 0l-.78.78A1 1 0 0 1 7.393 9H4a1 1 0 0 0-1 1v2h18v-2h-3Z"/>
                                                </svg>
                                            @else
                                                <svg class="h-3.5 w-3.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18 17.94 6M18 18 6.06 6" />
                                                </svg>
                                            @endif
                                            {{ ucfirst($status) }}
                                        </span>
                                    </td>
                                    <td class="whitespace-nowrap px-6 py-4">
                                        @if($transaction->tracking_number)
                                            <span class="inline-flex items-center gap-1.5 rounded-full px-2.5 py-0.5 text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-300">
                                                <svg class="h-3.5 w-3.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2-10V4a1 1 0 0 0-1-1H4a1 1 0 0 0-1 1v16a1 1 0 0 0 1 1h16a1 1 0 0 0 1-1V10a1 1 0 0 0-1-1h-3.393a1 1 0 0 1-.894-.553L14 5h-3c-.53 0-1.04-.2-1.414-.586l-.78-.78a1 1 0 0 0-1.414 0l-.78.78A1 1 0 0 1 7.393 9H4a1 1 0 0 0-1 1v2h18v-2h-3Z"/>
                                                </svg>
                                                {{ $transaction->tracking_number }}
                                            </span>
                                        @else
                                            <span class="text-gray-400 dark:text-gray-500">-</span>
                                        @endif
                                    </td>
                                    <td class="whitespace-nowrap px-6 py-4">
                                        <div class="flex flex-wrap items-center gap-2">
                                            @if($status === 'pending')
                                                <form action="{{ route('my-orders.cancel', $transaction) }}" method="POST" class="inline">
                                                    @csrf
                                                    <button type="submit" 
                                                            class="inline-flex items-center rounded-lg border border-red-700 px-3 py-2 text-center text-sm font-medium text-red-700 transition-colors hover:bg-red-700 hover:text-white focus:outline-none focus:ring-4 focus:ring-red-300 dark:border-red-500 dark:text-red-500 dark:hover:bg-red-600 dark:hover:text-white dark:focus:ring-red-900">
                                                        <svg class="mr-1.5 h-4 w-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18 17.94 6M18 18 6.06 6"/>
                                                        </svg>
                                                        Cancel
                                                    </button>
                                                </form>
                                            @elseif($status === 'shipped')
                                                <form action="{{ route('my-orders.complete', $transaction) }}" method="POST" class="inline">
                                                    @csrf
                                                    <button type="submit" 
                                                            class="inline-flex items-center rounded-lg !bg-green-600 px-3 py-2 text-sm font-medium text-white transition-colors hover:!bg-green-700 focus:outline-none focus:ring-4 focus:!ring-green-300 dark:!bg-green-600 dark:hover:!bg-green-700 dark:focus:!ring-green-800">
                                                        <svg class="mr-1.5 h-4 w-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 11.917 9.724 16.5 19 7.5"/>
                                                        </svg>
                                                        Complete
                                                    </button>
                                                </form>
                                            @else
                                                <form action="{{ route('my-orders.reorder', $transaction) }}" method="POST" class="inline">
                                                    @csrf
                                                    <button type="submit" 
                                                            class="inline-flex items-center rounded-lg !bg-primary-600 px-3 py-2 text-sm font-medium text-white transition-colors hover:!bg-primary-700 focus:outline-none focus:ring-4 focus:!ring-primary-300 dark:!bg-primary-600 dark:hover:!bg-primary-700 dark:focus:!ring-primary-800">
                                                        <svg class="mr-1.5 h-4 w-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0 3.181 3.183a8.25 8.25 0 0 0 13.803-3.7M4.031 9.865a8.25 8.25 0 0 1 13.803-3.7l3.181 3.182m0-4.991v4.99"/>
                                                        </svg>
                                                        Order Again
                                                    </button>
                                                </form>
                                            @endif
                                            <a href="{{ route('my-orders.show', $transaction) }}" 
                                               class="inline-flex items-center rounded-lg border border-gray-200 bg-white px-3 py-2 text-sm font-medium text-gray-900 transition-colors hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:outline-none focus:ring-4 focus:ring-gray-100 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white dark:focus:ring-gray-700">
                                                <svg class="mr-1.5 h-4 w-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z"/>
                                                </svg>
                                                View
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-8 text-center">
                                        <div class="mx-auto flex max-w-sm flex-col items-center">
                                            <svg class="mb-3 h-10 w-10 text-gray-400 dark:text-gray-600" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2-10V4a1 1 0 0 0-1-1H4a1 1 0 0 0-1 1v16a1 1 0 0 0 1 1h16a1 1 0 0 0 1-1V10a1 1 0 0 0-1-1h-3.393a1 1 0 0 1-.894-.553L14 5h-3c-.53 0-1.04-.2-1.414-.586l-.78-.78a1 1 0 0 0-1.414 0l-.78.78A1 1 0 0 1 7.393 9H4a1 1 0 0 0-1 1v2h18v-2h-3Z"/>
                                            </svg>
                                            <h3 class="mb-1 text-lg font-semibold text-gray-900 dark:text-white">No orders found</h3>
                                            <p class="text-sm text-gray-500 dark:text-gray-400">Start shopping to see your orders here</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Pagination -->
            <nav class="mt-6 flex items-center justify-center sm:mt-8" aria-label="Page navigation">
                {{ $transactions->links() }}
            </nav>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const statusSelect = document.getElementById('order-type');
        const durationSelect = document.getElementById('duration');

        function submitForm() {
            this.form.submit();
        }

        if (statusSelect) statusSelect.addEventListener('change', submitForm);
        if (durationSelect) durationSelect.addEventListener('change', submitForm);
    });
</script>
@endpush
