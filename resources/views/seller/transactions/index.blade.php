@extends('layouts.master')

@section('title', 'My Transactions')

@section('main')
<div class="container mx-auto px-4 py-8">
    <!-- Header Section -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-800">My Transactions</h1>
        <p class="mt-2 text-gray-600">Manage orders for your products</p>
    </div>

    <!-- Search and Filter Section -->
    <div class="mb-6 bg-white rounded-xl shadow-sm p-6 border border-gray-100">
        <form method="GET" action="{{ route('seller.transactions.index') }}" class="flex flex-col sm:flex-row gap-4">
            <div class="flex-1">
                <input type="text" name="search" value="{{ request('search') }}" 
                       placeholder="Search by order ID, customer name, or email..." 
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#2596be] focus:border-transparent">
            </div>
            <div class="sm:w-48">
                <select name="status" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#2596be] focus:border-transparent">
                    <option value="all" {{ request('status') === 'all' ? 'selected' : '' }}>All Status</option>
                    <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="processing" {{ request('status') === 'processing' ? 'selected' : '' }}>Processing</option>
                    <option value="shipped" {{ request('status') === 'shipped' ? 'selected' : '' }}>Shipped</option>
                    <option value="delivered" {{ request('status') === 'delivered' ? 'selected' : '' }}>Delivered</option>
                    <option value="failed" {{ request('status') === 'failed' ? 'selected' : '' }}>Failed</option>
                </select>
            </div>
            <button type="submit" class="px-6 py-2 bg-[#2596be] text-white rounded-lg hover:bg-[#217ca6] transition-colors duration-300">
                Search
            </button>
        </form>
    </div>

    <!-- Transactions Table -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            <a href="{{ request()->fullUrlWithQuery(['sort' => 'id', 'direction' => request('sort') === 'id' && request('direction') === 'asc' ? 'desc' : 'asc']) }}" 
                               class="group inline-flex items-center gap-1 hover:text-[#2596be]">
                                Order ID
                                @if(request('sort') === 'id')
                                    <svg class="h-3 w-3 transition-transform {{ request('direction') === 'asc' ? 'rotate-180' : '' }}" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M8.574 11.024h6.852a2.075 2.075 0 0 0 1.847-1.086 1.9 1.9 0 0 0-.11-1.986L13.736 2.9a2.122 2.122 0 0 0-3.472 0L6.837 7.952a1.9 1.9 0 0 0-.11 1.986 2.074 2.074 0 0 0 1.847 1.086Zm6.852 1.952H8.574a2.072 2.072 0 0 0-1.847 1.087 1.9 1.9 0 0 0 .11 1.985l3.426 5.05a2.123 2.123 0 0 0 3.472 0l3.427-5.05a1.9 1.9 0 0 0 .11-1.985 2.074 2.074 0 0 0-1.846-1.087Z"/>
                                    </svg>
                                @endif
                            </a>
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Customer</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            <a href="{{ request()->fullUrlWithQuery(['sort' => 'total_amount', 'direction' => request('sort') === 'total_amount' && request('direction') === 'asc' ? 'desc' : 'asc']) }}" 
                               class="group inline-flex items-center gap-1 hover:text-[#2596be]">
                                Amount
                                @if(request('sort') === 'total_amount')
                                    <svg class="h-3 w-3 transition-transform {{ request('direction') === 'asc' ? 'rotate-180' : '' }}" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M8.574 11.024h6.852a2.075 2.075 0 0 0 1.847-1.086 1.9 1.9 0 0 0-.11-1.986L13.736 2.9a2.122 2.122 0 0 0-3.472 0L6.837 7.952a1.9 1.9 0 0 0-.11 1.986 2.074 2.074 0 0 0 1.847 1.086Zm6.852 1.952H8.574a2.072 2.072 0 0 0-1.847 1.087 1.9 1.9 0 0 0 .11 1.985l3.426 5.05a2.123 2.123 0 0 0 3.472 0l3.427-5.05a1.9 1.9 0 0 0 .11-1.985 2.074 2.074 0 0 0-1.846-1.087Z"/>
                                    </svg>
                                @endif
                            </a>
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            <a href="{{ request()->fullUrlWithQuery(['sort' => 'shipping_status', 'direction' => request('sort') === 'shipping_status' && request('direction') === 'asc' ? 'desc' : 'asc']) }}" 
                               class="group inline-flex items-center gap-1 hover:text-[#2596be]">
                                Status
                                @if(request('sort') === 'shipping_status')
                                    <svg class="h-3 w-3 transition-transform {{ request('direction') === 'asc' ? 'rotate-180' : '' }}" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M8.574 11.024h6.852a2.075 2.075 0 0 0 1.847-1.086 1.9 1.9 0 0 0-.11-1.986L13.736 2.9a2.122 2.122 0 0 0-3.472 0L6.837 7.952a1.9 1.9 0 0 0-.11 1.986 2.074 2.074 0 0 0 1.847 1.086Zm6.852 1.952H8.574a2.072 2.072 0 0 0-1.847 1.087 1.9 1.9 0 0 0 .11 1.985l3.426 5.05a2.123 2.123 0 0 0 3.472 0l3.427-5.05a1.9 1.9 0 0 0 .11-1.985 2.074 2.074 0 0 0-1.846-1.087Z"/>
                                    </svg>
                                @endif
                            </a>
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tracking</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            <a href="{{ request()->fullUrlWithQuery(['sort' => 'created_at', 'direction' => request('sort') === 'created_at' && request('direction') === 'asc' ? 'desc' : 'asc']) }}" 
                               class="group inline-flex items-center gap-1 hover:text-[#2596be]">
                                Date
                                @if(request('sort') === 'created_at')
                                    <svg class="h-3 w-3 transition-transform {{ request('direction') === 'asc' ? 'rotate-180' : '' }}" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M8.574 11.024h6.852a2.075 2.075 0 0 0 1.847-1.086 1.9 1.9 0 0 0-.11-1.986L13.736 2.9a2.122 2.122 0 0 0-3.472 0L6.837 7.952a1.9 1.9 0 0 0-.11 1.986 2.074 2.074 0 0 0 1.847 1.086Zm6.852 1.952H8.574a2.072 2.072 0 0 0-1.847 1.087 1.9 1.9 0 0 0 .11 1.985l3.426 5.05a2.123 2.123 0 0 0 3.472 0l3.427-5.05a1.9 1.9 0 0 0 .11-1.985 2.074 2.074 0 0 0-1.846-1.087Z"/>
                                    </svg>
                                @endif
                            </a>
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($transactions as $transaction)
                    <tr class="hover:bg-gray-50 transition-colors duration-200">
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                            <a href="{{ route('seller.transactions.show', $transaction) }}" class="text-[#2596be] hover:text-[#217ca6]">
                                #{{ $transaction->id }}
                            </a>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            <div>
                                <div class="font-medium">{{ $transaction->user->name }}</div>
                                <div class="text-gray-500">{{ $transaction->user->email }}</div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            Rp {{ number_format($transaction->total_amount, 0, ',', '.') }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                @if($transaction->shipping_status === 'delivered') bg-green-100 text-green-800
                                @elseif($transaction->shipping_status === 'shipped') bg-blue-100 text-blue-800
                                @elseif($transaction->shipping_status === 'processing') bg-yellow-100 text-yellow-800
                                @elseif($transaction->shipping_status === 'failed') bg-red-100 text-red-800
                                @else bg-gray-100 text-gray-800 @endif">
                                {{ ucfirst($transaction->shipping_status) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            @if($transaction->tracking_number)
                                <span class="inline-flex items-center gap-1.5 rounded-full px-2.5 py-0.5 text-xs font-medium bg-blue-100 text-blue-800">
                                    <svg class="h-3.5 w-3.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2-10V4a1 1 0 0 0-1-1H4a1 1 0 0 0-1 1v16a1 1 0 0 0 1 1h16a1 1 0 0 0 1-1V10a1 1 0 0 0-1-1h-3.393a1 1 0 0 1-.894-.553L14 5h-3c-.53 0-1.04-.2-1.414-.586l-.78-.78a1 1 0 0 0-1.414 0l-.78.78A1 1 0 0 1 7.393 9H4a1 1 0 0 0-1 1v2h18v-2h-3Z"/>
                                    </svg>
                                    {{ $transaction->tracking_number }}
                                </span>
                            @else
                                <span class="text-gray-400">-</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            {{ $transaction->created_at->format('d M Y H:i') }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <div class="flex items-center gap-2">
                                <a href="{{ route('seller.transactions.show', $transaction) }}" 
                                   class="text-white bg-[#2596be] hover:bg-[#217ca6] focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-xs px-3 py-1.5 transition-colors duration-300">
                                    View
                                </a>
                                <button onclick="editTransaction({{ $transaction->id }})" 
                                        class="text-white bg-yellow-600 hover:bg-yellow-700 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-xs px-3 py-1.5 transition-colors duration-300">
                                    Update
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="px-6 py-8 text-center">
                            <div class="mx-auto flex max-w-sm flex-col items-center">
                                <svg class="mb-3 h-10 w-10 text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2-10V4a1 1 0 0 0-1-1H4a1 1 0 0 0-1 1v16a1 1 0 0 0 1 1h16a1 1 0 0 0 1-1V10a1 1 0 0 0-1-1h-3.393a1 1 0 0 1-.894-.553L14 5h-3c-.53 0-1.04-.2-1.414-.586l-.78-.78a1 1 0 0 0-1.414 0l-.78.78A1 1 0 0 1 7.393 9H4a1 1 0 0 0-1 1v2h18v-2h-3Z"/>
                                </svg>
                                <h3 class="mb-1 text-lg font-semibold text-gray-900">No transactions found</h3>
                                <p class="text-sm text-gray-500">No orders for your products yet</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Pagination -->
    <div class="mt-6">
        {{ $transactions->links() }}
    </div>
</div>

<!-- Update Transaction Modal -->
<div id="updateTransactionModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
        <div class="mt-3">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-medium text-gray-900">Update Transaction Status</h3>
                <button onclick="closeModal()" class="text-gray-400 hover:text-gray-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
            <form id="updateTransactionForm" method="POST" class="space-y-4">
                @csrf
                @method('PUT')
                <div>
                    <label for="shipping_status" class="block text-sm font-medium text-gray-700 mb-2">Shipping Status</label>
                    <select name="shipping_status" id="shipping_status" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#2596be] focus:border-transparent" required>
                        <option value="pending">Pending</option>
                        <option value="processing">Processing</option>
                        <option value="shipped">Shipped</option>
                        <option value="delivered">Delivered</option>
                        <option value="failed">Failed</option>
                    </select>
                </div>
                <div id="tracking_number_field" style="display: none;">
                    <label for="tracking_number" class="block text-sm font-medium text-gray-700 mb-2">Tracking Number <span class="text-red-500">*</span></label>
                    <input type="text" name="tracking_number" id="tracking_number" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#2596be] focus:border-transparent" placeholder="Enter tracking number">
                    <p class="mt-1 text-xs text-gray-500">Required when marking order as shipped</p>
                </div>
                <div class="flex justify-end gap-3 pt-4">
                    <button type="button" onclick="closeModal()" class="px-4 py-2 text-gray-700 bg-gray-200 rounded-lg hover:bg-gray-300 transition-colors duration-300">
                        Cancel
                    </button>
                    <button type="submit" class="px-4 py-2 bg-[#2596be] text-white rounded-lg hover:bg-[#217ca6] transition-colors duration-300">
                        Update
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
function editTransaction(id) {
    // Fetch transaction data
    fetch(`/seller/transactions/${id}/edit`)
        .then(response => {
            if (!response.ok) {
                throw new Error('Error fetching transaction data');
            }
            return response.json();
        })
        .then(transaction => {
            // Update form action
            document.getElementById('updateTransactionForm').action = `/seller/transactions/${id}`;
            
            // Fill form fields
            const shippingStatusSelect = document.getElementById('shipping_status');
            const trackingNumberField = document.getElementById('tracking_number_field');
            const trackingNumberInput = document.getElementById('tracking_number');
            
            if (shippingStatusSelect) {
                shippingStatusSelect.value = transaction.shipping_status;
            }
            
            if (trackingNumberInput) {
                trackingNumberInput.value = transaction.tracking_number || '';
            }
            
            // Show/hide tracking number field based on status
            if (transaction.shipping_status === 'shipped') {
                trackingNumberField.style.display = 'block';
            } else {
                trackingNumberField.style.display = 'none';
            }
            
            // Show modal
            document.getElementById('updateTransactionModal').classList.remove('hidden');
        })
        .catch(error => {
            console.error('Error in editTransaction:', error);
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Failed to fetch transaction data. Please try again.',
                confirmButtonColor: '#2596be'
            });
        });
}

function closeModal() {
    document.getElementById('updateTransactionModal').classList.add('hidden');
}

// Show/hide tracking number field when shipping status changes
document.addEventListener('DOMContentLoaded', function() {
    const shippingStatusSelect = document.getElementById('shipping_status');
    const trackingNumberField = document.getElementById('tracking_number_field');
    const trackingNumberInput = document.getElementById('tracking_number');
    
    if (shippingStatusSelect) {
        shippingStatusSelect.addEventListener('change', function() {
            if (this.value === 'shipped') {
                trackingNumberField.style.display = 'block';
                trackingNumberInput.required = true;
            } else {
                trackingNumberField.style.display = 'none';
                trackingNumberInput.required = false;
            }
        });
    }
});

// Form validation
document.getElementById('updateTransactionForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const shippingStatus = document.getElementById('shipping_status').value;
    const trackingNumber = document.getElementById('tracking_number').value;
    
    // Validate tracking number if status is shipped
    if (shippingStatus === 'shipped' && !trackingNumber.trim()) {
        Swal.fire({
            icon: 'error',
            title: 'Validation Error',
            text: 'Tracking number is required when marking order as shipped',
            confirmButtonColor: '#2596be'
        });
        return;
    }
    
    Swal.fire({
        title: 'Update Status?',
        text: "Are you sure you want to update the transaction status?",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#2596be',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, update it!',
        cancelButtonText: 'No, cancel!',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            this.submit();
        }
    });
});
</script>
@endpush 