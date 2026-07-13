<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sermons', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('preacher');
            $table->text('scripture_reference')->nullable();
            $table->text('description')->nullable();
            $table->date('sermon_date');
            $table->string('audio_url')->nullable();
            $table->string('video_url')->nullable();
            $table->string('thumbnail')->nullable();
            $table->string('series')->nullable();
            $table->boolean('featured')->default(false);
            $table->timestamps();
            
            $table->index('sermon_date');
            $table->index('featured');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sermons');
    }
};
