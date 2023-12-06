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
        Schema::create('order_details', function (Blueprint $table) {
            $table->integer('orderDetailID', 11)->primary();
            $table->integer('orderID');
            $table->integer('productID');
            $table->string('productName', 200);
            $table->integer('productPrice');
            $table->integer('productQuantity');
            $table->integer('productTotalPrice');
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_details');
    }
};
// php artisan migrate --path=database/migrations/2023_12_06_051743_create_order_details_table.php
