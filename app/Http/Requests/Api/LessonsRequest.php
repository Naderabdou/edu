<?php

namespace App\Http\Requests\Api;

use App\Http\Requests\Api\MasterApiRequest;
use Illuminate\Foundation\Http\FormRequest;

class LessonsRequest extends MasterApiRequest
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
            'course_id' => 'required|exists:courses,id',
            'topic_id' => 'required|exists:topic_courses,id',
            'video_lesson' => $this->_method == 'PUT' ? 'nullable' : 'required',
            'pdf_lesson' => 'nullable',
            'title_ar' => 'required|min:3|max:255',
            'title_en' => 'required|min:3|max:255',
            'desc_ar' => 'required|min:3',
            'desc_en' => 'required|min:3',


        ];
    }
}
