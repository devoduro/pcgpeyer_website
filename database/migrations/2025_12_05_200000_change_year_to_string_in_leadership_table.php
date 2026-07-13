<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('leadership', function (Blueprint $table) {
            // Change year column to be an integer
            DB::statement('ALTER TABLE leadership MODIFY COLUMN year INT NOT NULL');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('leadership', function (Blueprint $table) {
            DB::statement('ALTER TABLE leadership MODIFY COLUMN year YEAR NOT NULL');
        });
    }
};
