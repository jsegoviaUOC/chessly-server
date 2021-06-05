<?php

namespace App\Http\Controllers;

use App\Game;
use App\Http\Resources\GameResource;
use App\Http\Resources\GamesResource;
use App\Http\Requests\NewGameRequest;
use App\Http\Requests\UpdateGameRequest;
use Illuminate\Http\Request;

class GameController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $games = Game::query()
        ->get();
        
        return new GamesResource($games);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(NewGameRequest $request)
    {
        $game = Game::create(request()->all());

        return $game->id;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $game = Game::query()
        ->find($id);
        
        return new GameResource($game);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateGameRequest $request, $id)
    {
        $game = Game::findOrFail($id);

        $game->update(request()->all());

        return $game->id;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function getStatus($id)
    {
    	$game = Game::withTrashed()->find($id);

    	if($game->winner_id != null){
    		return 2;
    	} else {
    		if($game->visitor_id != null){
    			return 1;
	    	} else {
	    		return 0;
	    	}
    	}
    }

    public function exitGame($game_id, $player_id)
    {
        $game = Game::findOrFail($game_id);

        if($game->visitor_id == null){
            $game->delete();
        }else{
            $game->winner_id = $game->visitor_id == $player_id ? $game->creator_id : $game->visitor_id;

            $game ->save();
        }
            
        return $game->id;
    }

	public function setWinner($game_id, $player_id)
    {
    	$game = Game::findOrFail($game_id);

        if($game->winner_id == null){
            $game->winner_id = $player_id;

            $game ->save();
        }
    		
    	return $game->id;
    }

    public function setVisitor($player_id, Request $request)
    {
        $game = Game::query()
            ->where('type',request('type'))
            ->whereNull('visitor_id')
            ->where('creator_id','!=',$player_id)
            ->first();

        if(!$game){
            return null;
        }

        $game->visitor_id = $player_id;

        $game ->save();
            
        return $game->id;
    }

    public function getUsername($game_id, Request $request)
    {
        $game = Game::withTrashed()->find($game_id);

        if(request('user') == "visitor"){
            return $game->visitor->login;
        }else{
            if(request('user') == "creator"){
                return $game->creator->login;
            }
        }
            
        return null;
    }
    
}
