<?php

namespace App\Models;

use App\Models\User;
use App\Models\Lesson;
use App\Models\Watched;
use App\Models\Category;
use App\Models\TopicCourse;
use Illuminate\Database\Eloquent\Model;
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

    public function instructor(){
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

    public function users()
    {
        return $this->belongsToMany(User::class, 'subscriptions', 'course_id', 'user_id');
    }

    public function lessons()
    {
        return $this->hasMany(Lesson::class);
    }

    public function rate()
    {
        return $this->hasMany(Rate::class, 'course_id', 'id');
    }
    public function watched(){
        return $this->hasMany(Watched::class,'course_id','id');
    }
}
