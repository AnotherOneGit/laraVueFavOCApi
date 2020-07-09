<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/games', 'GamesController@index');

Route::post('/games/favorite/{game}', 'GamesController@favoriteGame');
Route::post('/games/unfavorite/{game}', 'GamesController@unFavoriteGame');

Route::get('my_favorites', 'UsersController@myFavorites')->middleware('auth');
