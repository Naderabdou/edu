<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

     protected $fillable = ['name_en', 'name_ar', 'image'];

    protected $appends = ['image_path'];



  // get name translation
  public function getNameAttribute()
  {
      return $this->attributes['name_' . app()->getLocale()];
  } // end getNameAttribute

    public function getImagePathAttribute()
    {
        return asset('storage/' . $this->attributes['image']);
    }


    // get slug translation
    public function getSlugAttribute()
    {
        return $this->attributes['slug_' . app()->getLocale()];
    } // end getNameAttribute

    public function courses()
{
    return $this->belongsToMany(Course::class, 'category_courses', 'category_id', 'course_id');
}


}
