<?php

namespace App\Models;

use App\Models\Course;
use App\Models\TopicCourse;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Lesson extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $appends = ['video_lesson_path', 'pdf_lesson_path'];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function topics()
    {
        return $this->belongsTo(TopicCourse::class, 'topic_id');
    }


    public function getVideoLessonPathAttribute()
    {
        return $this->video_lesson ? asset('storage/' . $this->attributes['video_lesson']) : null;
    }

    public function getPdfLessonPathAttribute()
    {
        return $this->pdf_lesson ? asset('storage/' . $this->attributes['pdf_lesson']) : null;
    }

    public function getTileAttribute()
    {
        return $this->attributes['title_' . app()->getLocale()];
    } // end getNameAttribute


    public function getDescAttribute()
    {
        return $this->attributes['desc_' . app()->getLocale()];
    } // end getDescAttribute


}
