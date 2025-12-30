<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

const STATUS_PENDING = 'pending';
const STATUS_IN_PROGRESS = 'in_progress';
const STATUS_FINISHED = 'finished';

class Game extends Model
{
    protected $fillable = [
        'team_home_id',
        'team_away_id',
        'game_date',
    ];

    public function homeTeam()
    {
        return $this->belongsTo(Team::class, 'team_home_id');
    }

    public function awayTeam()
    {
        return $this->belongsTo(Team::class, 'team_away_id');
    }

    public function predictions()
    {
        return $this->hasMany(Prediction::class);
    }
}
