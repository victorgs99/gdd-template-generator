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
        Schema::create('plantilla', function (Blueprint $table) {
            $table->id();
            $table->string('img_referencias_visuales');
            $table->string('titulo');
            $table->string('descripcion_corta');
            $table->string('publico_dirigido');
            $table->foreignId('creador_id')->constrained('creador')->cascadeOnUpdate()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plantilla');
    }
};
