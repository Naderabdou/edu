<?php

namespace App\Http\Controllers\Api;

use App\Models\Rate;
use App\Models\User;
use App\Models\Course;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Api\CoursesRequest;
use App\Http\Requests\Api\PriceCourceRequest;
use App\Http\Resources\Api\CoursesEditResource;
use App\Http\Resources\Api\Courses\RatesResource;
use App\Http\Resources\Api\Courses\CourcesResource;
use App\Http\Controllers\Api\Traits\ApiResponseTrait;
use App\Http\Resources\Api\Courses\CategoriesResource;
use App\Http\Resources\Api\Courses\CourseTypeResource;
use App\Http\Resources\Api\Courses\CourseLevelResource;
use App\Http\Resources\Api\Courses\InstructorsResource;

class CourseController extends Controller
{
    use ApiResponseTrait;
    public function index()
    {
        $courses = Course::withCount('rate', 'lessons')->where('status', 'publish')->when(Request()->search, function ($query) {

            $query->where('title_ar', 'like', '%' . Request()->search . '%')->orWhere('title_en', 'like', '%' . Request()->search . '%');
        })->when(Request()->sort, function ($query) {
if (request('sort') == 'latest') {
                $query->latest();
            } elseif (request('sort') == 'popular') {
                $query->withCount('favorites')->orderBy('favorites_count', 'desc');
            } elseif (request('sort') == 'low') {
                $query->orderBy('price', 'asc');
            } elseif (request('sort') == 'high') {
                $query->orderBy('price', 'desc');
            } elseif (request('sort') == 'default') {
                $query->orderBy('id', 'desc');
            }
        })->get();
        $courses->filter(function ($course) {
            $course['rate'] = $course->rate->avg('rate') ?? 0;
            $course['users_count'] = $course->orders->count();
        });


        return $this->ApiResponse(CourcesResource::collection($courses)->response()->getData(true));
    }
    public function filterList()
    {
        $categories = Category::withcount('courses')->get();
        $rates = collect(['1', '2', '3', '4', '5'])->map(function ($rate) {

            $rateModel = Rate::withCount('course')->where('rate', $rate)->first();
            return $rateModel ?? ['rate' => $rate, 'course_count' => 0];
        });



        $instructors = User::role('instructor')->withCount('courses')->get();
        $courseType = Course::select('type_course', DB::raw('count(*) as total'))
            ->whereIn('type_course', ['free', 'paid'])
            ->groupBy('type_course')
            ->get();
        $allCoursesCount = Course::count();

        $courseType->push((object)[
            'type_course' => 'all',
            'total' => $allCoursesCount
        ]);

        $courseLevels = Course::select('level', DB::raw('count(*) as total'))
            ->whereIn('level', ['beginner', 'intermediate', 'advanced', 'expert'])
            ->groupBy('level')
            ->get();


        $courseLevels->push((object)[
            'level' => 'all',
            'total' => $allCoursesCount
        ]);

        $data = [
            'categories' => CategoriesResource::collection($categories),
            'rates' => RatesResource::collection($rates),
            'instructors' => InstructorsResource::collection($instructors),
            'courseType' => CourseTypeResource::collection($courseType),
            'courseLevels' => CourseLevelResource::collection($courseLevels),
        ];



        return $this->ApiResponse($data);
    }

    public function filter(Request $request)
    {
        $courses = Course::where('status', 'publish');

        $this->applyFilter($courses, 'instructor_id', $request->instructor_id);
        $this->applyFilter($courses, 'level', $request->level);
        $this->applyFilter($courses, 'type_course', $request->type_course);

        $courses->when($request->rate, function ($query) use ($request) {
            $query->whereHas('rate', function ($query) use ($request) {
                $query->where('rate', $request->rate);
            });
        });

        $courses->when($request->category_id, function ($query) use ($request) {
            $query->whereHas('categories', function ($query) use ($request) {
                $query->where('category_id', $request->category_id);
            });
        });

        $courses = $courses->get();

        $courses->filter(function ($course) {
            $course['rate'] = $course->rate->avg('rate') ?? 0;
            $course['users_count'] = $course->orders->count();
        });

        return $this->ApiResponse(CourcesResource::collection($courses)->response()->getData(true));
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


    private function getCoursesCountByType($type)
    {
        return Course::select(DB::raw("'{$type}' as type_course"), DB::raw('count(*) as total'))
            ->when($type !== 'all', function ($query) use ($type) {
                $query->where('type_course', $type);
            });
    }

    public function TypeCourse()
    {
        $types = ['free', 'paid', 'all'];
        $courseType = collect($types)->flatMap(function ($type) {
            return $this->getCoursesCountByType($type)->get();
        });
    }
    private function applyFilter($query, $field, $value)
    {
        return $query->when($value, function ($query) use ($field, $value) {
            $query->where($field, $value);
        });
    }
}
