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
        Schema::create('subcategories', function (Blueprint $table) {
            $table->integer('subCategoryID', 50)->primary();
            $table->string('subCategoryName', 200);
            $table->string('subCategoryImage', 1000);
            $table->string('subCategoryDescription', 1000);
            $table->integer('productCount')->nullable();
            $table->dateTime('subCategoryCreatedDate');
            $table->dateTime('subCategoryModifiedDate');
            $table->integer('categoryID');
            $table->string('categoryName', 50);
            $table->string('subCategorySlug', 50);
            $table->boolean('isActive');
            // Foreign key constraint to link with the 'categories' table
            $table->foreign('categoryID')->references('categoryID')->on('categories')->onDelete('cascade');

            // Laravel timestamps for created_at and updated_at columns
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subcategories');
    }
};
