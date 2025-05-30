@extends('layouts.master')

@section('title', 'Payment Status')

@section('main')
<div class="container">
    @if ($transaction && $transaction->payment_status === 'paid')
        <h1 class="text-success">Payment Successful!</h1>
        <p>Thank you for your payment.</p>
        <p>Your order ID is: <strong>{{ $transaction->id }}</strong></p>
        {{-- You can display more details here from the transaction object --}}
        {{-- <p>Midtrans Transaction ID: {{ $transaction->midtrans_transaction_id }}</p> --}}
        {{-- <p>Midtrans Status: {{ $transaction->midtrans_transaction_status }}</p> --}}
        
        <a href="{{ route('my-orders.show', $transaction->id) }}" class="btn btn-primary">View Order Details</a>
    @else
        <h1 class="text-danger">Payment Failed!</h1>
        <p>There was an issue processing your payment.</p>
        @if($transaction)
            <p>Order ID: <strong>{{ $transaction->id }}</strong></p>
            <p>Status: {{ $transaction->payment_status }}</p>
        @endif
        <p>Please check your order history for more details or try again.</p>
        <a href="{{ route('my-orders') }}" class="btn btn-secondary">View My Orders</a>
        {{-- Optionally, add a link to retry payment if applicable --}}
        {{-- <a href="{{ route('checkout') }}" class="btn btn-primary">Try Again</a> --}}
    @endif
</div>
@endsection
