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
            $table->foreignUlid('pengawas_id')->references('id')->on('users')->cascadeOnDelete();
            $table->foreignUlid('pengunjung_id')->references('id')->on('users')->cascadeOnDelete();
            $table->foreignUlid('design_id')->references('id')->on('designs')->cascadeOnDelete();
            $table->string('nama_proyek', length:150)->nullable(false);
            $table->text('deskripsi')->nullable(false);
            $table->decimal('harga', total: 15, places: 2)->nullable(true);
            $table->enum('status', ['disetujui', 'pending', 'proses', 'selesai'])->default('pending')->nullable(false);
            $table->text('alamat')->nullable(false);
            $table->date('tanggal_mulai')->nullable(false);
            $table->date('tanggal_selesai')->nullable(false);
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
