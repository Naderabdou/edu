<?php

namespace App\Http\Requests\Api;

use App\Http\Requests\Api\MasterApiRequest;

class RegisterRequest extends MasterApiRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'email' => 'required|email:rfc,dns|unique:users,email',
            'username' =>'required|string|unique:users,username',
            'password' => 'required|string|min:8|confirmed',
        ];
    }
}
