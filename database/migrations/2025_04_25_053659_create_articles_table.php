<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->id(); 
            $table->string('title'); 
            $table->string('slug')->unique(); 
            $table->text('summary');
            $table->longText('content'); 
            $table->string('cover_image_url')->nullable(); 
            $table->enum('publish_status', ['draft', 'published', 'archived'])->default('draft'); 
            $table->timestamp('published_at')->nullable(); 
            $table->unsignedBigInteger('view_count')->default(0); 
            $table->foreignId('author_id')->constrained('users')->onDelete('cascade'); 
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};
