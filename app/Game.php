<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use App\Genre;
use App\Platform;

class Game extends Model
{

    public function genre()
    {
        return $this->belongsToMany(Genre::class);
    }

    public function platform()
    {
        return $this->belongsToMany(Platform::class);
    }

    public function favorited()
    {
        return (bool) Favorite::where('user_id', Auth::id())
                            ->where('game_id', $this->id)
                            ->first();
    }
}
