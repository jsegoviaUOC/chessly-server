<?php

namespace App\Http\Controllers;

use App\Move;
use App\Game;
use App\Http\Resources\MoveResource;
use App\Http\Resources\MovesResource;
use App\Http\Requests\NewMoveRequest;
use App\Http\Requests\UpdateMoveRequest;
use Illuminate\Http\Request;

class MoveController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($game_id)
    {
        $moves = Move::query()
        ->where('game_id',$game_id)
        ->get();
        
        return new MovesResource($moves);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($game_id,NewMoveRequest $request)
    {
    	$game = Game::findOrFail($game_id);
        $move = $game->moves()->create(request()->all());

        return $move->id;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($game_id, $id)
    {
        $move = Move::query()
        ->where('game_id',$game_id)
        ->find($id);
        
        return new MoveResource($move);
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
    public function update(UpdateMoveRequest $request, $id)
    {
        $move = Move::findOrFail($id);

        $move->update(request()->all());

        return $move->id;
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

    public function getLastMove($game_id)
    {
    	Game::findOrFail($game_id);

    	$move = Move::query()
    		->where('game_id', $game_id)
    		->orderBy('created_at', 'desc')
    		->first();

    	if(!$move){
    		return null;
    	}
    	return new MoveResource($move);
	}
    	
}
