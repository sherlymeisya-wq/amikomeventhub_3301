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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();

            // Relasi ke event
            $table->foreignId('event_id')->constrained()->cascadeOnDelete();

            // Data pesanan
            $table->string('order_id')->unique(); // nomor pesanan unik

            // Data customer (guest)
            $table->string('customer_name');
            $table->string('customer_email');
            $table->string('customer_phone');

            // Pembayaran
            $table->integer('total_price');
            $table->string('status')->default('Pending');

            // Midtrans / pembayaran gateway
            $table->string('snap_token')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};