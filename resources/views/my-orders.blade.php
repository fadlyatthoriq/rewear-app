@extends('layouts.master')

@section('title', 'My Orders')

@section('main')
<section class="bg-white py-8 antialiased dark:bg-gray-900 md:py-16">
    <div class="mx-auto max-w-screen-xl px-4 2xl:px-0">
        <div class="mx-auto max-w-5xl">
            <div class="gap-4 sm:flex sm:items-center sm:justify-between">
                <h2 class="text-xl font-semibold text-gray-900 dark:text-white sm:text-2xl">My orders</h2>
            </div>

            <div class="mt-6 flow-root sm:mt-8">
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm text-gray-500 dark:text-gray-400">
                        <thead class="bg-gray-50 text-xs uppercase text-gray-700 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-4 py-3">
                                    <a href="{{ request()->fullUrlWithQuery(['sort' => 'created_at', 'direction' => $sortField === 'created_at' && $sortDirection === 'asc' ? 'desc' : 'asc']) }}" class="group inline-flex items-center">
                                        {{ $allowedSortFields['created_at'] }}
                                        @if($sortField === 'created_at')
                                            <svg class="ml-1 h-3 w-3 {{ $sortDirection === 'asc' ? 'rotate-180' : '' }}" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M8.574 11.024h6.852a2.075 2.075 0 0 0 1.847-1.086 1.9 1.9 0 0 0-.11-1.986L13.736 2.9a2.122 2.122 0 0 0-3.472 0L6.837 7.952a1.9 1.9 0 0 0-.11 1.986 2.074 2.074 0 0 0 1.847 1.086Zm6.852 1.952H8.574a2.072 2.072 0 0 0-1.847 1.087 1.9 1.9 0 0 0 .11 1.985l3.426 5.05a2.123 2.123 0 0 0 3.472 0l3.427-5.05a1.9 1.9 0 0 0 .11-1.985 2.074 2.074 0 0 0-1.846-1.087Z"/>
                                            </svg>
                                        @endif
                                    </a>
                                </th>
                                <th scope="col" class="px-4 py-3">Order ID</th>
                                <th scope="col" class="px-4 py-3">
                                    <a href="{{ request()->fullUrlWithQuery(['sort' => 'total_amount', 'direction' => $sortField === 'total_amount' && $sortDirection === 'asc' ? 'desc' : 'asc']) }}" class="group inline-flex items-center">
                                        {{ $allowedSortFields['total_amount'] }}
                                        @if($sortField === 'total_amount')
                                            <svg class="ml-1 h-3 w-3 {{ $sortDirection === 'asc' ? 'rotate-180' : '' }}" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M8.574 11.024h6.852a2.075 2.075 0 0 0 1.847-1.086 1.9 1.9 0 0 0-.11-1.986L13.736 2.9a2.122 2.122 0 0 0-3.472 0L6.837 7.952a1.9 1.9 0 0 0-.11 1.986 2.074 2.074 0 0 0 1.847 1.086Zm6.852 1.952H8.574a2.072 2.072 0 0 0-1.847 1.087 1.9 1.9 0 0 0 .11 1.985l3.426 5.05a2.123 2.123 0 0 0 3.472 0l3.427-5.05a1.9 1.9 0 0 0 .11-1.985 2.074 2.074 0 0 0-1.846-1.087Z"/>
                                            </svg>
                                        @endif
                                    </a>
                                </th>
                                <th scope="col" class="px-4 py-3">
                                    <a href="{{ request()->fullUrlWithQuery(['sort' => 'status', 'direction' => $sortField === 'status' && $sortDirection === 'asc' ? 'desc' : 'asc']) }}" class="group inline-flex items-center">
                                        {{ $allowedSortFields['status'] }}
                                        @if($sortField === 'status')
                                            <svg class="ml-1 h-3 w-3 {{ $sortDirection === 'asc' ? 'rotate-180' : '' }}" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M8.574 11.024h6.852a2.075 2.075 0 0 0 1.847-1.086 1.9 1.9 0 0 0-.11-1.986L13.736 2.9a2.122 2.122 0 0 0-3.472 0L6.837 7.952a1.9 1.9 0 0 0-.11 1.986 2.074 2.074 0 0 0 1.847 1.086Zm6.852 1.952H8.574a2.072 2.072 0 0 0-1.847 1.087 1.9 1.9 0 0 0 .11 1.985l3.426 5.05a2.123 2.123 0 0 0 3.472 0l3.427-5.05a1.9 1.9 0 0 0 .11-1.985 2.074 2.074 0 0 0-1.846-1.087Z"/>
                                            </svg>
                                        @endif
                                    </a>
                                </th>
                                <th scope="col" class="px-4 py-3">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($transactions as $transaction)
                                <tr class="border-b border-gray-200 dark:border-gray-700">
                                    <td class="px-4 py-3">{{ $transaction->created_at->format('d.m.Y H:i') }}</td>
                                    <td class="px-4 py-3">
                                        <a href="{{ route('my-orders.show', $transaction) }}" class="font-medium text-primary-600 hover:underline dark:text-primary-500">
                                            #{{ $transaction->id }}
                                        </a>
                                    </td>
                                    <td class="px-4 py-3">Rp. {{ number_format($transaction->total_amount, 2) }}</td>
                                    <td class="px-4 py-3">
                                        <span class="inline-flex items-center rounded px-2.5 py-0.5 text-xs font-medium
                                            @if($transaction->status === 'pending') bg-primary-100 text-primary-800 dark:bg-primary-900 dark:text-primary-300
                                            @elseif($transaction->status === 'processing') bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-300
                                            @elseif($transaction->status === 'completed') bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300
                                            @elseif($transaction->status === 'shipped') bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-300
                                            @else bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-300 @endif">
                                            @if($transaction->status === 'pending')
                                                <svg class="me-1 h-3 w-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.5 4h-13m13 16h-13M8 20v-3.333a2 2 0 0 1 .4-1.2L10 12.6a1 1 0 0 0 0-1.2L8.4 8.533a2 2 0 0 1-.4-1.2V4h8v3.333a2 2 0 0 1-.4 1.2L13.957 11.4a1 1 0 0 0 0 1.2l1.643 2.867a2 2 0 0 1 .4 1.2V20H8Z" />
                                                </svg>
                                            @elseif($transaction->status === 'processing')
                                                <svg class="me-1 h-3 w-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h6l2 4m-8-4v8m0-8V6a1 1 0 0 0-1-1H4a1 1 0 0 0-1 1v9h2m8 0H9m4 0h2m4 0h2v-4m0 0h-5m3.5 5.5a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0Zm-10 0a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0Z" />
                                                </svg>
                                            @elseif($transaction->status === 'completed')
                                                <svg class="me-1 h-3 w-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 11.917 9.724 16.5 19 7.5" />
                                                </svg>
                                            @elseif($transaction->status === 'shipped')
                                                 <svg class="me-1 h-3 w-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2-10V4a1 1 0 0 0-1-1H4a1 1 0 0 0-1 1v16a1 1 0 0 0 1 1h16a1 1 0 0 0 1-1V10a1 1 0 0 0-1-1h-3.393a1 1 0 0 1-.894-.553L14 5h-3c-.53 0-1.04-.2-1.414-.586l-.78-.78a1 1 0 0 0-1.414 0l-.78.78A1 1 0 0 1 7.393 9H4a1 1 0 0 0-1 1v2h18v-2h-3Z"/>
                                                </svg>
                                            @else
                                                <svg class="me-1 h-3 w-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18 17.94 6M18 18 6.06 6" />
                                                </svg>
                                            @endif
                                            {{ ucfirst($transaction->status) }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-3">
                                        <div class="flex items-center space-x-3">
                                            @if($transaction->status === 'pending')
                                                <form action="{{ route('my-orders.cancel', $transaction) }}" method="POST" class="inline">
                                                    @csrf
                                                    <button type="submit" class="rounded-lg border border-red-700 px-3 py-2 text-center text-sm font-medium text-red-700 hover:bg-red-700 hover:text-white focus:outline-none focus:ring-4 focus:ring-red-300 dark:border-red-500 dark:text-red-500 dark:hover:bg-red-600 dark:hover:text-white dark:focus:ring-red-900">Cancel</button>
                                                </form>
                                            @elseif($transaction->status === 'shipped')
                                                <form action="{{ route('my-orders.complete', $transaction) }}" method="POST" class="inline">
                                                    @csrf
                                                    <button type="submit" class="rounded-lg bg-success px-3 py-2 text-sm font-medium text-white hover:bg-green-700 focus:outline-none focus:ring-4 focus:ring-green-300 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Complete Order</button>
                                                </form>
                                            @else
                                                <form action="{{ route('my-orders.reorder', $transaction) }}" method="POST" class="inline">
                                                    @csrf
                                                    <button type="submit" class="rounded-lg bg-primary px-3 py-2 text-sm font-medium text-white hover:bg-primary-800 focus:outline-none focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Order again</button>
                                                </form>
                                            @endif
                                            <a href="{{ route('my-orders.show', $transaction) }}" class="rounded-lg border border-gray-200 bg-white px-3 py-2 text-sm font-medium text-gray-900 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:outline-none focus:ring-4 focus:ring-gray-100 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white dark:focus:ring-gray-700">View</a>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-4 py-3 text-center text-gray-500 dark:text-gray-400">No orders found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <nav class="mt-6 flex items-center justify-center sm:mt-8" aria-label="Page navigation example">
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

        statusSelect.addEventListener('change', submitForm);
        durationSelect.addEventListener('change', submitForm);
    });
</script>
@endpush
