<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\User;
use App\Models\Course;
use Illuminate\Http\Request;
use App\Models\Subscriptions;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\SubscriptionRequest;

class SubscriptionController extends Controller
{
    public function index()
    {
        $subscriptions = Subscriptions::latest()->get();
        return view('dashboard.subscriptions.index', compact('subscriptions'));
    }

    public function create()
    {
        $courses = Course::latest()->get();
        $users = User::whereDoesntHave('roles', function ($query) {
            $query->where('name', 'admin');
        })->latest()->get();

        return view('dashboard.subscriptions.create', compact('courses', 'users'));
    }

    public function store(SubscriptionRequest $request)
    {
        Subscriptions::create($request->validated());
        return redirect()->route('admin.subscriptions.index')->with('success', transWord('subscription has been added successfully'));
    }

    

    public function show($id)
    {

    }

}
