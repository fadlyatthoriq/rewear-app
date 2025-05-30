<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
        // Prioritize failed or cancelled states
        if ($this->status === 'failed' || $this->status === 'cancelled') {
            return ucfirst($this->status);
        }

        if ($this->payment_status === 'failed' || $this->payment_status === 'cancelled') {
            return ucfirst($this->payment_status) . ' Payment';
        }

        if ($this->shipping_status === 'failed') {
            return 'Shipping Failed';
        }

        // Prioritize shipping/delivery status as it's a later stage
        if ($this->shipping_status === 'delivered') {
            return 'Delivered';
        }

        if ($this->shipping_status === 'shipped') {
            return 'Shipped';
        }

        // Then consider processing states
        if ($this->payment_status === 'processing') {
            return 'Payment Processing';
        }

        if ($this->shipping_status === 'processing') {
            return 'Shipping Processing';
        }

        if ($this->status === 'processing') {
            return 'Processing';
        }

        // If payment is paid but shipping is pending, show payment status
        if ($this->payment_status === 'paid') {
             // If payment is paid but shipping is still pending, maybe show 'Payment Confirmed' or similar, 
             // or just let the 'Pending' shipping status take precedence if appropriate for your flow.
             // Based on the image, 'Paid' payment status is shown, so let's reflect that payment is done.
             return 'Payment Confirmed'; // Or 'Paid'
        }

        // If shipping is still pending, this is the most accurate overall status for that stage
        if ($this->shipping_status === 'pending') {
            return 'Pending Shipping'; // Or just 'Pending' if that's the desired initial state name
        }

        // Finally, if none of the above, fall back to the general status
        // This might catch 'completed' or other specific statuses not covered above
        return ucfirst($this->status);
    }
} 