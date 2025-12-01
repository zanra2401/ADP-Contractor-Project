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
        Schema::create('forget_codes', function (Blueprint $table) {
            $table->id();
            $table->foreignUlid('user_id')->references('id')->on('users');
            $table->uuid('code')->uniqid();
            $table->timestamp('expired_at')->useCurrent();
            $table->timestamp('created_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('forget_codes');
    }
};
