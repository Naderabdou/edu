<?php

namespace App\Http\Controllers\Api;

use App\Models\Quiz;
use App\Models\TopicCourse;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\QuizRequest;
use App\Http\Resources\Api\QuizResource;
use App\Http\Requests\Api\QuizSubmitRequest;
use App\Http\Controllers\Api\Traits\ApiResponseTrait;

class QuizController extends Controller
{
    use ApiResponseTrait;

    public function userQuizSubmit(QuizSubmitRequest $request){

        $user = auth()->user();
        $data = $request->validated();
        $quiz = Quiz::find($data['quiz_id'])->questions;
        dd($quiz);

        $user->quizzes()->attach($quiz->id, ['answers' => json_encode($data['answers'])]);
        return $this->ApiResponse(null, transWord('تم ارسال الاجابات بنجاح'));

    }

    public function index()
    {
        $instractor = $this->getUserOrError();
        if ($instractor instanceof JsonResponse) return $instractor;
        $quizzes = Quiz::whereHas('course', function ($query) use ($instractor) {

            $query->whereIn('id', $instractor->courses->pluck('id'));
        })->get();


        return $this->ApiResponse(QuizResource::collection($quizzes));
    }
    public function store(QuizRequest $request)
    {

        $instractor = $this->getUserOrError();
        if ($instractor instanceof JsonResponse) return $instractor;

        $data = $request->validated();

        if (!$instractor->courses()->find($data['course_id'])) {
            return $this->ApiResponse(null, transWord('هذه الدورة ليست ملك لك'), 401);
        }
        $topic = TopicCourse::where('type', 'quiz')->find($data['topic_id']);

        if (!$topic) {

            return $this->ApiResponse(null, transWord('هذا الموضوع ليس امتحان'), 401);
        }
        Quiz::create($data);

        return $this->ApiResponse(null, transWord('تم اضافة الامتحان بنجاح'));
    }

    //eidt
    public function show($id)
    {
        $instractor = $this->getUserOrError();
        if ($instractor instanceof JsonResponse) return $instractor;

        $quiz = Quiz::find($id);

        if (!$quiz) {
            return $this->ApiResponse(null, transWord('هذا الامتحان غير موجود'), 401);
        }

        if (!$instractor->courses()->find($quiz->course_id)) {
            return $this->ApiResponse(null, transWord('هذه الدورة ليست ملك لك'), 401);
        }

        return $this->ApiResponse(new QuizResource($quiz));
    }

    public function destroy($id)
    {
        $instractor = $this->getUserOrError();
        if ($instractor instanceof JsonResponse) return $instractor;

        $quiz = Quiz::find($id);

        if (!$quiz) {
            return $this->ApiResponse(null, transWord('هذا الامتحان غير موجود'), 401);
        }

        if (!$instractor->courses()->find($quiz->course_id)) {
            return $this->ApiResponse(null, transWord('هذه الدورة ليست ملك لك'), 401);
        }

        $quiz->delete();

        return $this->ApiResponse(null, transWord('تم حذف الامتحان بنجاح'));
    }

    public function update(QuizRequest $request, $id)
    {
        $instractor = $this->getUserOrError();
        if ($instractor instanceof JsonResponse) return $instractor;

        $data = $request->validated();

        $quiz = Quiz::find($id);

        if (!$quiz) {
            return $this->ApiResponse(null, transWord('هذا الامتحان غير موجود'), 401);
        }

        if (!$instractor->courses()->find($quiz->course_id)) {
            return $this->ApiResponse(null, transWord('هذه الدورة ليست ملك لك'), 401);
        }

        $topic = TopicCourse::where('type', 'quiz')->find($data['topic_id']);

        if (!$topic) {

            return $this->ApiResponse(null, transWord('هذا الموضوع ليس امتحان'), 401);
        }

        $quiz->update($data);

        return $this->ApiResponse(null, transWord('تم تعديل الامتحان بنجاح'));
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
