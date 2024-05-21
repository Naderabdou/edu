<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Traits\GlobalFunction;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Dashboard\CategoryRequest;

class CategoryController extends Controller
{
    use GlobalFunction;
    public function index()
    {
        $categories = Category::latest()->get();
        return view('dashboard.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('dashboard.categories.create');
    }

    public function store(CategoryRequest $request)
    {

        $data = $request->validated();


        Category::create($data);

        return redirect()->route('admin.categories.index')->with('success', transWord('Category created successfully'));
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('dashboard.categories.edit', compact('category'));
    }

    public function update(CategoryRequest $request, $id)
    {
        $category = Category::findOrFail($id);

        $data = $request->validated();

        $this->deleteFileIfNotURL($data, 'image', $category);

        $data['image'] = $this->convertURLsToPaths($data['image']);


        $category->update($data);

        return redirect()->route('admin.categories.index')->with('success', transWord('Category updated successfully'));
    }

    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        if ($category->image){
            Storage::disk('public')->delete($category->image);
        }
        $category->delete();
        return response()->json(['message' => transWord('تم الحذف بنجاح')]);
    }
    public function show($id){
        return redirect()->route('admin.categories.index');
    }




}
