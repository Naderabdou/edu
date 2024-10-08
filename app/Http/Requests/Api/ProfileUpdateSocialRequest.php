<?php

namespace App\Http\Requests\Api;

use App\Http\Requests\Api\MasterApiRequest;
use Illuminate\Foundation\Http\FormRequest;

class ProfileUpdateSocialRequest extends MasterApiRequest
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
            'facebook' => 'nullable|string|url',
            'twitter' => 'nullable|string|url',
            'linkedin' => 'nullable|string|url',
            'github' => 'nullable|string|url',
            'website' => 'nullable|string|url',

        ];
    }
}
