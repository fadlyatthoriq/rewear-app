@extends('layouts.master')

@section('title', 'Transaction #' . $transaction->id)

@section('main')
<div class="container mx-auto px-4 py-8">
    <!-- Header Section -->
    <div class="mb-8">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold text-gray-800">Transaction Details</h1>
                <p class="mt-2 text-gray-600">Order #{{ $transaction->id }}</p>
            </div>
            <a href="{{ route('seller.transactions.index') }}" 
               class="inline-flex items-center px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition-colors duration-300">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Back to Transactions
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Transaction Information -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Transaction Details Card -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Transaction Information</h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="p-3 bg-gray-50 rounded-lg">
                        <p class="text-sm font-medium text-gray-500">Transaction ID</p>
                        <p class="text-base font-semibold text-gray-900">#{{ $transaction->id }}</p>
                    </div>
                    <div class="p-3 bg-gray-50 rounded-lg">
                        <p class="text-sm font-medium text-gray-500">Date</p>
                        <p class="text-base font-semibold text-gray-900">{{ $transaction->created_at->format('M d, Y H:i') }}</p>
                    </div>
                    <div class="p-3 bg-gray-50 rounded-lg">
                        <p class="text-sm font-medium text-gray-500">Payment Method</p>
                        <p class="text-base font-semibold text-gray-900">{{ ucfirst($transaction->payment_method) }}</p>
                    </div>
                    <div class="p-3 bg-gray-50 rounded-lg">
                        <p class="text-sm font-medium text-gray-500">Delivery Method</p>
                        <p class="text-base font-semibold text-gray-900">{{ ucfirst($transaction->delivery_method) }}</p>
                    </div>
                </div>
            </div>

            <!-- Status Information Card -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Status Information</h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="p-3 bg-gray-50 rounded-lg">
                        <p class="text-sm font-medium text-gray-500">Overall Status</p>
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                            @if($transaction->overall_status === 'Completed' || $transaction->overall_status === 'Success' || $transaction->overall_status === 'Paid' || $transaction->overall_status === 'Delivered' || $transaction->overall_status === 'Payment Confirmed') bg-green-100 text-green-800
                            @elseif($transaction->overall_status === 'Processing' || $transaction->overall_status === 'Payment Processing' || $transaction->overall_status === 'Shipping Processing') bg-yellow-100 text-yellow-800
                            @elseif($transaction->overall_status === 'Shipped') bg-blue-100 text-blue-800
                            @elseif($transaction->overall_status === 'Failed' || $transaction->overall_status === 'Cancelled' || $transaction->overall_status === 'Shipping Failed' || $transaction->overall_status === 'Failed Payment' || $transaction->overall_status === 'Cancelled Payment') bg-red-100 text-red-800
                            @elseif($transaction->overall_status === 'Pending' || $transaction->overall_status === 'Pending Shipping') bg-gray-100 text-gray-800
                            @else bg-gray-100 text-gray-800 @endif">
                            {{ $transaction->overall_status }}
                        </span>
                    </div>
                    <div class="p-3 bg-gray-50 rounded-lg">
                        <p class="text-sm font-medium text-gray-500">Shipping Status</p>
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                            @if($transaction->shipping_status === 'delivered') bg-green-100 text-green-800
                            @elseif($transaction->shipping_status === 'shipped') bg-blue-100 text-blue-800
                            @elseif($transaction->shipping_status === 'processing') bg-yellow-100 text-yellow-800
                            @elseif($transaction->shipping_status === 'failed') bg-red-100 text-red-800
                            @else bg-gray-100 text-gray-800 @endif">
                            {{ ucfirst($transaction->shipping_status) }}
                        </span>
                        @if($transaction->tracking_number)
                        <div class="mt-2">
                            <p class="text-sm font-medium text-gray-500">Tracking Number</p>
                            <p class="text-base font-semibold text-gray-900">{{ $transaction->tracking_number }}</p>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Seller's Products in Transaction -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Your Products in This Order</h3>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                            <tr>
                                <th scope="col" class="px-4 py-3">Product</th>
                                <th scope="col" class="px-4 py-3">Price</th>
                                <th scope="col" class="px-4 py-3">Quantity</th>
                                <th scope="col" class="px-4 py-3">Subtotal</th>
                                <th scope="col" class="px-4 py-3">Shipping Status</th>
                                <th scope="col" class="px-4 py-3">Tracking Number</th>
                                <th scope="col" class="px-4 py-3">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @foreach($sellerItems as $item)
                            <tr class="hover:bg-gray-50 transition-colors duration-200">
                                <td class="px-4 py-3">
                                    <div class="flex items-center space-x-3">
                                        @if($item->product->image)
                                        <img src="{{ $item->product->image }}" class="w-10 h-10 rounded-lg object-cover" alt="{{ $item->product->name }}">
                                        @endif
                                        <div>
                                            <p class="font-medium text-gray-900">{{ $item->product->name }}</p>
                                            <p class="text-sm text-gray-500">{{ $item->product->category->name }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-4 py-3">Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                                <td class="px-4 py-3">{{ $item->quantity }}</td>
                                <td class="px-4 py-3 font-medium text-gray-900">Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}</td>
                                <td class="px-4 py-3">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                        @if($item->shipping_status === 'delivered') bg-green-100 text-green-800
                                        @elseif($item->shipping_status === 'shipped') bg-blue-100 text-blue-800
                                        @elseif($item->shipping_status === 'processing') bg-yellow-100 text-yellow-800
                                        @elseif($item->shipping_status === 'failed') bg-red-100 text-red-800
                                        @else bg-gray-100 text-gray-800 @endif">
                                        {{ ucfirst($item->shipping_status) }}
                                    </span>
                                </td>
                                <td class="px-4 py-3">
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
                                </td>
                                <td class="px-4 py-3">
                                    <form action="{{ route('seller.transaction-items.update-status', $item) }}" method="POST" class="flex flex-col gap-2">
                                        @csrf
                                        @method('PUT')
                                        <select name="shipping_status" class="px-2 py-1 border border-gray-300 rounded-lg text-xs" onchange="toggleTrackingInput(this, 'tracking-{{ $item->id }}')">
                                            <option value="pending" {{ $item->shipping_status === 'pending' ? 'selected' : '' }}>Pending</option>
                                            <option value="processing" {{ $item->shipping_status === 'processing' ? 'selected' : '' }}>Processing</option>
                                            <option value="shipped" {{ $item->shipping_status === 'shipped' ? 'selected' : '' }}>Shipped</option>
                                            <option value="delivered" {{ $item->shipping_status === 'delivered' ? 'selected' : '' }}>Delivered</option>
                                            <option value="failed" {{ $item->shipping_status === 'failed' ? 'selected' : '' }}>Failed</option>
                                        </select>
                                        <input type="text" name="tracking_number" id="tracking-{{ $item->id }}" value="{{ $item->tracking_number }}" placeholder="Tracking number" class="px-2 py-1 border border-gray-300 rounded-lg text-xs mt-1" style="display: {{ $item->shipping_status === 'shipped' ? 'block' : 'none' }};" />
                                        <button type="submit" class="mt-1 px-3 py-1 bg-[#2596be] text-white rounded-lg text-xs hover:bg-[#217ca6] transition-colors duration-200">Update</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Customer Information -->
        <div class="space-y-6">
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Customer Information</h3>
                <div class="space-y-4">
                    <div class="p-3 bg-gray-50 rounded-lg">
                        <p class="text-sm font-medium text-gray-500">Name</p>
                        <p class="text-base font-semibold text-gray-900">{{ $transaction->user->name }}</p>
                    </div>
                    <div class="p-3 bg-gray-50 rounded-lg">
                        <p class="text-sm font-medium text-gray-500">Email</p>
                        <p class="text-base font-semibold text-gray-900">{{ $transaction->user->email }}</p>
                    </div>
                    @if($transaction->customer_phone)
                    <div class="p-3 bg-gray-50 rounded-lg">
                        <p class="text-sm font-medium text-gray-500">Phone</p>
                        <p class="text-base font-semibold text-gray-900">{{ $transaction->customer_phone }}</p>
                    </div>
                    @endif
                    @if($transaction->customer_address)
                    <div class="p-3 bg-gray-50 rounded-lg">
                        <p class="text-sm font-medium text-gray-500">Address</p>
                        <p class="text-base font-semibold text-gray-900">{{ $transaction->customer_address }}</p>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Actions</h3>
                <div class="space-y-3">
                    <button onclick="editTransaction({{ $transaction->id }})" 
                            class="w-full inline-flex items-center justify-center px-4 py-2 bg-yellow-600 text-white rounded-lg hover:bg-yellow-700 transition-colors duration-300">
                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z"></path>
                            <path fill-rule="evenodd" d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z" clip-rule="evenodd"></path>
                        </svg>
                        Update Status
                    </button>
                </div>
            </div>
        </div>
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
    fetch(window.location.origin + `/seller/transactions/${id}/edit`)
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

function toggleTrackingInput(select, inputId) {
    const input = document.getElementById(inputId);
    if (select.value === 'shipped') {
        input.style.display = 'block';
        input.required = true;
    } else {
        input.style.display = 'none';
        input.required = false;
    }
}
</script>
@endpush 