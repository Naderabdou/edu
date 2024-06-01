<?php

namespace App\Http\Controllers\Api;

use App\Models\Course;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Api\WishListRequest;
use App\Http\Resources\Api\ProfileResource;
use App\Http\Resources\Api\wishlistResource;
use App\Http\Requests\Api\ProfileUpdateRequest;
use App\Http\Resources\Api\EnrollerdCoursesResource;
use App\Http\Controllers\Api\Traits\ApiResponseTrait;
use App\Http\Requests\Api\ProfileUpdateSocialRequest;
use App\Http\Requests\Api\ProfileUpdatePasswordRequest;
use App\Http\Requests\Api\ReviewRemoveRequest;
use App\Http\Requests\Api\ReviewRequest;
use App\Http\Resources\Api\ReviewsResource;

class ProfileController extends Controller
{
    use ApiResponseTrait;

    // this function is used to get the user profile
    public function index()
    {
        $user = auth()->user();
        return $this->ApiResponse(new ProfileResource($user));
    }
    //end function index



    // this function is used to update the user profile
    public function update(ProfileUpdateRequest $request)
    {
        $user = auth()->user();

        $data = $request->validated();
        if ($request->hasFile('avatar')) {
            if ($user->avatar) {
                Storage::disk('public')->delete($user->avatar);
            }
            $user->user_type == 'student' ? $data['avatar'] = $request->file('avatar')->store('students', 'public') : $data['avatar'] = $request->file('avatar')->store('instructors', 'public');
        }
        if ($request->hasFile('background_image')) {
            if ($user->background_image) {
                Storage::disk('public')->delete($user->background_image);
            }
            $user->user_type == 'student' ? $data['background_image'] = $request->file('background_image')->store('students', 'public') : $data['background_image'] = $request->file('background_image')->store('instructors', 'public');
        }
        $user->update($data);
        return $this->ApiResponse(null, transWord('تم تحديث البيانات بنجاح'));
    }
    //end function update



    // this function is used to update the user password
    public function updatePasword(ProfileUpdatePasswordRequest $request)
    {
        $user = auth()->user();
        if (!\Hash::check($request->old_password, $user->password)) {
            return $this->ApiResponse(null, transWord('كلمة المرور القديمة غير صحيحة'), 401);
        }

        $user->update(['password' => $request->password]);
        Auth::guard('web')->logoutOtherDevices($request->old_password);
        //    Auth::logoutOtherDevices($request->old_password);


        return $this->ApiResponse(null, transWord('تم تحديث كلمة المرور بنجاح'));
    }
    //end function updatePasword


    // this function is used to update the user social media
    public function updateSocial(ProfileUpdateSocialRequest $request)
    {
        $user = auth()->user();
        $user->update($request->validated());
        return $this->ApiResponse(null, transWord('تم تحديث كلمة المرور بنجاح'));
    }
    //end function updateSocial


    // this function is used to get the enrolled courses and type is {active,completed,enrolled}
    public function EnrolledCourses($type)
    {

        $courses = auth()->user()->subscribedCourses()->withCount('watched', 'lessons', 'users', 'rate')->get();


        switch ($type) {
            case 'active':
                $filteredCourses = $courses->where('watched_count', '>', 0)->where('watched_count', '<', $courses->pluck('lessons_count')->max());
                $lessonsCount = $filteredCourses->pluck('lessons_count')->sum();
                $progress = $lessonsCount > 0 ? $filteredCourses->pluck('watched_count')->sum() / $lessonsCount * 100 . '%' : '0%';


                $certificate = 'inactive';
                break;
            case 'completed':
                $filteredCourses = $courses->where('watched_count', '=', $courses->pluck('lessons_count')->max());
                $progress = '100%';
                $certificate = 'active';
                break;
            case 'enrolled':
                $filteredCourses = $courses->where('watched_count', 0);
                $progress = '0%';
                $certificate = 'inactive';

                break;
            default:
                return $this->ApiResponse(null, transWord('هذا النوع غير موجود'), 404);
        }
        $filteredCourses = $filteredCourses->map(function ($course) use ($progress, $certificate) {
            $course['rate'] = $course->rate()->avg('rate');
            $course['progress'] = $progress;
            $course['certificate'] = $certificate;
            return $course;
        });


        return $this->ApiResponse(EnrollerdCoursesResource::collection($filteredCourses));
    }
    //end function EnrolledCourses


    // this function is used to get the wishlist
    public function wishlist()
    {
        $wishlist = auth()->user()->cart()->withCount('lessons', 'users', 'rate')->get();
        $wishlist = $wishlist->map(function ($course) {
            $course['rate'] = $course->rate()->avg('rate');
            return $course;
        });




        return $this->ApiResponse(wishlistResource::collection($wishlist));
    }
    //end function wishlist


    // this function is used to add course to wishlist and id is course id
    public function addWishlist($id)
    {
        if (!Course::find($id)) {
            return $this->ApiResponse(null, transWord('هذه الدورة غير موجودة'), 404);
        }
        $course = auth()->user()->cart()->where('course_id', $id)->first();
        if ($course) {
            return $this->ApiResponse(null, transWord('هذه الدورة موجودة بالفعل في قائمة المفضلة'), 400);
        }

        auth()->user()->cart()->syncWithoutDetaching($id);
        return $this->ApiResponse(null, transWord('تمت الاضافة بنجاح'));
    }
    //end function addWishlist


    // this function is used to remove course from wishlist and id is course id
    public function removeWishlist($id)
    {
        $course = auth()->user()->cart()->where('course_id', $id)->first();

        if (!$course) {
            return $this->ApiResponse(null, transWord('هذه الدورة غير موجودة في قائمة المفضلة'), 404);
        }

        auth()->user()->cart()->detach($id);
        return $this->ApiResponse(null, transWord('تم الحذف بنجاح'));
    }
    //end function removeWishlist


   // this function is used to get the reviews
    public function reviews()
    {
        $reviews = auth()->user()->reviews()->with('course')->get();


        return $this->ApiResponse(ReviewsResource::collection($reviews));
    }
    //end function reviews


    // this function is used to add review to course
    public function addReview(ReviewRequest $request)
    {

        $review = auth()->user()->reviews()->where('course_id', $request->course_id)->first();
        if ($review) {
            return $this->ApiResponse(null, transWord('لقد قمت بتقييم هذه الدورة مسبقا'), 400);
        }
        auth()->user()->reviews()->create($request->validated());
        return $this->ApiResponse(null, transWord('تمت الاضافة بنجاح'));
    }
    //end function addReview


    // this function is used to remove review and id is review id
    public function removeReview($id)
    {
        $reviews = auth()->user()->reviews()->where('id', $id)->first();

        if (!$reviews) {
            return $this->ApiResponse(null, transWord('هذا التقييم غير موجود'), 404);
        }

        $reviews->delete();
        return $this->ApiResponse(null, transWord('تم الحذف بنجاح'));
    }
    //end function removeReview


    // this function is used to update review and id is review id
    public function updateReview(ReviewRequest $request, $id)
    {
        $review = auth()->user()->reviews()->where('id', $id)->first();
        if (!$review) {
            return $this->ApiResponse(null, transWord('هذا التقييم غير موجود'), 404);
        }
        $review->update($request->validated());
        return $this->ApiResponse(null, transWord('تم التعديل بنجاح'));
    }
    //end function updateReview
}
