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
        Schema::create('discounts', function (Blueprint $table) {
            $table->integer('discountID', 11)->primary();
            $table->string('discountCode',200);
            $table->string('discountName',200);
            $table->text('discountDescription')->nullable();
            $table->integer('discountQuantity')->default(0);
            $table->integer('discountUsed')->default(0);
            $table->enum('discountType', ['percent', 'fixed'])->default('fixed');
            $table->double('discountAmount', 10, 2)->nullable();
            $table->boolean('isActive')->default(1);
            $table->dateTime('discountStart')->nullable();
            $table->dateTime('discountEnd')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('discounts');
    }
};
