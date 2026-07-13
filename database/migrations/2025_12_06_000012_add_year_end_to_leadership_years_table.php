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
        // Add year_end column to support year ranges
        Schema::table('leadership_years', function (Blueprint $table) {
            $table->year('year_end')->nullable()->after('year');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('leadership_years', function (Blueprint $table) {
            $table->dropColumn('year_end');
        });
    }
};
