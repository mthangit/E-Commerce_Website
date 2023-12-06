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
        Schema::create('customer_infos', function (Blueprint $table) {
            $table->integer('customerID', 11)->primary();
            $table->integer('userID');
            $table->string('customerName',200);
            $table->string('customerPhone',200);
            $table->string('customerEmail',200);
            $table->integer('customerProvinceID');
            $table->string('customerAddress',200);
            $table->boolean('customerStatus')->default(1);
            $table->dateTime('customerJoinDate');
            // column quantity of order
            $table->integer('customerOrderQuantity')->default(0);
            // customer Account Bank
            $table->string('customerBankAccount',200)->nullable();
            $table->string('customerBankName',200)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customer_infos');
    }
};

// php artisan migrate --path=database/migrations/2023_12_06_044437_create_customer_infos_table.php
