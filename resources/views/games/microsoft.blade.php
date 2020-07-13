@extends('layouts.app')

@section('content')

<div class="container">
<h1>Microsoft's Exclusives</h1>
<img src="/microsoft.bmp" alt="" srcset="">
<br>
@forelse ($games as $game)
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2>{{ $game->name }}</h2>
                <h3>{{$game->firstReleaseDate}}</h3>
            </div>

    Genres:
    @foreach($game->genre as $genre)
        {{ $genre->name }},
    @endforeach
    <br>
    Platforms:
    @foreach($game->platform as $platform)
        {{ $platform->shortName }},
    @endforeach
    <br>
    <div class="panel-body">
        Average score: <strong>{{ $game->averageScore }}</strong>
    </div>
    @if(Auth::check())
        <div class="panel-footer">
            <favorite
            :game={{ $game->id }}
            :favorited={{ $game->favorited() ? 'true' : 'false' }}
            ></favorite>
        </div>
    @endif
    <br>
    </div>
    @empty
        <p>No games created.</p>
    @endforelse

@endsection
