<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class ChessUserResource extends Resource
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
            'login' => $this->login,
            'password' => $this->password,
        ];
    }
}
