<?php

namespace App\Http\Requests\Api\Settings\Role;

use App\Http\Requests\ApiBaseRequest;

class UpdateRoleRequest extends ApiBaseRequest
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
            'role_name' => 'required|string',
        ];
    }
}
