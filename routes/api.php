<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::resource('/chess-users', 'ChessUserController');

Route::resource('/game', 'GameController');
Route::resource('/game/{game_id}/move', 'MoveController');

Route::get('/game-status/{id}', 'GameController@getStatus');
Route::get('/game/{game_id}/last-move', 'MoveController@getLastMove');

Route::post('/game/{game_id}/set-winner/{player_id}', 'GameController@setWinner');
Route::post('/game/{game_id}/exit/{player_id}', 'GameController@exitGame');
Route::post('/login', 'LoginController@login');
Route::post('/connect-to-game/{player_id}', 'GameController@setVisitor');