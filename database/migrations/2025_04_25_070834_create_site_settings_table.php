<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('site_settings', function (Blueprint $table) {
            $table->string('setting_key')->primary(); 
            $table->text('setting_value');
            $table->timestamp('updated_at')->useCurrent()->nullable(); 
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('site_settings');
    }
};
