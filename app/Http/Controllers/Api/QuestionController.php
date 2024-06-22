<?php

namespace App\Http\Controllers\Api;

use App\Models\Quiz;
use App\Models\Question;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\QuestionsRequest;
use App\Http\Controllers\Api\Traits\ApiResponseTrait;

class QuestionController extends Controller
{
    use ApiResponseTrait;
    public function store(QuestionsRequest $request)
    {

        $user = $this->getUserOrError();
        if ($user instanceof JsonResponse) return $user;
        $quiz = Quiz::find($request->quiz_id);
        if (!$quiz) {
            return $this->ApiResponse(null, transWord('هذا الامتحان غير موجود'), 404);
        }

        if (!$user->courses()->find($quiz->course_id)) {
            return $this->ApiResponse(null, transWord('هذه الدورة ليست ملك لك'), 401);
        }


        $question = Question::create([
            'question' => $request->question,
            'quiz_id' => $request->quiz_id,
            'score' => $request->score,
        ]);
        $this->createAnswers($question, $request->answer, $request->is_correct);

        return $this->ApiResponse(null, transWord('تم اضافة السؤال بنجاح'));
    }

    public function update(QuestionsRequest $request, $id)
    {
        $user = $this->getUserOrError();
        if ($user instanceof JsonResponse) return $user;
        $question = Question::find($id);
        if (!$question) {
            return $this->ApiResponse(null, transWord('هذا السؤال غير موجود'), 404);
        }

        $quiz = Quiz::find($request->quiz_id);
        if (!$quiz) {
            return $this->ApiResponse(null, transWord('هذا الامتحان غير موجود'), 404);
        }

        if (!$user->courses()->find($quiz->course_id)) {
            return $this->ApiResponse(null, transWord('هذه الدورة ليست ملك لك'), 401);
        }

        $question->update([
            'question' => $request->question,
            'quiz_id' => $request->quiz_id,
            'score' => $request->score,
        ]);

        $question->answers()->delete();
        $this->createAnswers($question, $request->answer, $request->is_correct);

        return $this->ApiResponse(null, transWord('تم تعديل السؤال بنجاح'));
    }

    public function destroy($id)
    {
        $user = $this->getUserOrError();
        if ($user instanceof JsonResponse) return $user;
        $question = Question::find($id);
        if (!$question) {
            return $this->ApiResponse(null, transWord('هذا السؤال غير موجود'), 404);
        }

        $quiz = $question->quiz;
        if (!$quiz) {
            return $this->ApiResponse(null, transWord('هذا الامتحان غير موجود'), 404);
        }

        if (!$user->courses()->find($quiz->course_id)) {
            return $this->ApiResponse(null, transWord('هذه الدورة ليست ملك لك'), 401);
        }

        $question->delete();
        return $this->ApiResponse(null, transWord('تم حذف السؤال بنجاح'));
    }


    private function createAnswers(Question $question, array $answers, $correctAnswerKey)
    {
        foreach ($answers as $key => $answer) {
            $is_correct = $correctAnswerKey == $key ? 1 : 0;
            $question->answers()->create([
                'answer' => $answer,
                'is_correct' => $is_correct,
            ]);
        }
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
