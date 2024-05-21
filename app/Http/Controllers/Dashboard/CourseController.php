<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\User;
use App\Models\Course;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Traits\GlobalFunction;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Dashboard\CourseRequest;

class CourseController extends Controller
{
    use GlobalFunction;
    public function index()
    {
        $courses = Course::latest()->get();
        return view('dashboard.courses.index', compact('courses'));
    }

    public function create()
    {
        $categories = Category::all();
        $instructors = User::role('instructor')->latest()->get();

        return view('dashboard.courses.create', compact('categories', 'instructors'));
    }

    public function store(CourseRequest $request)
    {
        $data = $request->validated();
        $categories = $data['category_id'];
        unset($data['category_id'], $data['upload_vidoe'], $data['youtube_url'], $data['vimeo_url']);



        if ($request->intro_video_type == 'upload') {
            $data['intro_video'] = $request->upload_vidoe;
        } elseif ($request->intro_video_type == 'youtube') {
            $data['intro_video'] = $request->youtube_url;
        } elseif ($request->intro_video_type == 'vimeo') {
            $data['intro_video'] = $request->vimeo_url;
        }

        $data['type_course'] = $request->price ? 'paid' : 'free';


        $course = Course::create($data);
        $course->categories()->sync($categories);

        return redirect()->route('admin.courses.index')->with('success', transWord('Course created successfully'));
    }

    public function edit($id)
    {
        $categories = Category::all();
        $instructors = User::role('instructor')->latest()->get();
        $course = Course::findorFail($id);

        return view('dashboard.courses.edit', compact('categories', 'instructors', 'course'));
    }

    public function update(CourseRequest $request, $id)
    {

        $data = $request->validated();
        $course = Course::findOrFail($id);
        $categories = $data['category_id'];
        $data['intro_video'] = $this->getIntroVideo($request, $data, $course);
        $data['image'] = $this->getImage($request, $data, $course);
        $data['type_course'] = $request->price ? 'paid' : 'free';
        $course->update($data);
        $course->categories()->sync($categories);

        return redirect()->route('admin.courses.index')->with('success', transWord('Course updated successfully'));
    }


    
    public function destroy($id)
    {
        $course = Course::findorFail($id);
        if ($course->image) {
            Storage::disk('public')->delete($course->image);
        }
        if ($course->intro_video_type == 'upload') {
            if ($course->intro_video) {
                Storage::disk('public')->delete($course->intro_video);
            }
        }

        $course->delete();
        return response()->json(['message' => transWord('تم الحذف بنجاح')]);
    }

    public function show($id)
    {
        return redirect()->route('admin.courses.index');
    }

    private function getIntroVideo($request, &$data, $course)
    {
        unset($data['upload_vidoe'], $data['youtube_url'], $data['vimeo_url'], $data['category_id']);

        switch ($request->intro_video_type) {
            case 'upload':
                $video = $request->upload_vidoe;
                $data['intro_video'] = $video;
                $this->deleteFileIfNotURL($data, 'intro_video', $course);
                return $this->convertURLsToPaths($video);
            case 'youtube':
                return $request->youtube_url;
            case 'vimeo':
                return $request->vimeo_url;
            default:
                return null;
        }
    }

    private function getImage($request, &$data, $course)
    {


        $this->deleteFileIfNotURL($data, 'image', $course);
        return $this->convertURLsToPaths($request->image);
    }
}
