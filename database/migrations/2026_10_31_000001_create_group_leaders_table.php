<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * The executives of a fellowship, guild or singing group. A ministry's own `leader` column
     * holds one name; a group such as the YPG has a president, secretary, treasurer and more.
     */
    public function up(): void
    {
        Schema::create('group_leaders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ministry_id')->constrained('ministries')->cascadeOnDelete();
            $table->string('name');
            $table->string('position')->nullable();
            $table->string('photo')->nullable();
            $table->unsignedSmallInteger('display_order')->default(0);
            $table->boolean('active')->default(true);
            $table->timestamps();

            $table->index(['ministry_id', 'active', 'display_order']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('group_leaders');
    }
};
