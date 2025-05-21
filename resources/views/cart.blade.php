@extends('layouts.master')

@section('title', 'Cart')

@section('main')
<section class="bg-gradient-to-b from-gray-50 to-white py-4 sm:py-8 antialiased dark:from-gray-900 dark:to-gray-800">
    <div class="mx-auto max-w-screen-xl px-2 sm:px-4 2xl:px-0">
        <h2 class="mb-4 sm:mb-8 text-xl sm:text-2xl font-bold text-gray-900 dark:text-white">Shopping Cart</h2>

        <div class="mt-4 sm:mt-6 md:gap-4 lg:gap-6 lg:flex lg:items-start xl:gap-8">
            <div class="mx-auto w-full flex-none lg:max-w-2xl xl:max-w-4xl">
                <div class="space-y-4 sm:space-y-6" id="cart-items">
                    @forelse($cart as $id => $item)
                    <div class="rounded-lg border border-gray-200 bg-white p-3 sm:p-4 md:p-6 shadow-sm transition-all duration-300 hover:shadow-md dark:border-gray-700 dark:bg-gray-800">
                        <div class="space-y-4 md:flex md:items-center md:justify-between md:gap-4 md:space-y-0">
                            <a href="{{ route('product.show', $id) }}" class="shrink-0 md:order-1">
                                <img src="{{ asset('storage/' . $item->product->image_url) }}" alt="{{ $item->product->name }}" class="w-14 h-14 sm:w-16 sm:h-16 object-cover rounded">
                            </a>

                            <div class="w-full min-w-0 flex-1 space-y-3 sm:space-y-4 md:order-2 md:max-w-md">
                                <a href="{{ route('product.show', $id) }}" class="text-sm sm:text-base font-medium text-gray-900 hover:underline dark:text-white">{{ $item->product->name }}</a>
                                <p class="text-xs sm:text-sm text-gray-500 dark:text-gray-400">Rp. {{ number_format($item->price, 2) }} per item</p>

                                <div class="flex flex-wrap items-center gap-3 sm:gap-4">
                                    <form action="#" method="POST" class="inline">
                                        @csrf
                                        <button type="submit" class="inline-flex items-center text-xs sm:text-sm font-medium text-gray-500 hover:text-gray-900 hover:underline dark:text-gray-400 dark:hover:text-white">
                                            <svg class="me-1 h-4 w-4 sm:h-5 sm:w-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12.01 6.001C6.5 1 1 8 5.782 13.001L12.011 20l6.23-7C23 8 17.5 1 12.01 6.002Z" />
                                            </svg>
                                            Add to Favorites
                                        </button>
                                    </form>

                                    <form action="{{ route('cart.remove', $id) }}" method="POST" class="inline" id="remove-form-{{ $id }}">
                                        @csrf
                                        <button type="button" onclick="confirmRemove({{ $id }})" class="inline-flex items-center text-xs sm:text-sm font-medium text-red-600 hover:underline dark:text-red-500">
                                            <svg class="me-1 h-4 w-4 sm:h-5 sm:w-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18 17.94 6M18 18 6.06 6" />
                                            </svg>
                                            Remove
                                        </button>
                                    </form>
                                </div>
                            </div>

                            <div class="flex items-center justify-between md:order-3 md:justify-end">
                                <div class="flex items-center gap-3 sm:gap-6">
                                    <div class="flex items-center border border-gray-200 rounded-lg dark:border-gray-700">
                                        <button type="button" onclick="updateQuantity({{ $item->product->id }}, 'decrease')" class="inline-flex h-8 w-8 sm:h-10 sm:w-10 shrink-0 items-center justify-center rounded-l-lg border-r border-gray-200 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-primary-100 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-primary-800 transition-colors duration-200">
                                            <svg class="h-3 w-3 sm:h-4 sm:w-4 text-gray-600 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 2">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h16" />
                                            </svg>
                                        </button>
                                        <span id="quantity-{{ $item->product->id }}" class="w-10 sm:w-14 shrink-0 border-0 bg-transparent text-center text-sm sm:text-base font-medium text-gray-900 dark:text-white">{{ $item->quantity }}</span>
                                        <button type="button" onclick="updateQuantity({{ $item->product->id }}, 'increase')" class="inline-flex h-8 w-8 sm:h-10 sm:w-10 shrink-0 items-center justify-center rounded-r-lg border-l border-gray-200 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-primary-100 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-primary-800 transition-colors duration-200">
                                            <svg class="h-3 w-3 sm:h-4 sm:w-4 text-gray-600 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 1v16M1 9h16" />
                                            </svg>
                                        </button>
                                    </div>
                                    <div class="text-end md:w-28 sm:w-32">
                                        <p id="total-{{ $item->product->id }}" class="item-total text-sm sm:text-base font-bold text-gray-900 dark:text-white" data-price="{{ $item->price }}">Rp. {{ number_format($item->price * $item->quantity, 2) }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="text-center py-8 sm:py-12">
                        <svg class="mx-auto h-10 w-10 sm:h-12 sm:w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                        </svg>
                        <h3 class="mt-2 text-sm font-medium text-gray-900 dark:text-white">Your cart is empty</h3>
                        <p class="mt-1 text-xs sm:text-sm text-gray-500 dark:text-gray-400">Start adding some items to your cart</p>
                        <div class="mt-4 sm:mt-6">
                            <a href="{{ route('shop') }}" class="inline-flex items-center rounded-md bg-primary-600 px-3 py-2 text-xs sm:text-sm font-semibold text-white shadow-sm hover:bg-primary-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary-600">
                                Continue Shopping
                                <svg class="ml-2 h-4 w-4 sm:h-5 sm:w-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 12H5m14 0-4 4m4-4-4-4" />
                                </svg>
                            </a>
                        </div>
                    </div>
                    @endforelse
                </div>
            </div>

            <div class="mx-auto mt-4 sm:mt-6 max-w-4xl flex-1 space-y-4 sm:space-y-6 lg:mt-0 lg:w-full">
                <div class="space-y-4 rounded-lg border border-gray-200 bg-white p-4 sm:p-6 shadow-sm dark:border-gray-700 dark:bg-gray-800">
                    <p class="text-lg sm:text-xl font-semibold text-gray-900 dark:text-white">Order summary</p>

                    <div class="space-y-3 sm:space-y-4">
                        <div class="space-y-2">
                            <dl class="flex items-center justify-between gap-4">
                                <dt class="text-sm sm:text-base font-normal text-gray-500 dark:text-gray-400">Original price</dt>
                                <dd id="original-price-summary" class="text-sm sm:text-base font-medium text-gray-900 dark:text-white">Rp. {{ number_format($total, 2) }}</dd>
                            </dl>

                            <dl class="flex items-center justify-between gap-4">
                                <dt class="text-sm sm:text-base font-normal text-gray-500 dark:text-gray-400">Tax (10%)</dt>
                                <dd id="tax-summary" class="text-sm sm:text-base font-medium text-gray-900 dark:text-white">Rp. {{ number_format($total * 0.1, 2) }}</dd>
                            </dl>
                        </div>

                        <dl class="flex items-center justify-between gap-4 border-t border-gray-200 pt-3 sm:pt-4 dark:border-gray-700">
                            <dt class="text-sm sm:text-base font-bold text-gray-900 dark:text-white">Total</dt>
                            <dd id="total-summary" class="text-sm sm:text-base font-bold text-gray-900 dark:text-white">Rp. {{ number_format($total + ($total * 0.1) - ($savings ?? 0), 2) }}</dd>
                        </dl>
                    </div>

                    <a href="{{ route('checkout') }}" class="flex w-full items-center justify-center rounded-lg bg-primary px-4 sm:px-5 py-2.5 sm:py-3.5 text-sm sm:text-base font-semibold text-white shadow-lg hover:bg-primary-600 hover:shadow-xl hover:scale-[1.02] focus:outline-none focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800 transition-all duration-300">
                        <svg class="w-4 h-4 sm:w-5 sm:h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                        Proceed to Checkout
                    </a>

                    <div class="flex items-center justify-center gap-2">
                        <span class="text-xs sm:text-sm font-normal text-gray-500 dark:text-gray-400"> or </span>
                        <a href="{{ route('shop') }}" class="inline-flex items-center gap-1 sm:gap-2 text-xs sm:text-sm font-medium text-primary-700 underline hover:no-underline dark:text-primary-500 transition-all duration-300">
                            Continue Shopping
                            <svg class="h-4 w-4 sm:h-5 sm:w-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 12H5m14 0-4 4m4-4-4-4" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
function confirmRemove(id) {
    Swal.fire({
        title: 'Remove Item',
        text: 'Are you sure you want to remove this item from your cart?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#ef4444',
        cancelButtonColor: '#6b7280',
        confirmButtonText: 'Yes, remove it!',
        cancelButtonText: 'Cancel'
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('remove-form-' + id).submit();
        }
    });
}

