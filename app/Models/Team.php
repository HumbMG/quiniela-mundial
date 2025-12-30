<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    protected $fillable = [
        'name',
    ];

    public function homeGames()
    {
        return $this->hasMany(Game::class, 'team_home_id');
    }

    public function awayGames()
    {
         return $this->hasMany(Game::class, 'team_away_id');
    }
}
