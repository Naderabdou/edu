<?php

namespace App\Http\Requests\Api;

use App\Http\Requests\Api\MasterApiRequest;
use Illuminate\Foundation\Http\FormRequest;

class QuestionsRequest extends MasterApiRequest
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
           'question' => 'required|string',
            'quiz_id' => 'required|exists:quizzes,id',
            'score' => 'required|integer',
            'answer' => 'required|array| min:4|max:4',
            'answer.*' => 'required|string|min:2',
            'is_correct' => 'required|in:0,1,2,3',
        ];
    }
}
