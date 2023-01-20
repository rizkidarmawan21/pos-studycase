<?php

namespace App\Http\Requests\Settings\User;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email,'.$this->id,
            'role_id' => 'required|exists:roles,id',
            'password' => 'nullable|confirmed|min:6',
        ];
    }

    public function messages()
    {
        return [
            'role_id.required' => 'The role field is required.'
        ];
    }
}
