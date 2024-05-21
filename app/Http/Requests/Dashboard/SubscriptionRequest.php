<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class SubscriptionRequest extends FormRequest
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
            'user_id' => 'required|exists:users,id',
            'course_id' => 'required|array',
            'course_id.*' => 'required|exists:courses,id',
            'price' => 'required|numeric',
            'discount' => 'nullable|numeric',
            'price_after_discount' => 'required|numeric',
            'payment_method' => 'required|string|in:visa,mastercard,amex,apple_pay,google_pay',


        ];
    }
}
