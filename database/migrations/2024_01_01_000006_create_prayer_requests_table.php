<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('prayer_requests', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->text('request');
            $table->boolean('is_anonymous')->default(false);
            $table->boolean('is_urgent')->default(false);
            $table->boolean('is_answered')->default(false);
            $table->timestamp('answered_at')->nullable();
            $table->timestamps();
            
            $table->index('is_urgent');
            $table->index('is_answered');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('prayer_requests');
    }
};
