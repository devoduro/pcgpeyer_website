<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('devotionals', function (Blueprint $table) {
            $table->id();
            $table->date('publish_date')->unique(); // one devotional per calendar day (church timezone)
            $table->string('title');
            $table->string('scripture_reference');
            $table->text('scripture_text')->nullable();
            $table->longText('reflection');
            $table->text('prayer')->nullable();
            $table->string('question')->nullable(); // optional reflection question
            $table->string('author')->nullable();
            $table->string('thumbnail')->nullable();
            $table->boolean('published')->default(false);
            $table->timestamps();
        });

        // First time a user opened a devotional. Used to enforce the minimum reading time on the server.
        Schema::create('devotional_reads', function (Blueprint $table) {
            $table->id();
            $table->foreignId('app_user_id')->constrained('app_users')->cascadeOnDelete();
            $table->foreignId('devotional_id')->constrained('devotionals')->cascadeOnDelete();
            $table->timestamp('opened_at');
            $table->unique(['app_user_id', 'devotional_id']);
        });

        Schema::create('devotional_completions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('app_user_id')->constrained('app_users')->cascadeOnDelete();
            $table->foreignId('devotional_id')->constrained('devotionals')->cascadeOnDelete();
            $table->date('completed_on'); // church-timezone date, used for streaks and the daily reset
            $table->text('answer')->nullable();
            $table->timestamp('completed_at');
            $table->unique(['app_user_id', 'devotional_id']);
            $table->index(['app_user_id', 'completed_on']);
        });

        Schema::table('app_users', function (Blueprint $table) {
            $table->boolean('devotion_first')->default(false); // voluntary devotion-first mode
        });
    }

    public function down(): void
    {
        Schema::table('app_users', function (Blueprint $table) {
            $table->dropColumn('devotion_first');
        });
        Schema::dropIfExists('devotional_completions');
        Schema::dropIfExists('devotional_reads');
        Schema::dropIfExists('devotionals');
    }
};
