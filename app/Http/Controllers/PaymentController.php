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
            $orderId = explode('-', $payload['order_id'])[1];
            $transaction = Transaction::findOrFail($orderId);
            
            Log::info('Found transaction', [
                'transaction_id' => $transaction->id,
                'current_status' => $transaction->status,
                'current_payment_status' => $transaction->payment_status
            ]);
            
            // Only update Midtrans data
            $transaction->update([
                'midtrans_transaction_id' => $payload['transaction_id'],
                'midtrans_transaction_status' => $payload['transaction_status'],
                'midtrans_payment_type' => $payload['payment_type'],
                'midtrans_fraud_status' => $payload['fraud_status'] ?? null,
            ]);
            
            Log::info('Midtrans data updated', [
                'transaction_id' => $transaction->id,
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