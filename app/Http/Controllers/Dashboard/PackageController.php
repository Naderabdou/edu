<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Course;
use App\Models\Package;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\PackagesRequest;

class PackageController extends Controller
{
    public function index()
    {
        $packages = Package::latest()->get();
        //dd($packages[0]->courses);
        return view('dashboard.packages.index', compact('packages'));
    }

    public function create()
    {
        $courses = Course::latest()->get();
        return view('dashboard.packages.create', compact('courses'));
    }

    public function store(PackagesRequest $request)
    {

        $data = $request->except('course_id');

        $package = Package::create($data);
        $package->courses()->sync($request->course_id);

        return redirect()->route('admin.packages.index')->with('success', transWord('Package created successfully'));
    }

    public function edit($id)
    {
        $package = Package::findorFail($id);
        $courses = Course::latest()->get();
        return view('dashboard.packages.edit', compact('package', 'courses'));
    }

    public function update(PackagesRequest $request, $id)
    {
        $package = Package::findorFail($id);
        $data = $request->except('course_id');
        $package->update($data);
        $package->courses()->sync($request->course_id);

        return redirect()->route('admin.packages.index')->with('success', transWord('Package updated successfully'));
    }

    public function destroy($id)
    {
        $package = Package::findorFail($id);
        $package->delete();
        return response()->json(['message' => transWord('Package deleted successfully')], 200);

    }


    public function changeStatus(Request $request)
    {
        $package = Package::find($request->id);
        $package->update([
            'is_active' => ! $package->is_active
        ]);
        return response()-> json(['message' => transWord('Status changed successfully')]);
    }
}