function updateQuantity(productId, action) {
    // Get CSRF token from meta tag
    const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    const quantitySpan = document.getElementById('quantity-' + productId);
    const totalElement = document.getElementById('total-' + productId);
    const currentQuantity = parseInt(quantitySpan.textContent);
    
    // Disable both buttons
    const buttons = quantitySpan.parentElement.querySelectorAll('button');
    buttons.forEach(button => button.disabled = true);

    fetch(`/cart/update/${productId}`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': token,
            'Accept': 'application/json',
            'X-Requested-With': 'XMLHttpRequest',
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            action: action,
            quantity: currentQuantity
        })
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.json();
    })
    .then(data => {
        if (data.status === 'success') {
            // Update quantity
            quantitySpan.textContent = data.newQuantity;
            
            // Get the price per item from the data-attribute
            const pricePerItem = parseFloat(totalElement.getAttribute('data-price'));
            
            // Update total price for this item
            const newTotal = pricePerItem * data.newQuantity;
            totalElement.textContent = 'Rp. ' + newTotal.toLocaleString('id-ID', {minimumFractionDigits: 2});

            // Update order summary
            updateOrderSummary();

            // Update cart count in navbar if exists
            const cartCountElement = document.querySelector('.cart-count');
            if (cartCountElement && data.cartCount) {
                cartCountElement.textContent = data.cartCount;
            }
            
            // Show success message
            Swal.fire({
                toast: true,
                position: 'top-end',
                icon: 'success',
                title: data.message || 'Cart updated successfully',
                showConfirmButton: false,
                timer: 3000
            });
        } else {
            // Revert quantity display if update failed
            quantitySpan.textContent = currentQuantity;
            Swal.fire({
                toast: true,
                position: 'top-end',
                icon: 'error',
                title: data.message || 'Failed to update cart',
                showConfirmButton: false,
                timer: 3000
            });
        }
    })
    .catch(error => {
        console.error('Error:', error);
        // Revert quantity display if update failed
        quantitySpan.textContent = currentQuantity;
        Swal.fire({
            toast: true,
            position: 'top-end',
            icon: 'error',
            title: 'Something went wrong',
            showConfirmButton: false,
            timer: 3000
        });
    })
    .finally(() => {
        // Re-enable both buttons
        buttons.forEach(button => button.disabled = false);
    });
}

