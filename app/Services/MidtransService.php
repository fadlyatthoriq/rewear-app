<?php

namespace App\Services;

use App\Models\Transaction;
use Midtrans\Config;
use Midtrans\Snap;
use Illuminate\Support\Facades\Log;

class MidtransService
{
    public function __construct()
    {
        Config::$serverKey = config('services.midtrans.server_key');
        Config::$isProduction = config('services.midtrans.is_production');
        Config::$isSanitized = true;
        Config::$is3ds = true;
    }

    public function createTransaction(Transaction $transaction)
    {
        try {
            // Validasi konfigurasi
            if (empty(config('services.midtrans.server_key'))) {
                throw new \Exception('Midtrans server key is not configured');
            }

            // Modifikasi ini untuk testing: tambahkan timestamp agar order_id lebih unik
            $uniqueOrderId = 'ORDER-' . $transaction->id . '-' . now()->timestamp; // Tambahkan timestamp

            $params = [
                'transaction_details' => [
                    // Gunakan uniqueOrderId yang baru dibuat
                    'order_id' => $uniqueOrderId,
                    'gross_amount' => (int) $transaction->total_amount,
                ],
                'customer_details' => [
                    'first_name' => $transaction->user->name,
                    'email' => $transaction->user->email,
                    'phone' => $transaction->user->phone,
                ],
                'item_details' => $this->getItemDetails($transaction),
                'expiry' => [
                    'start_time' => date('Y-m-d H:i:s O'),
                    'unit' => 'day',
                    'duration' => 1,
                ],
            ];

            // Log parameters for debugging
            Log::info('Midtrans transaction parameters', $params);

            // Ganti Snap::getSnapToken dan Snap::createTransaction jika menggunakan Snap API
            // Respons dari Midtrans Snap API
            $snapResponse = \Midtrans\Snap::createTransaction($params); // Pastikan namespace sudah benar

            // Pastikan respons berhasil dan memiliki token serta redirect_url
            if (empty($snapResponse) || !isset($snapResponse->token) || !isset($snapResponse->redirect_url)) {
                 Log::error('Midtrans Snap API returned invalid response', ['response' => $snapResponse]);
                 throw new \Exception('Invalid response from Midtrans Snap API');
            }

            return [
                'status' => 'success',
                'snap_token' => $snapResponse->token,
                'redirect_url' => $snapResponse->redirect_url,
                // Simpan order_id yang benar-benar dikirim ke Midtrans
                'order_id' => $uniqueOrderId
            ];
        } catch (\Exception $e) {
            Log::error('Midtrans transaction creation failed', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return [
                'status' => 'error',
                'message' => $e->getMessage()
            ];
        }
    }

    private function getItemDetails(Transaction $transaction)
    {
        $items = [];
        $subtotal = 0;
        
        foreach ($transaction->items as $item) {
            $items[] = [
                'id' => $item->product_id,
                'price' => (int) $item->price,
                'quantity' => $item->quantity,
                'name' => $item->product->name,
            ];
            $subtotal += $item->price * $item->quantity;
        }

        // Hitung pajak dari subtotal (bukan dari total_amount)
        $tax = $subtotal * 0.1;
        $items[] = [
            'id' => 'TAX',
            'price' => (int) $tax,
            'quantity' => 1,
            'name' => 'Tax (10%)',
        ];

        return $items;
    }

    public function handleCallback($notification)
    {
        $notif = new \Midtrans\Notification();
        
        $transaction = $notif->transaction_status;
        $type = $notif->payment_type;
        $orderId = $notif->order_id;
        $fraud = $notif->fraud_status;

        if ($transaction == 'capture') {
            if ($type == 'credit_card') {
                if($fraud == 'challenge') {
                    // TODO: Set payment status in merchant's database to 'challenge'
                } else {
                    // TODO: Set payment status in merchant's database to 'success'
                }
            }
        } else if ($transaction == 'settlement') {
            // TODO: Set payment status in merchant's database to 'success'
        } else if ($transaction == 'pending') {
            // TODO: Set payment status in merchant's database to 'pending'
        } else if ($transaction == 'deny') {
            // TODO: Set payment status in merchant's database to 'failed'
        } else if ($transaction == 'expire') {
            // TODO: Set payment status in merchant's database to 'expired'
        } else if ($transaction == 'cancel') {
            // TODO: Set payment status in merchant's database to 'failed'
        }

        return [
            'status' => $transaction,
            'type' => $type,
            'order_id' => $orderId,
            'fraud_status' => $fraud
        ];
    }
} 