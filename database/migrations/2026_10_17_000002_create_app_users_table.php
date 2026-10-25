<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('app_users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone', 20)->nullable()->unique();
            $table->string('password');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('status', 20)->default('active'); // active, suspended, deactivated
            $table->string('role', 20)->default('user'); // user, leader, pastor
            $table->string('language', 5)->default('en'); // en, tw, ga
            $table->string('profile_picture')->nullable();
            $table->string('congregation')->nullable();
            $table->json('notification_settings')->nullable();
            $table->foreignId('member_id')->nullable()->unique()->constrained('members')->nullOnDelete();
            $table->timestamp('last_login_at')->nullable();
            $table->timestamp('deletion_requested_at')->nullable();
            $table->timestamps();
        });

        Schema::create('membership_applications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('app_user_id')->constrained('app_users')->cascadeOnDelete();
            $table->foreignId('member_id')->nullable()->constrained('members')->nullOnDelete();
            $table->string('status', 20)->default('pending'); // pending, approved, rejected
            $table->string('congregation')->nullable();
            $table->text('notes')->nullable();
            $table->text('rejection_reason')->nullable();
            $table->foreignId('reviewed_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamp('reviewed_at')->nullable();
            $table->timestamps();
            $table->index(['app_user_id', 'status']);
        });

        Schema::create('app_auth_codes', function (Blueprint $table) {
            $table->id();
            $table->string('email')->index();
            $table->string('type', 20); // verify_email, reset_password
            $table->string('code_hash');
            $table->unsignedTinyInteger('attempts')->default(0);
            $table->timestamp('expires_at');
            $table->timestamps();
            $table->unique(['email', 'type']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('app_auth_codes');
        Schema::dropIfExists('membership_applications');
        Schema::dropIfExists('app_users');
    }
};
