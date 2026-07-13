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
            $table->string('ministry_category')->after('category')->nullable(); // e.g., Worship, Outreach, Fellowship
            $table->string('leader_phone')->after('leader')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ministries', function (Blueprint $table) {
            $table->dropColumn(['ministry_category', 'leader_phone']);
        });
    }
};
