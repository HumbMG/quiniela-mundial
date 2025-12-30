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
        Schema::create('games', function (Blueprint $table) {
            $table->id();
        
            // Equipos
            $table->foreignId('team_home_id')->constrained('teams')->onDelete('cascade');
            $table->foreignId('team_away_id')->constrained('teams')->onDelete('cascade');
        
            // Fecha y hora
            $table->dateTime('game_date');
        
            // Marcador real
            $table->integer('home_score')->nullable();
            $table->integer('away_score')->nullable();
        
            // Estado
            $table->enum('status', ['pending', 'in_progress', 'finished'])->default('pending');
        
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('games');
    }
};
