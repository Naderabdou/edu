<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Course;
use App\Models\Lesson;
use App\Models\TopicCourse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Dashboard\LessonRequest;
use App\Traits\GlobalFunction;

class LessonController extends Controller
{
    use GlobalFunction;
    public function index()
    {
        $lessons = Lesson::latest()->get();
        return view('dashboard.lessons.index', compact('lessons'));
    }



    public function create()
    {
        $TopicCourse = TopicCourse::where('type', 'lesson')->latest()->get();
        $courses = Course::whereHas('topicCourses')->latest()->get();
        return view('dashboard.lessons.create', compact('courses', 'TopicCourse'));
    }

    public function store(LessonRequest $request)
    {

        Lesson::create($request->validated());
        return redirect()->route('admin.lessons.index')->with('success', transWord('lesson has been added successfully'));
    }

    public function edit($id)
    {
        $lesson = Lesson::findOrFail($id);
        $TopicCourse = TopicCourse::where('type', 'lesson')->latest()->get();
        $courses = Course::whereHas('topicCourses')->latest()->get();
        return view('dashboard.lessons.edit', compact('lesson', 'courses', 'TopicCourse'));
    }

    public function update(LessonRequest $request, $id)
    {
        $lesson = Lesson::findOrFail($id);
        $data = $request->validated();
        $this->deleteFileIfNotURL($data, 'video_lesson', $lesson);
        $this->deleteFileIfNotURL($data, 'pdf_lesson', $lesson);

        $data['video_lesson'] =  $this->convertURLsToPaths($data['video_lesson']);
        $data['pdf_lesson'] =  $this->convertURLsToPaths($data['pdf_lesson']);
        $lesson->update($data);
        return redirect()->route('admin.lessons.index')->with('success', transWord('lesson has been updated successfully'));
    }

    public function destroy($id)
    {
        $lesson = Lesson::findOrFail($id);
        if ($lesson->video_lesson) {
            Storage::disk('public')->delete($lesson->video_lesson);;
        }

        if ($lesson->pdf_lesson) {
            Storage::disk('public')->delete($lesson->pdf_lesson);
        }
        $lesson->delete();

        return response()->json(['message' => transWord('lesson has been deleted successfully'), 'status' => 'success']);

    }


    public function topices(Request $request)
    {
        $topics = TopicCourse::where('course_id', $request->id)->get();
        return response()->json($topics);
    }

    public function show($id){
        return redirect()->route('admin.lessons.index');
    }
}
