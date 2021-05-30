<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMoveRequest extends FormRequest
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
            'x_current' => 'sometimes',
            'y_current' => 'sometimes',
            'x_target' => 'sometimes',
            'y_target' => 'sometimes',
            'player_id' => 'sometimes|exists:chess_users,id',
        ];
    }
}
