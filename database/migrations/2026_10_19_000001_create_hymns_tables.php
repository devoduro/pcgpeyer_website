<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('hymns', function (Blueprint $table) {
            $table->id();
            $table->unsignedSmallInteger('number')->index(); // not unique: duplicate source files are kept for review
            $table->string('author')->nullable();            // composer/author line from the title slide
            $table->string('source_file')->nullable()->unique();
            $table->string('status', 20)->default('draft');  // draft, published
            $table->text('import_notes')->nullable();
            $table->timestamp('published_at')->nullable();
            $table->timestamps();
        });

        Schema::create('hymn_verses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('hymn_id')->constrained('hymns')->cascadeOnDelete();
            $table->string('language', 2);                   // ga, tw, en
            $table->unsignedSmallInteger('position');        // slide order
            $table->string('label', 40)->nullable();         // "Verse 1A", "Chorus"
            $table->text('text');                            // corrected text shown in the app
            $table->text('raw_text')->nullable();            // exactly as extracted, never edited
            $table->string('source_font')->nullable();
            $table->string('flags')->nullable();             // e.g. suspect_chars, language_guessed
            $table->string('review_status', 20)->default('pending'); // pending, approved
            $table->timestamps();
            $table->index(['hymn_id', 'language', 'position']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('hymn_verses');
        Schema::dropIfExists('hymns');
    }
};
