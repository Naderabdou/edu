<?php

namespace App\Http\Requests\Api;

use App\Http\Requests\Api\MasterApiRequest;
use Illuminate\Foundation\Http\FormRequest;

class CoursesRequest extends MasterApiRequest
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
   $id = $this->id ?? null;
        return [
            'slug_en' => 'required|string|unique:courses,slug_en, ' . $id,
            'title_ar' => 'required|string',
            'title_en' => 'required|string',
            'about_en' => 'required|string',
            'about_ar' => 'required|string',
            'max_students' => 'required|integer',
            'level' => 'required|string|in:beginner,intermediate,advanced,expert',
            'is_public' => 'nullable|boolean',
            'is_qa_enabled' => 'nullable|boolean',
            'is_content_drip_enabled' => 'nullable|boolean',
            'content_drip_type' => 'nullable|string|in:Scheduled,Post_Enrollment,Sequential,Prerequisite_Unlocked',
            'type_course' => 'required|string|in:free,paid',
            'price' => 'required_if:type_course,paid|numeric',
            'discount' => 'required_if:type_course,paid|numeric',
            'category_id' => 'required|array',
            'category_id.*' => 'required|exists:categories,id',
            'image' => $id != null? 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048' : 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'intro_video_type' => 'required|string|in:youtube,vimeo,upload',
            'intro_video' => $this->videoType(),
            'start_date' => 'required|date',
            'language' => 'required|array',
            'language.*' => 'in:english,arabic,japan,hindi,frence,garmani',
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
            //'certificates' => 'nullable|exists:certificates,id',


        ];
    }

    public function videoType()
    {


        // dd($this->intro_video_type

        if ($this->intro_video_type == 'upload') {
            return $id != null ? 'nullable|file|mimes:mp4,mov,ogg,qt|max:2048' : 'required|file|mimes:mp4,mov,ogg,qt|max:2048';
        } elseif ($this->intro_video_type == 'youtube') {
            return 'url|required';
        } elseif ($this->intro_video_type == 'vimeo') {
            return 'url|required';
        }

        return 'required'; // default validation rule
    }

    public function messages()
    {
        if ($this->intro_video_type == null) {
            return [];
        }
        if ($this->intro_video_type == 'upload') {
            return [
                'intro_video.file' => 'The intro video must be a file',
            ];
        } elseif ($this->intro_video_type == 'youtube') {
            return [
                'intro_video.url' => transWord('يجب ان يكون الرابط من موقع يوتيوب'),
            ];
        } elseif ($this->intro_video_type == 'vimeo') {
            return [
                'intro_video.url' => transWord('يجب ان يكون الرابط من موقع فيميو'),
            ];
        }
    }
}