function updateOrderSummary() {
    // Get all individual cart item containers
    const cartItems = document.querySelectorAll('.rounded-lg.border.border-gray-200');

    let subtotal = 0;

    console.log('Calculating order summary...');

    cartItems.forEach(item => {
        // Within each item, find the quantity span and the total price paragraph
        const quantitySpan = item.querySelector('[id^="quantity-"]');
        const totalElement = item.querySelector('[id^="total-"]');

        if (quantitySpan && totalElement) {
            const quantity = parseInt(quantitySpan.textContent);
            const pricePerItem = parseFloat(totalElement.getAttribute('data-price'));
            
            console.log(`Item: Quantity = ${quantity}, Price per item = ${pricePerItem}`);

            // Add item total to subtotal
            subtotal += pricePerItem * quantity;
        }
    });
    
    console.log(`Subtotal calculated: ${subtotal}`);

    // Calculate tax
    const tax = subtotal * 0.1;
    
    // Calculate final total (assuming no savings for simplicity for now)
    const finalTotal = subtotal + tax;

    console.log(`Tax calculated: ${tax}`);
    console.log(`Final Total calculated: ${finalTotal}`);

    // Get the order summary container
    const orderSummaryContainer = document.querySelector('.space-y-4.rounded-lg.border.border-gray-200');

    if (orderSummaryContainer) {
        // Update the order summary elements within the container
        const originalPriceElement = orderSummaryContainer.querySelector('#original-price-summary');
        const taxElement = orderSummaryContainer.querySelector('#tax-summary');
        const totalElement = orderSummaryContainer.querySelector('#total-summary');

        if (originalPriceElement) {
            originalPriceElement.textContent = 'Rp. ' + subtotal.toLocaleString('id-ID', {minimumFractionDigits: 2});
        }
        if (taxElement) {
            taxElement.textContent = 'Rp. ' + tax.toLocaleString('id-ID', {minimumFractionDigits: 2});
        }
        if (totalElement) {
            totalElement.textContent = 'Rp. ' + finalTotal.toLocaleString('id-ID', {minimumFractionDigits: 2});
        }
        console.log('Order summary elements updated within container.');
    } else {
        console.error('Order summary container not found.');
    }
}
</script>
@endpush
