<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('media_gallery', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->enum('type', ['photo', 'video']);
            $table->string('file_path')->nullable();
            $table->string('video_url')->nullable();
            $table->string('thumbnail')->nullable();
            $table->string('category')->nullable();
            $table->date('event_date')->nullable();
            $table->integer('order')->default(0);
            $table->boolean('featured')->default(false);
            $table->timestamps();
            
            $table->index('type');
            $table->index('category');
            $table->index('featured');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('media_gallery');
    }
};
