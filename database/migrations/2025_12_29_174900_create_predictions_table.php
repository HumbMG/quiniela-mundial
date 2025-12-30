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
        Schema::create('predictions', function (Blueprint $table) {
            $table->id();
        
            // Usuario que hace la predicción
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
        
            // Partido al que pertenece la predicción
            $table->foreignId('game_id')->constrained('games')->onDelete('cascade');
        
            // Predicción del usuario
            $table->integer('predicted_home_score');
            $table->integer('predicted_away_score');
        
            // Puntos obtenidos (se llenará después)
            $table->integer('points')->nullable();
        
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('predictions');
    }
};
