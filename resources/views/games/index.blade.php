
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="page-header">
                <h1>All Games</h1>
            </div>
            <br>

            <form action="/games">

                <label for="name">Name</label>
                <input type="text" name="name" value="{{request()->name}}">

                <label for="exclusive">Exclusive</label>
                <input type="checkbox" name="exclusive" id="exclusive" {{request()->exclusive ? 'checked' : ''}}>

                <label for="date">First Release Date</label>
                <input required type="date" name="date" id="date" value={{request()->date ? : '1999-09-09'}}>

                <label for="tier">Tier</label>
                <select name="tier" id="tier">

                    <option disabled selected value>All</option>

                    <option
                    value="Mighty"
                    {{ request()->tier == 'Mighty' ? 'selected' : '' }}
                    >Mighty</option>
                    <option value="Strong"
                    {{ request()->tier == 'Strong' ? 'selected' : '' }}
                    >Strong</option>
                    <option value="Fair"
                    {{ request()->tier == 'Fair' ? 'selected' : '' }}
                    >Fair</option>
                    <option value="Weak"
                    {{ request()->tier == 'Weak' ? 'selected' : '' }}
                    >Weak</option>
                </select>

                <label for="genre">Genre</label>
                <select name="genre" id="genre">

                <option disabled selected value>All</option>

                @foreach($genres as $genre)
                    <option value="{{$genre->name}}"
                    {{request()->genre == $genre->name ? 'selected' : ''}}
                    >{{$genre->name}}
                    </option>
                @endforeach
                </select>

                <button type='submit'>Search</button>
            </form>

            <br>

            @forelse ($games as $game)
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h2>{{ $game->name }}</h2>
                        <h2>{{$game->firstReleaseDate}}</h2>
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
                    Exclusive: {{count($game->platform) == 1 ? 'Yes' : 'No'}}
                    <div class="panel-body">
                    <h3>Average score: {{ $game->averageScore }}</h3>
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

            {{ $games->links() }}
        </div>
    </div>
</div>
@endsection
