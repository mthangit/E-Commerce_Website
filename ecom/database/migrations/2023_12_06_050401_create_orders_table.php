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
        Schema::create('orders', function (Blueprint $table) {
            $table->integer('orderID', 50)->primary();
            $table->integer('customerID')->nullable();
            $table->integer('totalPrice');
            $table->integer('shippingFee');
            // discount
            $table->integer('discountID')->nullable();
            $table->string('discountCode', 200)->nullable();
            $table->string('discountPrice', 200)->nullable();
            // grand price
            $table->integer('grandPrice');
            // payment method
            $table->string('paymentMethod', 200)->nullable();
            // created date
            $table->dateTime('orderCreatedDate');
            // completed date
            $table->dateTime('orderCompletedDate')->nullable();
            // province id
            $table->integer('orderProvinceID')->nullable();
            // address
            $table->string('orderAddress', 200)->nullable();
            // phone
            $table->string('orderPhone', 200)->nullable();
            // payment status - enum paid, unpaid
            $table->enum('paymentStatus', ['paid', 'unpaid'])->default('unpaid');
            // order status - enum pending, processing, completed, cancelled
            $table->enum('orderStatus', ['pending', 'processing', 'completed', 'cancelled'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};

// php artisan migrate --path=database/migrations/2023_12_06_050401_create_orders_table.php
