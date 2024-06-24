<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class QuizSubmitRequest extends MasterApiRequest
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
            'quiz_id' => $this->method() == 'POST' ? 'required|exists:quizzes,id' : '',
            'answers_id' => 'required|array',
            'answers_id.*' => 'required|exists:answers,id',
            'question_id' => 'required|array',
            'question_id.*' => 'required|exists:questions,id',


        ];
    }
}
