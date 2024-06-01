<?php

namespace App\Http\Requests\Api;

use App\Http\Requests\Api\MasterApiRequest;

class ReviewRequest extends MasterApiRequest
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
            'rate' => 'required|numeric|min:1|max:5',
            'comment' => 'nullable|string',
            'course_id' => 'required|exists:courses,id',
            

        ];
    }
}
