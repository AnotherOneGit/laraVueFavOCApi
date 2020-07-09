<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;

class Game extends Model
{
    public function favorited()
    {
        return (bool) Favorite::where('user_id', Auth::id())
                            ->where('game_id', $this->id)
                            ->first();
    }
}
