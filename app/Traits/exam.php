<?php

namespace App\Traits;

use App\Models\Quiz;




trait exam

{


    protected function getQuiz($quizId)
    {
        return Quiz::find($quizId);
    }

    protected function calculateScore($data, $quiz)
    {
        $score = 0;
        foreach ($data['question_id'] as $key => $questionId) {
            $question = $quiz->questions()->find($questionId);
            if ($question) {
                $correctAnswer = $question->answers()->where('is_correct', 1)->first();
                $userAnswer = $data['answers_id'][$key];
                if ($correctAnswer && $correctAnswer->id == $userAnswer) {
                    $score += $question->score;
                }
            }
        }
        return $score;
    }

    protected function isPass($score, $passScore)
    {
        return $score >= $passScore ? 1 : 0;
    }

    protected function attachUserQuiz($user, $quiz, $score, $isPass, $totalQuestions)
    {
       // dd($score);
    //    dd($quiz->total_score, $score, $isPass, $totalQuestions);
    $user->quiz()->syncWithoutDetaching([
        $quiz->id => [
            'score' => $score,
            'is_passed' => $isPass,
            'total_score' => $quiz->total_score,
            'total_ques' => $totalQuestions
        ]
    ]);
       $result = $user->quiz()->where('quiz_id', $quiz->id)->first();
// dd($result);
         return $result;
    }
}
