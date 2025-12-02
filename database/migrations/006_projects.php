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
        Schema::create('projects', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->foreignUlid('pengawas_id')->nullable(true)->references('id')->on('users')->cascadeOnDelete();
            $table->foreignUlid('pengunjung_id')->references('id')->on('users')->cascadeOnDelete();
            $table->foreignUlid('design_id')->references('id')->on('designs')->cascadeOnDelete();
            $table->string('nama_proyek', length:150)->nullable(true);
            $table->text('deskripsi')->nullable(true);
            $table->decimal('harga', total: 15, places: 2)->nullable(true);
            $table->enum('status', ['disetujui', 'pending', 'proses', 'selesai'])->default('pending')->nullable(false);
            $table->text('alamat')->nullable(false);
            $table->string('file_path', length: 255)->nullable(true);
            $table->date('tanggal_mulai')->nullable(true);
            $table->date('tanggal_selesai')->nullable(true);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::drop('prijects');
    }
};
