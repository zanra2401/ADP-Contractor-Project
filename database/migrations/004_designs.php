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
        Schema::create('designs', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->foreignUlid('created_by')->references('id')->on('users')->cascadeOnDelete();
            $table->string('nama', length:100)->nullable(false);
            $table->decimal("harga", total: 15, places: 2);               
            $table->text('deskripsi')->nullable(true)->nullable(false);
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
