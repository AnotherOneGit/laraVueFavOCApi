
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="page-header">
                <h3>All Games</h3>
            </div>
            @forelse ($games as $game)
                <div class="panel panel-default">
                    <div class="panel-heading">
                        {{ $game->name }}
                    </div>

                    <!-- <div class="panel-body">
                        <img src="{{ $game->bannerScreenshot }}" alt="{{ $game->name }}">
                    </div> -->
                    
                    <div class="panel-body">
                        {{ $game->averageScore }}
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
