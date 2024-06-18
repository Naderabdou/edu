<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Review;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Dashboard\ReviewRequest;

class ReviewController extends Controller
{
    public function index()
    {
        $reviews = Review::all();
        return view('dashboard.reviews.index', compact('reviews'));
    }

    public function create()
    {
        return view('dashboard.reviews.create');
    }

    public function store(ReviewRequest $request)
    {
        $data = $request->validated();
        if ($request->hasFile('image')) {


            $data['image'] = $request->file('image')->store('reviews', 'public');
        }

        Review::create($data);



        return redirect()->route('admin.reviews.index')->with('success', transWord('تم اضافة التقييم بنجاح'));
    }

    public function edit($id)
    {
        $review = Review::findOrFail($id);
        return view('dashboard.reviews.edit', compact('review'));
    }

    public function update(ReviewRequest $request, $id)
    {

        $review = Review::findOrFail($id);

        $data = $request->validated();

        if ($request->hasFile('image')) {
            if ($review->image) {
                Storage::disk('public')->delete($review->image);
            }
            $data['image'] = $request->file('image')->store('reviews', 'public');
        }

        $review->update($data);

        return redirect()->route('admin.reviews.index')->with('success', transWord('تم تعديل التقييم بنجاح'));
    }

    public function destroy($id)
    {

        $review = Review::findOrFail($id);
        if ($review->image) {
            Storage::disk('public')->delete($review->image);
        }
        $review->delete();
        return response()->json(['message' => transWord('تم الحذف بنجاح')]);
    }

    public function show()
    {
        return redirect()->route('admin.reviews.index');
    }
}
