<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('transactions', function (Blueprint $table) {
            $table->string('midtrans_order_id')->nullable()->after('id');
            $table->string('midtrans_payment_token')->nullable()->after('midtrans_order_id');
            $table->string('midtrans_payment_type')->nullable()->after('midtrans_payment_token');
            $table->string('midtrans_transaction_id')->nullable()->after('midtrans_payment_type');
            $table->string('midtrans_transaction_status')->nullable()->after('midtrans_transaction_id');
            $table->string('midtrans_fraud_status')->nullable()->after('midtrans_transaction_status');
            $table->timestamp('payment_expiry')->nullable()->after('midtrans_fraud_status');
            $table->string('midtrans_va_number')->nullable()->after('midtrans_payment_type');
            $table->string('midtrans_bank')->nullable()->after('midtrans_va_number');
            $table->string('midtrans_expiry_time')->nullable()->after('midtrans_bank');
            $table->string('shipping_status')->default('pending')->after('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('transactions', function (Blueprint $table) {
            $table->dropColumn([
                'midtrans_order_id',
                'midtrans_payment_token',
                'midtrans_payment_type',
                'midtrans_transaction_id',
                'midtrans_transaction_status',
                'midtrans_fraud_status',
                'payment_expiry',
                'midtrans_va_number',
                'midtrans_bank',
                'midtrans_expiry_time',
                'shipping_status'
            ]);
        });
    }
};
