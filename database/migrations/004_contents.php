<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Carbon;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('contents', function (Blueprint $table) {
            $table->id();
            $table->foreignUlid('created_by')->references('id')->on('users')->cascadeOnDelete();
            $table->enum('tipe', ['banner', 'galeri', 'artikel', 'video'])->nullable(false);
            $table->string('judul', length:100)->nullable(false);
            $table->text('deskripsi')->nullable(true)->nullable(false);
            $table->string('file_path', length: 255)->nullable(true);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::drop('contents');
    }
};
