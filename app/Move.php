<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Move extends Model
{
    use Notifiable, SoftDeletes;

    protected $fillable = [
    	'x_current',
    	'y_current',
    	'x_target',
    	'y_target',
    	'player_id',
    	'game_id',
    	'created_at'
    ];

    protected $casts = [
    	'x_current' => 'integer',
    	'y_current' => 'integer',
    	'x_target' => 'integer',
    	'y_target' => 'integer',
    ];

    protected $table = 'move';

    public function player(){
    	return $this->belongsTo(ChessUsers::class, 'player_id');
    }

    public function game(){
    	return $this->belongsTo(Game::class,'game_id');
    }

}
