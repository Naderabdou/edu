<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\User;
use App\Models\Course;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CeckController extends Controller
{
    public function checkUsername(Request $request)
    {
        return $this->checkRecordExists('User', 'username', $request->username, $request, 'اسم المستخدم مستخدم بالفعل');
    }

    public function checkEmail(Request $request)
    {
        return $this->checkRecordExists('User', 'email', $request->email, $request, 'البريد الالكتروني مستخدم بالفعل');
    }

    public function checkPhone(Request $request)
    {
        return $this->checkRecordExists('User', 'phone', $request->phone, $request, 'رقم الهاتف مستخدم بالفعل');
    }


    //checkSlug
    public function checkSlug(Request $request)
    {
        return $this->checkRecordExists('Course', 'slug_en', $request->slug_en, $request, 'الاسم المستعار مستخدم بالفعل');
    }












    public function checkName(Request $request)
    {

        if ($request->name_ar) {
            return $this->checkRecordExists('Category', 'name_ar', $request->name_ar, $request, 'اسم القسم بالعربي مستخدم بالفعل');
        }

        if ($request->name_en) {
            return $this->checkRecordExists('Category', 'name_en', $request->name_en, $request, 'اسم القسم بالانجليزي مستخدم بالفعل');
        }
    }

    private function checkRecordExists($model, $field, $value, $request, $message)
    {
        $query = 'App\Models\\' . $model;
        $query = new $query;

        if ($request->id) {
            if ($query->where($field, $value)->where('id', '!=', $request->id)->exists()) {
                return response()->json(['message' => transWord($message)]);
            }
        } else {
            if ($query->where($field, $value)->exists()) {
                return response()->json(['message' => transWord($message)]);
            }
        }

        return response()->json(true);
    }

    // private function checkSlugCourses($request,  $attribute, $message)
    // {
    //     if ($request->id) {
    //         if (Course::where($attribute, $request->$attribute)->where('id', '!=', $request->id)->exists()) {
    //             return response()->json(['message' => transWord($message)]);
    //         }
    //     } else {
    //         if (Course::where($attribute, $request->$attribute)->exists()) {
    //             return response()->json(['message' => transWord($message)]);
    //         }
    //     }

    //     return response()->json(true);
    // }


    // public function checkAttributeExists(Request $request, $attribute, $message)
    // {
    //     if ($request->id) {
    //         if (User::where($attribute, $request->$attribute)->where('id', '!=', $request->id)->exists()) {
    //             return response()->json(['message' => transWord($message)]);
    //         }
    //     } else {
    //         if (User::where($attribute, $request->$attribute)->exists()) {
    //             return response()->json(['message' => transWord($message)]);
    //         }
    //     }



    //     return response()->json(true);
    // }

    // private function checkCategoryExists($field, $value, $request, $message)
    // {

    //     if ($request->id) {
    //         if (Category::where($field, $value)->where('id', '!=', $request->id)->exists()) {
    //             return response()->json(['message' => transWord($message)]);
    //         }
    //     } else {

    //         if (Category::where($field, $value)->exists()) {
    //             return response()->json(['message' => transWord($message)]);
    //         }
    //     }

    //     return response()->json(true);
    // }
}
