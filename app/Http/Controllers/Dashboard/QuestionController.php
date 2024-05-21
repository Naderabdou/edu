<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Quiz;
use App\Models\Question;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\QuestionRequest;

class QuestionController extends Controller
{
    // public function index()
    // {

    //     $questions = Question::latest()->get();
    //     return view('dashboard.questions.index', compact('questions'));
    // }

    public function create($id)
    {

        $quiz = Quiz::findOrFail($id);
        $count = $quiz->questions->count();

        return view('dashboard.questions.create', compact('quiz', 'count'));
    }
    public function store(QuestionRequest $request)
    {

        $question = Question::create([
            'question' => $request->question,
            'quiz_id' => $request->quiz_id,
            'score' => $request->score,
        ]);


        $this->createAnswers($question, $request->answer, $request->is_correct);
        $quiz = Quiz::findOrfail($request->quiz_id);
        $questionsCount = $quiz->questions->count() + 1;

        return response()->json(
            [
                'message' => transWord('Question created successfully'),
                'count' => $questionsCount,
                'name' => $quiz->name
            ]
        );
    }

    public function show($id)
    {


        $questions = Question::where('quiz_id', $id)->latest()->get();

        return view('dashboard.questions.index', compact('questions', 'id'));
    }

    public function edit($id)
    {
        $question = Question::findOrFail($id);

        return view('dashboard.questions.edit', compact('question'));
    }

    public function update(QuestionRequest $request, $id)
    {
        $question = Question::findOrFail($id);
        $question->update([
            'question' => $request->question,
            'score' => $request->score,
        ]);

        $question->answers()->delete();
        $this->createAnswers($question, $request->answer, $request->is_correct);

        return redirect()->route('admin.questions.show', $question->quiz_id)->with('success', transWord('Question updated successfully'));
    }

    public function destroy($id)
    {
        $question = Question::findOrFail($id);
        $question->delete();

        return response()->json(['message' => transWord('Question deleted successfully')]);

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
}
