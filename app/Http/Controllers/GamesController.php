<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Game;
use Illuminate\Support\Facades\Auth;

class GamesController extends Controller
{
    public function index()
    {
        $games = Game::paginate(3);
        return view('games.index', compact('games'));
    }

    public function favoriteGame(Game $game)
    {
        Auth::user()->favorites()->attach($game->id);

        return back();
    }

    public function unFavoriteGame(Game $game)
    {
        Auth::user()->favorites()->detach($game->id);

        return back();
    }
}
