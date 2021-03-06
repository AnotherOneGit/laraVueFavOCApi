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

Route::get('/home', 'HomeController@index');

Route::get('/games', 'GamesController@index')->name('games.index');
Route::get('/sony', 'GamesController@sony')->name('games.sony');
Route::get('/microsoft', 'GamesController@microsoft')->name('games.microsoft');
Route::get('/nintendo', 'GamesController@nintendo')->name('games.nintendo');

Route::post('/games/favorite/{game}', 'GamesController@favoriteGame');
Route::post('/games/unfavorite/{game}', 'GamesController@unFavoriteGame');

Route::get('my_favorites', 'UsersController@myFavorites')->middleware('auth')->name('my.favorites');
