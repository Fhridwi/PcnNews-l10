<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('media', function (Blueprint $table) {
            $table->id(); // PK
            $table->string('file_path'); 
            $table->string('file_type'); 
            $table->unsignedBigInteger('file_size'); 
            $table->string('alt_text')->nullable(); 
            $table->foreignId('uploaded_by')->constrained('users')->onDelete('cascade');
            $table->timestamps(); 
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('media');
    }
};
