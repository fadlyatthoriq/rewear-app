@extends('layouts.master')

@section('title', 'Cart')

@section('main')
<section class="bg-gray-100 dark:bg-gray-900 py-6 sm:py-8 lg:py-12 antialiased">
    <div class="mx-auto max-w-screen-xl px-4 sm:px-6 lg:px-8 2xl:px-0">
        <h2 class="mb-6 sm:mb-8 text-2xl sm:text-3xl font-bold text-gray-900 dark:text-white">Shopping Cart</h2>

        <div class="mt-6 md:gap-6 lg:flex lg:items-start xl:gap-8">
            <div class="mx-auto w-full flex-none lg:max-w-2xl xl:max-w-4xl">
                <div class="space-y-4" id="cart-items">
                    @forelse($cart as $item)
                    <div class="rounded-lg border border-gray-200 bg-white p-4 sm:p-6 shadow-sm transition-all duration-300 hover:shadow-md dark:border-gray-700 dark:bg-gray-800">
                        <div class="flex flex-wrap items-center md:justify-between md:gap-6">
                            <a href="{{ route('product.show', $item->product_id) }}" class="shrink-0 w-20 h-20 sm:w-24 sm:h-24 md:w-28 md:h-28 order-1 md:order-none">
                                <img src="{{ $item->product->image }}" alt="{{ $item->product->name }}" class="w-full h-full object-cover rounded-md">
                            </a>

                            <div class="w-full md:w-auto flex-1 min-w-0 space-y-2 md:space-y-3 order-3 md:order-none">
                                <a href="{{ route('product.show', $item->product_id) }}" class="text-base sm:text-lg font-medium text-gray-900 hover:text-primary-700 dark:text-white dark:hover:text-primary-500 transition-colors duration-200 line-clamp-2">{{ $item->product->name }}</a>
                                <p class="text-sm text-gray-500 dark:text-gray-400">Rp. {{ number_format($item->price, 0, ',', '.') }} per item</p>

                                <div class="flex items-center gap-4">
                                    <form action="{{ route('wishlist.add', $item->product_id) }}" method="POST" class="wishlist-form inline">
                                        @csrf
                                        <button type="submit" class="inline-flex items-center text-sm font-medium text-gray-500 hover:text-primary-700 hover:underline dark:text-gray-400 dark:hover:text-primary-500 transition-colors duration-200">
                                            <svg class="me-1 h-4 w-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12.01 6.001C6.5 1 1 8 5.782 13.001L12.011 20l6.23-7C23 8 17.5 1 12.01 6.002Z" />
                                            </svg>
                                            <span class="wishlist-text">Add to Favorites</span>
                                        </button>
                                    </form>

                                    <form action="{{ route('cart.remove', $item->product_id) }}" method="POST" class="inline" id="remove-form-{{ $item->product_id }}">
                                        @csrf
                                        <button type="button" onclick="confirmRemove({{ $item->product_id }})" class="inline-flex items-center text-sm font-medium text-red-600 hover:text-red-700 hover:underline dark:text-red-500 dark:hover:text-red-600 transition-colors duration-200">
                                            <svg class="me-1 h-4 w-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18 17.94 6M18 18 6.06 6" />
                                            </svg>
                                            Remove
                                        </button>
                                    </form>
                                </div>
                            </div>

                            <div class="w-auto md:w-auto flex items-center justify-between md:order-none order-2 mt-4 md:mt-0">
                                <div class="flex items-center border border-gray-300 rounded-lg dark:border-gray-600">
                                    <button type="button" onclick="updateQuantity({{ $item->product_id }}, 'decrease')" class="inline-flex h-8 w-8 sm:h-9 sm:w-9 shrink-0 items-center justify-center rounded-l-lg text-gray-900 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-100 dark:text-white dark:hover:bg-gray-700 dark:focus:ring-gray-700 transition-colors duration-200">
                                        <svg class="h-2.5 w-2.5 sm:h-3 sm:w-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 2">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h16" />
                                        </svg>
                                    </button>
                                    <span id="quantity-{{ $item->product_id }}" class="w-9 sm:w-12 shrink-0 border-0 bg-transparent text-center text-sm sm:text-base font-medium text-gray-900 dark:text-white">{{ $item->quantity }}</span>
                                    <button type="button" onclick="updateQuantity({{ $item->product_id }}, 'increase')" class="inline-flex h-8 w-8 sm:h-9 sm:w-9 shrink-0 items-center justify-center rounded-r-lg text-gray-900 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-100 dark:text-white dark:hover:bg-gray-700 dark:focus:ring-gray-700 transition-colors duration-200">
                                        <svg class="h-2.5 w-2.5 sm:h-3 sm:w-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 1v16M1 9h16" />
                                        </svg>
                                    </button>
                                </div>
                                <div class="text-end w-28 sm:w-36 ml-4">
                                    <p id="total-{{ $item->product_id }}" class="item-total text-base sm:text-lg font-bold text-gray-900 dark:text-white" data-price="{{ $item->price }}">Rp. {{ number_format($item->price * $item->quantity, 0, ',', '.') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="text-center py-12 rounded-lg border border-gray-200 bg-white shadow-sm dark:border-gray-700 dark:bg-gray-800">
                        <svg class="mx-auto h-16 w-16 text-gray-400 dark:text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                        </svg>
                        <h3 class="mt-4 text-lg font-medium text-gray-900 dark:text-white">Your cart is empty</h3>
                        <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">Start adding some items to your cart</p>
                        <div class="mt-6">
                            <a href="{{ route('shop') }}" class="inline-flex items-center px-6 py-3 rounded-md bg-primary text-white font-semibold shadow-md hover:bg-primary-700 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary-600 transition-colors duration-200">
                                <svg class="mr-2 h-5 w-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 12H5m14 0-4 4m4-4-4-4" />
                                </svg>
                                Continue Shopping
                            </a>
                        </div>
                    </div>
                    @endforelse
                </div>
            </div>

            <div class="mx-auto w-full flex-none lg:max-w-xs mt-6 lg:mt-0">
                <div class="space-y-4 rounded-lg border border-gray-200 bg-white p-4 sm:p-6 shadow-sm dark:border-gray-700 dark:bg-gray-800 sticky top-6">
                    <p class="text-xl font-semibold text-gray-900 dark:text-white">Order summary</p>

                    <div class="space-y-4">
                        <div class="space-y-2">
                            <dl class="flex items-center justify-between gap-4">
                                <dt class="text-base font-normal text-gray-500 dark:text-gray-400">Original price</dt>
                                <dd id="original-price-summary" class="text-base font-medium text-gray-900 dark:text-white">Rp. {{ number_format($total, 0, ',', '.') }}</dd>
                            </dl>

                            <dl class="flex items-center justify-between gap-4">
                                <dt class="text-base font-normal text-gray-500 dark:text-gray-400">Tax (10%)</dt>
                                <dd id="tax-summary" class="text-base font-medium text-gray-900 dark:text-white">Rp. {{ number_format($total * 0.1, 0, ',', '.') }}</dd>
                            </dl>
                            {{-- You can add a section for Savings/Discount here if applicable --}}
                            {{-- 
                            <dl class="flex items-center justify-between gap-4">
                                <dt class="text-base font-normal text-green-600">Savings</dt>
                                <dd class="text-base font-medium text-green-600">- Rp. {{ number_format($savings ?? 0, 0, ',', '.') }}</dd>
                            </dl>
                            --}}
                        </div>

                        <dl class="flex items-center justify-between gap-4 border-t border-gray-200 pt-4 dark:border-gray-700">
                            <dt class="text-lg font-bold text-gray-900 dark:text-white">Total</dt>
                            <dd id="total-summary" class="text-lg font-bold text-gray-900 dark:text-white">Rp. {{ number_format($total + ($total * 0.1) - ($savings ?? 0), 0, ',', '.') }}</dd>
                        </dl>
                    </div>

                    <a href="{{ route('checkout') }}" class="flex w-full items-center justify-center rounded-lg bg-primary px-5 py-2.5 text-base font-semibold text-white shadow-md hover:bg-primary-700 transition-colors duration-200">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                        Proceed to Checkout
                    </a>

                    <div class="flex items-center justify-center gap-2">
                        <span class="text-sm font-normal text-gray-500 dark:text-gray-400"> or </span>
                        <a href="{{ route('shop') }}" class="inline-flex items-center gap-1 text-sm font-medium text-primary-700 underline hover:no-underline dark:text-primary-500 transition-colors duration-200">
                            Continue Shopping
                            <svg class="h-4 w-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
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
            const form = document.getElementById('remove-form-' + id);
            
            // Show loading state
            Swal.fire({
                title: 'Removing item...',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });

            fetch(form.action, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: new FormData(form)
            })
            .then(response => {
                // Check for 401 Unauthorized specifically
                if (response.status === 401) {
                    Swal.fire({
                        toast: true,
                        position: 'top-end',
                        icon: 'warning',
                        title: 'Please login first to manage your cart',
                        showConfirmButton: false,
                        timer: 3000
                    });
                    return Promise.reject('Unauthorized');
                }

                // Try to parse response as JSON
                return response.text().then(text => {
                    try {
                        return JSON.parse(text);
                    } catch (e) {
                        // If response is not JSON, check if it's a redirect
                        if (text.includes('<!DOCTYPE html>')) {
                            // Session expired or other server-side redirect
                            window.location.reload();
                            return Promise.reject('Session expired');
                        }
                        throw new Error('Invalid response format');
                    }
                });
            })
            .then(data => {
                if (data.status === 'success') {
                    // Remove the item from the DOM
                    const itemElement = document.getElementById('remove-form-' + id).closest('.rounded-lg');
                    if (itemElement) {
                        itemElement.remove();
                    }

                    // Update cart count in navbar
                    const cartCountElement = document.querySelector('.cart-count');
                    if (cartCountElement && data.cartCount) {
                        cartCountElement.textContent = data.cartCount;
                    }

                    // Update order summary
                    updateOrderSummary();

                    // Show success message
                    Swal.fire({
                        toast: true,
                        position: 'top-end',
                        icon: 'success',
                        title: data.message || 'Item removed successfully',
                        showConfirmButton: false,
                        timer: 3000
                    });

                    // If cart is empty, reload the page to show empty state
                    if (data.cartCount === 0) {
                        window.location.reload();
                    }
                } else {
                    throw new Error(data.message || 'Failed to remove item');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                
                // Don't show error for session expired as we're reloading
                if (error !== 'Session expired' && error !== 'Unauthorized') {
                    Swal.fire({
                        toast: true,
                        position: 'top-end',
                        icon: 'error',
                        title: error.message || 'Something went wrong. Please try again.',
                        showConfirmButton: false,
                        timer: 3000
                    });
                }
            });
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
            totalElement.textContent = 'Rp. ' + newTotal.toLocaleString('id-ID', {minimumFractionDigits: 0}); // Changed to 0 decimal places

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
            originalPriceElement.textContent = 'Rp. ' + subtotal.toLocaleString('id-ID', {minimumFractionDigits: 0}); // Changed to 0 decimal places
        }
        if (taxElement) {
            taxElement.textContent = 'Rp. ' + tax.toLocaleString('id-ID', {minimumFractionDigits: 0}); // Changed to 0 decimal places
        }
        if (totalElement) {
            totalElement.textContent = 'Rp. ' + finalTotal.toLocaleString('id-ID', {minimumFractionDigits: 0}); // Changed to 0 decimal places
        }
        console.log('Order summary elements updated within container.');
    } else {
        console.error('Order summary container not found.');
    }
}

