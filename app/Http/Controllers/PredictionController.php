<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Game;
use App\Models\Prediction;


class PredictionController extends Controller
{
    public function index()
    {
        // Obtener todos los partidos con sus equipos
        $games = Game::with(['homeTeam', 'awayTeam'])
            ->orderBy('game_date')
            ->get();

        return view('predictions.index', compact('games'));
    }

    public function store(Request $request, Game $game)
    {
         // Validar datos
        $request->validate([
            'predicted_home_score' => 'required|integer|min:0',
            'predicted_away_score' => 'required|integer|min:0',
         ]);

         // Evitar predicciones después del inicio del partido
         if (now()->greaterThanOrEqualTo($game->game_date)) {
            return back()->with('error', 'El partido ya comenzó. No puedes modificar tu predicción.');
        }

        // Crear o actualizar predicción del usuario
        Prediction::updateOrCreate(
        [
            'user_id' => auth()->id(),
            'game_id' => $game->id,
        ],
        [
            'predicted_home_score' => $request->predicted_home_score,
            'predicted_away_score' => $request->predicted_away_score,
        ]
    );

    return back()->with('success', 'Predicción guardada correctamente.');
    }

    public function all()
    {
         // Partidos finalizados
        $games = \App\Models\Game::where('status', 'finished')
           ->orderBy('game_date')
           ->get();

         // Cargar todos los usuarios
        $users = \App\Models\User::orderBy('name')->get();
           
        // Predicciones agrupadas por partido
        $predictions = \App\Models\Prediction::with(['user', 'game'])
            ->whereIn('game_id', $games->pluck('id'))
            ->get()
            ->groupBy('game_id');

    return view('predictions.all', compact('games', 'predictions', 'users'));
    }
}
