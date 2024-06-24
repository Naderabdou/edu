<?php

namespace App\Http\Controllers\Api;

use App\Traits\exam;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ExamResource;
use App\Http\Requests\Api\QuizSubmitRequest;
use App\Http\Controllers\Api\Traits\ApiResponseTrait;

class ExamController extends Controller
{
    use ApiResponseTrait, exam;
    public function index()
    {
        $user = auth()->user();
        $quizzes = $user->quiz()->get();
        return $this->ApiResponse(ExamResource::collection($quizzes));
    }

    public function store(QuizSubmitRequest $request)
    {
        $user = auth()->user();
        $data = $request->validated();
        $quiz = $this->getQuiz($data['quiz_id']);
        if (!$quiz) {
            return $this->ApiResponse(null, transWord('هذا الامتحان غير موجود'), 401);
        }

        $score = $this->calculateScore($data, $quiz);

        $isPass = $this->isPass($score, $quiz->pass_score);
        $result =  $this->attachUserQuiz($user, $quiz, $score, $isPass, count($data['question_id']));


        return $this->ApiResponse(new ExamResource($result), transWord('تم ارسال الاجابات بنجاح وهذه نتيجتك'));
    }

    public function delete($id)
    {
        $user = auth()->user();
        $quiz = $this->getQuiz($id);
        if (!$quiz) {
            return $this->ApiResponse(null, transWord('هذا الامتحان غير موجود'), 401);
        }

       if(!$user->quiz()->where('quiz_id', $quiz->id)->first()){
            return $this->ApiResponse(null, transWord('هذا الامتحان غير موجود لديك'), 401);
        }



        $user->quiz()->detach($quiz->id);
        return $this->ApiResponse(null, transWord('تم حذف الامتحان بنجاح'));
    }

    // public function show($id){
    //     $user = auth()->user();
    //     $quiz = $this->getQuiz($id);
    //     if (!$quiz) {
    //         return $this->ApiResponse(null, transWord('هذا الامتحان غير موجود'), 401);
    //     }
    //     $result = $user->quiz()->where('quiz_id', $quiz->id)->first();
    //     return $this->ApiResponse(new ExamResource($result));

    // }

    // public function update(QuizSubmitRequest $request, $id)
    // {
    //     $user = auth()->user();
    //     $data = $request->validated();
    //     $quiz = $this->getQuiz($id);
    //     if (!$quiz) {
    //         return $this->ApiResponse(null, transWord('هذا الامتحان غير موجود'), 401);
    //     }

    //     $score = $this->calculateScore($data, $quiz);

    //     $isPass = $this->isPass($score, $quiz->pass_score);
    //     $result =  $this->attachUserQuiz($user, $quiz, $score, $isPass, count($data['question_id']));
    //     return $this->ApiResponse(new ExamResource($result), transWord('تم تحديث الاجابات بنجاح وهذه نتيجتك'));
    // }

//   public function update(QuizSubmitRequest $request, $id)
//     {
//         $user = auth()->user();
//         $data = $request->validated();
//         $quiz = $this->getQuiz($id);
//         if (!$quiz) {
//             return $this->ApiResponse(null, transWord('هذا الامتحان غير موجود'), 401);
//         }

//         $score = $this->calculateScore($data, $quiz);

//         $isPass = $this->is


 }
