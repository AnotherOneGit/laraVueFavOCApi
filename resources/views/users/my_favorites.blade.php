@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="com-md-8 col-mdoffset-2-">
            <div class="page-header">
                <h3>My Favorites</h3>
            </div>
            @forelse ($myFavorites as $myFavorite)
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ $myFavorite->name }}
                </div>

                <div class="panel-body">
                    <img src="{{ $myFavorite->bannerScreenshot }}" alt="{{ $myFavorite->name }}">
                </div>

                @if(Auth::check())
                    <div class="panel-footer">
                        <favorite
                            :game={{ $myFavorite->id }}
                            :favorited={{ $myFavorite->favorited() ? 'true' : 'false' }}
                        ></favorite>
                    </div>
                @endif
            </div>
            @empty
                <p>U havn't favorite game</p>
            @endforelse
        </div>
    </div>
</div>
@endsection
