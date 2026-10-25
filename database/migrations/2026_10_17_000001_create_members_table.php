<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('members', function (Blueprint $table) {
            $table->id();
            $table->string('legacy_id')->nullable()->unique(); // id in the old app.pcgpeyer.org system
            $table->string('member_number')->nullable()->unique();
            $table->string('first_name');
            $table->string('last_name')->nullable();
            $table->string('other_names')->nullable();
            $table->string('email')->nullable()->index();
            $table->string('phone', 20)->nullable()->index(); // normalised +233...
            $table->string('gender', 10)->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('congregation')->nullable();
            $table->string('society')->nullable();
            $table->string('status', 20)->default('active'); // active, inactive, transferred, deceased
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('members');
    }
};
