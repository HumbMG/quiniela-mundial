<?php

namespace App\Http\Controllers;

use App\Models\User;

class LeaderboardController extends Controller
{
    public function index()
    {
        // Obtener usuarios con sus predicciones y puntos
        $users = User::with('predictions')
            ->get()
            ->map(function ($user) {
                $user->total_points = $user->predictions->sum('points');
                return $user;
            })
            ->sortByDesc('total_points')
            ->values();

        return view('leaderboard.index', compact('users'));
    }
}