<?php

namespace App\Http\Controllers;

use App\Game;
use App\Genre;
use App\Platform;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GamesController extends Controller
{
    public function index(Request $request)
    {

        $games = Game::with('genre', 'platform');

        if($request->has('name')) {
            $games->where('name', 'like', "%$request->name%");
        }

        // if($request->has('exclusive')) {
        //     $games->where('Sony', 1)
        //         ->where('Nintendo', 0)
        //         ->where('Microsoft', 0);
        // }

        if($request->has('date')) {
            $games->where('firstReleaseDate', '>', $request->date);
        }

        if($request->has('tier')) {
            $games->where('tier', $request->tier);
        }

        if($request->has('genre')) {
            $games->whereHas('genre', function ($quere) use ($request)
            {
                $quere->where('name', 'like',"%$request->genre%");
            });
        }

        if($request->has('platform')) {
            $games->whereHas('platform', function ($quere) use ($request)
            {
                $quere->where('shortName',$request->platform);
            });
        }

        $platforms = Platform::get();
        $games = $games->orderBy('averageScore', 'desc')->paginate(3);
        $genres = Genre::get();
        return view('games.index', compact('games', 'genres', 'platforms'));
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

    public function sony() {
        $games = Game::with('genre', 'platform');

        $games = $games->where('Sony', 1)
            ->where('Nintendo', 0)
            ->where('Microsoft', 0)
            ->get();

        return view('games.sony', compact('games'));
    }

    public function microsoft()
    {
        $games = Game::with('genre', 'platform');
        $games = $games->where('Sony', 0)
        ->where('Nintendo', 0)
        ->where('Microsoft', 1)
        ->get();
        return view('games.microsoft', compact('games'));
    }

    public function nintendo()
    {
        $games = Game::with('genre', 'platform');
        $games = $games->where('Sony', 0)
        ->where('Nintendo', 1)
        ->where('Microsoft', 0)
        ->get();
        return view('games.nintendo', compact('games'));
    }
}
