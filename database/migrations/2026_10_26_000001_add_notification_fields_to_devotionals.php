<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('devotionals', function (Blueprint $table) {
            $table->boolean('notify')->default(true)->after('published'); // send the morning push for this day
            $table->string('notification_title', 100)->nullable()->after('notify');
            $table->string('notification_body', 240)->nullable()->after('notification_title');
            $table->timestamp('notified_at')->nullable()->after('notification_body'); // set once sent; never sent twice
        });
    }

    public function down(): void
    {
        Schema::table('devotionals', function (Blueprint $table) {
            $table->dropColumn(['notify', 'notification_title', 'notification_body', 'notified_at']);
        });
    }
};
