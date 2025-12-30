<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PredictionController;
use App\Http\Controllers\GameController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Rutas exclusivas del administrador
Route::middleware(['auth', 'is_admin'])->group(function () {
    Route::get('/games', [GameController::class, 'index']);
    Route::post('/games/{game}/result', [GameController::class, 'updateResult']);
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Mostrar los partidos y formulario de predicciones
Route::get('/predictions', [PredictionController::class, 'index'])
    ->name('predictions.index')
    ->middleware('auth');

// Guardar la predicción
Route::post('/predictions/{game}', [PredictionController::class, 'store'])
    ->name('predictions.store')
    ->middleware('auth');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/leaderboard', [\App\Http\Controllers\LeaderboardController::class, 'index'])
    ->middleware('auth');

Route::get('/predictions/all', [PredictionController::class, 'all'])
    ->middleware('auth')
    ->name('predictions.all');

require __DIR__.'/auth.php';