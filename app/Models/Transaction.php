<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'total_amount',
        'payment_method',
        'delivery_method',
        'status',
        'payment_status',
        'shipping_status',
        'midtrans_transaction_id',
        'midtrans_transaction_status',
        'midtrans_payment_type',
        'midtrans_va_number',
        'midtrans_bank',
        'midtrans_expiry_time'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasMany(TransactionItem::class);
    }

    // Accessor to get the overall status of the transaction
    public function getOverallStatusAttribute()
    {
        if ($this->status === 'failed' || $this->status === 'cancelled') {
            return ucfirst($this->status);
        }

        if ($this->payment_status === 'failed' || $this->payment_status === 'cancelled') {
            return ucfirst($this->payment_status) . ' Payment';
        }

        if ($this->shipping_status === 'failed') {
            return 'Shipping Failed';
        }

        if ($this->shipping_status === 'delivered') {
            return 'Delivered';
        }

        if ($this->shipping_status === 'shipped') {
            return 'Shipped';
        }

        if ($this->payment_status === 'processing') {
            return 'Payment Processing';
        }

        if ($this->shipping_status === 'processing') {
            return 'Shipping Processing';
        }

        if ($this->status === 'processing') {
            return 'Processing';
        }

        if ($this->status === 'completed') {
            return 'Completed';
        }

        // Default to transaction status if none of the above match
        return ucfirst($this->status);
    }
} 