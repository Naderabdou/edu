<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\TopicesRequest;
use App\Models\TopicCourse;

class TopicesController extends Controller
{
    public function index()
    {
        $instractor = $this->getUserOrError();
        if ($instractor instanceof JsonResponse) return $instractor;


    }

    public function store(TopicesRequest $request)
    {
        $instractor = $this->getUserOrError();
        if ($instractor instanceof JsonResponse) return $instractor;

        $data = $request->validated();
        if(!$instractor->courses()->find($data['course_id'])){
            return $this->ApiResponse(null, transWord('هذه الدورة ليست ملك لك'), 401);
        }



      $topice = TopicCourse::create($data);

        return $this->ApiResponse([
            'id' => $topice->id
        ], transWord('تم اضافة موضوع الدرس بنجاح'));

    }

    public function update(TopicesRequest $request, $id)
    {
        $instractor = $this->getUserOrError();
        if ($instractor instanceof JsonResponse) return $instractor;

        $topice = TopicCourse::find($id);
        if(!$topice){
            return $this->ApiResponse(null, transWord('هذا الموضوع غير موجود'), 404);
        }

        if(!$instractor->courses()->find($topice->course_id)){
            return $this->ApiResponse(null, transWord('هذه الدورة ليست ملك لك'), 401);
        }

        $data = $request->validated();
        $topice->update($data);

        return $this->ApiResponse(null, transWord('تم تحديث موضوع الدرس بنجاح'));

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
