<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Midtrans\Config;
use Midtrans\Notification;

class PaymentController extends Controller
{
    public function __construct()
    {
        // Initialize Midtrans configuration
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
    }

    public function handleCallback(Request $request)
    {
        try {
            // Log the raw request for debugging
            Log::info('Midtrans callback received', [
                'headers' => $request->headers->all(),
                'payload' => $request->all(),
                'ip' => $request->ip()
            ]);
            
            // Log the value of isProduction and the selected IP list
            $isProduction = config('midtrans.is_production');
            Log::info('MIDTRANS_IS_PRODUCTION value', ['is_production' => $isProduction]);

            // Verify the request is coming from Midtrans
            // $allowedIps = $isProduction ? [
            //     // Production IPs
            //     '8.215.30.222',
            //     '147.139.209.49',
            //     '8.215.32.142',
            //     '147.139.163.77',
            //     '8.215.25.24',
            //     '8.215.3.193',
            //     '147.139.210.20',
            //     '149.129.238.95',
            //     '8.215.9.206',
            //     '147.139.134.22',
            //     '149.129.253.222',
            //     '8.215.56.174',
            //     '8.215.27.65',
            //     '147.139.129.139',
            //     '149.129.192.10',
            //     '8.215.15.117',
            //     '149.129.234.6',
            //     '8.215.79.106',
            //     '149.129.192.204',
            //     '8.215.83.17',
            //     '147.139.197.147',
            //     '147.139.207.105',
            //     '147.139.193.191',
            //     '147.139.201.222',
            //     '8.215.82.175',
            //     '149.129.218.45',
            //     '8.215.10.140',
            //     '8.215.83.130',
            //     '147.139.206.209',
            //     '8.215.75.234',
            //     // Added IP from error log
            //     '180.252.209.42',
            //     // Added new IP from latest error log
            //     '34.101.92.69'
            // ] : [
            //     // Sandbox IPs
            //     '149.129.216.115',
            //     '147.139.167.196',
            //     '147.139.179.47',
            //     '147.139.144.184',
            //     '147.139.169.196',
            //     '147.139.168.217',
            //     '8.215.17.96',
            //     '149.129.254.13',
            //     '147.139.203.227',
            //     '147.139.192.94',
            //     '147.139.206.250',
            //     '147.139.213.108',
            //     '8.215.23.167',
            //     '147.139.209.91',
            //     '8.215.21.228',
            //     '147.139.173.83',
            //     '147.139.132.215',
            //     '149.129.227.68',
            //     '149.129.234.77',
            //     '147.139.137.231',
            //     '147.139.180.156',
            //     '8.215.10.65',
            //     '8.215.22.163',
            //     '147.139.215.190',
            //     '8.215.0.89',
            //     '8.215.16.140',
            //     '147.139.165.251',
            //     '147.139.209.83',
            //     '147.139.167.157',
            //     '147.139.192.232',
            //     // Added new IP from latest error log (appears in production logs but might be sent from sandbox)
            //     '34.101.92.69'
            // ];
            
            // if (!in_array($request->ip(), $allowedIps)) {
            //     Log::warning('Unauthorized callback attempt', [
            //         'ip' => $request->ip(),
            //         'payload' => $request->all()
            //     ]);
            //     return response()->json(['status' => 'error', 'message' => 'Unauthorized'], 403);
            // }
            
            // Temporarily bypass IP validation for debugging
            Log::info('IP validation temporarily bypassed.', ['ip' => $request->ip()]);
            
            // Create notification object from request
            $notification = new Notification();
            
            // Log the notification object received
            Log::info('Midtrans notification object received', [
                'order_id' => $notification->order_id,
                'transaction_status' => $notification->transaction_status,
                'payment_type' => $notification->payment_type,
                'fraud_status' => $notification->fraud_status ?? null,
                'gross_amount' => $notification->gross_amount // Added gross_amount for signature verification
            ]);
            
            // Validate payload
            if (!isset($notification->order_id, $notification->transaction_id, $notification->transaction_status, $notification->payment_type, $notification->gross_amount, $notification->signature_key)) {
                Log::error('Invalid callback payload: Missing required fields', ['payload' => $request->all()]);
                return response()->json(['status' => 'error', 'message' => 'Invalid callback payload: Missing required fields'], 400); // Respond with 400 Bad Request for invalid payload
            }

            // Verify Signature Key (Best Practice)
            $hashed = hash('sha512', $notification->order_id . $notification->transaction_status . $notification->gross_amount . config('midtrans.server_key'));
            if ($hashed !== $notification->signature_key) {
                Log::warning('Invalid signature key', [
                    'order_id' => $notification->order_id,
                    'received_signature' => $notification->signature_key,
                    'calculated_signature' => $hashed
                ]);
                return response()->json(['status' => 'error', 'message' => 'Invalid signature key'], 401); // Respond with 401 Unauthorized for invalid signature
            }

            // Safely extract order_id
            $orderIdParts = explode('-', $notification->order_id);
            Log::info('Order ID parts from notification', ['parts' => $orderIdParts, 'full_order_id' => $notification->order_id]);
            
            if (count($orderIdParts) < 2) {
                Log::error('Invalid order_id format', ['order_id' => $notification->order_id]);
                throw new \Exception('Invalid order_id format');
            }
            $orderId = $orderIdParts[1];
            Log::info('Extracted Order ID', ['order_id' => $orderId]);
            
            // Find transaction using find() instead of findOrFail() to avoid 404 exception
            $transaction = Transaction::find($orderId);
            
            if (!$transaction) {
                Log::error('Transaction not found in DB', ['order_id_extracted' => $orderId, 'full_order_id_midtrans' => $notification->order_id]);
                return response()->json(['status' => 'error', 'message' => 'Transaction not found'], 404); // Respond with 404 Not Found if transaction doesn't exist
            }

            Log::info('Found transaction in DB', [
                'transaction_id' => $transaction->id,
                'current_status' => $transaction->status,
                'current_payment_status' => $transaction->payment_status
            ]);
            
            // Update transaction status based on Midtrans status
            switch ($notification->transaction_status) {
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
                'midtrans_transaction_id' => $notification->transaction_id,
                'midtrans_transaction_status' => $notification->transaction_status,
                'midtrans_payment_type' => $notification->payment_type,
                'midtrans_fraud_status' => $notification->fraud_status ?? null,
            ]);
            
            Log::info('Transaction updated', [
                'transaction_id' => $transaction->id,
                'status' => $transaction->status,
                'payment_status' => $transaction->payment_status,
                'midtrans_status' => $notification->transaction_status
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