<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Models\Course;
use App\Models\Review;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\Home\HeaderResource;
use App\Http\Resources\Api\Home\ReviewResource;
use App\Http\Resources\Api\Home\CategoryResource;
use App\Http\Controllers\Api\Traits\ApiResponseTrait;
use App\Http\Resources\Api\Home\blogsResource;
use App\Http\Resources\Api\Home\InstructorsResource;
use App\Models\Blog;
use App\Models\Subscribe;

class HomeController extends Controller
{
    use ApiResponseTrait;
    public function header()
    {
        $courses = Course::withCount(['watched', 'rate', 'lessons'])->where('status', 'publish')->take(4)->get();

        $courses->filter(function ($course) {
            $course['rate'] = $course->rate->avg('rate') ?? 0;
            $course['users_count'] = $course->orders->count();
        });
     
        $image_header = asset('storage/' . getSetting('slider_image'));

        $desc =  getSetting('main_desc', app()->getLocale());

        $data = [
            'image_header' => $image_header,
            'desc' => $desc,
            'courses' => HeaderResource::collection($courses)
        ];



        return $this->apiResponse($data);
    }

    public function categories()
    {
        $categories = Category::withcount('courses')->take(8)->get();

        return $this->apiResponse(CategoryResource::collection($categories));
    }

    public function aboutUs()
    {
        $settings = [
            'about_application',
            'first_image_about',
            'second_image_about',
            'third_image_about',
            'flexible_classes',
            'Learn_anywhere',
            'new_collection_video',
            'learners_counting',
            'courses_video_counting',
            'certified_students_counting',
            'registered_enrolls_counting',
            'successfully_trained_counting',

        ];

        $data = [];

        foreach ($settings as $setting) {
            if (in_array($setting, ['first_image_about', 'second_image_about', 'third_image_about', 'new_collection_video'])) {
                $data[$setting] = asset('storage/' . getSetting($setting));
            } elseif (in_array($setting, ['learners_counting', 'courses_video_counting', 'certified_students_counting', 'registered_enrolls_counting','successfully_trained_counting'])) {
                $data[$setting] = getSetting($setting);
            }
            else {
                $data[$setting] = getSetting($setting, app()->getLocale());
            }
        }

        return $this->apiResponse($data);
    }

    public function reviews()
    {
        $reviews = Review::latest()->get();



        return $this->apiResponse(ReviewResource::collection($reviews));
    }

    public function instructors()
    {
        $instructors = User::role('instructor')->latest()->get();

        return $this->apiResponse(InstructorsResource::collection($instructors));
    }

    public function instructorsShow($id)
    {
        $instructor = User::role('instructor')->find($id);
        if (!$instructor) {
            return $this->apiResponse(null, 'Instructor Not Found', 404);
        }

        return $this->apiResponse(new InstructorsResource($instructor));
    }

    public function blogs()
    {
        $blogs = Blog::latest()->get();

        return $this->apiResponse(blogsResource::collection($blogs));
    }

    public function subscribe(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:users,email'
        ]);

        $subscribe = Subscribe::create($request->all());

        return $this->apiResponse(null, transWord('تم الاشتراك بنجاح سيتم ارسال الاخبار لبريدك الالكتروني'));
    }
}
