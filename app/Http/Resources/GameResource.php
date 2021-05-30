<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class GameResource extends Resource
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
            'xAxis' => $this->x_axis,
            'yAxis' => $this->y_axis,
            'type' => $this->type,
            'creatorId' => $this->creator_id,
            'creatorName' => $this->creator->login,
            'visitorId' => $this->visitor_id,
            'visitorName' => $this->visitor ? $this->visitor->login : null,
            'winnerId' => $this->winner_id,
            'colorCreator' => $this->color_creator,
            'pieces' => $this->pieces,
        ];
    }
}
