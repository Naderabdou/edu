<?php

namespace App\Http\Controllers\Api;

use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Api\CoursesRequest;
use App\Http\Requests\Api\PriceCourceRequest;
use App\Http\Resources\Api\CoursesEditResource;
use App\Http\Controllers\Api\Traits\ApiResponseTrait;

class CourseController extends Controller
{
    use ApiResponseTrait;
    public function index()
    {
        $courses = Course::withCount('users', 'lesson')->paginate(9);
        return $this->ApiResponse($courses);
    }

    public function store(CoursesRequest $request)
    {

        $instractor = $this->getUserOrError();
        if ($instractor instanceof JsonResponse) return $instractor;

        $data = $request->validated();
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('courses');
        }
        if ($data['intro_video_type'] == 'upload') {
            if ($request->hasFile('intro_video')) {
                $data['intro_video'] = $request->file('intro_video')->store('courses');
            }
        }

        $categories = $data['category_id'];
        unset($data['category_id']);

        $course = $instractor->courses()->create($data);
        $course->categories()->sync($categories);

        return $this->ApiResponse(['id' => $course->id], transWord('تم اضافة الدورة بنجاح'));
    }

    public function edit($id)
    {
        $instractor = $this->getUserOrError();
        if ($instractor instanceof JsonResponse) return $instractor;
        $course = Course::where('instructor_id', $instractor->id)->find($id);
        if (!$course) {
            return $this->ApiResponse(null, transWord('لا يوجد دورة'), 404);
        }

        return $this->ApiResponse(new CoursesEditResource($course));
    }

    public function update(CoursesRequest $request, $id)
    {
        $instractor = $this->getUserOrError();
        if ($instractor instanceof JsonResponse) return $instractor;

        $course = Course::where('instructor_id', $instractor->id)->find($id);
        if (!$course) {
            return $this->ApiResponse(null, transWord('لا يوجد دورة'), 404);
        }

        $data = $request->validated();
        if ($request->hasFile('image')) {
            Storage::disk('public')->delete($course->image);

            $data['image'] = $request->file('image')->store('courses');
        }
        if ($data['intro_video_type'] == 'upload') {
            if ($request->hasFile('intro_video')) {
                Storage::disk('public')->delete($course->intro_video);

                $data['intro_video'] = $request->file('intro_video')->store('courses');
            }
        }

        $categories = $data['category_id'];
        unset($data['category_id']);

        $course->update($data);
        $course->categories()->sync($categories);

        return $this->ApiResponse(['id' => $course->id], transWord('تم تعديل الدورة بنجاح'));
    }

    public function destroy($id)
    {
        $instractor = $this->getUserOrError();
        if ($instractor instanceof JsonResponse) return $instractor;
        $course = Course::where('instructor_id', $instractor->id)->find($id);
        if (!$course) {
            return $this->ApiResponse(null, transWord('لا يوجد دورة'), 404);
        }

        if ($course->image) {
            Storage::disk('public')->delete($course->image);
        }
        if ($course->intro_video_type == 'upload') {
            if ($course->intro_video) {
                Storage::disk('public')->delete($course->intro_video);
            }
        }

        $course->delete();
        return $this->ApiResponse(null, transWord('تم حذف الدورة بنجاح'));
    }
    public function updatePrice(PriceCourceRequest $request, $id)
    {
        $instractor = $this->getUserOrError();
        if ($instractor instanceof JsonResponse) return $instractor;
        $course = Course::where('instructor_id', $instractor->id)->find($id);
        if (!$course) {
            return $this->ApiResponse(null, transWord('لا يوجد دورة'), 404);
        }

        $data = $request->validated();
        if ($request->discount) {
            $data['discount'] = $request->discount;
        }
        $course->update($data);

        return $this->ApiResponse(null, transWord('تم تعديل السعر بنجاح'));
    }

    public function statusUpdate($id, $status)
    {
        $instractor = $this->getUserOrError();
        if ($instractor instanceof JsonResponse) return $instractor;
        $arr = ['pending', 'publish', 'draft'];
        if (!in_array($status, $arr)) {
            return $this->ApiResponse(null, transWord('الحالة غير معروفة'), 404);
        }
        $course = Course::where('instructor_id', $instractor->id)->find($id);
        if (!$course) {
            return $this->ApiResponse(null, transWord('لا يوجد دورة'), 404);
        }

        $course->update(['status' => $status]);

        return $this->ApiResponse(null, transWord('تم تعديل الحالة بنجاح'));
    }

    public function user()
    {

        $user = auth()->user()->hasRole('instructor') ? auth()->user() : null;

        return $user;
    }

    private function getUserOrError()
    {
        $user = $this->user(); // Get the authenticated user
        if (empty($user)) {
            return $this->ApiResponse(null, transWord('هذا المستخدم ليس مدرب'), 401);
        }
        return $user;
    }
}
