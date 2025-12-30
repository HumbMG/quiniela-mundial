<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Http\Request;

class GameController extends Controller
{
    /**
     * Mostrar lista de partidos para que el ADMIN registre resultados reales.
     */
    public function index()
    {
        // Obtener todos los partidos con sus equipos
        $games = Game::with(['homeTeam', 'awayTeam'])
            ->orderBy('game_date')
            ->get();

        // PASO 2 DE LA MEJORA 2:
        // Actualizar automáticamente el estatus a "in_progress" si el partido ya inició
        foreach ($games as $game) {
            if (
                $game->status === 'pending' &&
                now()->greaterThanOrEqualTo($game->game_date)
            ) {
                $game->status = 'in_progress';
                $game->save();
            }
        }

        return view('games.index', compact('games'));
    }

    /**
     * Registrar el resultado real del partido (ADMIN).
     */
    public function updateResult(Request $request, Game $game)
    {
        $request->validate([
            'home_score' => 'required|integer|min:0',
            'away_score' => 'required|integer|min:0',
        ]);

        // Guardar resultado real
        $game->home_score = $request->home_score;
        $game->away_score = $request->away_score;
        $game->status = 'finished'; // El partido terminó
        $game->save();

        // Recalcular puntos de todos los usuarios
        foreach ($game->predictions as $prediction) {
            $prediction->points = $this->calculatePoints(
                $prediction->predicted_home_score,
                $prediction->predicted_away_score,
                $game->home_score,
                $game->away_score
            );
            $prediction->save();
        }

        return back()->with('success', 'Resultado actualizado y puntos recalculados correctamente.');
    }

    /**
     * Lógica de puntos de la quiniela.
     */
    private function calculatePoints($predHome, $predAway, $realHome, $realAway)
    {
        // Exacto
        if ($predHome == $realHome && $predAway == $realAway) {
            return 3;
        }

        // Mismo ganador
        if (
            ($predHome > $predAway && $realHome > $realAway) ||
            ($predHome < $predAway && $realHome < $realAway) ||
            ($predHome == $predAway && $realHome == $realAway)
        ) {
            return 1;
        }

        // Falló
        return 0;
    }
}