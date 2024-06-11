<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class CourseRequest extends FormRequest
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
            //'slug_ar' => 'nullable|string|unique:courses,slug_ar',
            'slug_en' => request()->method() == 'POST' ? 'required|string|unique:courses,slug_en' : 'required|string|unique:courses,slug_en,' . $this->route('course'),
            'title_en' => 'required|string|max:255',
            'title_ar' => 'required|string|max:255',
            'about_en' => 'required|string',
            'about_ar' => 'required|string',
          //  'is_active' => 'required|boolean',
            'max_students' => 'nullable|integer',
            'level' => 'nullable|string|in:beginner,intermediate,advanced,expert',
            'is_public' => 'nullable|boolean',
            'is_qa_enabled' => 'nullable|boolean',
            'is_content_drip_enabled' => 'nullable|boolean',
            'content_drip_type' => 'nullable|string|in:Scheduled,Post_Enrollment,Sequential,Prerequisite_Unlocked',
            'type_course' => 'nullable|string|in:free,paid',
            'price' => 'nullable|numeric',
            'discount' => 'nullable|numeric',
            'category_id' => 'required|array',
            'category_id.*' => 'required|exists:categories,id',
            'instructor_id' => 'required|exists:users,id',
            'image'=> 'required',
            'intro_video' => 'nullable|string',
            'intro_video_type' => 'required|string|in:youtube,vimeo,upload',
            'start_date' => 'required|date',
            'requirements_en' => 'required|string',
            'requirements_ar' => 'required|string',
            'desc_en' => 'required|string',
            'desc_ar' => 'required|string',
            'duration_hours' => 'required|integer',
            'duration_minutes' => 'required|integer',
            'tags' => 'required|array',
            'tags.*' => 'required|string',
            'target_audience' => 'required|array',
            'target_audience.*' => 'required|string',
            'vimeo_url' => 'nullable|string',
            'youtube_url' => 'nullable|string',
            'upload_vidoe' => 'nullable|string',
            'language' => 'required|array',
            'language.*' => 'in:english,arabic,japan,hindi,frence,garmani',




        ];
    }
}
