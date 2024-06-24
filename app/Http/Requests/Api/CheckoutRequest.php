<?php

namespace App\Http\Requests\Api;

use App\Http\Requests\Api\MasterApiRequest;
use Illuminate\Foundation\Http\FormRequest;

class CheckoutRequest extends MasterApiRequest
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
            'payment_id' => 'required|exists:payments,id',
            'address' => 'required|string',
            'city' => 'required|string',
            'country' => 'required|string',
            'postal_code' => 'required|string',
            'phone' => 'required|string',
            'email' => 'required|email',
            'first_name' => 'required|string',
            'last_name' => 'required|string',
        ];
    }
}
