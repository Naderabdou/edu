<?php

namespace App\Models;

use App\Models\Rate;
use App\Models\User;
use App\Models\Order;
use App\Models\Lesson;
use App\Models\Watched;
use App\Models\Category;
use App\Models\OrderItems;
use App\Models\TopicCourse;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Course extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected $casts = [
        'tags' => 'json',
        'target_audience' => 'json',
        'category_id' => 'array',
        'language' => 'json'
    ];

    //appends
    protected $appends = ['image_path', 'intro_video_path'];

    // public function category(){
    //     return $this->belongsTo(Category::class);
    // }

    public function instructor()
    {
        return $this->belongsTo(User::class);
    }

    public function getTitleAttribute()
    {
        return $this->attributes['title_' . app()->getLocale()];
    }

    public function getSlugAttribute()
    {
        return $this->attributes['slug_' . app()->getLocale()];
    }
    public function getAboutAttribute()
    {
        return $this->attributes['about_' . app()->getLocale()];
    }
    //requir_en
    public function getRequirementsAttribute()
    {
        return $this->attributes['requirements_' . app()->getLocale()];
    }
    //desc
    public function getDescAttribute()
    {
        return $this->attributes['desc_' . app()->getLocale()];
    }

    //image
    public function getImagePathAttribute()
    {
        return $this->image ? asset('storage/' . $this->attributes['image']) : asset('dashboard/images/avatar.jpg');
    }

    public function getIntroVideoPathAttribute()
    {
        return $this->intro_video ? asset('storage/' . $this->attributes['intro_video']) : null;
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_courses', 'course_id', 'category_id');
    }

    public function topicCourses()
    {
        return $this->hasMany(TopicCourse::class);
    }


    // public function scopeFilter($query , $request)
    // {
    //     if (request('search')) {
    //         $query->where('title_en', 'like', '%' . request('search') . '%')
    //             ->orWhere('title_ar', 'like', '%' . request('search') . '%');
    //     }
    //     if (request('category_id')) {
    //         $query->whereHas('categories', function ($query) use ($request) {
    //             $query->where('category_id', $request->category_id);
    //         });
    //     }

    //     if (request('instructor_id')) {
    //         $query->where('instructor_id', $request->instructor_id);
    //     }
    //     if (request('rate')) {
    //         $query->whereHas('rate', function ($query) use ($request) {
    //             $query->where('rate', $request->rate);
    //         });
    //     }
    //     if (request('price_from') && request('price_to')) {
    //         dd('price_from');
    //         $query->whereBetween('price', [request('price_from'), request('price_to')]);
    //     }
    //     if (request('price_from')) {
    //         dd('price_from');
    //         $query->where('price', '>=', request('price_from'));
    //     }
    //     if (request('price_to')) {
    //         $query->where('price', '<=', request('price_to'));
    //     }
    //     if (request('tags')) {
    //         dd('tags');
    //         $query->whereJsonContains('tags', request('tags'));
    //     }
    //     if (request('target_audience'))
    //         dd('target_audience'); {
    //         $query->whereJsonContains('target_audience', request('target_audience'));
    //     }
    //     if (request('language')) {
    //         dd('language');
    //         $query->whereJsonContains('language', request('language'));
    //     }
    //     if (request('sort')) {
    //         dd('sort');
    //         if (request('sort') == 'asc') {
    //             $query->orderBy('price', 'asc');
    //         } elseif (request('sort') == 'desc') {
    //             $query->orderBy('price', 'desc');
    //         }
    //     }
    //     return $query;
    // }

    public function orders()
    {
        return $this->hasManyThrough(Order::class, OrderItems::class, 'course_id', 'id', 'id', 'order_id');
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItems::class);
    }
    public function favorites()
    {
        return $this->belongsToMany(User::class, 'favorites', 'course_id', 'user_id');
    }

    public function lessons()
    {
        return $this->hasMany(Lesson::class);
    }

    public function rate()
    {
        return $this->hasMany(Rate::class, 'course_id', 'id');
    }
    public function watched()
    {
        return $this->hasMany(Watched::class, 'course_id', 'id');
    }

    public function getTotalPriceAttribute($value)
    {
        if ($this->discount != null && $this->discount > 0) {
            return $this->price_after_discount;
        } else {
            return $this->price;
        }
    }

    // public function sluggable(): array
    // {
    //     return [
    //         'slug' => [
    //             'source' => 'name_en'
    //         ]
    //     ];
    // }
}
