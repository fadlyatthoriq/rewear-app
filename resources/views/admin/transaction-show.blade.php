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
                            <a href="{{ route('admin.transactions.index') }}" class="ml-1 text-gray-700 hover:text-primary-600 md:ml-2 dark:text-gray-300 dark:hover:text-white">Transactions</a>
                        </div>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                            <span class="ml-1 text-gray-400 md:ml-2 dark:text-gray-500" aria-current="page">Transaction #{{ $transaction->id }}</span>
                        </div>
                    </li>
                </ol>
            </nav>
            <h1 class="text-xl font-semibold text-gray-900 sm:text-2xl dark:text-white">Transaction Details</h1>
        </div>
    </div>
</div>

<div class="p-4 space-y-4">
    <!-- Transaction Information -->
    <div class="p-4 bg-white border border-gray-200 rounded-lg shadow-sm 2xl:col-span-2 dark:border-gray-700 sm:p-6 dark:bg-gray-800">
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
            <div>
                <h3 class="mb-4 text-xl font-bold dark:text-white">Transaction Information</h3>
                <div class="mb-4">
                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Transaction ID</p>
                    <p class="text-base font-medium text-gray-900 dark:text-white">#{{ $transaction->id }}</p>
                </div>
                <div class="mb-4">
                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Date</p>
                    <p class="text-base font-medium text-gray-900 dark:text-white">{{ $transaction->created_at->format('M d, Y H:i') }}</p>
                </div>
                <div class="mb-4">
                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Status</p>
                    <span class="px-2.5 py-0.5 rounded-full text-xs font-medium
                        @if($transaction->status === 'paid' || $transaction->status === 'completed') bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300
                        @elseif($transaction->status === 'processing') bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-300
                        @elseif($transaction->status === 'failed' || $transaction->status === 'cancelled') bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-300
                        @else bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300
                        @endif">
                        {{ ucfirst($transaction->status) }}
                    </span>
                </div>
                <div class="mb-4">
                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Payment Status</p>
                    <span class="px-2.5 py-0.5 rounded-full text-xs font-medium
                        @if($transaction->payment_status === 'paid') bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300
                        @elseif($transaction->payment_status === 'processing') bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-300
                        @elseif($transaction->payment_status === 'failed' || $transaction->payment_status === 'cancelled') bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-300
                        @else bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300
                        @endif">
                        {{ ucfirst($transaction->payment_status) }}
                    </span>
                </div>
                <div class="mb-4">
                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Shipping Status</p>
                    <span class="px-2.5 py-0.5 rounded-full text-xs font-medium
                        @if($transaction->shipping_status === 'delivered') bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300
                        @elseif($transaction->shipping_status === 'shipped') bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-300
                        @elseif($transaction->shipping_status === 'processing') bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-300
                        @elseif($transaction->shipping_status === 'failed') bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-300
                        @else bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300
                        @endif">
                        {{ ucfirst($transaction->shipping_status) }}
                    </span>
                </div>
            </div>
            <div>
                <h3 class="mb-4 text-xl font-bold dark:text-white">Customer Information</h3>
                <div class="mb-4">
                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Name</p>
                    <p class="text-base font-medium text-gray-900 dark:text-white">{{ $transaction->user->name }}</p>
                </div>
                <div class="mb-4">
                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Email</p>
                    <p class="text-base font-medium text-gray-900 dark:text-white">{{ $transaction->user->email }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Transaction Items -->
    <div class="p-4 bg-white border border-gray-200 rounded-lg shadow-sm 2xl:col-span-2 dark:border-gray-700 sm:p-6 dark:bg-gray-800">
        <h3 class="mb-4 text-xl font-bold dark:text-white">Transaction Items</h3>
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-4 py-3">Product</th>
                        <th scope="col" class="px-4 py-3">Price</th>
                        <th scope="col" class="px-4 py-3">Quantity</th>
                        <th scope="col" class="px-4 py-3">Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($transaction->items as $item)
                    <tr class="border-b dark:border-gray-700">
                        <td class="px-4 py-3">
                            <div class="flex items-center">
                                @if($item->product->image_url)
                                <img src="{{ asset('storage/' . $item->product->image_url) }}" class="w-8 h-8 mr-3 rounded-full" alt="{{ $item->product->name }}">
                                @endif
                                <div>
                                    <p class="font-medium text-gray-900 dark:text-white">{{ $item->product->name }}</p>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">{{ $item->product->category->name }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-4 py-3">${{ number_format($item->price, 2) }}</td>
                        <td class="px-4 py-3">{{ $item->quantity }}</td>
                        <td class="px-4 py-3">${{ number_format($item->price * $item->quantity, 2) }}</td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr class="font-semibold text-gray-900 dark:text-white">
                        <td scope="row" class="px-4 py-3 text-base">Total</td>
                        <td class="px-4 py-3"></td>
                        <td class="px-4 py-3"></td>
                        <td class="px-4 py-3">${{ number_format($transaction->total_amount, 2) }}</td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

    <!-- Action Buttons -->
    <div class="flex justify-end space-x-4">
        <a href="{{ route('admin.transactions.index') }}" class="inline-flex items-center px-5 py-2.5 text-sm font-medium text-center text-white bg-gray-700 rounded-lg focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-900 hover:bg-gray-800">
            Back to Transactions
        </a>
        <button type="button" data-drawer-target="drawer-update-transaction-default" data-drawer-show="drawer-update-transaction-default" aria-controls="drawer-update-transaction-default" data-drawer-placement="right" class="inline-flex items-center px-5 py-2.5 text-sm font-medium text-center text-white bg-yellow-600 rounded-lg focus:ring-4 focus:ring-yellow-200 dark:focus:ring-yellow-900 hover:bg-yellow-700" onclick="editTransaction({{ $transaction->id }})">
            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z"></path><path fill-rule="evenodd" d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z" clip-rule="evenodd"></path></svg>
            Edit Status
        </button>
    </div>
</div>

<!-- Update Transaction Status Drawer -->
<div id="drawer-update-transaction-default" class="fixed top-0 right-0 z-40 w-full h-screen max-w-xs p-4 overflow-y-auto transition-transform translate-x-full bg-white dark:bg-gray-800" tabindex="-1" aria-labelledby="drawer-label" aria-hidden="true">
    <h5 id="drawer-label" class="inline-flex items-center mb-6 text-sm font-semibold text-gray-500 uppercase dark:text-gray-400">Update Transaction Status</h5>
    <button type="button" data-drawer-dismiss="drawer-update-transaction-default" aria-controls="drawer-update-transaction-default" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 absolute top-2.5 right-2.5 inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white">
        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
        <span class="sr-only">Close menu</span>
    </button>
    <form id="updateTransactionForm" method="POST">
        @csrf
        @method('PUT')
        <div class="space-y-4">
            <div>
                <label for="status" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Status</label>
                <select name="status" id="status" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required>
                    <option value="pending">Pending</option>
                    <option value="processing">Processing</option>
                    <option value="shipped">Shipped</option>
                    <option value="completed">Completed</option>
                    <option value="failed">Failed</option>
                    <option value="cancelled">Cancelled</option>
                </select>
            </div>
            <div>
                <label for="payment_status" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Payment Status</label>
                <select name="payment_status" id="payment_status" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required>
                    <option value="pending">Pending</option>
                    <option value="processing">Processing</option>
                    <option value="paid">Paid</option>
                    <option value="failed">Failed</option>
                    <option value="cancelled">Cancelled</option>
                </select>
            </div>
            <div>
                <label for="shipping_status" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Shipping Status</label>
                <select name="shipping_status" id="shipping_status" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required>
                    <option value="pending">Pending</option>
                    <option value="processing">Processing</option>
                    <option value="shipped">Shipped</option>
                    <option value="delivered">Delivered</option>
                    <option value="failed">Failed</option>
                </select>
            </div>
            <div class="bottom-0 left-0 flex justify-center w-full pb-4 space-x-4 md:px-4 md:absolute">
                <button type="submit" class="text-white w-full justify-center bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                    Update Status
                </button>
                <button type="button" data-drawer-dismiss="drawer-update-transaction-default" aria-controls="drawer-update-transaction-default" class="inline-flex w-full justify-center text-gray-500 items-center bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-primary-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">
                    <svg aria-hidden="true" class="w-5 h-5 -ml-1 sm:mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    Cancel
                </button>
            </div>
        </div>
    </form>
</div>

@push('scripts')
<script>
function editTransaction(id) {
    // Fetch transaction data
    fetch(`/admin/transactions/${id}/edit`)
        .then(response => {
            if (!response.ok) {
                console.error('Error fetching transaction data:', response.statusText);
                return Promise.reject('Error fetching transaction data');
            }
            return response.json();
        })
        .then(transaction => {
            console.log('Transaction data received:', transaction);

            // Update form action
            document.getElementById('updateTransactionForm').action = `/admin/transactions/${id}`;
            
            // Fill form fields
            const statusSelect = document.getElementById('status');
            const paymentStatusSelect = document.getElementById('payment_status');
            const shippingStatusSelect = document.getElementById('shipping_status');

            console.log('Status select element:', statusSelect);
            console.log('Payment Status select element:', paymentStatusSelect);
            console.log('Shipping Status select element:', shippingStatusSelect);

            if (statusSelect) {
                statusSelect.value = transaction.status;
                console.log('Status set to:', transaction.status);
            }

            if (paymentStatusSelect && transaction.payment_status !== undefined) {
                const lowerCasePaymentStatus = transaction.payment_status.toLowerCase();
                paymentStatusSelect.value = lowerCasePaymentStatus;
                console.log('Payment Status received:', transaction.payment_status, 'setting to:', lowerCasePaymentStatus);
                
                // Trigger change event to notify Flowbite or other listeners
                const event = new Event('change');
                paymentStatusSelect.dispatchEvent(event);
                console.log('Change event dispatched for Payment Status.');
            } else {
                console.warn('Payment Status element not found or transaction.payment_status is undefined');
            }

            if (shippingStatusSelect) {
                shippingStatusSelect.value = transaction.shipping_status;
                console.log('Shipping Status set to:', transaction.shipping_status);
            }
        })
        .catch(error => {
            console.error('Error in editTransaction:', error);
            // Optionally show an error message to the user
        });
}

// Add status update confirmation with SweetAlert2
document.getElementById('updateTransactionForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    Swal.fire({
        title: 'Update Status?',
        text: "Are you sure you want to update the transaction status?",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, update it!'
    }).then((result) => {
        if (result.isConfirmed) {
            this.submit();
        }
    });
});
</script>
@endpush
@endsection 