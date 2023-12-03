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
        Schema::create('products', function (Blueprint $table) {
            $table->integer('productID', 11)->primary();
            $table->string('productName', 200);
            $table->integer('productBrandID');
            $table->string('productBrandName', 200);
            $table->integer('productSubCategoryID');
            $table->string('productSubCategoryName', 200);
            $table->integer('productCategoryID');
            $table->string('productCategoryName', 200);
            $table->integer('productOriginalPrice');
            $table->integer('productDiscountPrice');
            $table->text('productInfo');
            $table->string('productBarcode', 50);
            $table->integer('productInStock');
            $table->string('productImage', 1000);
            $table->string('productSideImage1', 1000);
            $table->string('productSideImage2', 1000);
            $table->string('productSideImage3', 1000);
            $table->dateTime('productCreatedDate');
            $table->dateTime('productModifiedDate');
            $table->string('productSlug',50);
            $table->boolean('isFlashSale');
            $table->boolean('isActive');

            // Laravel timestamps for created_at and updated_at columns
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
