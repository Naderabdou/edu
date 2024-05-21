<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\User;
use Illuminate\Http\Request;
use App\Traits\GlobalFunction;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Dashboard\StudentsRequest;
use App\Http\Requests\Dashboard\InstructorsRequest;

class InstructorController extends Controller
{
    use GlobalFunction;
    public function index()
    {
        $instructors = User::role('instructor')->latest()->get();
        return view('dashboard.instructors.index', compact('instructors'));
    }

    public function create()
    {
        return view('dashboard.instructors.create');
    }


    public function store(InstructorsRequest $request)
    {
        $data = $request->validated();

        $data['user_type'] = 'instructor';

        //   if ($request->hasFile('avatar')) {

        //     $data['avatar'] = $request->file('avatar')->store('instructors', 'public');
        // }

        // if ($request->hasFile('background_image')) {
        //     $data['background_image'] = $request->file('background_image')->store('instructors', 'public');
        // }

        $instructors = User::create($data);
        $instructors->assignRole('instructor');
        return redirect()->route('admin.instructors.index')->with('success', transWord('Instructor created successfully'));
    }

    public function show($id)
    {
        return redirect()->route('admin.instructors.index');
    }

    public function edit($id)
    {
        $instructor = User::role('instructor')->findOrFail($id);
        return view('dashboard.instructors.edit', compact('instructor'));
    }

    public function update(InstructorsRequest $request, $id)
    {

        $instructor = User::role('instructor')->findOrFail($id);
        $data = $request->validated();

        $this->deleteFileIfNotURL($data, 'avatar', $instructor);
        $this->deleteFileIfNotURL($data, 'background_image', $instructor);

        $data['avatar']=  $this->convertURLsToPaths($data['avatar']);
        $data['background_image']=  $this->convertURLsToPaths($data['background_image']);


        $instructor->update($data);
        return redirect()->route('admin.instructors.index')->with('success', transWord('Instructor updated successfully'));
    }


    public function destroy($id)
    {

        $instructor = User::role('instructor')->findOrFail($id);
        if ($instructor->avatar) {
            Storage::disk('public')->delete($instructor->avatar);
        }
        if ($instructor->background_image) {
            Storage::disk('public')->delete($instructor->background_image);
        }
        $instructor->delete();
        return response()->json(['message' => transWord('تم الحذف بنجاح')]);
    }



}
