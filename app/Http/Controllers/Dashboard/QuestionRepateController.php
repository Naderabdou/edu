<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\QuestionRepate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\QuestionRepateRequest;

class QuestionRepateController extends Controller
{
    public function index()
    {
        $questions = QuestionRepate::all();
        return view('dashboard.questionsRepate.index', compact('questions'));
    }


    public function create()
    {
        return view('dashboard.questionsRepate.create');
    }

    public function store(QuestionRepateRequest $request)
    {
        QuestionRepate::create($request->validated());
        return redirect()->route('admin.questionsRepate.index')->with('success', transWord('Question created successfully'));
    }

    public function edit(QuestionRepateRequest $question)
    {
        return view('dashboard.questionsRepate.edit', compact('question'));
    }

    public function update(QuestionRepateRequest $request , QuestionRepate $question){
             $question->update($request->validated());
             return redirect()->route('admin.questionsRepate.index')->with('success', transWord('Question updated successfully'));
    }

    public function destroy(QuestionRepate $question)
    {
        $question->delete();
        return response()->json(['message' => transWord('Question deleted successfully')] , 200);
    }

    public function show($id){
        return redirect()->route('admin.questionsRepate.index');
    }
}
