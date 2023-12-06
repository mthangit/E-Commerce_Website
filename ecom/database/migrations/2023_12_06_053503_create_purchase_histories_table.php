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
        Schema::create('purchase_histories', function (Blueprint $table) {
            $table->integer('historyID', 11)->primary();
            $table->integer('customerID');
            $table->integer('orderID');
            $table->integer('totalPrice');
            $table->string('paymentMethod',200);
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchase_histories');
    }
};

// php artisan migrate --path=database/migrations/2023_12_06_053503_create_purchase_histories_table.php
