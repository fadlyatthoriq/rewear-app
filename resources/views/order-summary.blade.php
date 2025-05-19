@extends('layouts.master')

@section('title', 'Order Summary')

@section('main')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-4xl mx-auto">
        <!-- Breadcrumb -->
        <div class="flex items-center space-x-2 mb-8">
            <div class="flex items-center">
                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                </svg>
                <span class="ml-2 text-gray-500">Cart</span>
            </div>
            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
            <div class="flex items-center">
                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                </svg>
                <span class="ml-2 text-gray-500">Checkout</span>
            </div>
            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
            <div class="flex items-center">
                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <span class="ml-2 text-blue-600">Order Summary</span>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <!-- Left Column -->
            <div class="space-y-8">
                <!-- Billing Information -->
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h2 class="text-xl font-semibold mb-4">Billing Information</h2>
                    <div class="space-y-4">
                        <div>
                            <span class="text-sm font-medium text-gray-500">Name</span>
                            <p class="mt-1">{{ $checkout['name'] }}</p>
                        </div>
                        <div>
                            <span class="text-sm font-medium text-gray-500">Email</span>
                            <p class="mt-1">{{ $checkout['email'] }}</p>
                        </div>
                        <div>
                            <span class="text-sm font-medium text-gray-500">Phone</span>
                            <p class="mt-1">{{ $checkout['phone'] }}</p>
                        </div>
                        <div>
                            <span class="text-sm font-medium text-gray-500">Address</span>
                            <p class="mt-1">{{ $checkout['address'] }}</p>
                        </div>
                    </div>
                </div>

                <!-- Payment & Delivery -->
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h2 class="text-xl font-semibold mb-4">Payment & Delivery</h2>
                    <div class="space-y-4">
                        <div>
                            <span class="text-sm font-medium text-gray-500">Payment Method</span>
                            <p class="mt-1 capitalize">{{ str_replace('_', ' ', $checkout['payment_method']) }}</p>
                        </div>
                        <div>
                            <span class="text-sm font-medium text-gray-500">Delivery Method</span>
                            <p class="mt-1 capitalize">{{ str_replace('_', ' ', $checkout['delivery_method']) }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column -->
            <div class="space-y-8">
                <!-- Order Items -->
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h2 class="text-xl font-semibold mb-4">Order Items</h2>
                    <div class="space-y-4">
                        @foreach($items as $item)
                        <div class="flex items-center space-x-4">
                            <img src="{{ secure_asset('storage/' . $item->product->image_url) }}" alt="{{ $item->product->name }}" class="w-16 h-16 object-cover rounded">
                            <div class="flex-1">
                                <h3 class="text-sm font-medium text-gray-900">{{ $item->product->name }}</h3>
                                <p class="text-sm text-gray-500">Quantity: {{ $item->quantity }}</p>
                            </div>
                            <div class="text-sm font-medium text-gray-900">
                                Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                <!-- Order Summary -->
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h2 class="text-xl font-semibold mb-4">Order Summary</h2>
                    <div class="space-y-4">
                        <div class="flex justify-between">
                            <span class="text-gray-600">Subtotal</span>
                            <span class="text-gray-900">Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Tax (10%)</span>
                            <span class="text-gray-900">Rp {{ number_format($tax, 0, ',', '.') }}</span>
                        </div>
                        <div class="border-t pt-4">
                            <div class="flex justify-between font-semibold text-lg">
                                <span>Total</span>
                                <span>Rp {{ number_format($total, 0, ',', '.') }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex space-x-4">
                    <button type="button" onclick="createTransaction()" class="flex-1 bg-primary text-white py-3 px-6 rounded-lg hover:bg-blue-700 transition duration-200">
                        Place Order
                    </button>
                    <a href="{{ route('checkout') }}" class="flex-1 bg-gray-200 text-gray-800 py-3 px-6 rounded-lg hover:bg-gray-300 transition duration-200 text-center">
                        Back to Checkout
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('services.midtrans.client_key') }}"></script>
<script>
function createTransaction() {
    // Disable button and show loading state
    const button = event.target;
    const originalText = button.innerHTML;
    button.disabled = true;
    button.innerHTML = '<svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white inline-block" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg> Processing...';

    // Show loading overlay
    const loadingOverlay = document.createElement('div');
    loadingOverlay.className = 'fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50';
    loadingOverlay.innerHTML = `
        <div class="bg-white p-6 rounded-lg shadow-xl">
            <div class="flex items-center space-x-3">
                <svg class="animate-spin h-8 w-8 text-primary" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                <span class="text-lg font-medium">Processing your order...</span>
            </div>
        </div>
    `;
    document.body.appendChild(loadingOverlay);

    fetch('{{ route("order.create-transaction") }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({
            total: {{ $total }},
            payment_method: '{{ $checkout["payment_method"] }}',
            delivery_method: '{{ $checkout["delivery_method"] }}'
        })
    })
    .then(response => {
        if (!response.ok) {
            return response.json().then(data => {
                throw new Error(data.message || 'Failed to create transaction');
            });
        }
        return response.json();
    })
    .then(data => {
        if (data.status === 'success') {
            // Create payment with Midtrans
            return fetch('{{ route("payment.create") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    transaction_id: data.transaction_id
                })
            });
        } else {
            throw new Error('Failed to create transaction');
        }
    })
    .then(response => {
        if (!response.ok) {
            return response.json().then(data => {
                throw new Error(data.message || 'Failed to create payment');
            });
        }
        return response.json();
    })
    .then(paymentData => {
        if (paymentData.status === 'success') {
            // Remove loading overlay
            document.body.removeChild(loadingOverlay);
            // Redirect to Midtrans payment page
            window.location.href = paymentData.redirect_url;
        } else {
            throw new Error('Failed to create payment');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        // Remove loading overlay
        document.body.removeChild(loadingOverlay);
        // Show error message using SweetAlert2
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true
        });

        Toast.fire({
            icon: 'error',
            title: error.message || 'An error occurred. Please try again.'
        });
    })
    .finally(() => {
        // Re-enable button and restore original text
        button.disabled = false;
        button.innerHTML = originalText;
    });
}
</script>
@endpush
@endsection
