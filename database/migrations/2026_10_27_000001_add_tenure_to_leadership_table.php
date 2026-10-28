<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Individual tenure for past leaders. The shared leadership_years range describes a session
     * term; a pastor or catechist has their own dates, which these hold. All optional: exact
     * dates when the record has them, otherwise just the closing year.
     */
    public function up(): void
    {
        Schema::table('leadership', function (Blueprint $table) {
            $table->unsignedSmallInteger('year_end')->nullable()->after('year');
            $table->date('served_from')->nullable()->after('year_end');
            $table->date('served_to')->nullable()->after('served_from');
        });
    }

    public function down(): void
    {
        Schema::table('leadership', function (Blueprint $table) {
            $table->dropColumn(['year_end', 'served_from', 'served_to']);
        });
    }
};
