@extends('layouts.master')

@section('title', 'Seller Dashboard')

@section('main')
<div class="container mx-auto px-4 py-8">
    <!-- Header Section -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-800">Seller Dashboard</h1>
        <p class="mt-2 text-gray-600">Welcome back, {{ auth()->user()->store_name }}!</p>
    </div>

    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Total Products -->
        <div class="bg-white rounded-xl shadow-sm hover:shadow-md transition-shadow duration-300 p-6 border border-gray-100">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-blue-50 text-[#2596be]">
                    <i class="fas fa-box text-2xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-gray-500 text-sm font-medium">Total Products</p>
                    <p class="text-2xl font-bold text-gray-800">{{ $stats['total_products'] }}</p>
                </div>
            </div>
        </div>

        <!-- Total Sales -->
        <div class="bg-white rounded-xl shadow-sm hover:shadow-md transition-shadow duration-300 p-6 border border-gray-100">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-green-50 text-green-600">
                    <i class="fas fa-dollar-sign text-2xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-gray-500 text-sm font-medium">Total Sales</p>
                    <p class="text-2xl font-bold text-gray-800">Rp {{ number_format($stats['total_sales'], 0, ',', '.') }}</p>
                </div>
            </div>
        </div>

        <!-- Total Orders -->
        <div class="bg-white rounded-xl shadow-sm hover:shadow-md transition-shadow duration-300 p-6 border border-gray-100">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-purple-50 text-purple-600">
                    <i class="fas fa-shopping-cart text-2xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-gray-500 text-sm font-medium">Total Orders</p>
                    <p class="text-2xl font-bold text-gray-800">{{ $stats['total_orders'] }}</p>
                </div>
            </div>
        </div>

        <!-- Pending Orders -->
        <div class="bg-white rounded-xl shadow-sm hover:shadow-md transition-shadow duration-300 p-6 border border-gray-100">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-yellow-50 text-yellow-600">
                    <i class="fas fa-clock text-2xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-gray-500 text-sm font-medium">Pending Orders</p>
                    <p class="text-2xl font-bold text-gray-800">{{ $stats['pending_orders'] }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <!-- Recent Products -->
        <div class="bg-white rounded-xl shadow-sm hover:shadow-md transition-shadow duration-300 p-6 border border-gray-100">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-xl font-bold text-gray-800">Recent Products</h2>
                <a href="{{ route('products.create') }}" class="inline-flex items-center px-4 py-2 bg-[#2596be] text-white rounded-lg hover:bg-[#217ca6] transition-colors duration-300 text-sm font-medium">
                    <i class="fas fa-plus mr-2"></i> Add New
                </a>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead>
                        <tr>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Product</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Price</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Stock</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach($products as $product)
                        <tr class="hover:bg-gray-50 transition-colors duration-200">
                            <td class="px-4 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <img src="{{ $product->image }}" alt="{{ $product->name }}" class="w-10 h-10 rounded-lg object-cover mr-3">
                                    <span class="text-sm font-medium text-gray-900">{{ $product->name }}</span>
                                </div>
                            </td>
                            <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-900">Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                            <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-900">{{ $product->stock }}</td>
                            <td class="px-4 py-4 whitespace-nowrap">
                                <span class="px-3 py-1 rounded-full text-xs font-medium {{ $product->status === 'active' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                    {{ $product->status }}
                                </span>
                            </td>
                            <td class="px-4 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <div class="flex items-center gap-2">
                                    <a href="{{ route('products.edit', $product->id) }}" class="text-white bg-[#2596be] hover:bg-[#217ca6] focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-xs px-3 py-1.5 transition-colors duration-300">Edit</a>
                                    <form id="delete-form-{{ $product->id }}" action="{{ route('products.destroy', $product->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" onclick="confirmDelete({{ $product->id }})" class="text-white bg-red-600 hover:bg-red-700 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-xs px-3 py-1.5 transition-colors duration-300">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Recent Transactions -->
        <div class="bg-white rounded-xl shadow-sm hover:shadow-md transition-shadow duration-300 p-6 border border-gray-100">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-xl font-bold text-gray-800">Recent Transactions</h2>
                <a href="{{ route('seller.transactions.index') }}" class="inline-flex items-center px-4 py-2 bg-[#2596be] text-white rounded-lg hover:bg-[#217ca6] transition-colors duration-300 text-sm font-medium">
                    <i class="fas fa-list mr-2"></i> View All
                </a>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead>
                        <tr>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Order ID</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Amount</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach($transactions as $transaction)
                        <tr class="hover:bg-gray-50 transition-colors duration-200">
                            <td class="px-4 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                <a href="{{ route('seller.transactions.show', $transaction) }}" class="text-[#2596be] hover:text-[#217ca6]">
                                    #{{ $transaction->id }}
                                </a>
                            </td>
                            <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-900">{{ $transaction->created_at->format('d M Y') }}</td>
                            <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-900">Rp {{ number_format($transaction->total_amount, 0, ',', '.') }}</td>
                            <td class="px-4 py-4 whitespace-nowrap">
                                <span class="px-3 py-1 rounded-full text-xs font-medium 
                                    @if($transaction->shipping_status === 'delivered') bg-green-100 text-green-800
                                    @elseif($transaction->shipping_status === 'shipped') bg-blue-100 text-blue-800
                                    @elseif($transaction->shipping_status === 'processing') bg-yellow-100 text-yellow-800
                                    @elseif($transaction->shipping_status === 'failed') bg-red-100 text-red-800
                                    @else bg-gray-100 text-gray-800
                                    @endif">
                                    {{ ucfirst($transaction->shipping_status) }}
                                </span>
                            </td>
                            <td class="px-4 py-4 whitespace-nowrap text-sm font-medium">
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
                        @endforeach
                    </tbody>
                </table>
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
    function confirmDelete(productId) {
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
                document.getElementById('delete-form-' + productId).submit();
            }
        })
    }

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