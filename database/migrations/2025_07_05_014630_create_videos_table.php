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
        Schema::create('videos', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('video_type'); // 'youtube', 'vimeo', 'upload'
            $table->string('video_url')->nullable(); // For YouTube/Vimeo links
            $table->string('video_file')->nullable(); // For uploaded video files
            $table->string('thumbnail')->nullable();
            $table->string('duration')->nullable();
            $table->boolean('featured')->default(false);
            $table->boolean('published')->default(true);
            $table->date('publish_date')->nullable();
            $table->string('category')->nullable();
            $table->integer('views')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('videos');
    }
};
