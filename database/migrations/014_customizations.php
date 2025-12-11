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
        Schema::create('customizations', function (Blueprint $table) {
            $table->foreignUlid('project')
                ->references("id")->on('projects')
                ->cascadeOnDelete();

            $table->foreignId('material')
                ->references('id')->on('materials')
                ->cascadeOnDelete();

            $table->primary(['project', 'material']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customizations');
    }
};
