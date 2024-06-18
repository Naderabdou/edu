<?php

namespace App\Http\Controllers\Api;

use App\Models\Lesson;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Api\LessonsRequest;
use App\Models\TopicCourse;

class LessonController extends Controller
{
    // public function index()
    // {

    //     $instractor = $this->getUserOrError();
    //     if ($instractor instanceof JsonResponse) return $instractor;


    // }

    public function store(LessonsRequest $request)
    {

        $instractor = $this->getUserOrError();
        if ($instractor instanceof JsonResponse) return $instractor;

        $data = $request->validated();

        if (!$instractor->courses()->find($data['course_id'])) {
            return $this->ApiResponse(null, transWord('هذه الدورة ليست ملك لك'), 401);
        }
        $topic = TopicCourse::where('type', 'lesson')->find($data['topic_id']);

        if (!$topic) {

            return $this->ApiResponse(null, transWord('هذا الموضوع ليس درس'), 401);
        }

        $files = ['video_lesson', 'pdf_lesson'];

        foreach ($files as $file) {
            if ($request->hasFile($file)) {
                $data[$file] = $request->file($file)->store('lessons', 'public');
            }
        }
        $lesson = Lesson::create($data);

        return $this->ApiResponse(null, transWord('تم اضافة الدرس بنجاح'));
    }

    public function update(LessonsRequest $request, $id)
    {
        $instractor = $this->getUserOrError();
        if ($instractor instanceof JsonResponse) return $instractor;

        $lesson = Lesson::find($id);
        if (!$lesson) {
            return $this->ApiResponse(null, transWord('هذا الدرس غير موجود'), 404);
        }

        if (!$instractor->courses()->find($lesson->course_id)) {
            return $this->ApiResponse(null, transWord('هذه الدورة ليست ملك لك'), 401);
        }

        $topic = TopicCourse::where('type', 'lesson')->find($data['topic_id']);

        if (!$topic) {

            return $this->ApiResponse(null, transWord('هذا الموضوع ليس درس'), 401);
        }

        $data = $request->validated();

        if ($request->hasFile('video_lesson')) {
            if ($lesson->video_lesson) {
                Storage::disk('public')->delete($lesson->video_lesson);
            }
            $data['video_lesson'] = $request->file('video_lesson')->store('lessons', 'public');
        }

        if ($request->hasFile('pdf_lesson')) {
            if ($lesson->pdf_lesson) {
                Storage::disk('public')->delete($lesson->pdf_lesson);
            }
            $data['pdf_lesson'] = $request->file('pdf_lesson')->store('lessons', 'public');
        }

        $lesson->update($data);

        return $this->ApiResponse(null, transWord('تم تعديل الدرس بنجاح'));
    }

    public function destroy($id)
    {
        $instractor = $this->getUserOrError();
        if ($instractor instanceof JsonResponse) return $instractor;

        $lesson = Lesson::find($id);
        if (!$lesson) {
            return $this->ApiResponse(null, transWord('هذا الدرس غير موجود'), 404);
        }

        if (!$instractor->courses()->find($lesson->course_id)) {
            return $this->ApiResponse(null, transWord('هذه الدورة ليست ملك لك'), 401);
        }

        if ($lesson->video_lesson) {
            Storage::disk('public')->delete($lesson->video_lesson);
        }
        if ($lesson->pdf_lesson) {
            Storage::disk('public')->delete($lesson->pdf_lesson);
        }

        $lesson->delete();

        return $this->ApiResponse(null, transWord('تم حذف الدرس بنجاح'));
    }

    public function show($id)
    {
        $instractor = $this->getUserOrError();
        if ($instractor instanceof JsonResponse) return $instractor;

        $lesson = Lesson::find($id);
        if (!$lesson) {
            return $this->ApiResponse(null, transWord('هذا الدرس غير موجود'), 404);
        }

        if (!$instractor->courses()->find($lesson->course_id)) {
            return $this->ApiResponse(null, transWord('هذه الدورة ليست ملك لك'), 401);
        }

        return $this->ApiResponse($lesson);
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
