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
        Schema::create('chats', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->foreignUlid('pengirim_id')->references('id')->on('users');
            $table->foreignUlid('penerima_id')->references('id')->on('users');
            $table->text('pesan')->nullable();
            $table->string('media_path', length: 255)->nullable();
            $table->timestamp('waktu_kirim');
            $table->enum('status', ['terkirim', 'dibaca']);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::drop('chats');
    }
};
