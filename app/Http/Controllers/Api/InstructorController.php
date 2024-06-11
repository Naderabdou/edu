<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Api\Traits\ApiResponseTrait;
use App\Http\Resources\Api\Instructor\CoursesResource;

class InstructorController extends Controller
{
    use ApiResponseTrait;

    public function courses()
    {

        $user = $this->getUserOrError();
        if ($user instanceof JsonResponse) return $user;

        $courses = $user->courses()->withCount('lessons', 'users', 'rate')->get();



        return $this->ApiResponse(CoursesResource::collection($courses));
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
            return $this->ApiResponse(null, transWord('هذا الحساب ليس حساب مدرب'), 403);
        }
        return $user;
    }
}
