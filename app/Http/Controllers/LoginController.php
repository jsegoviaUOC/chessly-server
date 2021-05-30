<?php

namespace App\Http\Controllers;

use App\ChessUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function login(Request $request){

        $user = ChessUsers::query()
            ->where('login',request('login'))
            ->where('password',request('password'))
            ->first();
        
        if(!$user){
        	return 0;
        }

        return $user->id;
    }
}
