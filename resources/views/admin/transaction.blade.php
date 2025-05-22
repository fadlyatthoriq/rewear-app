@extends('layouts.admin-master')

@section('content')
<div class="p-4 bg-white block sm:flex items-center justify-between border-b border-gray-200 lg:mt-1.5 dark:bg-gray-800 dark:border-gray-700">
    <div class="w-full mb-1">
        <div class="mb-4">
            <nav class="flex mb-5" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 text-sm font-medium md:space-x-2">
                    <li class="inline-flex items-center">
                        <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center text-gray-700 hover:text-primary-600 dark:text-gray-300 dark:hover:text-white">
                            <svg class="w-5 h-5 mr-2.5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path></svg>
                            Dashboard
                        </a>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                            <span class="ml-1 text-gray-400 md:ml-2 dark:text-gray-500" aria-current="page">Transactions</span>
                        </div>
                    </li>
                </ol>
            </nav>
            <h1 class="text-xl font-semibold text-gray-900 sm:text-2xl dark:text-white">All transactions</h1>
        </div>
        <div class="items-center justify-between block sm:flex">
            <div class="flex items-center mb-4 sm:mb-0">
                <form class="sm:pr-3" action="{{ route('admin.transactions.index') }}" method="GET">
                    <label for="transactions-search" class="sr-only">Search</label>
                    <div class="relative w-48 mt-1 sm:w-64 xl:w-96">
                        <input type="text" name="search" id="transactions-search" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 pr-12 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Search for transactions" value="{{ request('search') }}">
                        <button type="submit" class="absolute right-1 top-1.5 p-1.5 text-sm font-medium text-gray-500 bg-gray-100 rounded-lg border border-gray-200 hover:bg-gray-200 hover:text-gray-700 focus:ring-2 focus:outline-none focus:ring-gray-200 dark:bg-gray-600 dark:text-gray-400 dark:border-gray-500 dark:hover:bg-gray-500 dark:hover:text-white dark:focus:ring-gray-500">
                            <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                            </svg>
                            <span class="sr-only">Search</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Status Notes -->
<div class="p-4 mb-4 bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700">
    <h3 class="mb-3 text-lg font-semibold text-gray-900 dark:text-white">Status Guide</h3>
    <div class="grid grid-cols-1 gap-4 md:grid-cols-3">
        <!-- Main Status -->
        <div class="p-3 bg-gray-50 rounded-lg dark:bg-gray-700">
            <h4 class="mb-2 font-medium text-gray-900 dark:text-white">Transaction Status</h4>
            <ul class="space-y-2 text-sm text-gray-600 dark:text-gray-300">
                <li><span class="inline-block w-3 h-3 mr-2 bg-gray-400 rounded-full"></span>Pending: New transaction waiting for confirmation</li>
                <li><span class="inline-block w-3 h-3 mr-2 bg-yellow-400 rounded-full"></span>Processing: Transaction is being processed</li>
                <li><span class="inline-block w-3 h-3 mr-2 bg-blue-400 rounded-full"></span>Shipped: Items have been shipped</li>
                <li><span class="inline-block w-3 h-3 mr-2 bg-green-400 rounded-full"></span>Completed: Transaction fully completed</li>
                <li><span class="inline-block w-3 h-3 mr-2 bg-red-400 rounded-full"></span>Failed: Transaction failed</li>
                <li><span class="inline-block w-3 h-3 mr-2 bg-red-400 rounded-full"></span>Cancelled: Transaction cancelled</li>
            </ul>
        </div>
        
        <!-- Payment Status -->
        <div class="p-3 bg-gray-50 rounded-lg dark:bg-gray-700">
            <h4 class="mb-2 font-medium text-gray-900 dark:text-white">Payment Status</h4>
            <ul class="space-y-2 text-sm text-gray-600 dark:text-gray-300">
                <li><span class="inline-block w-3 h-3 mr-2 bg-gray-400 rounded-full"></span>Pending: Waiting for payment</li>
                <li><span class="inline-block w-3 h-3 mr-2 bg-yellow-400 rounded-full"></span>Processing: Payment being validated</li>
                <li><span class="inline-block w-3 h-3 mr-2 bg-green-400 rounded-full"></span>Paid: Payment confirmed</li>
                <li><span class="inline-block w-3 h-3 mr-2 bg-red-400 rounded-full"></span>Failed: Payment failed</li>
                <li><span class="inline-block w-3 h-3 mr-2 bg-red-400 rounded-full"></span>Cancelled: Payment cancelled</li>
            </ul>
        </div>
        
        <!-- Shipping Status -->
        <div class="p-3 bg-gray-50 rounded-lg dark:bg-gray-700">
            <h4 class="mb-2 font-medium text-gray-900 dark:text-white">Shipping Status</h4>
            <ul class="space-y-2 text-sm text-gray-600 dark:text-gray-300">
                <li><span class="inline-block w-3 h-3 mr-2 bg-gray-400 rounded-full"></span>Pending: Waiting for shipping</li>
                <li><span class="inline-block w-3 h-3 mr-2 bg-yellow-400 rounded-full"></span>Processing: Items being prepared</li>
                <li><span class="inline-block w-3 h-3 mr-2 bg-blue-400 rounded-full"></span>Shipped: Items have been shipped</li>
                <li><span class="inline-block w-3 h-3 mr-2 bg-green-400 rounded-full"></span>Delivered: Items received by customer</li>
                <li><span class="inline-block w-3 h-3 mr-2 bg-red-400 rounded-full"></span>Failed: Shipping failed</li>
            </ul>
        </div>
    </div>
