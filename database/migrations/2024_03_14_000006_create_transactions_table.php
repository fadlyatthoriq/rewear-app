<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->decimal('total_price', 12, 2);
            $table->enum('status', ['pending', 'paid', 'failed', 'cancelled'])->default('pending');
            $table->string('payment_method', 50)->default('midtrans');
            $table->string('midtrans_order_id', 100)->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}; 