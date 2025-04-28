<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('article_categories', function (Blueprint $table) {
            $table->unsignedBigInteger('article_id'); 
            $table->unsignedBigInteger('categories_id'); 
            $table->primary(['article_id', 'categories_id']);
            $table->foreign('article_id')->references('id')->on('articles')->onDelete('cascade');
            $table->foreign('categories_id')->references('id')->on('categories')->onDelete('cascade');
            $table->timestamps(); 
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('article_categories');
    }
};
