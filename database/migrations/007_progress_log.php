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
            $table->bigInteger('id')->primary();
            $table->foreignUlid('project_id')->references('id')->on('projects')->cascadeOnDelete();
            $table->text("deskripsi")->nullable(true);
            $table->string('file_path', length: 255);
            $table->enum('status_publikasi', ['menunggu', 'disetujui', 'ditolak'])->default('menunggu');
            $table->timestamp('tanggal_upload')->default(Carbon::now());
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
