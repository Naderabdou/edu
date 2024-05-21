<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Quiz;
use App\Models\Course;
use App\Models\TopicCourse;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\QuizRequest;

class QuizController extends Controller
{
    public function index()
    {
        $quizzes = Quiz::latest()->get();
        return view('dashboard.quizzes.index', compact('quizzes'));
    }
    public function create()
    {
        $TopicCourse = TopicCourse::where('type', 'quiz')->latest()->get();
        $courses = Course::whereHas('topicCourses')->latest()->get();
        return view('dashboard.quizzes.create', compact('courses', 'TopicCourse'));
    }

    public function store(QuizRequest $request){
        Quiz::create($request->validated());
        return redirect()->route('admin.quizzes.index')->with('success', transWord('quiz created successfully'));
    }

    public function edit($id)
    {
        $quiz = Quiz::findOrFail($id);
        $TopicCourse = TopicCourse::where('type', 'quiz')->latest()->get();
        $courses = Course::whereHas('topicCourses')->latest()->get();
        return view('dashboard.quizzes.edit', compact('quiz', 'courses', 'TopicCourse','quiz'));
    }

    public function update(QuizRequest $request, $id)
    {
        $quiz = Quiz::findOrFail($id);
        $quiz->update($request->validated());
        return redirect()->route('admin.quizzes.index')->with('success', transWord('quiz updated successfully'));
    }

    public function destroy($id)
    {
        $quiz = Quiz::findOrFail($id);
        $quiz->delete();
        return response()->json(['message' => transWord('quiz deleted successfully')]);
    }

    public function show($id){
        return redirect()->route('admin.quizzes.index');
    }
}
