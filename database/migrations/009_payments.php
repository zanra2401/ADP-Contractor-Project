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
        Schema::create('payments', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->foreignUlid('project_id')->references('id')->on('projects')->cascadeOnDelete();
            $table->foreignUlid('pengunjung_id')->references('id')->on('users');
            $table->decimal('jumlah', total: 15, places: 2);
            $table->enum('metode', ['transfer', 'e-wallet', 'kartu', 'cash']);
            $table->timestamp('tanggal_pembayaran');
            $table->enum('status', ['pending', 'berhasil', 'gagal']);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::drop('payments');
    }
};
