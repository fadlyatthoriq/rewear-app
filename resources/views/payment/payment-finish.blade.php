@extends('layouts.master')

@section('title', 'Payment Status')

@section('main')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-body text-center p-5">
                    @if(isset($message))
                        {{-- Error Message Display --}}
                        <div class="mb-4">
                            <i class="fas fa-exclamation-circle text-warning" style="font-size: 4rem;"></i>
                        </div>
                        <h1 class="text-warning mb-4">Payment Information</h1>
                        <div class="alert alert-warning bg-light border-warning">
                            <p class="mb-0">{{ $message }}</p>
                        </div>
                        <div class="mt-4">
                            <a href="{{ route('my-orders') }}" class="btn btn-secondary btn-lg px-5">
                                <i class="fas fa-list me-2"></i>View My Orders
                            </a>
                        </div>
                    @elseif ($transaction)
                        @if ($transaction->payment_status === 'paid')
                            {{-- Success Case --}}
                            <div class="mb-4">
                                <i class="fas fa-check-circle text-success" style="font-size: 4rem;"></i>
                            </div>
                            <h1 class="text-success mb-4">Payment Successful!</h1>
                            <div class="alert alert-success bg-light border-success">
                                <p class="mb-2">Thank you for your payment.</p>
                                <p class="mb-0">Your order ID is: <strong>{{ $transaction->id }}</strong></p>
                                @if($transaction->midtrans_transaction_id)
                                    <p class="mb-0 mt-2">Transaction ID: <strong>{{ $transaction->midtrans_transaction_id }}</strong></p>
                                @endif
                            </div>
                            
                            <div class="mt-4">
                                <a href="{{ route('my-orders.show', $transaction->id) }}" class="btn btn-primary btn-lg px-5">
                                    <i class="fas fa-shopping-bag me-2"></i>View Order Details
                                </a>
                            </div>
                        @elseif ($transaction->payment_status === 'pending')
                            {{-- Pending Case --}}
                            <div class="mb-4">
                                <i class="fas fa-clock text-warning" style="font-size: 4rem;"></i>
                            </div>
                            <h1 class="text-warning mb-4">Payment Pending</h1>
                            <div class="alert alert-warning bg-light border-warning">
                                <p class="mb-2">Your payment is being processed.</p>
                                <p class="mb-0">Order ID: <strong>{{ $transaction->id }}</strong></p>
                                @if($transaction->midtrans_transaction_id)
                                    <p class="mb-0 mt-2">Transaction ID: <strong>{{ $transaction->midtrans_transaction_id }}</strong></p>
                                @endif
                            </div>
                            
                            <div class="mt-4">
                                <a href="{{ route('my-orders.show', $transaction->id) }}" class="btn btn-warning btn-lg px-5 me-3">
                                    <i class="fas fa-sync me-2"></i>Check Status
                                </a>
                                <a href="{{ route('my-orders') }}" class="btn btn-secondary btn-lg px-5">
                                    <i class="fas fa-list me-2"></i>View My Orders
                                </a>
                            </div>
                        @else
                            {{-- Failed Case --}}
                            <div class="mb-4">
                                <i class="fas fa-times-circle text-danger" style="font-size: 4rem;"></i>
                            </div>
                            <h1 class="text-danger mb-4">Payment Failed!</h1>
                            <div class="alert alert-danger bg-light border-danger">
                                <p class="mb-2">There was an issue processing your payment.</p>
                                <p class="mb-1">Order ID: <strong>{{ $transaction->id }}</strong></p>
                                <p class="mb-0">Status: <span class="badge bg-danger">{{ $transaction->payment_status }}</span></p>
                                @if($transaction->midtrans_transaction_id)
                                    <p class="mb-0 mt-2">Transaction ID: <strong>{{ $transaction->midtrans_transaction_id }}</strong></p>
                                @endif
                            </div>
                            
                            <div class="mt-4">
                                <a href="{{ route('my-orders') }}" class="btn btn-secondary btn-lg px-5 me-3">
                                    <i class="fas fa-list me-2"></i>View My Orders
                                </a>
                                <a href="{{ route('checkout') }}" class="btn btn-primary btn-lg px-5">
                                    <i class="fas fa-redo me-2"></i>Try Again
                                </a>
                            </div>
                        @endif
                    @else
                        {{-- Fallback Error Case --}}
                        <div class="mb-4">
                            <i class="fas fa-exclamation-triangle text-danger" style="font-size: 4rem;"></i>
                        </div>
                        <h1 class="text-danger mb-4">Error</h1>
                        <div class="alert alert-danger bg-light border-danger">
                            <p class="mb-0">Unable to process payment information. Please contact support.</p>
                        </div>
                        <div class="mt-4">
                            <a href="{{ route('my-orders') }}" class="btn btn-secondary btn-lg px-5">
                                <i class="fas fa-list me-2"></i>View My Orders
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    .card {
        border-radius: 15px;
        border: none;
    }
    .alert {
        border-radius: 10px;
    }
    .btn {
        border-radius: 8px;
        transition: all 0.3s ease;
    }
    .btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }
    .badge {
        font-size: 0.9em;
        padding: 0.5em 1em;
    }
</style>
@endpush
@endsection
