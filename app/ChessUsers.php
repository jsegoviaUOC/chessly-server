<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class ChessUsers extends Model
{
    use Notifiable, SoftDeletes;

    protected $fillable = [
    	'login',
    	'password'
    ];

    protected $table = 'chess_users';
}