</div>

@if(session('success'))
<div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">
    {{ session('success') }}
</div>
@endif

<div class="flex flex-col">
    <div class="overflow-x-auto">
        <div class="inline-block min-w-full align-middle">
            <div class="overflow-hidden shadow">
                <table class="min-w-full divide-y divide-gray-200 table-fixed dark:divide-gray-600">
                    <thead class="bg-gray-100 dark:bg-gray-700">
                        <tr>
                            <th scope="col" class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">
                                <a href="{{ request()->fullUrlWithQuery(['sort' => 'id', 'direction' => request('direction') === 'asc' ? 'desc' : 'asc']) }}" class="flex items-center">
                                    Transaction ID
                                    @if(request('sort') === 'id')
                                        <svg class="w-3 h-3 ml-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="{{ request('direction') === 'asc' ? 'M8.574 11.024h6.852a2.075 2.075 0 0 0 1.847-1.086 1.9 1.9 0 0 0-.11-1.986L13.736 2.9a2.122 2.122 0 0 0-3.472 0L6.837 7.952a1.9 1.9 0 0 0-.11 1.986 2.074 2.074 0 0 0 1.847 1.086Zm6.852 1.952H8.574a2.072 2.072 0 0 0-1.847 1.087 1.9 1.9 0 0 0 .11 1.985l3.426 5.05a2.123 2.123 0 0 0 3.472 0l3.427-5.05a1.9 1.9 0 0 0 .11-1.985 2.074 2.074 0 0 0-1.846-1.087Z' : 'M8.574 11.024h6.852a2.075 2.075 0 0 0 1.847-1.086 1.9 1.9 0 0 0-.11-1.986L13.736 2.9a2.122 2.122 0 0 0-3.472 0L6.837 7.952a1.9 1.9 0 0 0-.11 1.986 2.074 2.074 0 0 0 1.847 1.086Zm6.852 1.952H8.574a2.072 2.072 0 0 0-1.847 1.087 1.9 1.9 0 0 0 .11 1.985l3.426 5.05a2.123 2.123 0 0 0 3.472 0l3.427-5.05a1.9 1.9 0 0 0 .11-1.985 2.074 2.074 0 0 0-1.846-1.087Z' }}"/>
                                        </svg>
                                    @endif
                                </a>
                            </th>
                            <th scope="col" class="hidden md:table-cell p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">
                                Customer
                            </th>
                            <th scope="col" class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">
                                <a href="{{ request()->fullUrlWithQuery(['sort' => 'total_amount', 'direction' => request('direction') === 'asc' ? 'desc' : 'asc']) }}" class="flex items-center">
                                    Total Amount
                                    @if(request('sort') === 'total_amount')
                                        <svg class="w-3 h-3 ml-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="{{ request('direction') === 'asc' ? 'M8.574 11.024h6.852a2.075 2.075 0 0 0 1.847-1.086 1.9 1.9 0 0 0-.11-1.986L13.736 2.9a2.122 2.122 0 0 0-3.472 0L6.837 7.952a1.9 1.9 0 0 0-.11 1.986 2.074 2.074 0 0 0 1.847 1.086Zm6.852 1.952H8.574a2.072 2.072 0 0 0-1.847 1.087 1.9 1.9 0 0 0 .11 1.985l3.426 5.05a2.123 2.123 0 0 0 3.472 0l3.427-5.05a1.9 1.9 0 0 0 .11-1.985 2.074 2.074 0 0 0-1.846-1.087Z' : 'M8.574 11.024h6.852a2.075 2.075 0 0 0 1.847-1.086 1.9 1.9 0 0 0-.11-1.986L13.736 2.9a2.122 2.122 0 0 0-3.472 0L6.837 7.952a1.9 1.9 0 0 0-.11 1.986 2.074 2.074 0 0 0 1.847 1.086Zm6.852 1.952H8.574a2.072 2.072 0 0 0-1.847 1.087 1.9 1.9 0 0 0 .11 1.985l3.426 5.05a2.123 2.123 0 0 0 3.472 0l3.427-5.05a1.9 1.9 0 0 0 .11-1.985 2.074 2.074 0 0 0-1.846-1.087Z' }}"/>
                                        </svg>
                                    @endif
                                </a>
                            </th>
                            <th scope="col" class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">
                                <a href="{{ request()->fullUrlWithQuery(['sort' => 'status', 'direction' => request('direction') === 'asc' ? 'desc' : 'asc']) }}" class="flex items-center">
                                    Status
                                    @if(request('sort') === 'status')
                                        <svg class="w-3 h-3 ml-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="{{ request('direction') === 'asc' ? 'M8.574 11.024h6.852a2.075 2.075 0 0 0 1.847-1.086 1.9 1.9 0 0 0-.11-1.986L13.736 2.9a2.122 2.122 0 0 0-3.472 0L6.837 7.952a1.9 1.9 0 0 0-.11 1.986 2.074 2.074 0 0 0 1.847 1.086Zm6.852 1.952H8.574a2.072 2.072 0 0 0-1.847 1.087 1.9 1.9 0 0 0 .11 1.985l3.426 5.05a2.123 2.123 0 0 0 3.472 0l3.427-5.05a1.9 1.9 0 0 0 .11-1.985 2.074 2.074 0 0 0-1.846-1.087Z' : 'M8.574 11.024h6.852a2.075 2.075 0 0 0 1.847-1.086 1.9 1.9 0 0 0-.11-1.986L13.736 2.9a2.122 2.122 0 0 0-3.472 0L6.837 7.952a1.9 1.9 0 0 0-.11 1.986 2.074 2.074 0 0 0 1.847 1.086Zm6.852 1.952H8.574a2.072 2.072 0 0 0-1.847 1.087 1.9 1.9 0 0 0 .11 1.985l3.426 5.05a2.123 2.123 0 0 0 3.472 0l3.427-5.05a1.9 1.9 0 0 0 .11-1.985 2.074 2.074 0 0 0-1.846-1.087Z' }}"/>
                                        </svg>
                                    @endif
                                </a>
                            </th>
                            <th scope="col" class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">
                                <a href="{{ request()->fullUrlWithQuery(['sort' => 'payment_status', 'direction' => request('direction') === 'asc' ? 'desc' : 'asc']) }}" class="flex items-center">
                                    Payment Status
                                    @if(request('sort') === 'payment_status')
                                        <svg class="w-3 h-3 ml-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="{{ request('direction') === 'asc' ? 'M8.574 11.024h6.852a2.075 2.075 0 0 0 1.847-1.086 1.9 1.9 0 0 0-.11-1.986L13.736 2.9a2.122 2.122 0 0 0-3.472 0L6.837 7.952a1.9 1.9 0 0 0-.11 1.986 2.074 2.074 0 0 0 1.847 1.086Zm6.852 1.952H8.574a2.072 2.072 0 0 0-1.847 1.087 1.9 1.9 0 0 0 .11 1.985l3.426 5.05a2.123 2.123 0 0 0 3.472 0l3.427-5.05a1.9 1.9 0 0 0 .11-1.985 2.074 2.074 0 0 0-1.846-1.087Z' : 'M8.574 11.024h6.852a2.075 2.075 0 0 0 1.847-1.086 1.9 1.9 0 0 0-.11-1.986L13.736 2.9a2.122 2.122 0 0 0-3.472 0L6.837 7.952a1.9 1.9 0 0 0-.11 1.986 2.074 2.074 0 0 0 1.847 1.086Zm6.852 1.952H8.574a2.072 2.072 0 0 0-1.847 1.087 1.9 1.9 0 0 0 .11 1.985l3.426 5.05a2.123 2.123 0 0 0 3.472 0l3.427-5.05a1.9 1.9 0 0 0 .11-1.985 2.074 2.074 0 0 0-1.846-1.087Z' }}"/>
                                        </svg>
                                    @endif
                                </a>
                            </th>
                            <th scope="col" class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">
                                <a href="{{ request()->fullUrlWithQuery(['sort' => 'shipping_status', 'direction' => request('direction') === 'asc' ? 'desc' : 'asc']) }}" class="flex items-center">
                                    Shipping Status
                                    @if(request('sort') === 'shipping_status')
                                        <svg class="w-3 h-3 ml-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="{{ request('direction') === 'asc' ? 'M8.574 11.024h6.852a2.075 2.075 0 0 0 1.847-1.086 1.9 1.9 0 0 0-.11-1.986L13.736 2.9a2.122 2.122 0 0 0-3.472 0L6.837 7.952a1.9 1.9 0 0 0-.11 1.986 2.074 2.074 0 0 0 1.847 1.086Zm6.852 1.952H8.574a2.072 2.072 0 0 0-1.847 1.087 1.9 1.9 0 0 0 .11 1.985l3.426 5.05a2.123 2.123 0 0 0 3.472 0l3.427-5.05a1.9 1.9 0 0 0 .11-1.985 2.074 2.074 0 0 0-1.846-1.087Z' : 'M8.574 11.024h6.852a2.075 2.075 0 0 0 1.847-1.086 1.9 1.9 0 0 0-.11-1.986L13.736 2.9a2.122 2.122 0 0 0-3.472 0L6.837 7.952a1.9 1.9 0 0 0-.11 1.986 2.074 2.074 0 0 0 1.847 1.086Zm6.852 1.952H8.574a2.072 2.072 0 0 0-1.847 1.087 1.9 1.9 0 0 0 .11 1.985l3.426 5.05a2.123 2.123 0 0 0 3.472 0l3.427-5.05a1.9 1.9 0 0 0 .11-1.985 2.074 2.074 0 0 0-1.846-1.087Z' }}"/>
                                        </svg>
                                    @endif
                                </a>
                            </th>
                            <th scope="col" class="hidden md:table-cell p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">
                                <a href="{{ request()->fullUrlWithQuery(['sort' => 'created_at', 'direction' => request('direction') === 'asc' ? 'desc' : 'asc']) }}" class="flex items-center">
                                    Date
                                    @if(request('sort') === 'created_at')
                                        <svg class="w-3 h-3 ml-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="{{ request('direction') === 'asc' ? 'M8.574 11.024h6.852a2.075 2.075 0 0 0 1.847-1.086 1.9 1.9 0 0 0-.11-1.986L13.736 2.9a2.122 2.122 0 0 0-3.472 0L6.837 7.952a1.9 1.9 0 0 0-.11 1.986 2.074 2.074 0 0 0 1.847 1.086Zm6.852 1.952H8.574a2.072 2.072 0 0 0-1.847 1.087 1.9 1.9 0 0 0 .11 1.985l3.426 5.05a2.123 2.123 0 0 0 3.472 0l3.427-5.05a1.9 1.9 0 0 0 .11-1.985 2.074 2.074 0 0 0-1.846-1.087Z' : 'M8.574 11.024h6.852a2.075 2.075 0 0 0 1.847-1.086 1.9 1.9 0 0 0-.11-1.986L13.736 2.9a2.122 2.122 0 0 0-3.472 0L6.837 7.952a1.9 1.9 0 0 0-.11 1.986 2.074 2.074 0 0 0 1.847 1.086Zm6.852 1.952H8.574a2.072 2.072 0 0 0-1.847 1.087 1.9 1.9 0 0 0 .11 1.985l3.426 5.05a2.123 2.123 0 0 0 3.472 0l3.427-5.05a1.9 1.9 0 0 0 .11-1.985 2.074 2.074 0 0 0-1.846-1.087Z' }}"/>
                                        </svg>
                                    @endif
                                </a>
                            </th>
                            <th scope="col" class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">
                        @forelse($transactions as $transaction)
                        <tr class="hover:bg-gray-100 dark:hover:bg-gray-700">
                            <td class="p-4 text-base font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                <div>#{{ $transaction->id }}</div>
                                <div class="md:hidden text-sm text-gray-500">
                                    {{ $transaction->user->name }} • {{ $transaction->created_at->format('M d, Y H:i') }}
                                </div>
                            </td>
                            <td class="hidden md:table-cell p-4 text-base font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $transaction->user->name }}
                            </td>
                            <td class="p-4 text-base font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                ${{ number_format($transaction->total_amount, 2) }}
                            </td>
                            <td class="p-4 text-base font-medium whitespace-nowrap">
                                <span class="px-2.5 py-0.5 rounded-full text-xs font-medium
                                    @if($transaction->status === 'paid' || $transaction->status === 'completed') bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300
                                    @elseif($transaction->status === 'processing') bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-300
                                    @elseif($transaction->status === 'shipped') bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-300
                                    @elseif($transaction->status === 'failed' || $transaction->status === 'cancelled') bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-300
                                    @else bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300
                                    @endif">
                                    {{ ucfirst($transaction->status) }}
                                </span>
                            </td>
                            <td class="p-4 text-base font-medium whitespace-nowrap">
                                <span class="px-2.5 py-0.5 rounded-full text-xs font-medium
                                    @if($transaction->payment_status === 'paid') bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300
                                    @elseif($transaction->payment_status === 'processing') bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-300
                                    @elseif($transaction->payment_status === 'failed' || $transaction->payment_status === 'cancelled') bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-300
                                    @else bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300
                                    @endif">
                                    {{ ucfirst($transaction->payment_status) }}
                                </span>
                            </td>
                            <td class="p-4 text-base font-medium whitespace-nowrap">
                                <span class="px-2.5 py-0.5 rounded-full text-xs font-medium
                                    @if($transaction->shipping_status === 'shipped') bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300
                                    @elseif($transaction->shipping_status === 'processing') bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-300
                                    @elseif($transaction->shipping_status === 'delivered') bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-300
                                    @elseif($transaction->shipping_status === 'failed') bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-300
                                    @else bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300
                                    @endif">
                                    {{ ucfirst($transaction->shipping_status) }}
                                </span>
                            </td>
                            <td class="hidden md:table-cell p-4 text-base font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $transaction->created_at->format('M d, Y H:i') }}
                            </td>
                            <td class="p-4 space-x-2 whitespace-nowrap">
                                <div class="flex flex-col sm:flex-row gap-2">
                                    <a href="{{ route('admin.transactions.show', $transaction) }}" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white rounded-lg bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path></svg>
                                        Detail
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="p-4 text-center text-gray-500 dark:text-gray-400">
                                No transactions found
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="sticky bottom-0 right-0 items-center w-full p-4 bg-white border-t border-gray-200 sm:flex sm:justify-between dark:bg-gray-800 dark:border-gray-700">
    <div class="flex items-center mb-4 sm:mb-0">
        <span class="text-sm font-normal text-gray-500 dark:text-gray-400">
            Showing <span class="font-semibold text-gray-900 dark:text-white">{{ $transactions->firstItem() ?? 0 }}-{{ $transactions->lastItem() ?? 0 }}</span> of <span class="font-semibold text-gray-900 dark:text-white">{{ $transactions->total() }}</span>
        </span>
    </div>
    <div class="flex items-center space-x-3">
        @if($transactions->hasPages())
            {{ $transactions->links() }}
        @endif
    </div>
</div>

@push('scripts')
<script>
function deleteTransaction(id) {
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            // Create form and submit
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = `/admin/transactions/${id}`;
            
            const csrfToken = document.createElement('input');
            csrfToken.type = 'hidden';
            csrfToken.name = '_token';
            csrfToken.value = '{{ csrf_token() }}';
            
            const methodField = document.createElement('input');
            methodField.type = 'hidden';
            methodField.name = '_method';
            methodField.value = 'DELETE';
            
            form.appendChild(csrfToken);
            form.appendChild(methodField);
            document.body.appendChild(form);
            form.submit();
        }
    });
}
</script>
@endpush
@endsection 