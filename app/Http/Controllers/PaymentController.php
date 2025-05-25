<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
{

    public function __construct()
    {

    }
    public function handleCallback(Request $request)
    {
        try {
            Log::info('Midtrans callback received', [
                'headers' => $request->headers->all(),
                'payload' => $request->all()
            ]);
            
            $payload = $request->all();
            
            // Validate payload
            if (!isset($payload['order_id'], $payload['transaction_id'], $payload['transaction_status'], $payload['payment_type'])) {
                throw new \Exception('Invalid callback payload');
            }
            
            // Safely extract order_id
            $orderIdParts = explode('-', $payload['order_id']);
            if (count($orderIdParts) < 2) {
                throw new \Exception('Invalid order_id format');
            }
            $orderId = $orderIdParts[1];
            
            $transaction = Transaction::findOrFail($orderId);
            
            Log::info('Found transaction', [
                'transaction_id' => $transaction->id,
                'current_status' => $transaction->status,
                'current_payment_status' => $transaction->payment_status
            ]);
            
            // Update transaction status based on Midtrans status
            switch ($payload['transaction_status']) {
                case 'capture':
                case 'settlement':
                    $transaction->status = 'success';
                    $transaction->payment_status = 'paid';
                    break;
                case 'pending':
                    $transaction->status = 'pending';
                    $transaction->payment_status = 'unpaid';
                    break;
                case 'deny':
                case 'expire':
                case 'cancel':
                    $transaction->status = 'failed';
                    $transaction->payment_status = 'failed';
                    break;
            }
            
            // Update Midtrans data
            $transaction->update([
                'midtrans_transaction_id' => $payload['transaction_id'],
                'midtrans_transaction_status' => $payload['transaction_status'],
                'midtrans_payment_type' => $payload['payment_type'],
                'midtrans_fraud_status' => $payload['fraud_status'] ?? null,
            ]);
            
            Log::info('Transaction updated', [
                'transaction_id' => $transaction->id,
                'status' => $transaction->status,
                'payment_status' => $transaction->payment_status,
                'midtrans_status' => $payload['transaction_status']
            ]);
            
            return response()->json(['status' => 'success']);
        } catch (\Exception $e) {
            Log::error('Error processing Midtrans callback', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'payload' => $request->all()
            ]);
            
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }
    }
} 