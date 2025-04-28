<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('reactions', function (Blueprint $table) {
            $table->id(); 
            $table->unsignedBigInteger('article_id');
            $table->unsignedBigInteger('user_id')->nullable(); 
            $table->string('reaction_type'); 
            $table->timestamps(); 
            $table->foreign('article_id')->references('id')->on('articles')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null'); // Jika user dihapus, user_id diset null
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reactions');
    }
};
