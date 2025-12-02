<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('design_specs', function (Blueprint $table) {
            $table->id();
            $table->foreignUlid('design_id')
                  ->references('id')->on('designs')
                  ->cascadeOnDelete();

            // 1 kolom saja, berisi string seperti "2 Kamar Tidur", "Luas Bangunan 45m²"
            $table->string('spesifikasi', 150);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('design_specs');
    }
};
