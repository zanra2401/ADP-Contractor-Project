<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Carbon;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('progress_log', function (Blueprint $table) {
            $table->id(); // bigint, auto increment, primary key
            $table->foreignUlid('project_id')->references('id')->on('projects')->cascadeOnDelete();
            $table->text("deskripsi")->nullable();
            $table->string('file_path', 255)->nullable();
            $table->enum('status_publikasi', ['menunggu', 'disetujui', 'ditolak'])->default('menunggu');
            $table->timestamp('tanggal_upload')->useCurrent();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::drop('progress_log');
    }
};
