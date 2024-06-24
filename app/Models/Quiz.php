<?php

namespace App\Models;

use App\Models\User;
use App\Models\Course;
use App\Models\Question;
use App\Models\TopicCourse;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Quiz extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function getNameAttribute()
    {
        return $this->attributes['name_' . app()->getLocale()];
    }

    public function topic()
    {
        return $this->belongsTo(TopicCourse::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    //set timer quiz
    public function getTimerAttribute($value)
    {
        return date('H:i', strtotime($value));
    }

    public function user(){
        return $this->belongsToMany(User::class, 'user_quizzes','quiz_id','user_id')->withPivot('score','total_score','is_passed','total_ques');
    }


}
