<?php

namespace App\Http\Requests\Api;

use App\Http\Requests\Api\MasterApiRequest;
use Illuminate\Foundation\Http\FormRequest;

class TopicesRequest extends MasterApiRequest
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
            'name_ar' => 'required|string|min:3|max:255',
            'name_en' => 'required|string|min:3|max:255',
            'description_ar' => 'required|string|min:3',
            'description_en' => 'required|string|min:3',
            'course_id' => 'required|exists:courses,id',
            'type' => 'required|in:lesson,quiz,assignment',
        ];
    }
}
