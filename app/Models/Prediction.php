<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prediction extends Model
{
    protected $fillable = [
        'user_id',
        'game_id',
        'predicted_home_score',
        'predicted_away_score',
        'points',
    ];

    public function user()
{
    return $this->belongsTo(User::class);
}

public function game()
{
    return $this->belongsTo(Game::class);
}

}
