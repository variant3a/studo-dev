<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'user_id' => 'sometimes|nullable|alpha_dash|max:32|unique:users',
            'name' => 'sometimes|nullable|string|max:32',
            'email' => 'sometimes|nullable|email|unique:users',
            'password' => 'sometimes|required|string|min:8|max:32',
        ];
    }
}
