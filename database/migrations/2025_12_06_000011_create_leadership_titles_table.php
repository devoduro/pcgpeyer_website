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
        Schema::create('leadership_titles', function (Blueprint $table) {
            $table->id();
            $table->string('title')->unique();
            $table->text('description')->nullable();
            $table->boolean('active')->default(true);
            $table->timestamps();
        });

        // Add title_id column to leadership table and rename title to title_text
        Schema::table('leadership', function (Blueprint $table) {
            $table->foreignId('title_id')->nullable()->after('name')->constrained('leadership_titles')->onDelete('set null');
        });

        // Rename title column using raw SQL
        DB::statement('ALTER TABLE leadership CHANGE COLUMN title title_text VARCHAR(255) NOT NULL');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('leadership', function (Blueprint $table) {
            DB::statement('ALTER TABLE leadership CHANGE COLUMN title_text title VARCHAR(255) NOT NULL');
            $table->dropForeign(['title_id']);
            $table->dropColumn('title_id');
        });

        Schema::dropIfExists('leadership_titles');
    }
};
