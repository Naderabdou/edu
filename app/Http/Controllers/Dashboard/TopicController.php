<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Course;
use App\Models\TopicCourse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\TopicRequest;

class TopicController extends Controller
{
    public function index()
    {
        $topics = TopicCourse::latest()->get();
        return view('dashboard.topics.index', compact('topics'));
    }


    public function create()
    {
        $courses = Course::all();
        return view('dashboard.topics.create', compact('courses'));
    }

    public function store (TopicRequest $request)
    {
        TopicCourse::create($request->validated());
        return redirect()->route('admin.topics.index')->with('success', transWord('topic created successfully'));

    }

    public function edit($id)
    {
        $topic = TopicCourse::find($id);
        $courses = Course::all();
        return view('dashboard.topics.edit', compact('topic', 'courses'));
    }

    public function update(TopicRequest $request, $id){
        $data = $request->validated();
         $topic = TopicCourse::find($id);

        $topic->update($data);

        return redirect()->route('admin.topics.index')->with('success', transWord('topic updated successfully'));


    }

    public function destroy($id)
    {
        $topic = TopicCourse::find($id);
        $topic->delete();
        return response()->json(['message' => 'deleted successfully'], 200);
}

public function show($id){
    return redirect()->route('admin.topics.index');

}
}
