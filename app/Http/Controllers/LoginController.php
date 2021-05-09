<?php

namespace App\Http\Controllers;

use App\ChessUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function login(Request $request){

        $count = ChessUsers::query()
            ->where('login',request('login'))
            ->where('password',request('password'))
            ->count();
            
        return $count;
    }
}
