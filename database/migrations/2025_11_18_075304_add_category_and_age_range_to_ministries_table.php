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
        Schema::table('ministries', function (Blueprint $table) {
            $table->string('category')->after('slug')->nullable(); // inter-generational or generational
            $table->string('age_range')->after('category')->nullable(); // For generational ministries
            $table->string('location')->after('meeting_schedule')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ministries', function (Blueprint $table) {
            $table->dropColumn(['category', 'age_range', 'location']);
        });
    }
};
