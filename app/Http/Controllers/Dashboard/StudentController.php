<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\User;
use Illuminate\Http\Request;
use App\Traits\GlobalFunction;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Dashboard\StudentsRequest;

class StudentController extends Controller
{
    use GlobalFunction;
    public function index()
    {
        $students = User::role('student')->latest()->get();
       return view('dashboard.students.index', compact('students'));
    }

    public function create()
    {
        return view('dashboard.students.create');
    }


    public function store(StudentsRequest $request)
    {
          $data = $request->validated();



        $student = User::create($data);
        $student->assignRole('student');
        return redirect()->route('admin.students.index')->with('success', transWord('Student created successfully'));
    }

    public function show($id)
    {
        return redirect()->route('admin.students.index');

    }

    public function edit($id)
    {
        $student = User::role('student')->findOrFail($id);
        return view('dashboard.students.edit', compact('student'));
    }

    public function update(StudentsRequest $request, $id)
    {

        $student = User::role('student')->findOrFail($id);
        $data = $request->validated();


        $this->deleteFileIfNotURL($data, 'avatar', $student);
        $this->deleteFileIfNotURL($data, 'background_image', $student);

        $data['avatar']=  $this->convertURLsToPaths($data['avatar']);
        $data['background_image']=  $this->convertURLsToPaths($data['background_image']);


        


        $student->update($data);
        return redirect()->route('admin.students.index')->with('success', transWord('Student updated successfully'));
    }


    public function destroy($id)
    {

        $student = User::role('student')->findOrFail($id);
        if (Storage::disk('public')->exists($student->avatar)) {
            Storage::disk('public')->delete($student->avatar);
        }

        if (Storage::disk('public')->exists($student->background_image)) {
            Storage::disk('public')->delete($student->background_image);
        }

        $student->delete();
        return response()->json(['message' => transWord('تم الحذف بنجاح')]);
   }







}

