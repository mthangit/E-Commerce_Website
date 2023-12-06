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
        Schema::create('blogs', function (Blueprint $table) {
        // blogID
            //blogTitle
            //blogIntro
            //blogContent
            //blogCreatedDate
            //blogModifiedDate
            $table->integer('blogID', 11)->primary();
            $table->string('blogTitle',200);
            $table->string('blogIntro',200);
            $table->text('blogContent')->nullable();
            $table->dateTime('blogCreatedDate');
            $table->dateTime('blogModifiedDate');
            // slug
            $table->string('blogSlug',200)->nullable();
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blogs');
    }
    // php artisan migrate --path=database/migrations/2023_12_06_052128_create_blogs_table.php
};
