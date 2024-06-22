<?php

namespace App\Models;

use App\Models\Course;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Package extends Model
{
    use HasFactory;
    protected $fillable = [
        'name_en',
        'name_ar',
        'price',
        'type',
        'features_en',
        'features_ar',
        'flaw_en',
        'flaw_ar',
        'duration',
        'is_active',
    ];

    public function scopeMonthly($query)
    {
        return $query->where('type', 'monthly');
    }

    public function scopeYearly($query)
    {
        return $query->where('type', 'yearly');
    }

    public function getNameAttribute()
    {
        return $this->attributes['name_' . app()->getLocale()];
    } // end getNameAttribute

    public function getFeaturesAttribute()
        {
            return $this->attributes['features_' . app()->getLocale()];
        } // end getNameAttribute
    public function getFlawAttribute(){
        return $this->attributes['flaw_' . app()->getLocale()];
    }

    public function courses()
    {
        return $this->belongsToMany(Course::class, 'package_courses', 'package_id', 'course_id');
    }



}
