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
                // Removed payload from initial log to avoid reading the stream twice
                'ip' => $request->ip()
            ]);
            
            // Log the value of isProduction and the selected IP list
            $isProduction = config('midtrans.is_production');
            Log::info('MIDTRANS_IS_PRODUCTION value', ['is_production' => $isProduction]);

            // Get the real client IP, considering proxies like ngrok or load balancers
            $clientIp = $request->header('x-forwarded-for', $request->ip());
            Log::info('Client IP used for validation', ['ip' => $clientIp, 'x-forwarded-for' => $request->header('x-forwarded-for'), 'request_ip' => $request->ip()]);

            // Verify the request is coming from Midtrans
            $allowedIps = $isProduction ? [
                // Production IPs
                '8.215.30.222',
                '147.139.209.49',
                '8.215.32.142',
                '147.139.163.77',
                '8.215.25.24',
                '8.215.3.193',
                '147.139.210.20',
                '149.129.238.95',
                '8.215.9.206',
                '147.139.134.22',
                '149.129.253.222',
                '8.215.56.174',
                '8.215.27.65',
                '147.139.129.139',
                '149.129.192.10',
                '8.215.15.117',
                '149.129.234.6',
                '8.215.79.106',
                '149.129.192.204',
                '8.215.83.17',
                '147.139.197.147',
                '147.139.207.105',
                '147.139.193.191',
                '147.139.201.222',
                '8.215.82.175',
                '149.129.218.45',
                '8.215.10.140',
                '8.215.83.130',
                '147.139.206.209',
                '8.215.75.234',
                // Added IP from error log
                '180.252.209.42',
                // Added new IP from latest error log
                '34.101.92.69'
            ] : [
                // Sandbox IPs
                '149.129.216.115',
                '147.139.167.196',
                '147.139.179.47',
                '147.139.144.184',
                '147.139.169.196',
                '147.139.168.217',
                '8.215.17.96',
                '149.129.254.13',
                '147.139.203.227',
                '147.139.192.94',
                '147.139.206.250',
                '147.139.213.108',
                '8.215.23.167',
                '147.139.209.91',
                '8.215.21.228',
                '147.139.173.83',
                '147.139.132.215',
                '149.129.227.68',
                '149.129.234.77',
                '147.139.137.231',
                '147.139.180.156',
                '8.215.10.65',
                '8.215.22.163',
                '147.139.215.190',
                '8.215.0.89',
                '8.215.16.140',
                '147.139.165.251',
                '147.139.209.83',
                '147.139.167.157',
                '147.139.192.232',
                // Added new IP from latest error log (appears in production logs but might be sent from sandbox)
                '34.101.92.69'
            ];
            
            if (!in_array($clientIp, $allowedIps)) {
                Log::warning('Unauthorized callback attempt', [
                    'ip' => $clientIp,
                    // Payload is not parsed yet at this point
                ]);
                return response()->json(['status' => 'error', 'message' => 'Unauthorized'], 403);
            }

            // Read and parse the raw payload AFTER IP validation
            $rawPayload = $request->getContent();
            Log::info('Raw request payload', ['payload' => $rawPayload]);

            $notificationData = json_decode($rawPayload, true);
            
            // Log the parsed payload
            Log::info('Parsed notification payload', ['data' => $notificationData]);
            
            // Validate payload - check if required keys exist in the parsed array
            $requiredFields = ['order_id', 'transaction_id', 'transaction_status', 'payment_type', 'gross_amount', 'signature_key'];
            foreach ($requiredFields as $field) {
                if (!isset($notificationData[$field])) {
                    Log::error('Invalid callback payload: Missing required field', ['field' => $field, 'payload' => $notificationData]);
                    return response()->json(['status' => 'error', 'message' => 'Invalid callback payload: Missing required field: ' . $field], 400);
                }
            }

            // Verify Signature Key manually (Best Practice)
            $orderId = $notificationData['order_id'];
            $transactionStatus = $notificationData['transaction_status'];
            $statusCode = $notificationData['status_code'];
            $grossAmount = $notificationData['gross_amount'];
            $receivedSignature = $notificationData['signature_key'];
            $serverKey = config('midtrans.server_key');

            // Calculate signature using order_id, status_code, gross_amount, and server_key
            $hashed = hash('sha512', $orderId . $statusCode . $grossAmount . $serverKey);

            if ($hashed !== $receivedSignature) {
                Log::warning('Invalid signature key', [
                    'order_id' => $orderId,
                    'received_signature' => $receivedSignature,
                    'calculated_signature' => $hashed,
                    'data_used' => ['order_id' => $orderId, 'status_code' => $statusCode, 'gross_amount' => $grossAmount, 'server_key' => $serverKey]
                ]);
                return response()->json(['status' => 'error', 'message' => 'Invalid signature key'], 401);
            }

            Log::info('Signature key verification successful.', ['order_id' => $orderId]);

            // Safely extract order_id (still needed if format is ORDER-ID)
            $orderIdParts = explode('-', $orderId);
            Log::info('Order ID parts from notification', ['parts' => $orderIdParts, 'full_order_id' => $orderId]);
            
            if (count($orderIdParts) < 2) {
                Log::error('Invalid order_id format', ['order_id' => $orderId]);
                return response()->json(['status' => 'error', 'message' => 'Invalid order_id format'], 400);
            }
            $extractedOrderId = $orderIdParts[1];
            Log::info('Extracted Order ID for DB search', ['order_id' => $extractedOrderId]);
            
            // Find transaction using find()
            $transaction = Transaction::find($extractedOrderId);
            
            if (!$transaction) {
                Log::error('Transaction not found in DB', ['order_id_extracted' => $extractedOrderId, 'full_order_id_midtrans' => $orderId]);
                return response()->json(['status' => 'error', 'message' => 'Transaction not found'], 404);
            }

            Log::info('Found transaction in DB', [
                'transaction_id' => $transaction->id,
                'current_status' => $transaction->status,
                'current_payment_status' => $transaction->payment_status
            ]);
            
            // Update transaction status based on Midtrans status
            switch ($transactionStatus) {
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
                'midtrans_transaction_id' => $notificationData['transaction_id'],
                'midtrans_transaction_status' => $transactionStatus,
                'midtrans_payment_type' => $notificationData['payment_type'],
                'midtrans_fraud_status' => $notificationData['fraud_status'] ?? null,
            ]);
            
            Log::info('Transaction updated', [
                'transaction_id' => $transaction->id,
                'status' => $transaction->status,
                'payment_status' => $transaction->payment_status,
                'midtrans_status' => $transactionStatus
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