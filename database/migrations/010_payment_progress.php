<?php

use Carbon\Carbon;
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
        Schema::create('payment_progress', function (Blueprint $table) {
            $table->ulid("id")->primary();
            $table->foreignUlid('payment_id')->references('id')->on('payments')->cascadeOnDelete();
            $table->decimal('jumlah', total: 15, places: 2);
            $table->enum('metode', ['transfer', 'cash']);
            $table->enum('status', ['pending', 'lunas'])->default('lunas');
            $table->string('deskripsi')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::drop('payment_progress');
    }
};
