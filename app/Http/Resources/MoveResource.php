<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class MoveResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'xCurrent' => $this->x_current,
            'yCurrent' => $this->y_current,
            'xTarget' => $this->x_target,
            'yTarget' => $this->y_target,
            'gameId' => $this->game_id,
            'playerId' => $this->player_id,
            'createdAt' => $this->created_at,
        ];
    }
}
