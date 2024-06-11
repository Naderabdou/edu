<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\LessonsRequest;

class LessonController extends Controller
{
    public function index()
    {

        $instractor = $this->getUserOrError();
        if ($instractor instanceof JsonResponse) return $instractor;

    }

    public function store(LessonsRequest $request)
    {
       $instractor = $this->getUserOrError();
        if ($instractor instanceof JsonResponse) return $instractor;
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
