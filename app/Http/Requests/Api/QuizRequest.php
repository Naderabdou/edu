<?php

namespace App\Http\Requests\Api;

use App\Http\Requests\Api\MasterApiRequest;

class QuizRequest extends MasterApiRequest
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
            'name_en' => 'required|string|min:3|max:255',
            'name_ar' => 'required|string|min:3|max:255',
            'time' => 'required',
            'total_score' => 'required|integer|min:0',
            'pass_score' => 'required|integer|min:0',
            'course_id' => 'required|exists:courses,id',
            'topic_id' => 'required|exists:topic_courses,id',
        ];
    }
}
