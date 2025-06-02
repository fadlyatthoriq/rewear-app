<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Midtrans\Config;
use Midtrans\Notification;
use App\Services\NotificationService;
use Illuminate\Support\Facades\Validator;
use Midtrans\Midtrans;

class PaymentController extends Controller
{
    protected $notificationService;

    public function __construct(NotificationService $notificationService)
    {
        // Initialize Midtrans configuration
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        $this->notificationService = $notificationService;
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
            
            // Create notification for admin about new order
            $this->notificationService->createAdminCheckoutNotification($transaction->order);
            
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

    public function createPayment(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'transaction_id' => 'required|exists:transactions,id',
            'payment_method' => 'required|in:bank_transfer,credit_card,e_wallet',
            'bank' => 'required_if:payment_method,bank_transfer|string|in:bca,bni,mandiri,bri',
            'card_number' => 'required_if:payment_method,credit_card|string|regex:/^[0-9]{16}$/',
            'card_expiry' => 'required_if:payment_method,credit_card|string|regex:/^(0[1-9]|1[0-2])\/([0-9]{2})$/',
            'card_cvv' => 'required_if:payment_method,credit_card|string|regex:/^[0-9]{3,4}$/',
            'e_wallet_type' => 'required_if:payment_method,e_wallet|string|in:gopay,ovo,dana,linkaja',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $transaction = Transaction::with(['user', 'items.product'])
                ->findOrFail($request->transaction_id);

            // Verify transaction ownership
            if ($transaction->user_id !== auth()->id()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Unauthorized access to transaction'
                ], 403);
            }

            // Verify transaction status
            if ($transaction->status !== 'pending') {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Invalid transaction status'
                ], 400);
            }

            // Sanitize sensitive data
            $paymentData = [
                'transaction_details' => [
                    'order_id' => $transaction->id,
                    'gross_amount' => (int) $transaction->total_amount
                ],
                'customer_details' => [
                    'first_name' => $transaction->user->name,
                    'email' => $transaction->user->email,
                    'phone' => $transaction->user->phone
                ],
                'item_details' => $transaction->items->map(function ($item) {
                    return [
                        'id' => $item->product_id,
                        'price' => (int) $item->price,
                        'quantity' => $item->quantity,
                        'name' => $item->product->name
                    ];
                })->toArray()
            ];

            // Add payment method specific data
            switch ($request->payment_method) {
                case 'bank_transfer':
                    $paymentData['bank_transfer'] = [
                        'bank' => $request->bank
                    ];
                    break;
                case 'credit_card':
                    // Only send last 4 digits to Midtrans
                    $paymentData['credit_card'] = [
                        'card_number' => substr($request->card_number, -4),
                        'expiry_month' => explode('/', $request->card_expiry)[0],
                        'expiry_year' => '20' . explode('/', $request->card_expiry)[1],
                        'cvv' => '***'
                    ];
                    break;
                case 'e_wallet':
                    $paymentData['e_wallet'] = [
                        'type' => $request->e_wallet_type
                    ];
                    break;
            }

            // Log payment attempt
            Log::info('Payment attempt', [
                'transaction_id' => $transaction->id,
                'user_id' => auth()->id(),
                'payment_method' => $request->payment_method,
                'amount' => $transaction->total_amount
            ]);

            $snapToken = Midtrans::getSnapToken($paymentData);

            return response()->json([
                'status' => 'success',
                'snap_token' => $snapToken
            ]);

        } catch (\Exception $e) {
            Log::error('Payment creation failed', [
                'error' => $e->getMessage(),
                'transaction_id' => $request->transaction_id,
                'user_id' => auth()->id()
            ]);

            return response()->json([
                'status' => 'error',
                'message' => 'Payment creation failed'
            ], 500);
        }
    }

    public function finishPayment(Request $request)
    {
        // This method will be called after the user finishes the payment on Midtrans side
        // The request will contain payment status information from Midtrans via GET parameters

        $orderId = $request->input('order_id');

        // Safely extract order_id (still needed if format is ORDER-ID)
        $orderIdParts = explode('-', $orderId);

        if (count($orderIdParts) < 2) {
            Log::error('Invalid order_id format in finishPayment', ['order_id' => $orderId]);
            // Redirect to an error page or show a generic message
            return view('payment.payment-finish', ['message' => 'Invalid order ID format.']); // Assuming a payment-fail view exists
        }
        $extractedOrderId = $orderIdParts[1];

        // Find transaction using the extracted order ID
        $transaction = Transaction::find($extractedOrderId);

        if (!$transaction) {
            Log::error('Transaction not found in DB in finishPayment', ['order_id_extracted' => $extractedOrderId, 'full_order_id_midtrans' => $orderId]);
            // Redirect to an error page or show a generic message
            return view('payment.payment-finish', ['message' => 'Transaction not found.']); // Assuming a payment-fail view exists
        }

        // Pass the transaction object to the view
        return view('payment.payment-finish', ['transaction' => $transaction]);
    }
} 