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
        Schema::create('plantilla_plataformas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('plantilla_id')->constrained('plantilla')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('plataforma_lanzamiento_id')->constrained('plataforma_lanzamiento')->cascadeOnUpdate()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plantilla_plataformas');
    }
};