// Handle wishlist forms
document.querySelectorAll('.wishlist-form').forEach(form => {
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        
        fetch(this.action, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Accept': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            },
            body: new FormData(this)
        })
        .then(response => {
            // Check for 401 Unauthorized specifically
            if (response.status === 401) {
                Swal.fire({
                    toast: true,
                    position: 'top-end',
                    icon: 'warning',
                    title: 'Please login first to add items to wishlist',
                    showConfirmButton: false,
                    timer: 3000
                });
                return Promise.reject('Unauthorized');
            }

            if (!response.ok) {
                return response.json().then(data => {
                    // Handle JSON errors returned by server
                    Swal.fire({
                        toast: true,
                        position: 'top-end',
                        icon: 'error',
                        title: data.message || 'Something went wrong! Please try again.',
                        showConfirmButton: false,
                        timer: 3000
                    });
                    throw new Error(data.message || 'Something went wrong!');
                }).catch(() => {
                    // Handle non-JSON errors or network issues
                    throw new Error('Network response was not ok');
                });
            }
            return response.json();
        })
        .then(data => {
            // Update wishlist count in navbar
            const wishlistCountElement = document.querySelector('a[href*="wishlist"] span');
            if (data.wishlistCount > 0) {
                if (wishlistCountElement) {
                    wishlistCountElement.textContent = data.wishlistCount;
                } else {
                    const wishlistLink = document.querySelector('a[href*="wishlist"]');
                    const countSpan = document.createElement('span');
                    countSpan.className = 'absolute -top-2 -right-2 bg-primary text-white text-xs rounded-full w-5 h-5 flex items-center justify-center shadow';
                    countSpan.textContent = data.wishlistCount;
                    wishlistLink.appendChild(countSpan);
                }
            }

            // Update button state
            const button = this.querySelector('button');
            const icon = button.querySelector('svg');
            const textSpan = button.querySelector('.wishlist-text');
            
            if (data.action === 'added') {
                // Change to remove from wishlist
                // This line is incorrect, the action URL should be for removing
                // this.action = this.action.replace('add', 'remove'); 
                icon.classList.add('text-primary-700'); // Use text-primary-700 for added state
                icon.classList.remove('text-gray-500'); // Remove gray color
                textSpan.textContent = 'Remove from Favorites';
            } else {
                // Change to add to wishlist
                // This line is incorrect, the action URL should be for adding
                // this.action = this.action.replace('remove', 'add');
                 icon.classList.remove('text-primary-700'); // Remove primary color
                icon.classList.add('text-gray-500'); // Add gray color
                textSpan.textContent = 'Add to Favorites';
            }
            
            // Note: The form's action URL needs to be dynamically updated based on whether the item is in the wishlist or not
            // This requires the server to send back the correct URL for the next action or a flag indicating current wishlist status.
            // For now, the button text and icon color will change, but the form submission might not perform the correct action without URL update.
            // A more robust solution would involve the server response including the updated state and potentially the correct form action URL.

            // Show success message
            Swal.fire({
                toast: true,
                position: 'top-end',
                icon: 'success',
                title: data.message, 
                showConfirmButton: false,
                timer: 3000
            });
        })
        .catch(error => {
            console.error('Error:', error);
            // Only show generic error for non-unauthorized issues
            if (error !== 'Unauthorized') {
                Swal.fire({
                    toast: true,
                    position: 'top-end',
                    icon: 'error',
                    title: 'Something went wrong! Please try again.',
                    showConfirmButton: false,
                    timer: 3000
                });
            }
        });
    });
});
</script>
@endpush
