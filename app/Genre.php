<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Game;
use App\Platform;

class Genre extends Model
{
    public function game()
    {
        return $this->belongsToMany(Game::class);
    }
}
