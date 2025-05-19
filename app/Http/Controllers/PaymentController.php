<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Services\MidtransService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
{
    protected $midtransService;

    public function __construct(MidtransService $midtransService)
    {
        $this->midtransService = $midtransService;
        // Exclude callback route from CSRF protection
        $this->middleware('web')->except('handleCallback');
    }

    public function createPayment(Request $request)
    {
        try {
            Log::info('Creating payment', ['request' => $request->all()]);
            
            $transaction = Transaction::findOrFail($request->transaction_id);
            
            // Check if transaction is already paid
            if ($transaction->status === 'paid') {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Transaction is already paid'
                ], 400);
            }
            
            $result = $this->midtransService->createTransaction($transaction);
            
            if ($result['status'] === 'success') {
                // Update transaction with Midtrans data
                $transaction->update([
                    'midtrans_order_id' => 'ORDER-' . $transaction->id,
                    'midtrans_payment_token' => $result['snap_token'],
                    'payment_expiry' => now()->addDay(), // 24 hours expiry
                ]);
                
                Log::info('Payment created successfully', [
                    'transaction_id' => $transaction->id,
                    'midtrans_order_id' => $transaction->midtrans_order_id
                ]);
                
                return response()->json([
                    'status' => 'success',
                    'redirect_url' => $result['redirect_url']
                ]);
            }

            Log::error('Failed to create payment', [
                'transaction_id' => $transaction->id,
                'error' => $result['message']
            ]);

            return response()->json([
                'status' => 'error',
                'message' => $result['message']
            ], 500);
        } catch (\Exception $e) {
            Log::error('Payment creation failed', [
                'error' => $e->getMessage(),
                'transaction_id' => $request->transaction_id,
                'trace' => $e->getTraceAsString()
            ]);
            
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to create payment. Please try again.'
            ], 500);
        }
    }

    public function handleCallback(Request $request)
    {
        try {
            Log::info('Midtrans callback received', $request->all());
            
            $payload = $request->all();
            $orderId = explode('-', $payload['order_id'])[1];
            $transaction = Transaction::findOrFail($orderId);
            
            // Update transaction with Midtrans data
            $transaction->update([
                'midtrans_transaction_id' => $payload['transaction_id'],
                'midtrans_transaction_status' => $payload['transaction_status'],
                'midtrans_payment_type' => $payload['payment_type'],
                'midtrans_fraud_status' => $payload['fraud_status'] ?? null,
            ]);
            
            // Map Midtrans status to your application status
            switch ($payload['transaction_status']) {
                case 'capture':
                case 'settlement':
                    $transaction->status = 'paid';
                    break;
                case 'pending':
                    $transaction->status = 'pending';
                    break;
                case 'deny':
                case 'cancel':
                case 'expire':
                    $transaction->status = 'failed';
                    break;
            }
            
            $transaction->save();
            
            Log::info('Transaction status updated', [
                'transaction_id' => $transaction->id,
                'status' => $transaction->status,
                'midtrans_status' => $payload['transaction_status']
            ]);
            
            return response()->json(['status' => 'success']);
        } catch (\Exception $e) {
            Log::error('Callback handling failed', [
                'error' => $e->getMessage(),
                'payload' => $request->all(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to process callback'
            ], 500);
        }
    }
} 