<?php

namespace App\Services;

use App\Models\Transaction;
use Midtrans\Config;
use Midtrans\Snap;

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
        $params = [
            'transaction_details' => [
                'order_id' => 'ORDER-' . $transaction->id,
                'gross_amount' => (int) $transaction->total_price,
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

        try {
            $snapToken = Snap::getSnapToken($params);
            return [
                'status' => 'success',
                'snap_token' => $snapToken,
                'redirect_url' => "https://app.midtrans.com/snap/v2/vtweb/{$snapToken}"
            ];
        } catch (\Exception $e) {
            return [
                'status' => 'error',
                'message' => $e->getMessage()
            ];
        }
    }

    private function getItemDetails(Transaction $transaction)
    {
        $items = [];
        
        foreach ($transaction->items as $item) {
            $items[] = [
                'id' => $item->product_id,
                'price' => (int) $item->price,
                'quantity' => $item->quantity,
                'name' => $item->product->name,
            ];
        }

        // Add tax
        $tax = $transaction->total_price * 0.1;
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