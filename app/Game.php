<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Game extends Model
{
    use Notifiable, SoftDeletes;

    protected $fillable = [
    	'pieces',
    	'x_axis',
    	'y_axis',
    	'type',
    	'creator_id',
    	'visitor_id',
    	'winner_id',
    	'color_creator',
    ];

    protected $casts = [
    	'x_axis' => 'integer',
    	'y_axis' => 'integer',
    ];

    protected $table = 'game';

    public function creator(){
    	return $this->belongsTo(ChessUsers::class, 'creator_id');
    }

    public function visitor(){
    	return $this->belongsTo(ChessUsers::class, 'visitor_id');
    }

    public function winner(){
    	return $this->belongsTo(ChessUsers::class, 'winner_id');
    }

    public function moves(){
    	return $this->hasMany(Move::class);
    }
}
