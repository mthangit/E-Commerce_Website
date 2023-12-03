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
        Schema::create('categories', function (Blueprint $table) {
            $table->integer('categoryID', 20)->primary();
            $table->string('categoryName', 200);
            $table->string('categorySlug', 200);
            $table->string('categoryImage', 1000);
            $table->string('categoryDescription', 1000);
            $table->integer('subCategoryCount')->nullable();
            $table->integer('productCount')->nullable();
            $table->dateTime('categoryCreatedDate');
            $table->dateTime('categoryModifiedDate');
            $table->boolean('isActive');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
