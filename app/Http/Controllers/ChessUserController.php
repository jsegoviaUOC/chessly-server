<?php

namespace App\Http\Controllers;

use App\ChessUsers;
use App\Game;
use App\Move;
use App\Http\Resources\ChessUsersResource;
use App\Http\Resources\ChessUserResource;
use App\Http\Requests\NewChessUserRequest;
use App\Http\Requests\UpdateChessUserRequest;
use Illuminate\Http\Request;

class ChessUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $chessUsers = ChessUsers::query()
        ->get();
        
        return new ChessUsersResource($chessUsers);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(NewChessUserRequest $request)
    {
        $count = ChessUsers::query()
            ->where('login',request('login'))
            ->count();

        if($count){
            return 0;
        }

        $chessUser = ChessUsers::create(request()->all());

        return $chessUser->id;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $chessUsers = ChessUsers::query()
        ->find($id);
        
        return new ChessUserResource($chessUsers);
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
    public function update(UpdateChessUserRequest $request, $id)
    {
        $chessUser = ChessUsers::findOrFail($id);

        $chessUser->update(request()->all());

        return $chessUser->id;
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

    public function getStatistics($id)
    {
        $statistics = array();

        $statistics['wins'] = Game::where('winner_id',$id)->count();
        $statistics['creatorCustom'] = Game::where('creator_id',$id)->where('type','custom')->count();
        $statistics['creatorClassic'] = Game::where('creator_id',$id)->where('type','classic')->count();
        $statistics['visitorCustom'] = Game::where('visitor_id',$id)->where('type','custom')->count();
        $statistics['visitorClassic'] = Game::where('visitor_id',$id)->where('type','classic')->count();

        $statistics['totalGames'] = $statistics['visitorCustom'] + $statistics['visitorClassic'] + $statistics['creatorClassic'] + $statistics['creatorCustom'];

        $statisticsWhite = Game::where('visitor_id',$id)->where('color_creator','B')->count() + Game::where('creator_id',$id)->where('color_creator','W')->count();
        $statisticsBlack = Game::where('visitor_id',$id)->where('color_creator','W')->count() + Game::where('creator_id',$id)->where('color_creator','B')->count();

        if($statistics['totalGames'] > 0 ){
            $statistics['statisticsWhite'] = round( ($statisticsWhite * 100) / $statistics['totalGames'], 2);
            $statistics['statisticsBlack'] = round( ($statisticsBlack * 100) / $statistics['totalGames'], 2);
        } else {
            $statistics['statisticsWhite'] = 0.00;
            $statistics['statisticsBlack'] = 0.00;
        }

        $statistics['totalMoves'] = Move::where('player_id',$id) ->count();

        return json_encode($statistics);

    }
}
