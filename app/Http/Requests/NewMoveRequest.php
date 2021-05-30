<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NewMoveRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'x_current' => 'required',
            'y_current' => 'required',
            'x_target' => 'required',
            'y_target' => 'required',
            'player_id' => 'required|exists:chess_users,id',
        ];
    }
}
