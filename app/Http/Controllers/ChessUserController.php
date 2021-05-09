<?php

namespace App\Http\Controllers;

use App\ChessUsers;
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
}
