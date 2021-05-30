<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NewGameRequest extends FormRequest
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
            'pieces' => 'required',
            'x_axis' => 'required',
            'y_axis' => 'required',
            'type' => 'required',
            'creator_id' => 'required|exists:chess_users,id',
            'color_creator' => 'required',
        ];
    }
}
